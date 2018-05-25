<?php
class flowDb
{
    /**
     * Execute INSERT sql query
     * @param array array('sqlField' => 'fieldContent');
     * @return void
     */
    public function addElements($id, $obj) // array = links to add (array key[] = array key = fields, value = values)
    {
        if (is_object($obj)) {
            if (count($obj) > 0) {
                if (count($obj->entry) > 0) {
                    $query     = 'INSERT INTO flow (sharer, link_hash, link, title, content, tags, permalink, published, updated, first_share, id)
                        VALUES (:sharer, :link_hash, :link, :title, :content, :tags, :permalink,  :published, :updated, :first_share, :id);';
                    $stmt = dbConnexion::getInstance()->prepare($query);
                    $stmt->bindParam(':sharer', $sharer, PDO::PARAM_INT);
                    $stmt->bindParam(':link_hash', $link_hash, PDO::PARAM_STR);
                    $stmt->bindParam(':link', $link, PDO::PARAM_STR);
                    $stmt->bindParam(':title', $title, PDO::PARAM_STR);
                    $stmt->bindParam(':content', $content, PDO::PARAM_STR);
                    $stmt->bindParam(':tags', $taglist, PDO::PARAM_STR);
                    $stmt->bindParam(':permalink', $permalink, PDO::PARAM_STR);
                    $stmt->bindParam(':published', $published, PDO::PARAM_STR);
                    $stmt->bindParam(':updated', $updated, PDO::PARAM_STR);
                    $stmt->bindParam(':first_share', $firstShare, PDO::PARAM_STR);
                    $stmt->bindParam(':id', $smallHash, PDO::PARAM_STR);

                    foreach($obj->entry as $entry) {
                        if (count($entry->category) > 0) { // Insert or update tag table if tag exist
                            $tags = '';
                            $tQuery = "INSERT INTO tags(tag)
                                VALUES (:tag) ON DUPLICATE KEY UPDATE hits = hits+1;";
                            $tStmt = dbConnexion::getInstance()->prepare($tQuery);
                            $tStmt->bindParam(':tag', $tag, PDO::PARAM_STR);
                            foreach($entry->category as $elements) {
                                $tag = trim($elements['term']);
                                $tStmt->execute();
                                $tags .= $elements['term'] . ' ';
                            }
                            $tStmt->closeCursor();
                            $tStmt = NULL;
                        }
                        $origin    = $this->linkNotExists($entry->link['href']);
                        $permalink = substr($entry->id, -6);
                        $published = substr($entry->published, 0, -6);
                        $updated   = substr($entry->updated, 0, -6);
                        $sharer    = $id;
                        $link_hash = is_int($origin) ? NULL : $origin;
                        $link      = $entry->link['href'];
                        $title     = $entry->title;
                        $content   = $entry->content;
                        $taglist   = isset($tags) ? $tags : '';
                        $permalink = substr($entry->id, -6);
                        $published = substr($entry->published, 0, -6);
                        $updated   = substr($entry->updated, 0, -6);
                        $firstShare = is_int($origin) ? $origin : '';
                        $smallHash = $this->smallHash(rand() . $permalink);
                        $stmt->execute();
                    }
                    $stmt->closeCursor();
                    $stmt = NULL;
                }
            }
        }
    }

    private function linkNotExists($uri)
    {
        $return = '';
        if (!empty($uri)) {
            $hash = md5($uri);
            $query = 'SELECT sharer FROM flow WHERE link_hash = :hash ORDER BY published ASC LIMIT 1;';
            $stmt  = dbConnexion::getInstance()->prepare($query);
            $stmt->bindValue(':hash', $hash, PDO::PARAM_STR);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_OBJ);
            $stmt->closeCursor();
            $stmt = NULL;
            if (count($result) === 0) {
                $return = $hash;
            }
            else {
                $return = (int)$result[0]->sharer;
            }
        }
        return $return;
    }

    public function getSharers()
    {
        $query = 'SELECT id, title, updated, feed, uri FROM sharers;';
        $stmt  = dbConnexion::getInstance()->prepare($query);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_OBJ);
        $stmt->closeCursor();
        $stmt = NULL;
        return $result;
    }

    /**
     * SmallHash via shaarli (sebsauvage)
     * @param  string $string [description]
     * @return string $hash   [description]
     */
    private function smallHash($string)
    {
        $hash = rtrim(base64_encode(hash('crc32', $string, TRUE)), '=');
        $hash = str_replace('+', '-', $hash); // Get rid of characters which need encoding in URLs.
        $hash = str_replace('/', '_', $hash);
        $hash = str_replace('=', '@', $hash);
        return $hash;
    }

    public function addSharer($obj)
    {
        if (is_object($obj)) {
            $query = 'INSERT INTO sharers (title, subtitle, updated, feed, author, uri)
                VALUES (:title, :subtitle, :updated, :feed, :author, :uri);';
            $stmt = dbConnexion::getInstance()->prepare($query);
            $stmt->bindParam(':title', $title, PDO::PARAM_STR);
            $stmt->bindParam(':subtitle', $subtitle, PDO::PARAM_STR);
            $stmt->bindParam(':updated', $updated, PDO::PARAM_STR);
            $stmt->bindParam(':feed', $feed, PDO::PARAM_STR);
            $stmt->bindParam(':author', $author, PDO::PARAM_STR);
            $stmt->bindParam(':uri', $uri, PDO::PARAM_STR);

            $title    = $obj->title;
            $subtitle = $obj->subtitle;
            $updated  = $obj->updated;
            $feed     = $obj->author->uri . '?' . http_build_query(['do' => 'atom']);
            $author   = $obj->author->name;
            $uri      = $obj->author->uri;
            $stmt->execute();
            $stmt->closeCursor();
            $stmt = NULL;
        }
    }
}
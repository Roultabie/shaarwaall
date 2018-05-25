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
        $elements = $this->objectToArray($obj);
        if (is_array($elements)) {
            foreach ($elements as $datas) {
                // Insert or update tag table if tag exist
                if (!empty($datas['tags'])) {
                    if (is_array($tags)) {
                        foreach ($tags as $value) {
                            $tQuery = "INSERT INTO " . self::$tblPrefix . "tags(tag)
                                        VALUES (:tag)
                                        ON DUPLICATE KEY UPDATE hits = hits+1;";
                            $tStmt = dbConnexion::getInstance()->prepare($tQuery);
                            $tStmt->bindValue(':tag', trim($value), PDO::PARAM_STR);
                            $tStmt->execute();
                        }
                    }
                }
                $stmt = dbConnexion::getInstance()->prepare('INSERT INTO flow
                    (sharer, link_hash, link, title, content, tags, permalink, published, updated, first_share)
                    VALUES (:sharer, :link_hash, :link, :title, :content, :tags, :permalink,  :published, :updated :first_share);');
                $stmt->bindValue(':sharer', $id, PDO::PARAM_INT);
                if (empty($datas['link_hash'])) {
                    $stmt->bindValue(':link_hash', '', PDO::PARAM_NULL);
                }
                else {
                    $stmt->bindValue(':link_hash', $datas['link_hash'], PDO::PARAM_STR);
                }
                $stmt->bindValue(':link', $datas['link'], PDO::PARAM_STR);
                $stmt->bindValue(':title', $datas['title'], PDO::PARAM_STR);
                $stmt->bindValue(':content', $datas['content'], PDO::PARAM_STR);
                $stmt->bindValue(':tags', $datas['tags'], PDO::PARAM_STR);
                $stmt->bindValue(':permalink', $datas['permalink'], PDO::PARAM_STR);
                $stmt->bindValue(':published', $published, PDO::PARAM_STR);
                $stmt->bindValue(':updated', $updated, PDO::PARAM_STR);
                $stmt->bindValue(':first_share', $firstShare, PDO::PARAM_STR);
                $stmt->execute();
            }
        }
    }

    private function objectToArray($obj)
    {
        if (is_object($obj)) {
            if (count($obj) > 0) {
                $sharer['title'] = $obj->title;
                $sharer['subtitle'] = $obj->subtitle;
                $sharer['updated'] = $obj->updated;
                $sharer['feed'] = $obj->feed;
                $sharer['author'] = $obj->author;
                $sharer['uri'] = $obj->id;
                if (count($obj->entry) > 0) {
                    foreach($obj->entry as $entry) {
                        if (count($entry->category) > 0) {
                            foreach($entry->category as $elements) {
                                $tags = $elements['term'];
                            }
                        }
                        $link      = $entry->{'@attributes'}->href;
                        $link_hash = $this->linkNotExists($link);
                        $permalink = substr($entry->id, -6);
                        $published = substr($entry->published, 0, -6);
                        $updated   = substr($entry->updated, 0, -6);
                        $sharer['datas'][] = ['title'     => $entry->title,
                                              'link'      => $link,
                                              'permalink' => $permalink,
                                              'published' => $published,
                                              'updated'   => $updated,
                                              'content'   => $entry->content,
                                              'tags'      => $tags,];
                    }
                }
            }
        }
        return $sharer;
    }

    private function linkNotExists($uri)
    {
        $exists = '';
        if (!empty($uri)) {
            $hash = md5sums($uri);
            $query = 'SELECT link_hash FROM flow WHERE link_hash = :hash ORDER BY published ASC LIMIT 1;';
            $stmt  = dbConnexion::getInstance()->prepare($query);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_OBJ);
            $stmt->closeCursor();
            $stmt = NULL;
            //var_dump($query);
            if (!is_object($result)) {
                $exists = $hash;
            }
        }
        return $exists;
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
}
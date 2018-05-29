<?php
class flowDb
{
    /**
     * Execute INSERT sql query
     * @param array array('sqlField' => 'fieldContent');
     * @return void
     */

    function __construct()
    {
        //$this->causes
    }
    public function addElements($id, $obj) // array = links to add (array key[] = array key = fields, value = values)
    {
        if (is_object($obj)) {
            if (count($obj) > 0) {
                if (count($obj->entry) > 0) {
                    $query = 'INSERT INTO flow (sharer, link_hash, link, title, content, tags, permalink, published, updated, first_share, id)
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

                    $pQuery = 'INSERT INTO flow_pending (sharer, updated, object, hash)
                               VALUES (:pSharer, NOW(), :pObject, :pHash)
                               ON DUPLICATE KEY UPDATE updated = NOW();';
                    $pStmt = dbConnexion::getInstance()->prepare($pQuery);
                    $pStmt->bindParam(':pSharer', $pSharer, PDO::PARAM_STR);
                    $pStmt->bindParam(':pObject', $pObject, PDO::PARAM_STR);
                    $pStmt->bindParam(':pHash', $pHash, PDO::PARAM_STR);
                    $pending = false;

                    foreach($obj->entry as $entry) {
                        if (count($entry->category) > 0) { // Insert or update tag table if tag exist
                            $tags = '';
                            $tQuery = "INSERT INTO tags(tag)
                                       VALUES (:tag) ON DUPLICATE KEY UPDATE hits = hits+1;";
                            $tStmt = dbConnexion::getInstance()->prepare($tQuery);
                            $tStmt->bindParam(':tag', $tag, PDO::PARAM_STR);
                            foreach($entry->category as $elements) {
                                $tag = trim($elements['term']);
                                //$tStmt->execute();
                                $tags .= $elements['term'] . ' ';
                            }
                            $tStmt->closeCursor();
                            $tStmt = NULL;
                        }
                        $sharer     = $id;
                        $link_hash  = md5($entry->link['href']);
                        $link       = $entry->link['href'];
                        $title      = $entry->title;
                        $content    = $entry->content;
                        $taglist    = isset($tags) ? $tags : '';
                        $permalink  = self::urlToPermalink($entry->id);
                        $published  = self::dateAtomtoSQL($entry->published);
                        $updated    = self::dateAtomtoSQL($entry->updated);
                        $firstShare = '';
                        $smallHash  = $this->smallHash(rand() . $permalink);
                        $origin     = $this->ifReShared($entry);
                        if (is_array($origin)) {
                            if ($origin['shared'] === false) {
                                $pSharer = $id;
                                $pObject = json_encode($entry);
                                $pHash   = md5($pObject);
                                $pending = true;
                                $pStmt->execute();
                            }
                            else {
                                $firstShare = $origin['shared'];
                                $stmt->execute();
                            }
                        }
                        else {
                            $stmt->execute();
                        }
                    }
                    $stmt->closeCursor();
                    $pStmt->closeCursor();
                    $stmt = NULL;
                }
            }
        }
        return $pending;
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
                $return = false;
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

    private function ifReShared($obj)
    {
        if (is_object($obj)) {
            $pattern = '/via([\s:]*)?<a href="(?P<href>(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?)">/i';
            $text    = $obj->content;
            preg_match($pattern, $text, $matches);
            if (count($matches) > 0) {
                $elements = parse_url($matches['href']);
                array_pop($elements);
                $shaarli = array_shift($elements) . '://' . implode($elements);
                if ($this->searchSharer($shaarli, true)) {
                echo $shaarli;
                    $shared = $this->linkNotExists($obj->link['href']);
                    if ($shared === false) {
                        $result['cause']  = 'source_not_in_database';
                        $result['shared'] = false;
                    }
                    else {
                        $result['shared'] = $shared;
                    }
                }
                else {
                    if (feedParser::isShaarli($shaarli)) {
                        $this->addSharer(feedParser::loadFeed($shaarli, 1));
                        $result['cause']  = 'new_source';
                        $result['shared'] = false;
                        echo "<pre>";
                        //var_dump($shaarli);
                        echo "</pre>";
                    }
                    else {
                        $result = false;
                    }
                }
            }
            else {
                $result = false;
            }
        }
        return $result;
    }

    private function searchSharer($uri, $boolResult = false)
    {
        if ($boolResult === true) {
            $query = 'SELECT COUNT(id) AS nb FROM sharers WHERE uri LIKE :uri LIMIT 1;';
            $stmt = dbConnexion::getInstance()->prepare($query);
            $stmt->bindValue(':uri', $uri .'%', PDO::PARAM_STR);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_OBJ);
            echo '<pre>' . $uri .PHP_EOL;
            var_dump($result);
            if ($result[0]->nb === '0') {
                $return = false;
            }
            else {
                $return = true;
            }
        }
        return $return;
    }

    private static function urlToPermalink($url)
    {
        return substr($url, -6);
    }

    private static function dateAtomtoSQL($date)
    {
        return substr($date, 0, -6);
    }
}
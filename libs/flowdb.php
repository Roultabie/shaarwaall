<?php
class flowDb
{
    function __construct()
    {
        //$this->causes
    }
    public function addElements($sharerObject, $datas)
    {
        if (is_array($datas)) {
            $query = 'INSERT INTO flow (
                sharer, link_hash, link, title, content,
                tags, permalink, published, updated, first_share, pending, id)
                VALUES (:sharer, :link_hash, :link, :title, :content,
                :tags, :permalink,  :published, :updated, :first_share, :pending, :id)
                ON DUPLICATE KEY UPDATE link_hash = :link_hash, link = :link,
                title = :title, content = :content, tags = :tags, published = :published,
                updated = :updated, first_share = :first_share, pending = :pending;';
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
            $stmt->bindParam(':pending', $pending, PDO::PARAM_BOOL);
            $stmt->bindParam(':id', $footPrint, PDO::PARAM_STR);

            foreach($datas as $entry) {
                if ($entry['updated'] >= $sharerObject->last_update) {
                    $sharer     = $sharerObject->id;
                    $link_hash  = md5($entry['link']);
                    $title      = $entry['title'];
                    $content    = $entry['content'];
                    $taglist    = is_array($entry['tags']) ? implode(',', $entry['tags']) : '';
                    $permalink  = self::urlToPermalink($entry['permalink']);
                    $published  = $entry['published'];
                    $updated    = $entry['updated'];
                    $firstShare = '';
                    $footPrint  = self::footPrint($entry['permalink']);
                    $pending    = false;
                    //$via        = self::isVia($content);
                    $link       = $this->setLink($entry['link'], $published, $sharer, $title);
                    if ($link) {
                        // if ($isVia) {
                        //     $host        = selft::returnHost($via);
                        //     $firstSharer = $this->getSharer($host);
                        //     if ($firstSharer) {
                        //         $pending = true;
                        //     }
                        // }
                        $result = $stmt->execute();
                        // quand un firstSharer est ajouté, il doit virer tous les pendings liés à sont url partagée.
                        if ($result) {
                            $this->setTags($entry['tags']);
                        }
                        else {
                            $result = false;
                        }
                    }
                    else {
                        $result = false;
                    }
                    //return $result;
                }
            }
            if (!empty($updated)) $this->setSharerLastUpdate($sharerObject->id, $updated);
            $stmt->closeCursor();
            $stmt = $pStmt = NULL;
        }
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
            $updated  = strtotime(self::filterDate($obj->updated));
            $feed     = $obj->author->uri . '?' . http_build_query(['do' => 'atom']);
            $author   = $obj->author->name;
            $uri      = $obj->author->uri;
            $result   = $stmt->execute();
            $stmt->closeCursor();
            $stmt = NULL;
            $return = ($result) ? dbConnexion::lastInsertId() : $false;
        }
        else {
            $return = false;
        }
        return $return;
    }

    public function getSharers()
    {
        $query = 'SELECT id, title, updated, feed, uri, last_update FROM sharers;';
        $stmt  = dbConnexion::getInstance()->prepare($query);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_OBJ);
        $stmt->closeCursor();
        $stmt = NULL;
        return $result;
    }

    public function getSharer($ressource, $addIfNotExists = true)
    {
        $cond  = (is_int($ressource)) ? $where = 'id = :id' : 'uri LIKE :uri';
        $query = 'SELECT id, title, updated, feed, uri, last_update FROM sharers WHERE ' . $cond . ' LIMIT 1;';
        // ajouter bindParam avec le cleanHost without scheme
        $stmt  = dbConnexion::getInstance()->prepare($query);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_OBJ);
        $stmt->closeCursor();
        $stmt = NULL;
        if (!$result && $addIfNotExists) {
            $flow = feedParser::loadFeed($uri, 1);
            if ($flow) {
                $sharer = $this->addSharer($flow);
                $result = ($sharer) ? : $this->getSharer($sharer);
            }
        }
        return $result;
    }

    public function getSharerUpdatedFeed($id)
    {
        $query = 'SELECT updated FROM sharers WHERE id = :id;';
        $stmt  = dbConnexion::getInstance()->prepare($query);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_OBJ);
        $stmt->closeCursor();
        $stmt = NULL;
        return $result[0]->updated;
    }

    public function setSharerLastUpdate($id, $time)
    {
        $query = 'UPDATE sharers SET last_update = :updated WHERE id = :id';
        $stmt  = dbConnexion::getInstance()->prepare($query);
        $stmt->bindValue(':updated', $time, PDO::PARAM_INT);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $stmt->closeCursor();
        $stmt = NULL;
    }

    public static function flowToArray($obj, $sort, $order, $minDate = '', $maxDate = '')
    {
        $curDate = date('Y-m-d H:i:s');
        $minDate = (empty($minDate)) ? strtotime('1970-01-01 00:00:00') : strtotime($minDate);
        $maxDate = (empty($maxDate)) ? strtotime($curDate) : strtotime($maxDate);
        foreach($obj as $value) {
            $published = strtotime(self::filterDate($value->published));
            $updated   = strtotime(self::filterDate($value->updated));
            $key = ($sort === 'published') ? $published : $updated;
            if ($key >= $minDate && $key <=$maxDate) {
                $entry[$key] = [
                    'title'     => (string) $value->title,
                    'link'      => (string) $value->link['href'],
                    'permalink' => (string) $value->id,
                    'published' => strtotime(self::filterDate($value->published)),
                    'updated'   => strtotime(self::filterDate($value->updated)),
                    'content'   => (string) $value->content,
                    'tags'      => self::tagsToArray($value->category),
                ];
            }
        }
        if ($order === 'ASC') {
            ksort($entry, SORT_NUMERIC);
        }
        else {
            krsort($entry);
        }
        return $entry;
    }

    // End # public functions -------------------------------------------------

    // Start # private functions ----------------------------------------------

    public function setSharerUpdatedFeed($id, $time)
    {
        $query = 'UPDATE sharers SET updated = :updated WHERE id = :id';
        $stmt  = dbConnexion::getInstance()->prepare($query);
        $stmt->bindValue(':updated', $time, PDO::PARAM_INT);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $stmt->closeCursor();
        $stmt = NULL;
    }

    private function getPendingElements($uri)
    {
        $hash  = md5($uri);
        $query = 'SELECT sharer, datas, id FROM flow_pending WHERE via = :via;';
        $stmt  = dbConnexion::getInstance()->prepare($query);
        $stmt->bindValue(':via', $hash, PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        $stmt = NULL;
        if (is_array($result) && count($result) > 0) {
            foreach ($result as $value) {
                $datas = unserialize($value['datas']);
                $key   = strtotime($datas['updated']);
                $pending['sharer'] = $value['sharer'];
                $pending['id']     = $value['id'];
                $pending['datas']  = [
                    $key  => $datas,
                ];
            }
            $return[] = $pending;
        }
        else {
            $return = false;
        }
        return $return;
    }

    private static function isVia($content)
    {
        if (is_array($entry)) {
            $pattern = '/via([\s:]*)?<a href="(?P<href>(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?)">/i';
            preg_match($pattern, $content, $matches);
            if (count($matches) > 0) {
               $result = $matches['href'];
            }
            else {
                $result = false;
            }
        }
        return $result;
    }

    private function linkNotExists($uri)
    {
        $return = '';
        if (!empty($uri)) {
            $hash  = md5($uri);
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

    private function setLink($href, $published, $sharer, $title = '')
    {
        $query = 'INSERT INTO links (href, title, published, sharer)
            VALUES (:href, :title, :published, :sharer)
            ON DUPLICATE KEY
            UPDATE sharer = CASE
                    WHEN published > VALUES(published) THEN :sharer
                    ELSE sharer
                END,
            published = LEAST(published, VALUES(published)),
            hits = hits+1;';
        $stmt = dbConnexion::getInstance()->prepare($query);
        $stmt->bindValue(':href', $href, PDO::PARAM_STR);
        $stmt->bindValue(':published', $published, PDO::PARAM_INT);
        $stmt->bindValue(':sharer', $sharer, PDO::PARAM_INT);
        $stmt->bindValue(':title', $title, PDO::PARAM_STR);
        $stmt->execute();
        $stmt->closeCursor();
        $stmt = NULL;
        $state = dbConnexion::getInstance()->lastInsertId();
        return $state;
    }

    private function setTags($tags)
    {
        if (is_array($tags)) { // Insert or update tag table if tag exist
            $query = "INSERT INTO tags(tag)
                VALUES (:tag) ON DUPLICATE KEY UPDATE hits = hits+1;";
            $stmt = dbConnexion::getInstance()->prepare($query);
            $stmt->bindParam(':tag', $tag, PDO::PARAM_STR);
            foreach($tags as $tag) {
                $tag = trim($tag);
                $stmt->execute();
            }
            $stmt->closeCursor();
            $stmt = NULL;
        }
    }

    private static function returnHost($url, $withScheme = true)
    {
        $scheme = parse_url($url, PHP_URL_SCHEME);
        $host   = parse_url($url, PHP_URL_HOST);
        return ($withScheme) ? $scheme . '://' . $host : $host;
    }

    private static function filterDate($date)
    {
        $date = str_replace('T', ' ', $date);
        return substr($date, 0, -6);
    }

    private static function footPrint($string)
    {
        $hash = rtrim(base64_encode(hash('md5', $string, TRUE)), '=');
        $hash = str_replace('+', '-', $hash); // Get rid of characters which need encoding in URLs.
        $hash = str_replace('/', '_', $hash);
        $hash = str_replace('=', '@', $hash);
        return $hash;
    }

    private static function tagsToArray($obj)
    {
        foreach($obj as $value) {
            $tags[] = (string) $value['term'];
        }
        return $tags;
    }

    private static function urlToPermalink($url)
    {
        return substr($url, -6);
    }
}
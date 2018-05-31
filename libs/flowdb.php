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
    public function addElements($id, $datas, $deleteFromPending = false) // array = links to add (array key[] = array key = fields, value = values)
    {
        if (is_array($datas)) {
            $query = 'INSERT INTO flow (
                sharer, link_hash, link, title, content,
                tags, permalink, published, updated, first_share, id)
                VALUES (:sharer, :link_hash, :link, :title, :content,
                :tags, :permalink,  :published, :updated, :first_share, :id)
                ON DUPLICATE KEY UPDATE link_hash = :link_hash, link = :link,
                title = :title, content = :content, tags = :tags, published = :published,
                updated = :updated, first_share = :first_share;';
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
            $stmt->bindParam(':id', $footPrint, PDO::PARAM_STR);

            $pQuery = 'INSERT INTO flow_pending (sharer, updated, datas, via, id)
                VALUES (:pSharer, NOW(), :pDatas, :pVia, :pId)
                ON DUPLICATE KEY UPDATE updated = NOW();';
            $pStmt = dbConnexion::getInstance()->prepare($pQuery);
            $pStmt->bindParam(':pSharer', $pSharer, PDO::PARAM_STR);
            $pStmt->bindParam(':pDatas', $pDatas, PDO::PARAM_STR);
            $pStmt->bindParam(':pDatas', $pDatas, PDO::PARAM_STR);
            $pStmt->bindParam(':pVia', $pVia, PDO::PARAM_STR);
            $pStmt->bindParam(':pId', $footPrint, PDO::PARAM_STR);
            $pending = false;

            foreach($datas as $entry) {
                if (is_array($entry['tags'])) { // Insert or update tag table if tag exist
                    $tQuery = "INSERT INTO tags(tag)
                        VALUES (:tag) ON DUPLICATE KEY UPDATE hits = hits+1;";
                    $tStmt = dbConnexion::getInstance()->prepare($tQuery);
                    $tStmt->bindParam(':tag', $tag, PDO::PARAM_STR);
                    foreach($entry['tags'] as $element) {
                        $tag = trim($element);
                        $tStmt->execute();
                    }
                    $tStmt->closeCursor();
                    $tStmt = NULL;
                }
                $sharer     = $id;
                $link_hash  = md5($entry['link']);
                $link       = $entry['link'];
                $title      = $entry['title'];
                $content    = $entry['content'];
                $taglist    = is_array($entry['tags']) ? implode(',', $entry['tags']) : '';
                $permalink  = self::urlToPermalink($entry['permalink']);
                $published  = $entry['published'];
                $updated    = $entry['updated'];
                $firstShare = '';
                $footPrint  = self::footPrint($entry['permalink']);
                $origin     = $this->ifReShared($entry);
                if (is_array($origin)) {
                    if ($origin['shared'] === false) {
                        $pSharer = $id;
                        $pDatas  = serialize($entry);
                        $pVia    = md5($origin['via']);
                        $pending = true;
                        $pStmt->execute();
                    }
                    else {
                        $firstShare = $origin['shared'];
                        $stmt->execute();
                    }
                }
                else {
                    $result = $stmt->execute();
                }
                if ($result) {
                    $flowPending = $this->getPendingElements($entry['permalink']);
                    if (is_array($flowPending)) {
                        foreach($flowPending as $row) {
                            $this->addElements($row['sharer'], $row['datas'], $row['id']);
                        }
                    }
                    if ($deleteFromPending) {
                        $dQuery = 'DELETE from flow_pending WHERE id = :dId';
                        $dStmt  = dbConnexion::getInstance()->prepare($dQuery);
                        $dStmt->bindValue(':dId', $deleteFromPending, PDO::PARAM_STR);
                        $dStmt->closeCursor();
                        $dStmt = NULL;
                    }
                }
            }
            $stmt->closeCursor();
            $pStmt->closeCursor();
            $stmt = $pStmt = NULL;
        }
        return $pending;
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
    private static function footPrint($string)
    {
        $hash = rtrim(base64_encode(hash('md5', $string, TRUE)), '=');
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

    private function ifReShared($entry)
    {
        if (is_array($entry)) {
            $pattern = '/via([\s:]*)?<a href="(?P<href>(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?)">/i';
            $text    = $entry['content'];
            preg_match($pattern, $text, $matches);
            if (count($matches) > 0) {
                $elements = parse_url($matches['href']);
                array_pop($elements);
                $shaarli = array_shift($elements) . '://' . implode($elements);
                if ($this->searchSharer($shaarli, true)) {
                    $shared = $this->linkNotExists($entry['link']);
                    if ($shared === false) {
                        $result['cause']  = 'source_not_in_database';
                        $result['via']    = $matches['href'];
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
                        $result['via']    = $matches['href'];
                        $result['shared'] = false;
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

    private static function filterDate($date)
    {
        return substr($date, 0, -6);
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

    public function setSharerUpdatedFeed($id, $date)
    {
        $query = 'UPDATE sharers SET updated = :updated WHERE id = :id';
        $stmt  = dbConnexion::getInstance()->prepare($query);
        $stmt->bindValue(':updated', $date, PDO::PARAM_STR);
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
                    'published' => self::filterDate($value->published),
                    'updated'   => self::filterDate($value->updated),
                    'content'   => (string) $value->content,
                    'tags'      => self::tagsToArray($value->category),
                ];
            }
        }
        if ($order === 'ASC') {
            ksort($entry);
        }
        else {
            krsort($entry);
        }
        return $entry;
    }

    private static function tagsToArray($obj)
    {
        foreach($obj as $value) {
            $tags[] = (string) $value['term'];
        }
        return $tags;
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
                $key           = strtotime($value['datas']['updated']);
                $pending['sharer'] = $value['sharer'];
                $pending['id']     = $value['id'];
                $pending['datas']  = [
                    $key  => unserialize($value['datas']),
                ];
            }
            $return[] = $pending;
        }
        else {
            $return = false;
        }
        return $return;
    }
}
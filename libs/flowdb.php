<?php
class flowDb
{
    function __construct()
    {
        //$this->causes
    }

    /**
     * Add elements to flow table, return an array of tags and updated timestamp if success.
     *
     * @param object  $sharerObject need a object from array given by getSharers method.
     * @param array $datas need a simple xml datas parsed by flowToArray method.
     * @return array
     */
    public function setFlow(object $sharerObject, array $datas)
    {
        if (is_array($datas)) {
            $query = 'INSERT INTO flow (
                sharer, link, title, content, tags, permalink,
                published, updated, id)
                VALUES (:sharer, :link, :title, :content, :tags,
                :permalink, :published, :updated, :id)
                ON DUPLICATE KEY UPDATE link = CASE
                    WHEN link != VALUES(link) THEN :link
                    ELSE link
                END, title = CASE
                    WHEN title != VALUES(title) THEN :title
                    ELSE title
                END, content = CASE
                    WHEN content != VALUES(content) THEN :content
                    ELSE content
                END, tags = CASE
                    WHEN tags != VALUES(tags) THEN :tags
                    ELSE tags
                END, updated = CASE
                    WHEN updated != VALUES(updated) THEN :updated
                    ELSE updated
                END;';
            $stmt = dbConnexion::getInstance()->prepare($query);
            $stmt->bindParam(':sharer', $sharer, PDO::PARAM_INT);
            $stmt->bindParam(':link', $link, PDO::PARAM_STR);
            $stmt->bindParam(':title', $title, PDO::PARAM_STR);
            $stmt->bindParam(':content', $content, PDO::PARAM_STR);
            $stmt->bindParam(':tags', $taglist, PDO::PARAM_STR);
            $stmt->bindParam(':permalink', $permalink, PDO::PARAM_STR);
            $stmt->bindParam(':published', $published, PDO::PARAM_INT);
            $stmt->bindParam(':updated', $updated, PDO::PARAM_INT);
            $stmt->bindParam(':id', $footPrint, PDO::PARAM_STR);
            foreach($datas as $entry) {
                if ($entry['updated'] >= $sharerObject->last_update) {
                    $sharer     = $sharerObject->id;
                    $title      = $entry['title'];
                    $content    = $entry['content'];
                    $taglist    = is_array($entry['tags']) ? implode(',', $entry['tags']) : '';
                    $permalink  = self::urlToPermalink($entry['permalink']);
                    $published  = ($entry['published']) ? $entry['published'] : $entry['updated'];
                    $updated    = $entry['updated'];
                    $firstShare = '';
                    $footPrint  = self::footPrint($entry['permalink']);
                    $link       = $this->setLink($entry['link'], $published, $sharer, $title);
                    if ($link) {
                        $result = $stmt->execute();
                        if ($result) {
                            $return['tags']   = $entry['tags'];
                            $return['update'] = $updated;
                        }
                        else {
                            $return = false;
                        }
                    }
                    else {
                        $return = false;
                    }
                }
                else {
                    $result = false;
                }
            }
            $stmt->closeCursor();
            $stmt = $pStmt = NULL;
            return $return;
        }
    }

    /**
     * Return object of current sharer requested by $res if success.
     * $ressource can be id or url of a sharer.
     *
     * @param int/string $res if int, search is by id, else il by uri.
     * @return object requested sharer if success, else false.
     */
    public function getSharer($res)
    {
        // res = :res for ID, res LIKE :res for uri
        $cond  = (is_int($res)) ? 'res = :res' : 'res LIKE :res';
        $cond  = ' WHERE ' . $cond;
        $query = 'SELECT id, title, updated, feed, uri, last_update FROM sharers ' . $cond . ';';
        $stmt  = dbConnexion::getInstance()->prepare($query);
        $res   = (is_int($res)) ? $res : self::returnHost($res, true);
        $param = (is_int($res)) ? PDO::PARAM_INT : PDO::PARAM_STR;
        $stmt->bindValue(':res', $res, $param);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_OBJ);
        $stmt->closeCursor();
        $stmt = NULL;
        return $result;
    }

    /**
     * Add new sharer in sharer table.
     *
     * @param object/array $data need a simple xmlElement generated object or array.
     * @return int/bool id of insert if success, else false.
     */
    public function setSharer($data)
    {
        if (empty($data->id)) {
            $query = 'INSERT INTO sharers (title, subtitle, updated, feed, author, uri, last_entry_updated, status)
                VALUES (:title, :subtitle, :updated, :feed, :author, :uri, :last_entry_updated, :status);';
        }
        else {
            $query = 'UPDATE sharers SET title = :title, subtitle = :subtitle, updated = :updated, feed = :feed, author = :author,
                            uri = :uri, last_entry_updated = :last_entry_updated, status = :status WHERE id = :id;';
        }
        $stmt = dbConnexion::getInstance()->prepare($query);
        $stmt->bindParam(':title', $title, PDO::PARAM_STR);
        $stmt->bindParam(':subtitle', $subtitle, PDO::PARAM_STR);
        $stmt->bindParam(':updated', $updated, PDO::PARAM_INT);
        $stmt->bindParam(':feed', $feed, PDO::PARAM_STR);
        $stmt->bindParam(':author', $author, PDO::PARAM_STR);
        $stmt->bindParam(':uri', $uri, PDO::PARAM_STR);
        $stmt->bindParam(':last_entry_updated', $last_entry_updated, PDO::PARAM_INT);
        $stmt->bindParam(':status', $status, PDO::PARAM_INT);
        if (is_object($data)) {
            if (!empty($data->id)) {
                $stmt->bindParam(':id', $id, PDO::PARAM_INT);
                $id = $data->id;
            } 
            $title              = $data->title;
            $subtitle           = $data->subtitle;
            $updated            = $data->updated;
            $feed               = $data->uri . '?' . http_build_query(['do' => 'atom']);
            $author             = $data->author;
            $uri                = $data->uri;
            $last_entry_updated = $data->last_entry_updated; 
            $status             = $data->status;
            $result             = $stmt->execute();
            $stmt->closeCursor();
            $stmt = NULL;
            $return = ($result) ? dbConnexion::getInstance()->lastInsertId() : $false;
        }
        elseif (is_array($data)) {
            $title      = $data['title'];
            $subtitle   = $data['subtitle'];
            $updated    = strtotime(self::filterDate($data['updated']));
            $feed       = $data['uri'] . '?' . http_build_query(['do' => 'atom']);
            $author     = $data['name'];
            $uri        = $data['uri'];
            $lastUpdate = $data['lastUpdate'];
            $status     = $data['status'];
            $result     = $stmt->execute();
            $stmt->closeCursor();
            $stmt = NULL;
            $return = ($result) ? dbConnexion::getInstance()->lastInsertId() : $false;
        }
        else {
            $return = false;
        }
        return $return;
    }

    /**
     * Return object of sharers list.
     *
     * @return object if success, else false.
     */
    public function getSharers()
    {
        $query = 'SELECT id, title, subtitle, updated, feed, author, uri, last_entry_updated, status FROM sharers;';
        $stmt  = dbConnexion::getInstance()->prepare($query);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_OBJ);
        $stmt->closeCursor();
        $stmt = NULL;
        return $result;
    }

    /**
     * Add tags in tags table, if exists, update hit+1.
     *
     * @param array $tags list of tags.
     * @return void
     */
    public function setTags(array $tags)
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

    /**
     * Transform atom feed parsed by simplexmlelement into array.
     *
     * @param object $obj a simplexml atom feed.
     * @param string $sort ASC DESC order by date.
     * @param string $order updated published for sort and mindate, maxdate.
     * @param string $minDate to limit nb of elements by min date.
     * @param string $maxDate to limit nb of elements by max date.
     * @return array table of entries.
     */
    public static function flowToArray(object $obj, string $sort, string $order, string $minDate = '', string $maxDate = '')
    {
        $curDate = date('Y-m-d H:i:s');
        $minDate = (empty($minDate)) ? strtotime('1970-01-01 00:00:00') : strtotime($minDate);
        $maxDate = (empty($maxDate)) ? strtotime($curDate) : strtotime($maxDate);
        foreach($obj as $value) {
            // $published = strtotime(self::filterDate($value->published));
            // $updated   = strtotime(self::filterDate($value->updated));
            $published = strtotime($value->published);
            $updated   = strtotime($value->updated);
            $key = ($sort === 'published') ? $published : $updated;
            if ($key >= $minDate && $key <=$maxDate) {
                $entry[$key] = [
                    'title'     => (string) $value->title,
                    'link'      => (string) $value->link['href'],
                    'permalink' => (string) $value->id,
                    'published' => $published,
                    'updated'   => $updated,
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

    /**
     * Add or update link in link table if exists. link is unique, if exists update.
     * sharer if published time is older than.
     *
     * @param string $href current link.
     * @param integer $published timestamp of published date.
     * @param integer $sharer id of sharer.
     * @param string $title title of current link
     * @return int id of current link added or updated.
     */
    private function setLink(string $href, int $published, int $sharer, string $title = '')
    {
        $published = (empty($published)) ? time() : $published; // protect against priority ofr poblished 0
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

    /**
     * Return host of url, remove http(s) if needed.
     *
     * @param string $url url to parse.
     * @param boolean $withScheme.
     * @return string host.
     */
    private static function returnHost(string $url, bool $withScheme = true)
    {
        $scheme = parse_url($url, PHP_URL_SCHEME);
        $host   = parse_url($url, PHP_URL_HOST);
        return ($withScheme) ? $scheme . '://' . $host : $host;
    }

    /**
     * Return a string type hash of string.
     *
     * @param string $string string to hash.
     * @return string
     */
    private static function footPrint(string $string)
    {
        $hash = rtrim(base64_encode(hash('md5', $string, TRUE)), '=');
        $hash = str_replace('+', '-', $hash); // Get rid of characters which need encoding in URLs.
        $hash = str_replace('/', '_', $hash);
        $hash = str_replace('=', '@', $hash);
        return $hash;
    }

    /**
     * Return array of object tags parsed by xmlsimpleelement.
     *
     * @param object $obj xml simplelement category.
     * @return array tags list.
     */
    private static function tagsToArray(object $obj)
    {
        foreach($obj as $value) {
            $tags[] = (string) $value['term'];
        }
        return $tags;
    }

    /**
     * Remove url part of link given.
     *
     * @param string $url.
     * @return string shaarli permalink.
     */
    private static function urlToPermalink(string $url)
    {
        return substr($url, -6);
    }
}
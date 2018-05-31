<?php
require_once 'config.php';
require_once 'libs/mysql.php';
require_once 'libs/feedParser.php';
require_once 'libs/flowdb.php';

$feedParser = new feedParser();
$flowDb     = new flowDb();

$sharers = $flowDb->getSharers();

if (is_array($sharers)) {
    foreach ($sharers as $sharer) {
        $feed     = feedParser::loadFeed($sharer->feed, 100);
        if ($feed) {
            $array = flowDb::flowToArray($feed->entry, 'ASC', 'updated');
            $result[] = $flowDb->addElements($sharer->id, $array);
        }
        else {
            echo "Can't load feed from " . $sharer;
        }
    }
}

//var_dump($result);

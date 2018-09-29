<?php
require_once 'config.php';
require_once 'libs/shaarwaall.php';
require_once 'libs/mysql.php';
require_once 'libs/feedParser.php';
require_once 'libs/flowdb.php';
require_once 'backend/threads.php';

ini_set('default_socket_timeout', 20);

$shaarwaal  = new shaarwaall();
$feedParser = new feedParser();
$flowDb     = new flowDb();

$sharers = $flowDb->getSharers();

function setUpdateList($sharers)
{
    foreach ($sharers as $sharer) {
        $feed      = feedParser::loadFeed($sharer->feed, 1);
        $newUpdate = flowDb::filterDate($feed->updated);
        $newUpdate = strtotime($newUpdate);
        if ($newUpdate > $sharer->last_entry_updated) {
            $flowDb->loadCrawler($sharer-feed, $sharer);
        }
    }
}

function initThreads($sharers)
{
    $threads   = ($GLOBALS['config']['threads'] > 0) ? $GLOBALS['config']['threads'] : 1;
    $nbSharers = count($sharers);
    $sByThread = ceil($nbSharers / $threads);
    $elements  = array_chunk($sharers, $sByThread);
    return $elements;
}

$toProcess = initThreads($sharers);

foreach ($toProcess as $process) {
    $t = new getFeedUpdate($process, $flowDb);
    $t->start();
    $threads[] = $t;
}

foreach ($threads as $t) {
    $t->join();
}

// foreach ($sharers as $sharer) {
//     $feed = feedParser::loadFeed($sharer->feed);
//     $url  = $sharer->feed;
// }

$execTime =microtime(true) - $_SERVER['REQUEST_TIME_FLOAT'];
var_dump($execTime);
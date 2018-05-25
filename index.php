<?php
require_once 'config.php';
require_once 'libs/feedParser.php';
require_once 'libs/mysql.php';
require_once 'libs/flowdb.php';

$flowDb = new flowDb();
$feed   = new feedParser();

$sharers = $flowDb->getSharers();
foreach($sharers as $sharer) {
    $flow = $feed->loadFeed($sharer->feed);
    $flowDb->addElements($sharer->id, $flow);
}

echo '<pre>';
//var_dump($sharers);
echo '</pre>';
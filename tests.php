<?php
require_once 'config.php';
require_once 'libs/feedParser.php';
require_once 'libs/mysql.php';
require_once 'libs/flowdb.php';

$flowDb = new flowDb();

$sharers = $flowDb->getSharers();
foreach($sharers as $sharer) {
    $flow = feedParser::loadFeed($sharer->uri);
    $result[] = $flowDb->addElements($sharer->id, $flow);
}

echo '<pre>';
var_dump($result);
echo '</pre>';
<?php
$config = array (
    'dbHost' => 'localhost',
    'dbName' => 'shaarwaall',
    'dbUser' => 'root',
    'dbPass' => 'm&t@ll1k',
    'tblPrefix' => '',
);

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
//var_dump($flow);
echo '</pre>';
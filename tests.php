<?php
require_once 'config.php';
require_once 'libs/feedParser.php';
require_once 'libs/mysql.php';
require_once 'libs/flowdb.php';

$flowDb = new flowDb();

$sharers = $flowDb->getSharers();
foreach($sharers as $sharer) {
    $flow = feedParser::loadFeed($sharer->uri);
    //$result[] = $flowDb->addElements($sharer->id, $flow);
}
//$result = $flowDb->editSharer(1, ['title' => 'Daniel Links ovekill']);
// $result = $flowDb->getSharerUpdatedFeed(3);
// $flowDb->setSharerUpdatedFeed(3, '2018-05-28T21:08:35+02:00');
// $result2 = $flowDb->getSharerUpdatedFeed(3);
//$json  = json_encode($flow->entry);

$array = flowDb::flowToArray($flow->entry, 'published', 'ASC', '2018-05-06 14:51:13', '2018-05-28 00:00:00');
var_dump($array);
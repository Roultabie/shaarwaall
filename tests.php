<?php
require_once 'config.php';
require_once 'libs/shaarwaall.php';
require_once 'libs/mysql.php';
require_once 'libs/feedParser.php';
require_once 'libs/flowdb.php';

$shaarlist  = 'https://raw.githubusercontent.com/Oros42/shaarlis_list/master/shaarlis.json';

$shaarwaal  = new shaarwaall();
$feedParser = new feedParser();
$flowDb     = new flowDb();
$json       = file_get_contents($shaarlist);

// $array      = json_decode($json, true);
// var_dump($array);

// foreach($array as $rss => $value) {
//     $data = [
//         'title'    => $value['text'],
//         'subtitle' => '',
//         'uri'      => $value['htmlUrl'],
//         'name'     => $value['htmlUrl'],
//         'updated'  => 0,
//     ];
//     $flowDb->addSharer($data);
// }

$sharers = $flowDb->getSharers();

if (is_array($sharers)) {
    foreach ($sharers as $sharer) {
        $feed = feedParser::loadFeed($sharer->feed, 10);
        if ($feed) {
            $array  = flowDb::flowToArray($feed->entry, 'ASC', 'updated');
            $result = $flowDb->setElements($sharer, $array);
            if (is_array($result)) {
                $flowDb->setTags($result['tags']);
                $flowDb->setSharerLastEntryUpdated($sharer->id, $result['update']);
                $flowDb->setSharerUpdatedFeed($sharer->id, $result['update']);
            }
        }
        else {
            echo "Can't load feed from " . $sharer->feed;
        }
    }
}

$test = file_get_contents('http://localhost/shaarwaall/sources/tables_creation.sql');

// $pattern = '/via([\s:]*)?<a href="(?P<href>(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?)">/i';
// preg_match($pattern, 'via: <o href="http://toto.com/titi.html)">toto</a>', $matches);

// $path = parse_url('http://daniel.gorgones.net/shaarli/?Edl_Id', PHP_URL_SCHEME);
//$flowDb->setLink('http://test.com', 111, '', 'Titre de test');
// var_dump();

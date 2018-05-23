<?php

require_once('libs/feedParser.php');

$feed = new feedParser();

$result = $feed->loadFeed('https://daniel.gorgones.net/shaarli/?do=atom');
// $rss->loadXml('https://korben.info/feed');
// $rss->loadXml('https://google.fr');

// $rss->loadXml('tests/rss1.xml');
// $rss->loadXml('tests/rss2.xml');
// $rss->loadXml('tests/norss.txt');

echo '<pre>';
var_dump($result);
echo '</pre>';
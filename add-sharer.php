<?php
require_once 'config.php';
require_once 'libs/feedParser.php';
require_once 'libs/mysql.php';
require_once 'libs/flowdb.php';

if (!empty($_POST['uri'])) {
    $flowDb = new flowDb();
    $feed   = new feedParser();
    $feedOptions = [
        'do' => 'atom',
        'nb' => 1,
        ];
    $uri   = rtrim($uri, '/');
    $path  = $_POST['uri'] . '?' . http_build_query($feedOptions);
    $flow  = $feed->loadFeed($path);
    $flowDb->addSharer($flow);
    var_dump($flow);
}
?>
<form name="addSharer" method="post">
    <input type="text" name="uri" id="uri" placeholder="http://shaarli..." value="">
    <input type="submit" value="Ajouter">
</form>
<?php
require_once 'config.php';
require_once 'libs/feedParser.php';
require_once 'libs/mysql.php';
require_once 'libs/flowdb.php';

if (!empty($_POST['uri'])) {
    $flowDb = new flowDb();
    $feed   = new feedParser();
    $flow  = $feed->loadFeed($path, 50);
    $flowDb->addSharer($flow);
    var_dump($flow);
}
?>
<form name="addSharer" method="post">
    <input type="text" name="uri" id="uri" placeholder="http://shaarli..." value="">
    <input type="submit" value="Ajouter">
</form>
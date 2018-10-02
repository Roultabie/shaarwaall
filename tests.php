<?php
require_once 'config.php';
require_once 'libs/shaarwaall.php';
require_once 'libs/mysql.php';
require_once 'libs/feedParser.php';
require_once 'libs/flowdb.php';
require_once 'timply/timply.php';

$shaarlist  = 'https://raw.githubusercontent.com/Oros42/shaarlis_list/master/shaarlis.json';

$shaarwaal  = new shaarwaall();
$feedParser = new feedParser();
$flowDb     = new flowDb();

function removePermalink($content)
{
    $patterns[] = "/(<br>)?\(<a href=\"(http|https)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?\">Permalink<\/a>\)/";
    $patterns[] = "/&#8212; <a href=\"(http|https)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?\" title=\"Permalink\">Permalink<\/a>/";
    $patterns[] = "/&#8212; &lt;a href=&quot;<a href=\"(http|https)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?\">(http|https)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?<\/a>&quot; title=&quot;Permalien&quot;&gt;Permalien&lt;\/a&gt;/";
    $content    = preg_replace($patterns, '', $content);
    return $content;
}

timply::setUri('templates/halloween');

$page = new timply('index.html');

$result = $flowDb->getFlow(50);
//var_dump($result);

foreach ($result as $value) {
    $oSharer = '';
    if ($value->sharer != $value->pSharer) {
        $pContent = removePermalink($value->pContent);
        $pSharer = new timply('firstShare.html');
        $pSharer->setElement('author', $value->pTitle);
        $pSharer->setElement('description', $pContent);
        $firstShare = $pSharer->returnHtml();
        //var_dump($firstShare);
    }
    else {
        $firstShare = '';
    }
    $content = removePermalink($value->content);
    $pSharer = ($value->sharer != $value->pSharer) ? new timply('firstSharer.html') : '';
    $page->setElement("shaarli", $value->lUri, "Shaare");
    $page->setElement("author", $value->lTitle, "Shaare");
    $page->setElement("description", $content, "Shaare");
    $page->setElement("first-share", $firstShare, "Shaare");
}

echo $page->returnHtml();
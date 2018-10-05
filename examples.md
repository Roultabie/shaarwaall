# Misc example to retrive results from libs

## Default initiatization
```
require_once 'config.php';
require_once 'threads/feedUpdate.php';
require_once 'libs/shaarwaall.php';
require_once 'libs/mysql.php';
require_once 'libs/feedParser.php';
require_once 'libs/flowdb.php';
require_once 'timply/timply.php';
require_once 'opengraph/OpenGraph.php';

$shaarwaal  = new shaarwaall();
$feedParser = new feedParser();
$flowDb     = new flowDb();
```

## Get shaarers from Oros JSON public list:
```
$shaarlist = 'https://raw.githubusercontent.com/Oros42/shaarlis_list/master/shaarlis.json';

$json      = file_get_contents($shaarlist);
$array     = json_decode($json, true);

foreach($array as $rss => $value) {
    $uri  = str_replace('?do=atom', '', $value['htmlUrl']);
    $uri  = str_replace('?do=rss', '', $uri);
    $uri  = rtrim($uri, '/');
    $uri  = $uri . '/';
    $data = [
        'title'    => $value['text'],
        'subtitle' => '',
        'uri'      => $uri,
        'name'     => $uri,
        'updated'  => 0,
    ];
    $flowDb->setSharer($data);
}
```

## Get shaarers list from db:
```
$sharers = $flowDb->getSharers();
```

### Set Shaares to DB
```
$sharers = $flowDb->getSharers();

$nbSharers  = count($sharers);
$nbElements = ceil($nbSharers/ $GLOBALS['config']['threads']);
$stack      = array_chunk($sharers, $nbElements);

foreach ($stack as $element) {
    $t = new feedUpdate($element, $flowDb);
    $t->start();
    $threads[] = $t;
}
```


## Set shaares to DB (without threads)
```
$sharers = $flowDb->getSharers();

if (is_array($sharers)) {
    foreach ($sharers as $sharer) {
         $feed  = feedParser::loadFeed($sharer->uri, $this->nb);
        if (is_array($feed)) {
            if ($feed['status'] === 200) {
                $feedUpdate = (string) $feed['xml']->updated;
                $oldUpdate  = $sharer->updated;
                $newUpdate  = strtotime($feedUpdate);
                if ((int) $oldUpdate < (int) $newUpdate) {
                    $entry = flowDb::flowToArray($feed['xml']->entry, 'ASC', 'updated');
                    $flow  = $this->flowDb->setFlow($sharer, $entry);
                    if (is_array($flow)) {
                        if (is_array($flow['tags'])) {
                            $this->flowDb->setTags($flow['tags']);
                        }
                        $sharer->updated            = $newUpdate;
                        $sharer->last_entry_updated = $flow['update'];
                    }
                }
                $sharer->status = $feed['status'];
            }
        }
        $this->flowDb->setSharer($sharer);
}
}
```

## Get flow
```
$result = $flowDb->getFlow();

foreach ($result as $key => $value) {
    
}
```
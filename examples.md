# Misc example to retrive results from libs

## Default initiatization
```
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

## Set shaares to DB
```
$sharers = $flowDb->getSharers();

if (is_array($sharers)) {
    foreach ($sharers as $sharer) {
        $feed = feedParser::loadFeed($sharer->feed, 10);
        if ($feed && is_object($feed['xml']->entry)) {
            $flow = flowDb::flowToArray($feed['xml']->entry, 'ASC', 'updated');
            if (is_array($flow)) {
                $result = $flowDb->setFlow($sharer, $flow);
                if (is_array($result)) {
                    if (is_array($result['tags'])) $flowDb->setTags($result['tags']);
                    $flowDb->setSharer($sharer->id, $result['update']);
                }
            }
        }
        else {
            echo "Can't load feed from " . $sharer->feed;
        }
    }
}
```

## Get flow
```
$result = $flowDb->getFlow();

foreach ($result as $key => $value) {
    
}
```
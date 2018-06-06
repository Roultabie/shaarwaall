<?php
class getFeedUpdate extends Thread
{
    private $sharers;
    public function __construct($sharers)
    {
        $this->sharers = $sharers;
    }

    public function run()
    {
        foreach ($this->sharers as $sharer) {
            $feed = feedParser::loadFeed($sharer->uri, 1);
            $url  = $sharer->feed;
            //var_dump($url);
        }
    }
}
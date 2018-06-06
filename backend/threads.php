<?php
class getFeedUpdate extends Thread
{
    private $sharers;
    public function __construct($sharers, $flowDb)
    {
        $this->sharers  = $sharers;
        $this->flowDb   = $flowDb;
        $this->nb      = 15;
    }

    public function run()
    {
        foreach ($this->sharers as $sharer) {
            $atom       = feedParser::loadFeed($sharer->uri, 1);
            $feedUpdate = (string) $atom->updated;
            $feedUpdate = flowDb::filterDate($feedUpdate);
            $oldUpdate  = $this->sharer->updated;
            $newUpdate  = strtotime($feedUpdate);
            if ($oldUpdate < $newUpdate) {
                $feed   = feedParser::loadFeed($sharer->uri, $this->nb);
                $entry  = flowDb::flowToArray($feed->entry, 'ASC', 'updated');
                $result = $this->flowDb->setFlow($sharer, $entry);
                if (is_array($entry)) {
                    $this->flowDb->setTags($result['tags']);
                    $this->flowDb->setSharerLastEntryUpdated($sharer->id, $result['update']);
                    $this->flowDb->setSharerUpdatedFeed($sharer->id, $result['update']);
                }

            }
            //var_dump($url);
        }
    }
}
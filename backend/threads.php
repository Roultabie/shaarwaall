<?php
class getFeedUpdate extends Thread
{
    private $sharers;
    public function __construct($sharers, $flowDb)
    {
        $this->sharers  = $sharers;
        $this->flowDb   = $flowDb;
        $this->nb       = 15;
        //$this->config   = $config;
    }

    public function run()
    {
        foreach ($this->sharers as $sharer) {
            $atom       = feedParser::loadFeed($sharer->uri, 1);
            $feedUpdate = (string) $atom->updated;
            $feedUpdate = flowDb::filterDate($feedUpdate);
            $oldUpdate  = $sharer->updated;
            $newUpdate  = strtotime($feedUpdate);
            if ((int) $oldUpdate < (int) $newUpdate) {
                $feed    = feedParser::loadFeed($sharer->uri, $this->nb);
                if ($feed) {
                    $entry = flowDb::flowToArray($feed->entry, 'ASC', 'updated');
                    $flow  = $this->flowDb->setFlow($sharer, $entry);
                    if (is_array($flow)) {
                        if (is_array($flow['tags'])) {
                            $this->flowDb->setTags($flow['tags']);
                        }
                        $this->flowDb->setSharerLastEntryUpdated($sharer->id, $flow['update']);
                        $this->flowDb->setSharerUpdatedFeed($sharer->id, $newUpdate);
                    }
                }
            }
        }
    }
}
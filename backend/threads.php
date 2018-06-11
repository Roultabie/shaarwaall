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
            $feed  = feedParser::loadFeed($sharer->uri, 1);
            if (is_array($feed)) {
                if ($feed['status'] === 200) {
                    $feedUpdate = (string) $feed['xml']->updated;
                    $feedUpdate = flowDb::filterDate($feedUpdate);
                    $oldUpdate  = $sharer->updated;
                    $newUpdate  = strtotime($feedUpdate);
                    if ((int) $oldUpdate < (int) $newUpdate) {
                        $atom = feedParser::loadFeed($sharer->uri, $this->nb);
                        if (is_array($atom)) {
                            if ($atom['status'] === 200) {
                                $entry = flowDb::flowToArray($atom['xml']->entry, 'ASC', 'updated');
                                $flow  = $this->flowDb->setFlow($sharer, $entry);
                                if (is_array($flow)) {
                                    if (is_array($flow['tags'])) {
                                        $this->flowDb->setTags($flow['tags']);
                                    }
                                    $sharer->updated            = strtotime(flowDb::filterDate($newUpdate));
                                    $sharer->last_entry_updated = strtotime(flowDb::filterDate($flow['update']));
                                    // $this->flowDb->setSharerLastEntryUpdated($sharer->id, $flow['update']);
                                    // $this->flowDb->setSharerUpdatedFeed($sharer->id, $newUpdate);
                                }
                            }
                        }
                    }
                    $sharer->status = $feed['status'];
                }
                elseif ($feed['status'] === 301) {
                    if (!is_array($feed['location'])) {
                        $scheme               = parse_url($feed['location'], PHP_URL_SCHEME);
                        $host                 = parse_url($feed['location'], PHP_URL_HOST);
                        $path                 = parse_url($feed['location'], PHP_URL_PATH);
                        $url                  = $scheme . '://' . $host . $path;
                        $sharer->old_id = $sharer->id;
                        $sharer->uri    = $url;
                    }
                    $sharer->status = $feed['status'];
                    
                }
            }
            $this->flowDb->setSharer($sharer);
        }
    }
}
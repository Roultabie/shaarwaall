<?php

class feedParser
{

    function __construct()
    {
        #
    }

    public function loadFeed($uri)
    {
        $object = '';
        if ($this->isvalid($uri)) {
            $object = simplexml_load_file($uri);
        }
        return $object;
    }

    private function isValid($uri)
    {
        $result = false;
        if (!empty($uri)) {
            if (strpos($uri, 'http') === 0) {
                $headers = get_headers($uri, 1);
                if ($headers && $headers[0] != 'HTTP/1.1 404 Not Found') {
                    if (strpos($headers['Content-Type'], 'application/atom+xml') === 0) {
                        $result = true;
                    }
                }
            }
            elseif (file_exists($uri)) {
                if (mime_content_type($uri) === "text/xml") {
                    $result = true;
                }
            }
        }
        return $result;
    }
}
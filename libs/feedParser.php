<?php
/**
* Used for retrieve atom elements of uri in object
*
* This class give methods to test validity of atom link and if true, load it
* in object with simplexml_load_file php function.
*
* PHP version 7
*
* @package shaarwall
* @author Daniel Douat <daniel[@]douat.fr>
* @copyright 2018 Daniel Douat
* @licence MIT
* @version 0
* @link https://github.com/Roultabie/shaarwaall
* @since  Class available since start of project
*/
class feedParser
{

    /**
    * Return a simplexml feed object of $uri (local or http(s).
    *
    * @param $uri uri to parse, this can be on local filesystem or a web ressource.
    *
    * @return obj the objext returned by simplewml_load_file PHP native function.
    *
    * @access public
    * @since  Method available since start of project
    */
    public static function loadFeed($uri, $nb = 0)
    {
        $object = '';
        $feed = self::setFeedUrl($uri, $nb);
        if (self::isvalid($feed)) {
            $string = file_get_contents($feed);
            $string = mb_convert_encoding($string, 'UTF-8');
            $result = simplexml_load_string($string, 'SimpleXMLElement', LIBXML_NOCDATA);
        }
        else {
            $result = false;
        }
        return $result;
    }

    /**
    * Check if uri exists,is accessible and if it's a valid atom feed
    *
    * @param $uri uri to parse, this can be on local filesystem or a web ressource.
    *
    * @return bool true if $uri is a valid atom feed, else false.
    *
    * @access private
    * @since Method available since start of project
    */
    private static function isValid($uri)
    {
        $result = false;
        if (!empty($uri)) {
            if (strpos($uri, 'http') === 0) {
                if ($GLOBALS['config']['badCertificateAllowed'] || true) {
                    stream_context_set_default( [
                        'ssl' => [
                            'verify_peer' => false,
                            'verify_peer_name' => false,
                            'allow_self_signed' => true,
                        ],
                    ]);
                }
                $headers = get_headers($uri, 1);
                if ($headers && $headers[0] === 'HTTP/1.1 200 OK') {
                    if (strpos($headers['Content-Type'], 'application/atom+xml') === 0) {
                        $result = true;
                    }
                }
                else {
                    $result = false;
                }
            }
            elseif (file_exists($uri)) {
                if (mime_content_type($uri) === "text/xml") {
                    $result = true;
                }
                else {
                    $result = false;
                }
            }
        }
        return $result;
    }

    public static function isShaarli($uri)
    {
        if (!empty($uri)) {
            $feed = self::setFeedUrl($uri, 1);
            $obj  = self::loadFeed($feed);
            if (is_object($obj)) {
                if ($obj->generator == "Shaarli") { // TODO: old shaarli do not have generator tag
                    $result = true;
                }
                else {
                    $result = false;
                }
            }
            else {
                $result = false;
            }
        }
        return $result;
    }

    public static function setFeedUrl($uri, $nb = 0)
    {
        $feedOptions = [
            'do' => 'atom',
            'nb' => (int)$nb,
            ];
        $uri   = rtrim($uri, '/');
        $feed  = $uri . '/?' . http_build_query($feedOptions);
        return $feed;
    }
}
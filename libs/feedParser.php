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
        $feed = self::setFeedUrl($uri, $nb);
        $curl = curl_init($feed);
        //curl_setopt($curl, CURLOPT_HEADER, true);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_TIMEOUT, 20);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($curl, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US) AppleWebKit/525.13 (KHTML, like Gecko) Chrome/0.A.B.C Safari/525.13');
        $content     = curl_exec($curl);
        $httpCode    = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        $contentType = curl_getinfo($curl, CURLINFO_CONTENT_TYPE);
        if ($content) {
            if ($httpCode === 200) {
                if (strpos($contentType, 'application/atom+xml') === 0) {
                    $content       = mb_convert_encoding($content, 'UTF-8');
                    $result['xml'] = simplexml_load_string($content, 'SimpleXMLElement', LIBXML_NOCDATA);
                }
            }
            elseif ($httpCode === 301) {
                $result['location'] = $headers['Location'];
            }
            $result['status'] = $httpCode;
        }
        else {
            $result = false;
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
            'nb' => $nb,
            ];
        $uri   = rtrim($uri, '/');
        $feed  = $uri . '/?' . http_build_query($feedOptions);
        return $feed;
    }
}
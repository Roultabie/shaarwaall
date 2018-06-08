<?php

class shaarwaall
{
    protected $userAgent;
    protected $version;

    function __construct()
    {
        // $this->userAgent = 'Shaarwaall (https://github.com/Roultabie/shaarwaall)';
        // $this->version   = 'alpha';
        $this->userAgent = 'Mozilla/5.0 (platform; rv:geckoversion) Gecko/geckotrail Firefox/firefoxversion';
        $this->version   = '°O°oooooo-';
        ini_set('user_agent', $this->userAgent . ' ' . $this->version);
    }
}
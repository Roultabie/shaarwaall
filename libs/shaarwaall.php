<?php

class shaarwaall
{
    protected $userAgent;
    protected $version;

    function __construct()
    {
        // $this->userAgent = 'Shaarwaall (https://github.com/Roultabie/shaarwaall)';
        // $this->version   = 'alpha';
        $this->userAgent = 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:40.0) Gecko/20100101 Firefox/40.1';
        $this->version   = '';
        ini_set('user_agent', $this->userAgent . ' ' . $this->version);
    }
}
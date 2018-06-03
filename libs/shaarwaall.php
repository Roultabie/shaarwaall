<?php

class shaarwaall
{
    protected $userAgent;
    protected $version;

    function __construct()
    {
        // $this->userAgent = 'Shaarwaall (https://github.com/Roultabie/shaarwaall)';
        // $this->version   = 'alpha';
        $this->userAgent = 'hungry shaare crawler';
        $this->version   = '°O°oooooo-';
        ini_set('user_agent', $this->userAgent . ' ' . $this->version);
    }
}
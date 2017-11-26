<?php

require_once __DIR__.'/../config/twitter.php';
require_once __DIR__.'/../vendor/autoload.php';
use Abraham\TwitterOAuth\TwitterOAuth;

class twlib
{
    var $conn;
    // var $content;

    function __construct()
    {
        global $tw_config;
        $this->conn = new TwitterOAuth(
            $tw_config['consumer_key'],
            $tw_config['consumer_secret'],
            $tw_config['access_token'],
            $tw_config['access_token_secret']
        );
        // $this->content = $this->conn->get("account/verify_credentials");
    }

    function post($msg)
    {
        $msg .= ' #ikemengo';
        return $this->conn->post('statuses/update', ['status' => $msg]);
    }
}
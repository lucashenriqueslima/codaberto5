<?php

    define("SITE",[
    "name"=>"FrameSoft | ",
    "desc"=>"desc qualquer",
    "domain"=>"www.google.com",
    "locale"=>"pt_BR",
    "root"=>"http://localhost/codaberto",

    ]);

    
    define("DATA_LAYER_CONFIG", [
        "driver" => "mysql",
        "host" => "localhost",
        "port" => "3306",
        "dbname" => "testes",
        "username" => "root",
        "passwd" => "",
        "options" => [
            PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
            PDO::ATTR_CASE => PDO::CASE_NATURAL
        ]
    ]);
    
    
    define("SOCIAL",[
        "facebook_page"=>"lucashenrique.fera",
        "facebook_author"=>"lucashenrique",
        "facebook_appId"=>"12343543",
        "twitter_creator"=>"@LucasHe40078005",
        "twitter_site"=>"@LucasHe40078005",
    ]);

    
    define("MAIL",[]);

    define("FACEBOOK_LOGIN",[]);
    
    define("GOOGLE_LOGIN",[]);


    
    if($_SERVER["SERVER_NAME"] == "localhost"){
        require __DIR__."/Minify.php";
    }

    
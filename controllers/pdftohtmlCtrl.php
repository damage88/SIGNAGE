<?php

ob_start();
$api->convert([
    "inputformat" => "pdf",
    "outputformat" => "html",
    "input" => "upload",
    "filename" => "index.pdf",
    "output" => [
        "ftp" => [
            "host" => "ftp.cluster007.ovh.net",
            "user" => "nurapcicgj",
            "port" => "21",
            "password" => "jojose08",
            "path" => "/DEMO/cloud/",
        ],
    ],
    "file" => fopen('pdf/lettre.pdf', 'r'),
])
->wait()
->download();
ob_clean();

// PARSING ET CORRECTION DES PDF CONVERTIS
/*
$parser = new simple_html_dom();
$parser->load_file( 'converted/cours4/index.html' );
$parser->find('#page-container',0)->setAttribute ( 'style', 'background:#fff' );
$parser->find('#pf1',0)->setAttribute ( 'style', 'box-shadow:none' );
$parser->save( 'converted/cours4/index.html' );
*/

//////////////////////////////////////////////


$view = 'pdf.tpl';

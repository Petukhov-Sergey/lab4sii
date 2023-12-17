<?php
session_start();
//print_r($_SESSION);
include('src/simple_html_dom.php');

$html = file_get_html('https://www.dotafire.com/dota-2/heroes');
$heroes = array();
foreach ($html->find('div.hero-list a') as $a) {
    $heroes[] = ["link" => $a->href, "heroName" => $a->lastchild()->plaintext];

}
$i=0;
$url = 'http://localhost/hero_create.php';
foreach ($heroes as &$hero) {
    $i+=1;
    if($i==5)
        break;
    $heroHtml = file_get_html('https://www.dotafire.com' . $hero['link']);
    $hero['attribute'] = $heroHtml->find('div.role-box table tr:nth-child(2) td:nth-child(2) span', 1)->plaintext;
    $hero['atkType'] = $heroHtml->find('div.role-box table tr:nth-child(2) td:nth-child(2) span', 2)->plaintext;
    $hero['position'] = "undefined";
    $hero['beer'] = "undefined";
    unset($hero['link']);
    $postData = http_build_query(array($hero));
    //print_r($postData);
    $postData = http_build_query($hero);
    $opts = array('http' =>
        array(
            'method'  => 'POST',
            'header'  => 'Content-type: application/x-www-form-urlencoded',
            'content' => $postData
        )
    );
    $context  = stream_context_create($opts);
    $result = file_get_contents('http://localhost/hero_create.php', false, $context);

}
header("Location: updater.php");

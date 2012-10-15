<?php
/**
 *	Slurp is a very simple caching proxy.
 *	You just define a host for the website you want to proxy and redirect it to slurp directory.
 *	Slurp will then download the requested file on disk, and will serve it on subsequent calls.
 **/
require('functions.php');
define('ROOT', dirname(__FILE__));


// We parse the requested url
$hostname = $_SERVER['HTTP_HOST'];
$protocol = ($_SERVER['HTTPS']=='on') ? 'https' : 'http';
$url = sprintf('%1$s://%2$s%3$s', $protocol, $hostname, $_GET['url']);

$path = explode('/', preg_replace('/^\//','',$_GET['url']));
$filename = array_pop($path);
$extension = substr($filename, strrpos($filename, '.') + 1);

$savePath = sprintf('websites/%1$s/%2$s/%3$s', $hostname, implode('/', $path), $filename);


// We get the content
$content = file_get_contents($url);

// We save it on file
saveFile($content, $savePath);

// We return the original headers...
array_map('header', get_headers($url));
header('X-Slurp: yes');
// ... and content
echo $content;
die();

<?php


// easy debugging
function debug($var, $displayAsHtml = false) {
	echo '<pre>';
	if ($displayAsHtml) $var = htmlentities($var);
	var_dump($var);
	echo '</pre>';
}

//Encode a complexe var in a string ready to be used as an url parameter
function encodeUrlParam($value) {
	return strtr(base64_encode(json_encode($value, true)), '+/', '-_');
}

// Decode a string used in an url parameter into a complex var
function decodeUrlParam($value) {
	return json_decode(base64_decode(strtr($value, '-_', '+/')), true);
}

// Save a file on disk
function saveFile($content, $savePath) {
	$paths = explode('/', $savePath);
	$filename = array_pop($paths);

	// Creating the directories
	$currentPath = ROOT;
	foreach($paths as $path) {
		$currentPath.='/'.$path;
		if (!file_exists($currentPath)) mkdir($currentPath);
	}

	// Creating the file
	file_put_contents($currentPath.'/'.$filename, $content);
}
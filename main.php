<?php

function main() {
    $file = '{"environment":"production","database":{"host":"mysql","port":3306,"username":"divido","password":"divido"},"cache":{"redis":{"host":"redis","port":6379}}}';
    $arrayConfig = parseConfig($file);
    $result = getConfigFromArray($arrayConfig, 'cache.redis.port');
    
    var_dump($result);
}

/**
 * Converts a correct JSON file string to array 
 **/
function parseConfig(string $file) {

	$arrayConfig = json_decode($file, true);
	if(is_null($arrayConfig)) {
		return;
	}

	return $arrayConfig;
}

/**
 * Gets the config key from the array 
 **/
function getConfigFromArray(array $arrayConfig, string $key) {

	$nestedKeys = explode('.', $key);
	if (empty($nestedKeys)) {
		return;
	}

	$resultVar = $arrayConfig;
	foreach ($nestedKeys as $nestedKey) {

		if (array_key_exists($nestedKey, $resultVar)) {
			$resultVar = $resultVar[$nestedKey];
		}
	}

	return $resultVar;
}

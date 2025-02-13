#!/usr/bin/env php
<?php
$skipJSsettings=true;
include_once "/opt/fpp/www/config.php";
include_once "/opt/fpp/www/common.php";
$pluginName = "remote-falcon-plugin";
// include_once "/home/fpp/media/plugins/remote-falcon/baseurl.php";
// $baseUrl = getBaseUrl();
$pluginConfigFile = $settings['configDirectory'] . "/plugin.remote-falcon-plugin";
$pluginSettings = parse_ini_file($pluginConfigFile);

$remoteToken = urldecode($pluginSettings['remoteToken']);
$remoteApi = urldecode($pluginSettings['remoteApi']);

if(strlen($remoteToken)>1) {
	$url = $remoteApi . "/updateManagedPsa";
	$data = array(
		'managedPsaEnabled' => 'Y'
	);
	$options = array(
		'http' => array(
			'method'  => 'POST',
			'content' => json_encode( $data ),
			'header'=>  "Content-Type: application/json; charset=UTF-8\r\n" .
									"Accept: application/json\r\n" .
									"remotetoken: $remoteToken\r\n"
			)
	);
	$context = stream_context_create( $options );
	$result = file_get_contents( $url, false, $context );
}
?>
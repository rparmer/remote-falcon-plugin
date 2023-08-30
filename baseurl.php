<?php
$pluginName = "remote-falcon-plugin";
$pluginPath = $settings['pluginDirectory']."/".$pluginName."/"; 
$logFile = $settings['logDirectory']."/".$pluginName."-listener.log";
$pluginConfigFile = $settings['configDirectory'] . "/plugin." .$pluginName;
$pluginSettings = parse_ini_file($pluginConfigFile);

$remoteApi = urldecode($pluginSettings['remoteApi']);

function getBaseUrl() {
  $host = gethostname();
  if($host == "fpplocal") {
    return "http://host.docker.internal:8080/remotefalcon/api";
  }
  if ($remoteApi != "") {
    return $remoteApi;
  }
  return "https://remotefalcon.com/remotefalcon/api";
}
?>
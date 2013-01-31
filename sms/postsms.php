<?php

function post_request($url, $data, $referer='') {
 
    // Convert the data array into URL Parameters like a=b&foo=bar etc.
    $data = http_build_query($data);
 
    // parse the given URL
    $url = parse_url($url);
 
    if ($url['scheme'] != 'http') { 
        die('Error: Only HTTP request are supported !');
    }
 
    // extract host and path:
    $host = $url['host'];
    $path = $url['path'];
 
    // open a socket connection on port 80 - timeout: 30 sec
    $fp = fsockopen($host, 80, $errno, $errstr, 30);
 
    if ($fp){
 
        // send the request headers:
        fputs($fp, "POST $path HTTP/1.1\r\n");
        fputs($fp, "Host: $host\r\n");
 
        if ($referer != '')
            fputs($fp, "Referer: $referer\r\n");
 
        fputs($fp, "Content-type: application/x-www-form-urlencoded\r\n");
        fputs($fp, "Content-length: ". strlen($data) ."\r\n");
        fputs($fp, "Connection: close\r\n\r\n");
        fputs($fp, $data);
 
        $result = ''; 
        while(!feof($fp)) {
            // receive the results of the request
            $result .= fgets($fp, 128);
        }
    }
    else { 
        return array(
            'status' => 'err', 
            'error' => "$errstr ($errno)"
        );
    }
 
    // close the socket connection:
    fclose($fp);
 
    // split the result header from the content
    $result = explode("\r\n\r\n", $result, 2);
 
    $header = isset($result[0]) ? $result[0] : '';
    $content = isset($result[1]) ? $result[1] : '';
 
    // return as structured array:
    return array(
        'status' => 'ok',
        'header' => $header,
        'content' => $content
    );
}


$MTURL = "http://i.sms.sohu.com/WLS/smsplat/mt/";
$appId = "100070" ;
$key= "070*&%&YGIIMCHSC=z?3z><y)UFTRH" ;
$routeid = "507" ;

$columnId = "6588";
$srcNumber = "106901952209909";
$destnumber = "15901227752";
$chargenumber = "13400000000";

$content = "测试短信内容";

// Submit those variables to the server
$post_data = array(
    'columnid' => $columnId,
    'appid' => $appId,
    'routeid' => $routeid,
    'srcnumber' => $srcNumber,
    'chargenumber' => $chargenumber ,
    'destnumber' => $destnumber,
    'content' => $content,
    'enc' => md5($appId.$columnId.$chargenumber.$srcNumber.$destnumber.$content.$key),
    'priority' => 3
);
 
// Send a request to example.com 
$result = post_request($MTURL, $post_data);
 
if ($result['status'] == 'ok'){
 
    // Print headers 
    echo $result['header']; 
 
    echo '<hr />';
 
    // print the result of the whole request:
    echo $result['content'];
 
}
else {
    echo 'A error occured: ' . $result['error']; 
}

?>


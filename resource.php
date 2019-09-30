<?php
$output = '';
$output .= 'Request uri: '.$_SERVER['REQUEST_URI'];
// header('Content-type: application/octet-stream');
if (array_key_exists('Accept-Encoding', apache_request_headers())){
	$output .= 'Accept-Encoding: '.apache_request_headers()['Accept-Encoding']."\n";
	if (in_array('gzip', array_map('trim', explode(',', apache_request_headers()['Accept-Encoding'])))){
		$output .= 'Client accepts gzip'."\n";
    	ob_start("ob_gzhandler");
    	if (file_exists($_SERVER['REQUEST_URI']))
		$output .= 'This output is compressed.'."\n";
    	echo $output;
    	ob_end_flush();
    	exit();
	} else {
		$output .= 'gzip not among accepted encodings'."\n";
	}
} else {
	$output .= 'Accept-Encoding header not present'."\n";
}
echo $output;

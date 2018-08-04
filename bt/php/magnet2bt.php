<?php
function udpGet($sendMsg = '', $ip = '127.0.0.1', $port = '5000'){
	$handle = stream_socket_client("udp://{$ip}:{$port}", $errno, $errstr);
	if( !$handle ){
		die("ERROR: {$errno} - {$errstr}\n");
	}
	fwrite($handle, $sendMsg);
	$result = fread($handle, 6);
	fclose($handle);
	return $result;
}
function mkdirs($path, $mode = 0755){
	if(is_dir($path)){
		return '无法创建,已经是目录了';
	}else{
		if(mkdir($path, $mode, true)) {
			return '创建成功';
		}else{
			return '创建失败';
		}
	}
}
$hash=$_POST['hash'];
$hash=strtolower($hash);
$hash=str_replace(" ","",$hash);
$hash=str_replace("magnet:?xt=urn:btih:","",$hash);
$hash=substr($hash,0,40);
if(preg_match("/^[a-z0-9]{40}$/", $hash)){
	$dir_=substr($hash,0,2)."/".substr($hash,38,2)."/";
	$dir=dirname(__DIR__)."/torrent/".$dir_;
	mkdirs($dir);
	if(!file_exists("{$dir}{$hash}.torrent"))
		$result = udpGet("{$hash}|{$dir}{$hash}.torrent|3000");
	else
		$result = true;
	$url="/torrent/{$dir_}{$hash}.torrent";
	if($result=='true')
		echo '{"error":false,"url":"'.$url.'"}';
	else
		echo '{"error":true}';	
}else{
	echo '{"error":true}';	
}

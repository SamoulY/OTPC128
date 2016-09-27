<?php
include('./lib/html');
$user=$_COOKIE['user'];
$cmd=$_GET['c'];
if(!$user) die('Can\'t log in.<br><br>$ ');
if(!$pwd=@file_get_contents('./home/'.$user.'/tmp/pwd')) $pwd='/home/'.$user;
$cmd=trim($cmd);
//if(@file_get_contents('./home/'.$user.'/tmp/reset')=='1') echo 'Encrypting error, use another settings. Disconnecting...<br><br>';
if($cmd){
	file_put_contents('./home/'.$user.'/user.log', $cmd."\n", FILE_APPEND);
	list($u,$uargs)=explode(' ', $cmd, 2);
	if(strstr($u,'/')){
		$uargs=$u;
		include('./bin/cat');
	}elseif(!file_exists('./bin/'.$u))
		echo 'Command not found: "'.$u.'". Type "help" for a list of commands.<br>';
	elseif(file_get_contents('./bin/'.$u)=='')
		echo 'Not improved yet :( You can help: <a href="https://github.com/z56/cmd/" target="_blank">https://github.com/z56/cmd/</a><br>';
	else{
		include('./bin/'.$u);
	}
}
echo '<b><sys>'.$user.'@otpc128</sys>:'.($pwd=='/home/'.$user ? '~' : $pwd).'#</b> ';
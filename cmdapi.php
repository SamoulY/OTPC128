<?php
$user=$_COOKIE['user'];
$cmd=$_GET['c'];
if(!$user) die('Can\'t log in.<br><br>$ ');
if(@file_get_contents('./home/'.$user.'/tmp/reset')=='1'){
	include('./lib/rmdirs');
	rmdirs('./home/'.$user.'/tmp');
	mkdir('./home/'.$user.'/tmp', 0777, 1);
	echo 'Encrypting error, use custom script. Disconnecting...<br><br>';
}
if (!$pwd=@file_get_contents('./home/'.$user.'/tmp/pwd')) $pwd='/home/'.$user;
if($cmd) {
	list($u,$uargs)=explode(' ', $cmd, 2);
	if(!@file_exists('./bin/'.$u)||strstr($u,'/')) echo 'Command not found: "'.$u.'". Type "help" for a list of commands.<br>';
	else {include('./bin/'.$u);}
}

if ($pwd=='/home/'.$user) $dpwd='~'; else $dpwd=$pwd;
if (!$duser=@file_get_contents('./home/'.$user.'/tmp/user')) $duser=$user;
if (!$dhost=@file_get_contents('./home/'.$user.'/tmp/host')) $dhost='otpc128';

echo '<b>'.$duser.'@'.$dhost.':'.$dpwd.'#</b> ';
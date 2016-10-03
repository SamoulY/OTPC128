<?php
if (!$user=$_COOKIE['user']) do{
	$user=rand(11111, 99999);
}while(file_exists('./home/'.$user));
setcookie('user', $user, time()+36000000);
include('./lib/rmdirs');
rmdirs('./home/'.$user.'/tmp');
mkdir('./home/'.$user.'/tmp', 0777, 1);
file_put_contents('./home/'.$user.'/tmp/pwd', '/home/'.$user);
?><!DOCTYPE HTML><html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<link rel="icon" href="favicon.ico" type="image/x-icon">
<title>OTPC128 / Z56</title>
<style>
*{word-wrap:break-word;box-sizing:border-box;font-size:16px;font-family:Source Code Pro,Courier New,Courier,monospace}
body{overflow:hidden;font-weight:500;color:#ddd;background:#000}
.sys, sys{color:#082;display: inline} .sys a, sys a{color:#082}
.red, red{color:#802;display: inline} .red a, red a{color:#802}
.blu, blu{color:#55c;display: inline} .blu a, blu a{color:#55c}
a{color:#888; position: relative; z-index: 600}
.cursor{margin-left:-11px;animation:cursor 700ms steps(2,start) 0s infinite}
@keyframes cursor{80%{visibility:hidden}}
.str1{animation:blink 1600ms steps(1,end)}
.str2{animation:blink 1660ms steps(1,end)}
.str3{animation:blink 1960ms steps(1,end)}
.str4{animation:blink 2390ms steps(1,end)}
.str5{animation:blink 4000ms steps(1,end)}
@keyframes blink{from{opacity:0}to{opacity:1}}
#cmd{background:#000;border:0;padding:0;margin:0;color:#ddd;display:inline;}
#textarea{width:1px;height:1px;opacity:0;cursor:default}
.s{display:inline}
.status-layer{position:absolute;top:10px;right:10px;opacity:1;animation:blink 230ms steps(2,start) 1s 3}
.status-layer a{text-decoration:none;margin-left:2px}
.display-layer{position:absolute;top:0px;left:0px;padding:12px;padding-bottom:40px;text-align:left;width:100%}
.input-layer{position:fixed;bottom:0px;left:0px;z-index:500}
.bottom-bar {position:fixed;bottom: 0;left:0;width:100%;text-align:center;font-size:22px;line-height:26px;font-weight:700;padding:20px}
.bottom-bar a{color:#fff;text-decoration:none}
</style>
<script type="text/javascript">
d1=new Date();
t1=d1.toLocaleTimeString();
if(d1.getHours()<10)
	t1='0'+t1;
d2=new Date(d1.getTime()+900);
t2=d2.toLocaleTimeString();
if(d2.getHours()<10)
	t2='0'+t2;
d3=new Date(d2.getTime()+1700);
t3=d3.toLocaleTimeString();
if(d3.getHours()<10)
	t3='0'+t3;
</script>
</head>
<body>
<audio src="beep.mp3" id="beep" autoplay></audio>

<div class="status-layer"><div class="sys" id="status-wrapper"><b id="status">Connected</b><a href="">&#8226;</a></div></div>

<div class="display-layer">
[remote host]<br>
<div class="str1 s"><sys><b>[<script>document.write(t1)</script>] <?=$_SERVER['REMOTE_ADDR']?></b> joined the session.</sys></div><br>
<div class="str2 s"><sys><b>[<script>document.write(t1)</script>][system]</b>:</sys> Initialising user <b><?=$user?></b>... <sys>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>[&nbsp;&nbsp;OK&nbsp;&nbsp;]</b></sys></div><br>
<div class="str3 s"><sys><b>[<script>document.write(t2)</script>][system]</b>:</sys> Checking cookies...</div><br>
<div class="str4 s"><sys><b>[<script>document.write(t3)</script>][system]</b>:</sys> Someone's destructed your data. Set password using "passwd" to get private.<br><br>
The programs included with the OTPC128 GNU/Linux system are free software.<br><br>
OTPC128 GNU/Linux comes with ABSOLUTELY NO WARRANTY, to the extent permitted by applicable law.
</div><br><br>

<div class="str5 s"><div id="s" class="s"><b><sys><?=$user?>@otpc128</sys>:~#</b> </div><input type="text" id="cmd" size="1" disabled><div class="cursor s">_</div><br><br><br><br><br></div>
</div>

<div class="input-layer">
<textarea autofocus id="textarea" class="str4" onblur="this.focus()" onkeyup="onkeydown()" onkeypress="onkeydown()" onchange="onkeydown()" onresize="onkeydown()" onclick="onkeydown()" onfocus="onkeydown()"
onkeydown="
cmd=getElementById('cmd');
if(cmd.value.length<80) cmd.value+=this.value;
else if(this.value) getElementById('beep').play();
cmd.size=cmd.value.length+1||1;
this.value='';
if(event){
	if(event.keyCode=='13'){
		new Audio('beep2.mp3').play();
		getElementById('s').insertAdjacentText('beforeEnd', cmd.value.replace(/ /g, '&nbsp;'));
		getElementById('s').innerHTML+='<br>';
		getElementById('textarea').disabled=true;
		var xd = new XMLHttpRequest();
		xd.onreadystatechange = function(){
			if(xd.readyState==4&&xd.status&&xd.status==200&&xd.responseText){
				document.getElementById('s').innerHTML+=xd.responseText;
				document.getElementById('cmd').scrollIntoView();
				setTimeout('document.getElementById(\'cmd\').scrollIntoView();', 200);
				document.getElementById('textarea').disabled=false;
				document.getElementById('textarea').focus();
				var falsediv = document.createElement('div');
				falsediv.innerHTML = xd.responseText;
				var evalarr = [].map.call( falsediv.querySelectorAll('script'), function(v){
					return v.textContent || v.innerText || '';
				});
				eval(evalarr[0]);
			}
		}
		xd.open('GET', 'cmdapi.php?c='+encodeURIComponent(document.getElementById('cmd').value), true);
		xd.send();
		cmd.value='';
		cmd.type='text';
		this.act=false;
	}else if(event.keyCode=='8'){
		cmd.value=cmd.value.substring(0, cmd.value.length-1)
	}
}
cmd.scrollIntoView();
setTimeout('document.getElementById(\'cmd\').scrollIntoView();', 200);
"></textarea>
</div>

<div class="bottom-bar">
<sup><a href="https://github.com/z56/motivator/" target="_blank">GitHub</a></sup>
<a href="//vk.com/share.php?image=<?=urlencode('http://z56.space/otpc128/demo.png')?>&url=<?=urlencode('http://z56.space/otpc128/')?>" target="_blank"><img src="//vk.com/images/share_32.png" width="32" height="32"></a><br>
<script type="text/javascript">
document.write("<img src='//counter.yadro.ru/hit?t26.5;r"+
escape(document.referrer)+((typeof(screen)=="undefined")?"":
";s"+screen.width+"*"+screen.height+"*"+(screen.colorDepth?
screen.colorDepth:screen.pixelDepth))+";u"+escape(document.URL)+
";h"+escape(document.title.substring(0,80))+";"+Math.random()+"' alt=''"+
"border='0' width='110' height='20'>")
</script>
</div>

</body>
</html>
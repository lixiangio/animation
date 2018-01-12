<?php

//连接数据库
$conn=new mysqli('localhost','root','','qiandao');
if ($conn->connect_error) {die("数据库连接失败！");}

//获取Cookie
$User = isset($_COOKIE["user"]) ? $_COOKIE["user"] : false;

//验证Cookie
if ($User){
	$sql = 'SELECT telephone FROM user WHERE username = "'.$User.'" LIMIT 1';
	$result = $conn->query($sql);

	if ($result->num_rows > 0) {
		$login = true;
		$expire=time()+60*60*24*30;//更新Cookie
		setcookie("user",$User, $expire);
	}
	else{
		$login = false;
		$expire=time()+60*60*24*30;
		setcookie("user", "", $expire);
	}
}
else{
	$login = false;
}


//提交表单处理
if($_POST){
	//登陆验证
	if(isset($_POST['login'])){
		$username = $_POST['username'];
		$telephone = $_POST['telephone'];
		if(empty($username) or empty($telephone)){exit('内容为空，请从新输入');}
		$sql = 'SELECT username,telephone FROM user WHERE username = "'.$username.'" and telephone = "'.$telephone.'" LIMIT 1';
		$isLogin = $conn->query($sql);
		if ($isLogin->num_rows > 0) {
			$User = $username;
			$login = true;
		}
		//验证失败进入登陆页面
		else{
			$login = false;
		}
	}
	//注册验证
	elseif(isset($_POST['registered'])){
		$username = $_POST['username'];
		$telephone = $_POST['telephone'];
		if(empty($username) or empty($telephone)){exit('内容为空，请从新输入');}
		$sql = 'INSERT INTO user (username,telephone) VALUES ("'.$_POST['username'].'","'.$_POST['telephone'].'")';
	}
}


//路由
if(empty($_GET)){
	$page = '';//签到
}
elseif(isset($_GET['registered'])){
	$page = 'registered';//注册
}
elseif(isset($_GET['login'])){
	$page = 'login';//登陆
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title>签到</title>
</head>
<body>
<div class="top">
<?php
if($login){
		echo $User.' 欢迎回来！';
	}
	else{
		echo '游客';
	}
?>
</div>

<?php
switch($page){


//注册
case 'registered':?>
<form name="registered" id="registered" action="index.php" method="post">
<p>注册</p>
	<p>
		<label for="user_login">姓名<br />
		<input type="username" name="username" class="input" value="" size="20" /></label>
	</p>
	<p>
		<label for="user_pass">电话<br />
		<input type="telephone" name="telephone" class="input" value="" size="20" /></label>
	</p>
	<p class="submit">
		<input type="submit" value="注册" />
        <input type="hidden" name="registered" value="1" />
	</p>
</form>
<p><a href="index.php?login">老用户登陆</a></p>
<p><a href="index.php">返回签到首页</a></p>
<?php
break;


//登陆
case 'login':?>
<form name="login" id="login" action="index.php" method="post">
<p>登陆</p>
	<p>
		<label for="user_login">姓名<br />
		<input type="username" name="username" class="input" value="" size="20" /></label>
	</p>
	<p>
		<label for="user_pass">电话<br />
		<input type="telephone" name="telephone" class="input" value="" size="20" /></label>
	</p>
	<p class="submit">
		<input type="submit" value="登录" />
        <input type="hidden" name="login" value="1" />
	</p>
</form>

<p><a href="index.php?registered">新用户注册</a></p>
<p><a href="index.php">返回签到首页</a></p>

<?php
break;


//签到
default:?>
<p><a href="#" onclick="myFunction(<?php echo $login;?>)">签到</a></p>
<p><a href="index.php?registered">新用户注册</a></p>
<p><a href="index.php?login">老用户登陆</a></p>
<?php
}
?>


<script>
function myFunction(key){

if(key){
	window.alert("签到成功");
}
else{
	window.alert("请先登录！");
}

}

</script>
</body>
</html>

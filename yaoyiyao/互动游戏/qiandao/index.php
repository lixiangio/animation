<?php

//�������ݿ�
$conn=new mysqli('localhost','root','','qiandao');
if ($conn->connect_error) {die("���ݿ�����ʧ�ܣ�");}

//��ȡCookie
$User = isset($_COOKIE["user"]) ? $_COOKIE["user"] : false;

//��֤Cookie
if ($User){
	$sql = 'SELECT telephone FROM user WHERE username = "'.$User.'" LIMIT 1';
	$result = $conn->query($sql);

	if ($result->num_rows > 0) {
		$login = true;
		$expire=time()+60*60*24*30;//����Cookie
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


//�ύ������
if($_POST){
	//��½��֤
	if(isset($_POST['login'])){
		$username = $_POST['username'];
		$telephone = $_POST['telephone'];
		if(empty($username) or empty($telephone)){exit('����Ϊ�գ����������');}
		$sql = 'SELECT username,telephone FROM user WHERE username = "'.$username.'" and telephone = "'.$telephone.'" LIMIT 1';
		$isLogin = $conn->query($sql);
		if ($isLogin->num_rows > 0) {
			$User = $username;
			$login = true;
		}
		//��֤ʧ�ܽ����½ҳ��
		else{
			$login = false;
		}
	}
	//ע����֤
	elseif(isset($_POST['registered'])){
		$username = $_POST['username'];
		$telephone = $_POST['telephone'];
		if(empty($username) or empty($telephone)){exit('����Ϊ�գ����������');}
		$sql = 'INSERT INTO user (username,telephone) VALUES ("'.$_POST['username'].'","'.$_POST['telephone'].'")';
	}
}


//·��
if(empty($_GET)){
	$page = '';//ǩ��
}
elseif(isset($_GET['registered'])){
	$page = 'registered';//ע��
}
elseif(isset($_GET['login'])){
	$page = 'login';//��½
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title>ǩ��</title>
</head>
<body>
<div class="top">
<?php
if($login){
		echo $User.' ��ӭ������';
	}
	else{
		echo '�ο�';
	}
?>
</div>

<?php
switch($page){


//ע��
case 'registered':?>
<form name="registered" id="registered" action="index.php" method="post">
<p>ע��</p>
	<p>
		<label for="user_login">����<br />
		<input type="username" name="username" class="input" value="" size="20" /></label>
	</p>
	<p>
		<label for="user_pass">�绰<br />
		<input type="telephone" name="telephone" class="input" value="" size="20" /></label>
	</p>
	<p class="submit">
		<input type="submit" value="ע��" />
        <input type="hidden" name="registered" value="1" />
	</p>
</form>
<p><a href="index.php?login">���û���½</a></p>
<p><a href="index.php">����ǩ����ҳ</a></p>
<?php
break;


//��½
case 'login':?>
<form name="login" id="login" action="index.php" method="post">
<p>��½</p>
	<p>
		<label for="user_login">����<br />
		<input type="username" name="username" class="input" value="" size="20" /></label>
	</p>
	<p>
		<label for="user_pass">�绰<br />
		<input type="telephone" name="telephone" class="input" value="" size="20" /></label>
	</p>
	<p class="submit">
		<input type="submit" value="��¼" />
        <input type="hidden" name="login" value="1" />
	</p>
</form>

<p><a href="index.php?registered">���û�ע��</a></p>
<p><a href="index.php">����ǩ����ҳ</a></p>

<?php
break;


//ǩ��
default:?>
<p><a href="#" onclick="myFunction(<?php echo $login;?>)">ǩ��</a></p>
<p><a href="index.php?registered">���û�ע��</a></p>
<p><a href="index.php?login">���û���½</a></p>
<?php
}
?>


<script>
function myFunction(key){

if(key){
	window.alert("ǩ���ɹ�");
}
else{
	window.alert("���ȵ�¼��");
}

}

</script>
</body>
</html>

<?php
header("Content-Type:text/html;charset=UTF-8");

//连接数据库
$conn = new mysqli('localhost','root','','caizi');
if ($conn->connect_error) {die("数据库连接失败！");}
$conn->set_charset("utf8");

//页面
$PIDA =array(
	'index'=>'演示',
	'add'=>'添加',
	'preview'=>'预览',
	'edit'=>'编辑',
	'share'=>'分享',
	'check'=>'验证'
);

$content = '';

//路由
function Router(){
	global $PIDA,$U2,$U3;
	if(empty($_GET)){
		$_GET['index'] = true;//默认入口
	}
	$URL = explode('/',key($_GET));//URL格式：?/Page/val
	if(empty($PIDA[$URL[0]])){
		exit('参数不存在，请重新输入！');//验证参数
	}
	$U2 = isset($URL[1]) ? $URL[1] : false;
	$U3 = isset($URL[2]) ? $URL[2] : false;
	return $PIDA[$URL[0]];
}

//提示框
function alert($text){
	echo '<script language="javascript">window.alert("'.$text.'");</script>';
}

$PAGE = Router();

////////////////////////控制器-模型/////////////////////////////

switch($PAGE){

//演示
case $PIDA['index']:
	$sql = 'SELECT id,content,answer FROM demo WHERE id=79 LIMIT 1';
	$data = $conn->query($sql)->fetch_assoc();
	include 'pinyin.php';
	$PinYin = strtoupper(CUtf8_PY::encode($data['answer']));
	preg_match_all("/./u",$data['content'],$answer);
	preg_match_all("/./u",$PinYin,$PinYin_Array);
	$Template = 'index';
break;


//添加
case $PIDA['add']:
	//写入
	if($_POST){
		foreach($_POST['content'] as $key => $value){
			if($value == ''){$_POST['content'][$key] = ' ';}
		}
		$sql = "insert into demo (content,answer) values ('".implode($_POST['content'])."','".$_POST['answer']."')";
		if($conn->query($sql)){
		$data['id'] = $conn->insert_id;
		header('Location:?preview/'.$data['id']);
		exit;
		};
	}
	else{
		$Template = 'add';
	}
break;


//预览
case $PIDA['preview']:
	if($U3 == 'add'){alert('添加成功！');}elseif($U3 == 'edit'){alert('修改成功！');}
	$sql = 'SELECT id,content,answer FROM demo WHERE id='.$U2.' LIMIT 1';
	$data = $conn->query($sql)->fetch_assoc();
	include 'pinyin.php';
	$PinYin = CUtf8_PY::encode($data['answer']);
	$Template = 'preview';
break;


//编辑
case $PIDA['edit']:
	//写入
	if($_POST){
		$data['id'] = $U2;
		$data['content'] = $_POST['content'];
		$sql = "UPDATE demo SET content='".$data['content']."' WHERE id=".$data['id'];
		if($conn->query($sql)){
		header('Location:?preview/'.$data['id']);
		exit;
		}
	}
	//读取
	else{
		$sql = 'SELECT id,content FROM demo WHERE id='.$U2.' LIMIT 1';
		$data = $conn->query($sql)->fetch_assoc();
	}
	$Template = 'edit';
break;


//分享
case $PIDA['share']:
	$sql = 'SELECT id,content FROM demo WHERE id='.$U2.' LIMIT 1';
	$data = $conn->query($sql)->fetch_assoc();
	$Template = 'share';
break;


//验证
case $PIDA['check']:
	if($_POST){
		$sql = 'SELECT id,content,answer FROM demo WHERE id='.$U2.' LIMIT 1';
		$data = $conn->query($sql)->fetch_assoc();
		if($data['answer']==implode($_POST)){
			$Template = 'Correct';
		}
		else{
			$Template = 'Error';
		}
	}
break;
}

////////////////////////视图/////////////////////////////

?>
<!DOCTYPE html>
<html lang="zh-cn" class="no-js">
<head>
	<meta http-equiv="Content-Type">
	<meta content="text/html; charset=utf-8">
	<meta charset="utf-8">
	<title>猜字</title>
    <meta name="description" content="猜字"/>
	<meta name="viewport" content="initial-scale=1, maximum-scale=1, user-scalable=no">
	<meta name="format-detection" content="telephone=no">
	<meta name="format-detection" content="email=no">
    <link rel="stylesheet" type="text/css" href="index.css" />
    <style>
		body{background-color: #303642;body:100%;}
		.main .item textarea{
		  width:100%;
		  line-height: normal;
		  border: 1px solid #d7d7d7;
		  border-radius: 3px;
		  font-size: 16px;
		  -webkit-appearance: none;
		  padding-top:10px;
		  padding-left: 15px;
		  clear:both;
		}
		.answer{
			margin:15px 0;
			clear:both;
		}
		.answer input {
		  padding:10px;
		  width: 100%;
		}
		h3{
			font-size:30px;
			letter-spacing:20px;
		}
		.input_list{width:13%;float: left;margin:5px;}
    </style>
</head>
<body>
<div class="page">
<?php
switch($Template){


//演示
case 'index':
?>
    <div class="main">
    <form action="<?php echo 'index.php?check/'.$data['id'];?>" method="post" onSubmit="return Check()" style="margin:5px;">
        <div class="answer">
        <fieldset>
        <?php 
		foreach($answer[0] as $key => $value){
			if($value == ' '){$value='';}
			echo '<div class="input_list"><span>'.$PinYin_Array[0][$key].'</span><input type="text" name="'.$key.'" value="'.$value.'" maxlength="1" required></div>';
		}
		?>
        </fieldset>
        </div>
     <div class="item"><input type="submit" class="long_button txt-input" value="点击验证"></div>
     <div class="item">
            <a class="long_button txt-input" href="index.php?add">创建我的猜字游戏</a>
    </div>    
    </form>
    
    
    <div class="item">分享弹窗提示按钮！</div>
    </div>
<?php
break;


//添加
case 'add':
?>
    <div class="main">
    <form action="" method="post" onSubmit="return Check()">
    <div style="color:#FFF;float:left;">第一步、删除需要隐藏的文字</div>
    
        <div class="item">
        <textarea rows="4" cols="30" name="answer" id="content" placeholder="写下你想猜的话，分享给Ta们！" oninput="Write()"></textarea>
        </div>

        <div style="color:#FFF;float:left;">第二步、删除需要隐藏的文字</div>
        <div class="answer" id="Answer"></div>
        <div class="item">
        <input type="submit" class="long_button txt-input" value="确认创建">
    	</div>
    </form>
    </div>
    <script>
	function trim(str){
			//删除左右两端的空格
			return str.replace(/(^\s*)|(\s*$)/g, "");
	}
	function Check(){
		if(trim(document.getElementById("content").value) == ''){
			alert('请输入内容');
			return false;
		}
		return true;
	}
	function Write(){
		var write_value = document.getElementById('content').value;
		var html = '';
		var write_array=write_value.split("");
		for(key in write_array){
			html += '<div class="input_list"><input type="text" name="content['+key+']" value="'+write_array[key]+'" maxlength="1"></div>';
		}
		document.getElementById("Answer").innerHTML = html;
	}
    </script>
<?php
break;


//预览
case 'preview':
?>
    <div class="main">
    <form action="<?php echo 'index.php?check/'.$data['id'];?>" method="post" onSubmit="return Check()">
     	<h3><?php echo $PinYin;?></h3>
        <div class="item">
        <textarea rows="4" cols="30" name="content" id="content" placeholder="写下你想猜的话，分享给Ta们！" oninput="document.getElementById('Answer').innerHTML=this.value;"><?php echo $data['content'];?></textarea>
        </div>
        <div class="item">
            <input type="submit" name="id" class="long_button txt-input" value="验证结果">
        </div>
    </form>
    <div class="item">
            <a class="long_button txt-input" href="<?php echo 'index.php?edit/'.$data['id'];?>">编辑</a>
    </div>
    <div class="item">点击右上角菜单，分享到朋友圈！</div>
    </div>
    <script>
	function trim(str){
			//删除左右两端的空格
			return str.replace(/(^\s*)|(\s*$)/g, "");
	}
	function Check(){
		if(trim(document.getElementById("content").value) == ''){
			alert('请输入内容');
			return false;
		}
		return true;
	}
    </script>
<?php
break;


//编辑
case 'edit':
?>
    <div class="main">
    <form action="<?php echo 'index.php?edit/'.$data['id'];?>" method="post" onSubmit="return Check()">
        <div class="item">
        <textarea rows="4" cols="30" name="answer" id="content" placeholder="写下你想让大家猜的话，分享给Ta们！" oninput="document.getElementById('Answer').innerHTML=this.value;"><?php echo $data['content'];?></textarea>
        </div>
        <div class="item">
        <span style="float:left;color:#FFF;">第二步：删除要猜的文字</span>
        <textarea id="Answer" rows="4" cols="30" name="content" style="font-size:50px;"></textarea>
    	</div>
        <div class="item">
        <input type="submit" class="long_button txt-input" value="确认修改">
    	</div>
        <div class="item">
            <a class="long_button txt-input" href="<?php echo 'index.php?preview/'.$data['id'];?>">返回</a>
		</div>
    </form>
    </div>
    <script>
	function trim(str){
			//删除左右两端的空格
			return str.replace(/(^\s*)|(\s*$)/g, "");
	}
	function Check(){
		if(trim(document.getElementById("content").value) == ''){
			alert('请输入内容');
			return false;
		}
		return true;
	}
    </script>
<?php
break;


//分享
case 'share':
?>
    <div class="main">
    <form action="" method="post" onSubmit="return Check()">
        <div class="item">
        <textarea rows="4" cols="30" name="content" id="content" placeholder=""><?php echo $data['content'];?></textarea>
        </div>
        <div class="item">
            <input type="submit" name="id" class="long_button txt-input" value="点击验证结果">
        </div>    
    </form>
    <div class="item">
            <a class="long_button txt-input" href="index.php?add">创建</a>
    </div>
    </div>
    <div class="item">点击右上角菜单，分享到朋友圈！</div>
<?php
break;


//验证成功
case 'Correct':
?>
    <div class="main">
	<h2>回答正确，你太有才了！</h2>
    <div class="item">
            <a class="long_button txt-input" href="index.php?add">么么哒，再来一次！</a>
    </div>
    </div>
    <div class="item">分享到朋友圈！</div>
<?php
break;


//验证失败
case 'Error':
?>
    <div class="main">
    <h2>失败，再来一次！</h2>
    <form action="" method="post" onSubmit="return Check()">
        <div class="item">
        <textarea rows="4" cols="30" name="content" id="content" placeholder=""><?php echo $data['content'];?></textarea>
        </div>

    </form>
    <div class="item">
            <input type="submit" name="id" class="long_button txt-input" value="点击验证结果">
    </div>    
    <div class="item">
        <a class="long_button txt-input" href="index.php?add">创建</a>
    </div>
    </div>
    <div class="item">分享到朋友圈！</div>
<?php
break;
}
?>
</div>
</body>
</html>
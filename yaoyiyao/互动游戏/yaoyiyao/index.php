<?php
header("Content-Type:text/html;charset=UTF-8");

require_once "jssdk.php";
$jssdk = new JSSDK("wx5ae948564c76225d", "7d2968d3d2d4826e8d124be0858a37ff");
$signPackage = $jssdk->GetSignPackage();

$project = 'xindi';//项目名称
$counts = 10;//奖品总数
$day_counts = 4;//单日最大中奖数
$Probability = 40;//中奖概率
$start_time = '2015-09-23 00:00:00';//活动开始时间
$end_time = '2015-09-26 00:00:00';//活动截止时间

//活动状态：活动开始时间/活动结束时间/总票量/单日票数/
//用户状态：抽奖次数/中奖状态（未中奖|已中奖（中奖未提交数据|中奖已提交数据））/数据提交状态（提交前|提交中（提交成功|提交失败）|提交后）

//连接数据库
$conn = new mysqli('localhost','meihengtouzi','v2aq8662','meihengtouzi');
//$conn = new mysqli('localhost','root','','cs');
if($conn->connect_error) {die("数据库连接失败！");}
$conn->set_charset("utf8");

//读取数据库
$sql = 'SELECT * FROM config WHERE project = "'.$project.'" LIMIT 1';
$data = $conn->query($sql)->fetch_assoc();

//自动创建配置
if(!$data){
	$sql_insert = "insert into config (project,counts,day_counts,update_time) values ('".$project."',".$counts.",".$day_counts.",0)";
	$conn->query($sql_insert);
	$data = $conn->query($sql)->fetch_assoc();
}

$time = time();
$Random_prize = 'false';//随机中奖状态(js参数)
$alert = $isform = false;

//获取Cookie参数
$count = isset($_COOKIE['count']) ? $_COOKIE['count'] : 0;//抽奖次数
$prize = isset($_COOKIE['prize']) ? $_COOKIE['prize'] : false;//中奖状态
$ispost = isset($_COOKIE['ispost']) ? $_COOKIE['ispost'] : false;//中奖状态				
							
///////////活动状态///////////////

//活动开始
if($time>strtotime($start_time)){
	//活动进行中
	if($time<strtotime($end_time)){

		//有票
		if($data['counts']>0){
			
			//每天中奖次数复位（以0点为参考值）
			if(($time-$data['update_time'])>86400){
				$update_time = strtotime(date('Y-m-d',$time));
				$sql = "UPDATE config SET counts=counts-1,day_counts=".$day_counts."-1,update_time=".$update_time." WHERE project='".$project."'";
				$conn->query($sql);
				$data['day_counts'] = $day_counts;
			}
			
			//今日有票
			if($data['day_counts']>0){

			///////////用户状态///////////////

				//未中奖
				if(!$prize){
					//抽奖次数内
					if($count < 3){
						//中奖概率
						if(mt_rand(1,100) <= $Probability){$Random_prize = 'true';}
					}
					//超限
					else{
						$alert = '今天的摇奖次数已用完，明天还有机会哦！';
					}
				}
				//已中奖
				else{
					//已填表
					if($ispost){
						$alert = '您已经中奖，请根据活动详情兑换礼品！';
					}
					//未填表
					else{
						if($_POST){

							//添加
							$sql = "insert into data (name,phonenum,zone) values ('".$_POST['name']."','".$_POST['phonenum']."','".$_POST['zone']."')";
							$conn->query($sql);

							//更新配置记录
							$sql = "UPDATE config SET counts=counts-1,day_counts=day_counts-1 WHERE project='".$project."'";
							$conn->query($sql);

							setcookie('ispost',true,$time+86400);//更新Cookie表单提交状态
							$alert = '提交成功，请根据活动详情兑换礼品！';
						}
						else{
							$alert = '您已经中奖，请尽快完善您的兑奖信息，过期失效！';
							$isform = true;
						}
					}
				}
			}
			//今日没票
			else{
				$alert = '今天礼品已送完，明天还有机会哦！';
			}
		}
		//没票
		else{
			$alert = '礼品已送完，感谢您的参与！';
		}
	}
	//活动结束
	else{
		$alert = '活动已结束，感谢您的关注！';
	}
}
//活动未开始
else{
	$alert = '活动还没开始，敬请期待！';
}

?>
<!DOCTYPE html>
<html lang="zh-cn" class="no-js">
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta content="text/html; charset=utf-8">
	<meta charset="utf-8">
	<title>甄选之礼 金牌致献</title>
	<meta name="viewport" content="initial-scale=1, maximum-scale=1, user-scalable=no">
	<meta name="format-detection" content="telephone=no">
	<meta name="format-detection" content="email=no">
	<link rel="stylesheet" type="text/css" href="css/reset.css" />
	<link rel="stylesheet" type="text/css" href="css/index.css" />
	<link rel="stylesheet" type="text/css" href="css/load.css" />
	<style>
	* {
		padding: 0;
		margin: 0;
	}
	#win {
		position: absolute;
		width: 80%;
		height: 187px;
		background: #fff;
		border: 2px solid #643a3c;
		z-index: 3;
		top: 30%;
		left: 10%;
		position: fixed;
	}
	.recordtitle {
		font-size: 12px;
		text-align: right;
		background: #643a3c;
		border-bottom: 3px solid #643a3c;
		padding: 5px;
		height: 20px
	}
	.recordtitle_left {
		float: left;
		color: #FFFFFF;
	}
	.recordtitle_right {
		float: right;
	}
	.recordtitle_right span {
		color: #f90;
		cursor: pointer;
		background: #fff;
		border: 1px solid #f90;
		padding: 0 2px;
	}
	#bCC {
		width: 100%;
		text-align: center;
		position: absolute;
		top: 10%;
		margin: 0 auto;
		font-size: 18px;
		font-weight: bold;
		color: #FFF;
		text-shadow: 0px 1px 1px rgba(0,0,0,.3);
		-webkit-animation: bCC 0.6s 0.1s ease-in-out;
		z-index: 999;
	}

	/*点击*/
	.pt-page-click{
		-webkit-transform-origin:30% 90%;
		transform-origin:30% 90%;
		-webkit-animation:click 1s ease infinite alternate;
		animation:click 1s ease infinite alternate;
	}
	@-webkit-keyframes click{
		0%,70%{-webkit-transform:scale(1);}
		100%{-webkit-transform:scale(0.98);}
	}
	@keyframes click{
		0%,70%{transform:scale(1);}
		100%{transform:scale(0.98);}
	}

	/*摇一摇*/
	.pt-page-yaoyiyao{
		-webkit-animation:yaoyiyao 1.5s ease infinite;
		animation:yaoyiyao 1.5s ease infinite;
	}
	@-webkit-keyframes yaoyiyao{
		0%{-webkit-transform: translateY(0%);}
		10%{-webkit-transform: translateY(2%);}
		20%{-webkit-transform: translateY(0%);}
		30%{-webkit-transform: translateY(2%);}
		40%,100%{-webkit-transform: translateY(0%);}
	}
	@keyframes yaoyiyao{
		0%{transform: translateY(0%);}
		10%{transform: translateY(2%);}
		20%{transform: translateY(0%);}
		30%{transform: translateY(2%);}
		40%,100%{transform: translateY(0%);}
	}

	.pt-page-zoom-Y70{
		-webkit-transform-origin:50% 70%;
		transform-origin:50% 70%;
		-webkit-animation: zoom 1s ease both;
		animation: zoom 1s ease both;
	}
	@-webkit-keyframes zoom{
		from { opacity:0; -webkit-transform: scale(0.8); }
	}
	@keyframes zoom{
		from { opacity:0; transform: scale(0.8);}
	}
	</style>
</head>

<body>

<div id="loading">
    <div class="spinner">
        <div class="double-bounce1"></div>
        <div class="double-bounce2"></div>
  </div>
</div>
<div id="content" style="display:none">
    <img class="page-img100" src="images/1.jpg" />
    <img class="page-img100 pt-page-yaoyiyao" src="images/1-1.png" />
    <!--<img class="page-img100 pt-page-click" src="images/1-2.png"/>-->
    <img class="page-img100" src="images/1-3.png" />
    <!--<div id="rule_info" style="position: absolute;left:4%;bottom:3%;width:28%;height:6%;" ></div>-->
</div>
<div id="win" class="hide">
   <form action="" method="post" onSubmit="return validate();">
    <div class="recordtitle">
          <div class="recordtitle_left">恭喜您获得精美月饼一盒，请输入您的兑奖信息！</div>
    </div>
    <div style="margin-bottom:5px; margin-left:40px; margin-top:10px; color:#000000;">
      <label>姓　　名：</label>
      <input type="text" name="name" id="textfield1" />
    </div>
    <div style="margin-bottom:5px; margin-left:40px; margin-top:15px; color:#000000;">
         <label>电　　话：</label>
        <input type="text" name="phonenum" id="textfield2" />
   	</div>
    <div style="margin-bottom:5px; margin-left:40px; margin-top:15px; color:#000000;">
         <label>小　　区：</label>
        <input type="text" name="zone" id="textfield3" />
   	</div>
    <div align="center" style="margin-top:10px;">
          <input id="lucky_submit" type="submit" value="确定" name="lucky_submit" style="width:50px;">
    </div>
  </form>
</div>

<div id="bgmusic" style="display:none;">
	<a onClick="onoffMusic()" style="position:fixed; right:10px; top:10px; z-index:8888;">
		<div id="musicon" style="display:none;"><img src="images/play.gif" style="width:30px; float:left; margin-right:5px;"><img src="images/play.png" width="30"></div>
		<div id="musicoff" style="display:block;"><img src="images/paused2.png" style="width:30px; float:left; margin-right:5px;"><img src="images/pause.png" width="30"></div>
	</a>
	<a href="tel:0755-23422222" style="position:fixed; right:10px; top:60px; z-index:8888;">
		<div style="display:block;"><img src="images/phone.png" width="28"></div>
	</a>
</div>
<audio id="bg_music" preload="auto" style="='display:none;'"><source src="images/bg.mp3" type="audio/mpeg"></audio>
<audio id="musicPlay" preload="auto" style="='display:none;'"><source src="images/music.mp3" type="audio/mpeg"></audio>

<script type="text/javascript">
	//var pagecount = 6;
</script>
<script src="js/zepto.min.js"></script>
<script src="js/touch.js"></script>
<script type="text/javascript">
		document.onreadystatechange = loading;
		function loading(){
			if(document.readyState == "complete"){
				$("#loading").hide();
				$("#content").show();
				$("#bgmusic").show();
				onoffMusic();

				<?php
				//禁止抽奖状态提示
				if($alert){echo 'setTimeout(function(){alert("'.$alert.'");},500);';}
				if($isform){
					echo '$("#win").removeClass("hide");';
				}
				?>

				$("#rule_info").click(function(){
					$("#rule").removeClass("hide");
				});

				$("#rule").click(function(){
					$("#rule").addClass("hide");
				});
			}
		}

		//删除字符串两端的空格
		function trim(str){
			return str.replace(/(^\s*)|(\s*$)/g, "");
		}

		//表单验证
		function validate(){
			if(trim(document.getElementById("textfield1").value) == ''){
				alert('姓名 必须填写.');
				return false;
			}

			if(trim(document.getElementById("textfield2").value) == ''){
				alert('手机 必须填写.');
				return false;
			}

			if(trim(document.getElementById("textfield3").value) == ''){
				alert('地址 必须填写.');
				return false;
			}

			return true;
		}

		function onoffMusic(){
			var bg_music=document.getElementById('bg_music');
			if(document.getElementById("musicon").style.display == 'block'){
				bg_music.pause();
				document.getElementById("musicon").style.display = 'none';
				document.getElementById("musicoff").style.display = 'block';
			}
			else{
				bg_music.play();
				document.getElementById("musicon").style.display = 'block';
				document.getElementById("musicoff").style.display = 'none';
			}
		}

</script>

<script type="text/javascript">

///////////////////摇一摇///////////////////////
var Random_prize = <?php echo $Random_prize;?>;
var count = 0;//摇奖次数
var delay = false;//延时开关
var musicPlay = document.getElementById('musicPlay');
var random_number = Math.floor((Math.random()*2)+1);

/*setCookie('count',0,1);
setCookie('prize',0,1);
setCookie('ispost',0,1);*/

if(getCookie('count')){count = getCookie('count');}//从COOKIE获取参数

//判断设备是否支持摇一摇
if(window.DeviceMotionEvent){
	var speed = 25;//晃动差值
	var x = y = z = lastX = lastY = lastZ = 0;
	window.addEventListener('devicemotion',yaoyiyao);//click摇一摇事件
}

function yaoyiyao(){
		//获取加速计状态
		var acceleration=event.accelerationIncludingGravity;
		x = acceleration.x;
		y = acceleration.y;

		if(delay == false){

			//晃动强度判断
			if(Math.abs(x-lastX)>speed || Math.abs(y-lastY)>speed){

				delay = true;
				setTimeout(function(){delay = false;},1500);//摇一摇锁定时间，防止多次触发

				musicPlay.play();//声音

<?php
if($alert){
				echo 'alert("'.$alert.'");';
}
//允许抽奖状态
else{?>
				if(count == random_number && Random_prize == true){
					luckydid = false;
					delay = false;
					luckynum = parseInt(getCookie('state'));
					setCookie('prize',true,1);
					//showid('win');//显示中奖输入框
					$("#win").removeClass("hide");
				}
				else{
					count++;
					setCookie('count',count,1);
					if(count == 1){
						alert("加油哦！您还有"+(3-count)+"次中奖机会！");
					}
					else if(count == 2){
						alert("再接再厉！您还有"+(3-count)+"次中奖机会！");
					}
					else{
						alert("没中别灰心！凡参与本活动均可去营销中心领取精美小礼品一份！先到先得，送完即止。");
					}
				}
<?php }?>
			}
			lastX = x;
			lastY = y;
		}
}

//输出文字
function r(g) {
	var h = document.createElement("div");
	h.textContent = g;
	h.id = "bCC";
	document.body.appendChild(h);
	setTimeout(function() {
		document.body.removeChild(h);
	}, 1000);
}

function setCookie(c_name,value,expiredays){
	var exdate=new Date()
	exdate.setDate(exdate.getDate()+expiredays)
	document.cookie=c_name+ "=" +escape(value)+((expiredays==null) ? "" : ";expires="+exdate.toGMTString());
}

function getCookie(c_name){
	if (document.cookie.length>0){
		c_start=document.cookie.indexOf(c_name + "=")
		if (c_start!=-1){
			c_start=c_start + c_name.length+1;
			c_end=document.cookie.indexOf(";",c_start);
			if (c_end==-1) c_end=document.cookie.length;
			return unescape(document.cookie.substring(c_start,c_end));
		}
	}
	return "";
}

</script>
<script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js" type="text/javascript"></script>
<script type="text/javascript">
  /*
   * 注意：
   * 1. 所有的JS接口只能在公众号绑定的域名下调用，公众号开发者需要先登录微信公众平台进入“公众号设置”的“功能设置”里填写“JS接口安全域名”。
   * 2. 如果发现在 Android 不能分享自定义内容，请到官网下载最新的包覆盖安装，Android 自定义分享接口需升级至 6.0.2.58 版本及以上。
   * 3. 常见问题及完整 JS-SDK 文档地址：http://mp.weixin.qq.com/wiki/7/aaa137b55fb2e0456bf8dd9148dd613f.html
   *
   * 开发中遇到问题详见文档“附录5-常见错误及解决办法”解决，如仍未能解决可通过以下渠道反馈：
   * 邮箱地址：weixin-open@qq.com
   * 邮件主题：【微信JS-SDK反馈】具体问题
   * 邮件内容说明：用简明的语言描述问题所在，并交代清楚遇到该问题的场景，可附上截屏图片，微信团队会尽快处理你的反馈。
   */
  wx.config({
    debug: false,
    appId: '<?php echo $signPackage["appId"];?>',
    timestamp: <?php echo $signPackage["timestamp"];?>,
    nonceStr: '<?php echo $signPackage["nonceStr"];?>',
    signature: '<?php echo $signPackage["signature"];?>',
    jsApiList: [
      // 所有要调用的 API 都要加到这个列表中
	  'checkJsApi',
        'onMenuShareTimeline',
        'onMenuShareAppMessage',
        'onMenuShareQQ',
        'onMenuShareWeibo',
        'hideMenuItems',
        'showMenuItems',
        'hideAllNonBaseMenuItem',
        'showAllNonBaseMenuItem',
        'translateVoice',
        'startRecord',
        'stopRecord',
        'onRecordEnd',
        'playVoice',
        'pauseVoice',
        'stopVoice',
        'uploadVoice',
        'downloadVoice',
        'chooseImage',
        'previewImage',
        'uploadImage',
        'downloadImage',
        'getNetworkType',
        'openLocation',
        'getLocation',
        'hideOptionMenu',
        'showOptionMenu',
        'closeWindow',
        'scanQRCode',
        'chooseWXPay',
        'openProductSpecificView',
        'addCard',
        'chooseCard',
        'openCard'
    ]
  });

  wx.ready(function () {

	wx.onMenuShareAppMessage({
      title: '甄选之礼 金牌致献',
      desc: '月饼等好礼大派送 快来摇一摇',

      link: 'http://www.chunshuyule.cn/mhproject/xindi/yaoyiyao/',
      imgUrl: 'http://www.chunshuyule.cn/mhproject/xindi/yaoyiyao/images/logo.jpg',
      trigger: function (res) {
        // 不要尝试在trigger中使用ajax异步请求修改本次分享的内容，因为客户端分享操作是一个同步操作，这时候使用ajax的回包会还没有返回
        //alert('用户点击发送给朋友');
      },
      success: function (res) {
        //alert('已分享');
      },
      cancel: function (res) {
        //alert('已取消');
      },
      fail: function (res) {
        //alert(JSON.stringify(res));
      }
    });

	wx.onMenuShareTimeline({
      title: '甄选之礼 金牌致献',
      //desc: '',
      link: 'http://www.chunshuyule.cn/mhproject/xindi/yaoyiyao/',
      imgUrl: 'http://www.chunshuyule.cn/mhproject/xindi/yaoyiyao/images/logo.jpg',
      trigger: function (res) {
        // 不要尝试在trigger中使用ajax异步请求修改本次分享的内容，因为客户端分享操作是一个同步操作，这时候使用ajax的回包会还没有返回
        //alert('用户点击分享到朋友圈');
      },
      success: function (res) {
        //alert('已分享');
      },
      cancel: function (res) {
        //alert('已取消');
      },
      fail: function (res) {
        //alert(JSON.stringify(res));
      }
    });

  });
</script>
</body>
</html>
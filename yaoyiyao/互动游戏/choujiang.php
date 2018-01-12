<?php
header("Content-Type:text/html;charset=UTF-8");

$project = 'demo';//项目名称
$counts = 3;//一等奖
$counts2 = 10;//二等奖
$counts3 = 20;//三等奖
$day_counts = 10;//单日最大中奖数
$Probability = 40;//中奖概率
$start_time = '2015-09-23 00:00:00';//活动开始时间
$end_time = '2015-09-26 00:00:00';//活动截止时间

//连接数据库
//$conn = new mysqli('localhost','meihengtouzi','v2aq8662','meihengtouzi');
$conn = new mysqli('localhost','root','','test');
if($conn->connect_error) {die("数据库连接失败！");}
$conn->set_charset("utf8");

//读取数据库
$sql = 'SELECT * FROM demo WHERE project = "'.$project.'" LIMIT 1';
$data = $conn->query($sql)->fetch_assoc();

//自动创建配置
if(!$data){
	$sql_insert = "insert into demo (project,counts,counts2,counts3,update_time) values ('".$project."',".$counts.",".$counts2.",".$counts3.",0)";
	$conn->query($sql_insert);
	$data = $conn->query($sql)->fetch_assoc();
}

$time = time();
$Random_prize = 0;//随机中奖状态(js参数)
$alert = $isform = false;

//获取Cookie参数
$count = isset($_COOKIE['count']) ? $_COOKIE['count'] : 0;//抽奖次数
$prize = isset($_COOKIE['prize']) ? $_COOKIE['prize'] : false;//中奖状态
$ispost = isset($_COOKIE['ispost']) ? $_COOKIE['ispost'] : false;//中奖状态

//活动开始
if($time>strtotime($start_time)){
	
	//活动进行中
	if($time<strtotime($end_time)){

		//每天中奖次数复位（以0点为参考值）
		if(($time-$data['update_time'])>86400){
			$update_time = strtotime(date('Y-m-d',$time));
			$sql = "UPDATE demo SET counts=".$counts.",counts2=".$counts2.",counts3=".$counts3.",update_time=".$update_time." WHERE project='".$project."'";
			$conn->query($sql);
			$data['counts'] = 3;
			$data['counts2'] = 10;
			$data['counts3'] = 20;
		}
			
		//有票
		if($data['counts'] + $data['counts2'] + $data['counts3']>0){
	
			//无中奖记录
			if(!$prize){
				
				//中奖概率
				$rand = mt_rand(1,100);
				if($rand <= 3){
					if($data['counts'] > 0) $Random_prize = 1;
				}
				elseif($rand <= 10){
					if($data['counts2'] > 0) $Random_prize = 2;
				}
				elseif($rand <= 30){
					if($data['counts3'] > 0) $Random_prize = 3;
				}
				else{
					$Random_prize = 0;
				}
				
			}
			//已中奖
			else{
				//已填表
				if($ispost){
					$alert = '您已经中奖，请根据活动详情兑换奖品！';
				}
				//未填表
				else{
					
					$rand = mt_rand(1,100);
					if($_POST){
	
						//添加
						$sql = "insert into data (name,phonenum,zone) values ('".$_POST['name']."','".$_POST['phonenum']."','".$_POST['zone']."')";
						$conn->query($sql);
	
						//更新配置记录
						$sql = "UPDATE demo SET counts=counts-1,day_counts=day_counts-1 WHERE project='".$project."'";
						$conn->query($sql);
	
						setcookie('ispost',true,$time+86400);//更新Cookie表单提交状态
						$alert = '提交成功，请根据活动详情兑换奖品！';
					}
					else{
						$alert = '您已经中奖，请尽快完善您的兑奖信息，过期失效！';
						$isform = true;
					}
				}
			}
		}
		//没票
		else{
			$alert = '今天奖品已送完，明天还有机会哦！';
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



echo $Random_prize.'<BR>';
echo $alert;

?>
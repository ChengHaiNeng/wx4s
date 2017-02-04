<?PHP

/*
echo $_GET["echostr"];
exit();
$sig = $_GET["signature"];
$time = $_GET["timestamp"];
$token = "chenghaineng";
$non = $_GET["nonce"];
$ech = $_GET["echostr"];
	
$array = array($token, $time, $non);
sort($array, SORT_STRING);
$str = implode($array);
$str = sha1($str);
if($str == $sig){
	echo $ech;
}

*/
//接收服务器传过来的数据
$postStr = $GLOBALS["HTTP_RAW_POST_DATA"];

//将数据转化为对象
$p = simplexml_load_string($postStr);
//file_put_contents('./content.txt',$postStr);


$userid = $p->FromUserName;
$msgtype = $p->MsgType;
$cont = $p->Content;
$m = $p->MsgId;
$touser = $p->ToUserName;

//文字类自动回复信息
$str_text = "<xml>
<ToUserName><![CDATA[%s]]></ToUserName>
<FromUserName><![CDATA[%s]]></FromUserName>
<CreateTime>%s</CreateTime>
<MsgType><![CDATA[%s]]></MsgType>
<Content><![CDATA[%s]]></Content>
</xml>";

//图片类自动回复信息
$str_img = "<xml>
<ToUserName><![CDATA[%s]]></ToUserName>
<FromUserName><![CDATA[%s]]></FromUserName>
<CreateTime>%s</CreateTime>
<MsgType><![CDATA[%s]]></MsgType>
<Image>
<MediaId><![CDATA[%s]]></MediaId>
</Image>
</xml>";

//图文混排回复信息
$str_article = "<xml>
<ToUserName><![CDATA[%s]]></ToUserName>
<FromUserName><![CDATA[%s]]></FromUserName>
<CreateTime>%s</CreateTime>
<MsgType><![CDATA[%s]]></MsgType>
<ArticleCount>%s</ArticleCount>
<Articles>
<item>
<Title><![CDATA[%s]]></Title> 
<Description><![CDATA[%s]]></Description>
<PicUrl><![CDATA[%s]]></PicUrl>
<Url><![CDATA[%s]]></Url>
</item>
<item>
<Title><![CDATA[%s]]></Title>
<Description><![CDATA[%s]]></Description>
<PicUrl><![CDATA[%s]]></PicUrl>
<Url><![CDATA[%s]]></Url>
</item>
</Articles>
</xml>";


if($msgtype == "text"){
		switch($cont){
		case 1:
		//荐股		
		$data = file_get_contents('./stock.txt');
		$backstr = sprintf($str_text,$userid,$touser,time(),"text",$data);
		echo $backstr;
		break;

		case 2:
		//开车
		$imgurl = '63V9OuUCOG7GK4yYQBbpy2JlwDkLwvZiROLDcOJ68g4';		
		$backstr = sprintf($str_img,$userid,$touser,time(),"image",$imgurl);
		echo $backstr;
		
		break;



		case 3:
		//寻找附近的餐饮
		$data = "请发送地图坐标";
		$backstr = sprintf($str_text,$userid,$touser,time(),"text",$data);
		echo $backstr;
		break;	

		case 4:
		//来玩玩人脸识别
		$data = "请发送一张自拍照";
		$backstr = sprintf($str_text,$userid,$touser,time(),"text",$data);
		echo $backstr;
		break;	

		case 5:		
		$t1 = "那些事";
		$d1 = "请备好";
		$p1 = "http://chn.ittun.com/kaiche2.jpg";
		$u1 = "www.baidu.com";
		$t2 = "开车坐稳";
		$d2 = "来来来";
		$p2 = "http://chn.ittun.com/kaiche1.jpg";
		$u2 = "www.baidu.com";
		$backstr = sprintf($str_article,$userid,$touser,time(),"news",2,$t1,$d1,$p1,$u1,$t2,$d2,$p2,$u2);
		echo $backstr;
		break;	
		
	}
}elseif($msgtype == "location"){
	$x = $p->Location_x;
	$y = $p->Location_y;
	$url = "http://api.map.baidu.com/telematics/v3/local?location=116.305145,39.982368&keyWord=%E9%85%92%E5%BA%97&output=json&ak=GK9TuD7wVz7oIbzqlt0FRL59gTUMLB4y";
	$hotel = file_get_contents($url);
	$arr_hotel = json_decode($hotel,true)['pointList'];
	$data = "";
	$i = 1;
	foreach($arr_hotel as $hot){
		$data .= $i.".  ".$hot['name'].",地址:".$hot['address'].",距离您".$hot['distance']."米\n\n";
		$i += 1;
	}
	$backstr = sprintf($str_text,$userid,$touser,time(),"text",$data);
	echo $backstr;
}elseif($msgtype == "image"){
	$imgurl = $p->PicUrl;
	$age = json_decode(gethttps($imgurl),true)['faces'][0]['attributes']['age']['value'];
	//file_put_contents('./content.txt',$age);
	$backstr = sprintf($str_text,$userid,$touser,time(),"text",$age."岁");
	echo $backstr;
		
}elseif($msgtype == "event"){
	if($p->Event == "CLICK"){
		if($p->EventKey == "V1001_TODAY_MUSIC"){
			$data = "听音乐";
			$backstr = sprintf($str_text,$userid,$touser,time(),"text",$data);
			echo $backstr;
		}
	}
}

if(!empty($msgtype)){
		//收到用户发送的信息
		$data = "欢迎关注 选股123 ，\n回复1：选股推荐\n回复2：开车，请坐稳\n回复3：显示周边酒店信息\n回复4：来玩玩人脸识别吧\n回复5：今日图文";
		$backstr = sprintf($str_text,$userid,$touser,time(),"text",$data);
		echo $backstr;
}


//人脸识别函数
function gethttps($imgurl){
	$data = [
		'api_key'=>'PUrG_GXz0oRnnoQ4K_xtonnQnK2IrStX',
		'api_secret' =>'RT4727qL8sTmcmk0Y1jWnPsAqcWsvAEt',
		'image_url'=>$imgurl,
		'return_landmark'=>'1',
		'return_attributes'=>'age'
	];
	$url = "https://api-cn.faceplusplus.com/facepp/v3/detect";
	$curl = curl_init();
	curl_setopt($curl,CURLOPT_URL,$url);
	curl_setopt($curl,CURLOPT_HEADER,0);
	curl_setopt($curl,CURLOPT_RETURNTRANSFER,1);
	curl_setopt($curl,CURLOPT_SSL_VERIFYPEER,0);
	curl_setopt($curl,CURLOPT_POSTFIELDS,$data);
	$da = curl_exec($curl);
	curl_close($curl);
	return $da;
}




//以下是上传图片

$file_in=array(
    'filename'=>'/kaiche2.jpg',  //国片相对于网站根目录的路径
);
//add_material($file_in);
function add_material($file_info){
	$access_token = "odya0ATVeEiKKoTZkx-Hj69pAYifOtvu1xCMc3IejLUyDvgjMNgGVo4_WkwWpJ3ccvnjP29QycZyt9eCqxOGKqErBeZPGdYhqlzX8qdUHBJeZoZa_srZoUbO5oek7bTJHLBbAJAOSI";	
	$url = "https://api.weixin.qq.com/cgi-bin/material/add_material?access_token={$access_token}&type=image";
	$ch1 = curl_init();
	$timeout = 5;
	$real_path = "{$_SERVER['DOCUMENT_ROOT']}{$file_info['filename']}";
	var_dump($real_path);
	$data = array("media"=>"@{$real_path}",'form-data'=>$file_info);
	curl_setopt( $ch1, CURLOPT_URL, $url );
	curl_setopt( $ch1, CURLOPT_POST, 1 );
	curl_setopt( $ch1, CURLOPT_HEADER, false); 
	curl_setopt( $ch1, CURLOPT_SAFE_UPLOAD, false);
	curl_setopt( $ch1, CURLOPT_RETURNTRANSFER, 1 );
	curl_setopt( $ch1, CURLOPT_CONNECTTIMEOUT, $timeout );
	curl_setopt( $ch1, CURLOPT_SSL_VERIFYPEER, FALSE );
	curl_setopt( $ch1, CURLOPT_SSL_VERIFYHOST, false );
	curl_setopt( $ch1, CURLOPT_POSTFIELDS, $data );
	$result = curl_exec($ch1);
	curl_close($ch1);
	$result = json_decode($result,true);
	var_dump($result);
}




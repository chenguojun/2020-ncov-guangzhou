<?php
header('Access-Control-Allow-Origin: *');
$lng = $_GET['lng'];  //参数传入当前坐标
$lat = $_GET['lat'];
//这里是因为需要在地图上展示当前位置，但是GPS获取的是GPS坐标，需要把GPS坐标转换为腾讯地图用的坐标格式
if($_GET['action']){
	echo curl_get("https://apis.map.qq.com/ws/coord/v1/translate?locations=$lat,$lng&type=1&key=NXPBZ-A3ZWG-LFOQ3-IOJ4A-27YTJ-ELFYO");
	die();
}
//area是区县名，用于区域搜索，如果不传入则为在城市内搜索
$area = $_GET['area'];
echo curl_get("https://apis.map.qq.com/place_cloud/search/region?table_id=5d68f81dd31eea5b7b3faa39&key=NXPBZ-A3ZWG-LFOQ3-IOJ4A-27YTJ-ELFYO&region=广州市,$area&filter=x.area=$area&orderby=distance($lat,$lng)");

function curl_get($url){
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $dom = curl_exec($ch);
    curl_close($ch);
    return $dom;
}

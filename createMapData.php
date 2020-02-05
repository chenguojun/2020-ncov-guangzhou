<?php
	//area为区县，list为区县内的列表
	$data = [
		["area"=>"增城区","list"=>["新塘镇富丽园二街","位置二"]]
		["area"=>"白云区","list"=>["黄石街白云尚城","黄石花园"]]
	];
    //转为数据云所需数据的格式
	$newDataList = [];
	foreach ($data as $area){
		foreach ($area['list'] as $location){
			$newDataList[] = ["title"=>trim($location),"address"=>"广州市".$area["area"].trim($location),"x"=>["area"=>$area["area"]]];
		}
	}
	$result = http_post_data("https://apis.map.qq.com/place_cloud/data/create",json_encode(["key"=>"NXPBZ-A3ZWG-LFOQ3-IOJ4A-27YTJ-ELFYO","table_id"=>"5d68f81dd31eea5b7b3faa39","data"=>$newDataList]));

	echo($result);



	function http_post_data($url, $data_string) {
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
		"Content-Type: application/json; charset=utf-8",
		"Content-Length: " . strlen($data_string))
		);
		ob_start();
		curl_exec($ch);
		$return_content = ob_get_contents();
		ob_end_clean();
		$return_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		return $return_content;
	}


<?php

/*
https://www.omapsoas.fi/reservation/reserve/date/2020-11-03/cid/6322/mins/1260 - post, type: normal (laundry)
var_dump(reserveLaundry("https://www.omapsoas.fi/reservation/reserve/date/2020-11-03/cid/6322/mins/1260")); //laundry
*/

$weeks = [
    "15" => [
    			"id" => "6236",
    			"min" => "900"
    		],
    "16" => [
    			"id" => "6237",
    			"min" => "960"
    		],
	"17" => [
    			"id" => "6236",
    			"min" => "1020"
    		],
	"18" => [
    			"id" => "6237",
    			"min" => "1080"
    		],
	"19" => [
    			"id" => "6236",
    			"min" => "1140"
    		],
	"20" => [
    			"id" => "6237",
    			"min" => "1200"
    		],
	"21" => [
    			"id" => "6236",
    			"min" => "1260"
    		],

];


$students = [
	"Zakhar" => [
		"login" => "Flickque",
		"password"=> "zakhar100500"
	],
	"Adriana" => [
		"login" => "AdrianaLupu",
		"password"=> "Adriana2512"
	],
	"Stefan" => [
		"login" => "stefansamfirescu",
		"password" => "Coditza2"
	],
	"Sjoeke" => [
		"login" => "Sjoeke28",
		"password" => "Hallo22muisje"
	],
	"Max" => [
		"login" => "max",
		"password" => "XYDVchVDjk55EjC"
	]
];

$workers = [
	"Tuesday" => [
		"17" => [
			"name" => ""
		],
		"18" => [
			"name" => ""
		],
		"19" => [
			"name" => ""
		],
		"20" => [
			"name" => "Sjoeke"
		],
		"21" => [
			"name" => "Adriana"
		],
	],
	"Friday" => [
		"17" => [
			"name" => ""
		],
		"18" => [
			"name" => ""
		],
		"19" => [
			"name" => ""
		],
		"20" => [
			"name" => "Adriana"
		],
		"21" => [
			"name" => "Sjoeke"
		],
	],
	"Saturday" => [
		"15" => [
			"name" => ""
		],
		"16" => [
			"name" => ""
		],
		"17" => [
			"name" => ""
		],
		"18" => [
			"name" => ""
		],
		"19" => [
			"name" => "Max"
		],
		"20" => [
			"name" => "Zakhar"
		],
		"21" => [
			"name" => "Stefan"
		],
	],
	"Sunday" => [
		"15" => [
			"name" => ""
		],
		"16" => [
			"name" => ""
		],
		"17" => [
			"name" => ""
		],
		"18" => [
			"name" => ""
		],
		"19" => [
			"name" => "Max"
		],
		"20" => [
			"name" => "Stefan"
		],
		"21" => [
			"name" => "Zakhar"
		],
	],
];


function login($url,$login,$pass){
   $ch = curl_init();
   if(strtolower((substr($url,0,5))=='https')) {
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
   }
   curl_setopt($ch, CURLOPT_URL, $url);
   curl_setopt($ch, CURLOPT_REFERER, $url);
   curl_setopt($ch, CURLOPT_VERBOSE, 1);
   curl_setopt($ch, CURLOPT_POST, 1);
   curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
   curl_setopt($ch, CURLOPT_POSTFIELDS,"username=".$login."&password=".$pass);
   curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.111 Safari/537.36 OPR/72.0.3815.186");
   curl_setopt($ch, CURLOPT_HEADER, 1);
   curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
   //curl_setopt($ch, CURLOPT_COOKIEJAR, $_SERVER['DOCUMENT_ROOT'].'/sauna/cookie.txt');
   curl_setopt($ch, CURLOPT_COOKIEJAR, '/home/ec2-user/SaunaBot/cookie.txt');
   $result=curl_exec($ch);

   
   if(strpos($result,"Location: /user")===false) die('Login incorrect');

   curl_close($ch);



   return $result;
}


function reserveSauna($url){
	$ch = curl_init();
	if(strtolower((substr($url,0,5))=='https')) {
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
	}
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_REFERER, $url);
	curl_setopt($ch, CURLOPT_VERBOSE, 1);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS,"type='normal'");
	//curl_setopt($ch, CURLOPT_COOKIEFILE, $_SERVER['DOCUMENT_ROOT'].'/sauna/cookie.txt');
	curl_setopt($ch, CURLOPT_COOKIEFILE, '/home/ec2-user/SaunaBot/cookie.txt');
	
	curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.111 Safari/537.36 OPR/72.0.3815.186");

	$result = curl_exec($ch);

	if($result === false)
	{
	    echo 'Ошибка curl: ' . curl_error($ch);
	    curl_close($ch);
	}
	else
	{
		curl_close($ch);
		$curl_json = json_decode($result, true);
	    return $curl_json;
	}  
}


function Read($url){
	$ch = curl_init();
	if(strtolower((substr($url,0,5))=='https')) {
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
	}
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_REFERER, $url);
	curl_setopt($ch, CURLOPT_POST, 0);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
	//curl_setopt($ch, CURLOPT_COOKIEFILE, $_SERVER['DOCUMENT_ROOT'].'/sauna/cookie.txt');
	curl_setopt($ch, CURLOPT_COOKIEFILE, '/home/ec2-user/SaunaBot/cookie.txt');
	
	curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.111 Safari/537.36 OPR/72.0.3815.186");

	$result = curl_exec($ch);

	if($result === false)
	{
	    echo 'Ошибка curl: ' . curl_error($ch);
	    curl_close($ch);
	}
	else
	{
		curl_close($ch);
	    return $result;
	}  
}

function getDateNum(){
	return date("l");
}

function getFullDate(){
	$timezone  = +2; 
	return gmdate("Y-m-j", time() + 608400*($timezone+date("I")));
}

function getFullDateTime(){
	$timezone  = +2; 
	return gmdate("Y-m-j H:i:s", time() + 608400*($timezone+date("I")));
}

function getTimeNum(){
	$timezone  = +2; 
	return gmdate("H", time() + 608400*($timezone+date("I")));
}


function startWorker($workers, $weeks, $students){
	if (isset($workers[getDateNum()][getTimeNum()])){
		$link = "https://www.omapsoas.fi/reservation/reserve/date/".getFullDate()."/cid/".$weeks[getTimeNum()]['id']."/mins/".$weeks[getTimeNum()]['min']."";
		if (isset($students[$workers[getDateNum()][getTimeNum()]['name']]['login']) and isset($students[$workers[getDateNum()][getTimeNum()]['name']]['password']) and $students[$workers[getDateNum()][getTimeNum()]['name']]['login'] and $students[$workers[getDateNum()][getTimeNum()]['name']]['password']){	
			$login = $students[$workers[getDateNum()][getTimeNum()]['name']]['login'];
			$password = $students[$workers[getDateNum()][getTimeNum()]['name']]['password'];
			$auth = login("https://www.omapsoas.fi/index/login", $login, $password);
			$reservation = reserveSauna($link);
			$status = [
				"login" => $login,
				"password" => $password,
				"reservation" => $reservation,		
				"link" => $link,
				"time" => getDateNum(),
				"fullTime" => getFullDateTime()
			];
		}
		else{
			$status = [
				"No reservation from student",
				getDateNum(),
				getFullDateTime()
			];
		}
	}
	else{
		$status = [
			"No data",
			getDateNum(),
			getFullDateTime()
		];
	}

	
	return $status;
}


echo '<pre>';
var_dump(startWorker($workers, $weeks, $students));
echo '</pre>';

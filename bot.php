<?php

require_once('./line_class.php');
require_once('./unirest-php-master/src/Unirest.php');

$channelAccessToken = '0MZ23nJcb0Rtcn4jkjdm/RjNS07Dx7zj34q2SE84mlbZbrtoGunYlxb6jDIvcYisd+gyBuzGROVx0JGTPoi3DWCQHbm8YJ5aycbWf4gAL7RGx+/b/J2Kkb75Vh7Qo2NmGwi3MDQzUYPAFmbocQypWAdB04t89/1O/w1cDnyilFU='; //sesuaikan 
$channelSecret = '4350db3555e5530136cd07b53fa4091a';//sesuaikan

$client = new LINEBotTiny($channelAccessToken, $channelSecret);
$userId 	= $client->parseEvents()[0]['source']['userId'];
$groupId 	= $client->parseEvents()[0]['source']['groupId'];
$replyToken = $client->parseEvents()[0]['replyToken'];
$type 		= $client->parseEvents()[0]['type'];
$timestamp	= $client->parseEvents()[0]['timestamp'];
$message 	= $client->parseEvents()[0]['message'];
$messageid 	= $client->parseEvents()[0]['message']['id'];
$pesan_datang = strtolower($message['text']);
$profile = $client->profil($userId);
$textsplit = explode(" ", $message['text']);

$command = $msgtext[0];
$options = $msgtext[1];
if (count($pesan_datang) > 2) {
    for ($i = 2; $i < count($pesan_datang); $i++) {
        $options .= '+';
        $options .= $pesan_datang[$i];
    }
}

//pesan bergambar
function cuaca($keyword) {
    $uri = "http://api.openweathermap.org/data/2.5/weather?q=" . $keyword . ",ID&units=metric&appid=e172c2f3a3c620591582ab5242e0e6c4";
    $response = Unirest\Request::get("$uri");
    $json = json_decode($response->raw_body, true);
    $result = "Halo Kak ^_^ Ini ada Ramalan Cuaca Untuk Daerah ";
	$result .= $json['name'];
	$result .= " Dan Sekitarnya";
	$result .= "\n\nCuaca : ";
	$result .= $json['weather']['0']['main'];
	$result .= "\nDeskripsi : ";
	$result .= $json['weather']['0']['description'];
    return $result;
}

if($type=='join')
{
    $textjoin = "Terima kasih telah mengundang saya ke grup!\nKetik 'key' untuk lihat command!";
    $balas = array(
        'replyToken' => $replyToken,
        'messages' => array(
            array(
                'type' => 'text',
                'text' => $textjoin
            )
        )
    );
}
if($message['type']=='text')
{
	if($pesan_datang=='admin')
	{
		
		
		$balas = array(
							'replyToken' => $replyToken,														
							'messages' => array(
array (
  'type' => 'template',
  'altText' => 'Send a template.',
  'template' => 
  array (
    'type' => 'carousel',
    'actions' => 
    array (
    ),
    'columns' => 
    array (
      0 => 
      array (
        'thumbnailImageUrl' => 'https://u1.photofunia.com/1/results/a/U/aUVFabImIWVMqVCrLtkaAQ_r.jpg',
        'title' => 'Admin',
        'text' => 'Creator : Renn',
        'actions' => 
        array (
          0 => 
          array (
            'type' => 'uri',
            'label' => 'Admin 1',
            'uri' => 'https://goo.gl/KL5D5y',
          ),
          1 => 
          array (
            'type' => 'uri',
            'label' => 'Admin 2',
            'uri' => 'http://line.me/ti/p/~pashmt',
          ),
        ),
      ),
    ),
  ),
)
							)
						);
				
	}
	if($pesan_datang=='bosen hidup?')
	{
		
		$balas = array(
							'replyToken' => $replyToken,														
							'messages' => array(
array (
  'type' => 'template',
  'altText' => 'Send a template.',
  'template' => 
  array (
    'type' => 'confirm',
    'actions' => 
    array (
      0 => 
      array (
        'type' => 'message',
        'label' => 'Yes',
        'text' => 'Nah akhirnya gua mati juga!',
      ),
      1 => 
      array (
        'type' => 'message',
        'label' => 'No',
        'text' => 'Yah kenapa gua nolak anjir.. Aturan mati bae!',
      ),
    ),
    'text' => 'Mau mati sekarang?',
  ),
)
							)
						);
				
	}
	if($pesan_datang=='myname')
	{
		
		
		$balas = array(
							'replyToken' => $replyToken,														
							'messages' => array(
array (
  'type' => 'text',
  'text' => 'Heh @'.$groupId.' Lu tolol ato dongo sih? liat anjeng di profile lu!'
)
							)
						);
				
	}
	if($command=='cuaca')
	{
		
		$result = cuaca($options);
		$balas = array(
							'replyToken' => $replyToken,														
							'messages' => array(
                array(
                    'type' => 'text',
                    'text' => $result
                )
							)
						);
				
	}
	if($pesan_datang=='help')
	{
		
		
		$balas = array(
							'replyToken' => $replyToken,														
							'messages' => array(
array (
  'type' => 'audio',
  'originalContentUrl' => 'https://vocaroo.com/media_command.php?media=s1EnBlvWWa6H&command=download_mp3',
  'duration' => 4000,
)
							)
						);
				
	}
	if($pesan_datang=='setting')
	{
		
		
		$balas = array(
							'replyToken' => $replyToken,														
							'messages' => array(
array (
  'type' => 'template',
  'altText' => 'Send a template.',
  'template' => 
  array (
    'type' => 'carousel',
    'actions' => 
    array (
    ),
    'columns' => 
    array (
      0 => 
      array (
        'thumbnailImageUrl' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcT-RiTL3rmVfnXoWo5im1Ma8kWvazETI87xAiRXSz9ZjRIgC0yF',
        'text' => 'Open 1 :',
        'actions' => 
        array (
          0 => 
          array (
            'type' => 'uri',
            'label' => 'Camera',
            'uri' => 'line://nv/camera',
          ),
          1 => 
          array (
            'type' => 'uri',
            'label' => 'Profile',
            'uri' => 'line://nv/profile',
          ),
          2 => 
          array (
            'type' => 'uri',
            'label' => 'Timeline',
            'uri' => 'line://nv/timeline',
          ),
        ),
      ),
      1 => 
      array (
        'thumbnailImageUrl' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcT-RiTL3rmVfnXoWo5im1Ma8kWvazETI87xAiRXSz9ZjRIgC0yF',
        'text' => 'Open 2 :',
        'actions' => 
        array (
          0 => 
          array (
            'type' => 'uri',
            'label' => 'Pengaturan',
            'uri' => 'line://nv/setting',
          ),
          1 => 
          array (
            'type' => 'uri',
            'label' => 'Check Device',
            'uri' => 'line://nv/connectedDevice',
          ),
          2 => 
          array (
            'type' => 'uri',
            'label' => 'Bonus +',
            'uri' => 'https://pbs.twimg.com/profile_images/946287919869829120/smZ-09vH_400x400.jpg',
          ),
        ),
      ),
    ),
  ),
)
							)
						);
				
	}
	if($pesan_datang=='serius')
	{
		
		
		$balas = array(
							'replyToken' => $replyToken,														
							'messages' => array(
array (
  'type' => 'image',
  'originalContentUrl' => 'https://stickershop.line-scdn.net/stickershop/v1/product/9528/LINEStorePC/main@2x.png;compress=true',
  'previewImageUrl' => 'https://stickershop.line-scdn.net/stickershop/v1/product/9528/LINEStorePC/main@2x.png;compress=true',
  'animated' => true,
)
							)
						);
		$balas = array(
							'replyToken' => $replyToken,														
							'messages' => array(
array (
  'type' => 'image',
  'originalContentUrl' => 'https://stickershop.line-scdn.net/stickershop/v1/product/9528/LINEStorePC/main@2x.png;compress=true',
  'previewImageUrl' => 'https://stickershop.line-scdn.net/stickershop/v1/product/9528/LINEStorePC/main@2x.png;compress=true',
  'animated' => true,
)
							)
						);
				
	}
	if($pesan_datang=='ea')
	{
		
		
		$balas = array(
							'replyToken' => $replyToken,														
							'messages' => array(
array (
  'type' => 'video',
  'originalContentUrl' => 'https://stickershop.line-scdn.net/stickershop/v1/product/9409/IOS/main_animation@2x.png;compress=true',
  'previewImageUrl' => 'https://stickershop.line-scdn.net/stickershop/v1/product/9409/IOS/main_animation@2x.png;compress=true',
)
							)
						);
				
	}
	if($pesan_datang=='udah mandi?')
	{
		
		
		$balas = array(
							'replyToken' => $replyToken,														
							'messages' => array(
array (
  'type' => 'template',
  'altText' => 'Send a template.',
  'template' => 
  array (
    'type' => 'buttons',
    'actions' => 
    array (
      0 => 
      array (
        'type' => 'message',
        'label' => 'Udah',
        'text' => 'Yakalii.. gua belom mandi kaya lu lu pada XD',
      ),
      1 => 
      array (
        'type' => 'message',
        'label' => 'Belom',
        'text' => 'Anjirr.. gua belom mandi lagih..',
      ),
      2 => 
      array (
        'type' => 'message',
        'label' => 'Ragu',
        'text' => 'Et.. gua udah mandi belom ya.. lupa gua asw :v',
      ),
    ),
    'thumbnailImageUrl' => 'https://stickershop.line-scdn.net/stickershop/v1/product/3789751/LINEStorePC/main@2x.png;compress=true',
    'title' => 'Lu udah mandi?',
    'text' => 'Jujur ye',
  ),
)
							)
						);
				
	}
	if($pesan_datang=='key')
	{
		
		
		$balas = array(
							'replyToken' => $replyToken,														
							'messages' => array(
array (
  'type' => 'text',
  'text' => '[ Menu Command ]

>admin
>setting

[ Sticker IMG ]

>serius
>ea

[ Funchat Response ]

>bosen hidup?
>udah mandi?',
)
							)
						);
				
	}
}
 
$result =  json_encode($balas);
//$result = ob_get_clean();
file_put_contents('./balasan.json',$result);
$client->replyMessage($balas);

?>

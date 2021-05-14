<?php

define("SITE", "PATH_TO_YOUR_FOLDER");


$img = $_POST['avt'];
$user_id = $_POST['userid'];
$bot = $_POST['bot'];

if($bot == 1){
  define("TOKEN", "YOUR_BOT_TOKEN");
  define("BOT", "YOUR_TELEGRAM_BOT_NAME");
}

else{
  echo "Wrong <i>bot</i> parameter";
  exit;
}




$file = "temp/".uniqid().".png";


$avatar = fopen($file, "wb");

$data = explode(',', $img );

fwrite($avatar, base64_decode($data[1]));
fclose($avatar);

$inline = array('inline_keyboard' => array(array(array('text' => '✅Set', 'callback_data' => 'settavatar'),array('text' => '❌Cancel', 'callback_data' => 'deleteavatar'))));
$ch1 = curl_init("https://api.telegram.org/bot".TOKEN."/sendDocument?caption=".urlencode("Set this avatar?")."&chat_id=".$user_id. "&document=".SITE.$file . "&reply_markup=" . json_encode($inline, true));
curl_setopt($ch1, CURLOPT_HTTPHEADER, array('Content-Type:multipart/form-data'));
curl_setopt($ch1, CURLOPT_HTTPGET, true);
curl_setopt($ch1, CURLOPT_RETURNTRANSFER, true);
$result = curl_exec($ch1);
curl_close($ch1);

// echo $result;
unlink($file);

 header("Location: https://t.me/" . BOT);


?>

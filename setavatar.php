<?php

define("SITE", "https://pretty-wasp-79.telebit.io/getavatar/");


$img = $_POST['avt'];
$user_id = $_POST['userid'];
$bot = $_POST['bot'];

if($bot == 2){
  define("TOKEN", "906452739:AAHomaRraCQSZIjf9E9dEbDqUD1DHwnb0pM");
  define("BOT", "NexusChat_bot");
}
else if($bot == 3){
  define("TOKEN", "1048540276:AAHvQwC1W2sFllm9W-oWKDY2dgUIw4lCuzY");
  define("BOT", "Natterbot");
}
else if($bot == 4){
  define("TOKEN", "570365482:AAGzWIjmCZdaqPvQCg6WCOTIsZdebZ4ohDs");
  define("BOT", "Strangerbyinterests_bot");
}
else if($bot == 1){
  define("TOKEN", "819145887:AAEaDqFMmJtQ6Yf5CVGFEiKFPzSxBwfRsIY");
  define("BOT", "BlatherBot");
}
else if($bot == 6){
  define("TOKEN", "1187480983:AAFIQkuft6sBvTWqAcFwpEnJE8KbPuQhDCQ");
  define("BOT", "EvilChatbot");
}
else if($bot == 5){
  define("TOKEN", "1732437285:AAEgW8rzLWvC7OGn3N3pwxmCcj8mp1opsz8");
  define("BOT", "provaavatarbot");
}
else{
  define("TOKEN", "");
  define("BOT", "");
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


if(BOT != ""){
  header("Location: https://t.me/" . BOT);
}
else{
  echo "<b>Wrong parameter</b> <i>bot</i>";
}

?>

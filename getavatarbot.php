<?php

  define("TOKEN", "YOUR_BOT_TOKEN");
  define("BOT", "YOUR_BOT_NAME");
  define("SITE", "YOUR_SITE");


  function sendtext($text, $chat, $keyboard = ""){
    $text = urlencode($text);
    if($keyboard != ""){
      $keyboard = "&reply_markup=".json_encode($keyboard, true);
    }
    $ch1 = curl_init("https://api.telegram.org/bot".TOKEN."/sendMessage?text=". $text ."&chat_id=" . $chat . "&parse_mode=html&disable_web_page_preview=true" . $keyboard);
    curl_setopt($ch1, CURLOPT_HTTPGET, true);
    curl_setopt($ch1, CURLOPT_RETURNTRANSFER, true);
    $res = curl_exec($ch1);
    curl_close($ch1);

    return $res;
  }

  function execurl($url){
    $ch1 = curl_init("https://api.telegram.org/bot".TOKEN."/".$url);
    curl_setopt($ch1, CURLOPT_HTTPHEADER, array('Content-Type:text/xml'));
    curl_setopt($ch1, CURLOPT_HTTPGET, true);
    curl_setopt($ch1, CURLOPT_RETURNTRANSFER, true);
    $res = curl_exec($ch1);
    curl_close($ch1);

    return $res;
  }

  function encodeid($chatId){
    $b = rand(11,99);
    $b = $b . $chatId * $b;
    return dechex($b);
  }



$content = file_get_contents("php://input");
$update = json_decode($content, true);
if(!$update){
  exit;
}


$message = isset($update['message']) ? $update['message'] : "";
if(isset($update['callback_query'])){
  $message = $update['callback_query']['message'];
}

$messageId = isset($message['message_id']) ? $message['message_id'] : "";
$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
$text = isset($message['text']) ? $message['text'] : "";
if(isset($update['callback_query'])){
  $text = $update['callback_query']['data'];
}
$text = trim($text);



if($text == "/new"){
  $keyboard = array('inline_keyboard' => array(array(array('text' => 'Get Avatar', 'url' => urlencode(SITE. '?id=' . encodeid($chatId) . '&bot=5' )))));
  sendtext("🧝🏻‍♂️<b>Customize your avatar</b> at this site and then click the button <i><b>CREATE</b></i> to create an avatar", $chatId, $keyboard);
}
else if($text == "/start"){
  sendtext("
🧝🏻‍♂️This bot lets you create <b>custom avatars</b> as telegram <b>stickers</b>

Here is the list of the commands:

/new - create a new avatar
/getstickerset - get your avatar sticker set
/start - shows this message

<b>Have fun❕</b>", $chatId);
}
else if($text == "settavatar"){

  execurl("createNewStickerSet?user_id="   . $chatId . "&name=Avatar".dechex(89 + $chatId*22) ."_by_".BOT."&title=".urlencode("Avatar")."&png_sticker=BQACAgQAAxkBAAMpXt945Ue3S79AsOW0lHrNlCOsMpEAAkAHAAINxQABU2XOgLfZifgrGgQ&emojis=🤖");
  execurl("addStickerToSet?user_id=" . $chatId . "&name=Avatar".dechex(89 +  $chatId*22)."_by_".BOT."&png_sticker=".$message['document']['file_id'] . "&emojis=🧛🏼‍♂️");

  execurl("deleteMessage?chat_id=" . $chatId ."&message_id=" . $messageId);
  $stickerset = json_decode(execurl("getStickerSet?name=Avatar".dechex(89 + $chatId*22) ."_by_".BOT),true);

  sendtext("The avatar has been set", $chatId);
  execurl("sendSticker?chat_id=".$chatId."&sticker=".$stickerset['result']['stickers'][count($stickerset['result']['stickers'])-1]['file_id']);
}
else if($text == "deleteavatar"){
  execurl("deleteMessage?chat_id=" . $chatId ."&message_id=" . $messageId);
}
else if($text == "/getstickerset"){
  sendtext("🧝🏻‍♂️<b>Here is your sticker set</b>\nt.me/addstickers/Avatar".dechex(89 + $chatId*22) ."_by_".BOT . "\n\n<i>To <b>edit</b> this set please use the <b>official</b> @Stickers bot</i>", $chatId);
}
else{
  sendtext("I'm sorry, I don't understand this command", $chatId);
}


 ?>

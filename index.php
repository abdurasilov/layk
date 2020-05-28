<?php 
ob_start(); 
define('API_KEY','927731040:AAEdHEogpUQHAm40LGHAU5ASjn-mpcywFlY'); 
//tokenni yozing 
$admin = "473301762";  
//ozizni id raqamizni yozing 
$console="-1001178429416"; //gruppa
$bot="927731040"; //bot id raqami
$mode="Markdown"; //parse mode

function bot($method,$datas=[]){ 
    $url = "https://api.telegram.org/bot".API_KEY."/".$method; 
    $ch = curl_init(); 
    curl_setopt($ch,CURLOPT_URL,$url); 
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,true); 
    curl_setopt($ch,CURLOPT_POSTFIELDS,$datas); 
    $res = curl_exec($ch); 
    if(curl_error($ch)){ 
        var_dump(curl_error($ch)); 
    }else{ 
        return json_decode($res); 
    } 
} 
$update = json_decode(file_get_contents('php://input')); 
$message = $update->message; 
$mid = $message->message_id; 
$chat_id = $message->chat->id; 
$text = $message->text; 

$fadmin = $message->from->id;
$fid=$message->reply_to_message->forward_from->id;
$username = $message->from->username;
$name = $message->from->first_name; 
$chat_type = $message->chat->type;
$ch=$update->channel_post;
$chid=$ch->message_id;
$reply_text=$message->reply_to_message->text;
$userid = $message->reply_to_message->from->id;
$contact = $message->contact;
$nomer = $message->contact->phone_number;
$nomi = $message->contact->first_name;
$coid = $message->contact->user_id;
$kun = date('H:i', strtotime('5 hour'));
$step = file_get_contents("xabar/yubor.step");


$photo = $update->message->photo;
$gif = $update->message->animation;
$video = $update->message->video;
$music = $update->message->audio;
$voice = $update->message->voice;
$sticker = $update->message->sticker;
$document = $update->message->document;
$caption = $message->caption;

//message file_id
$doc_id = $document->file_id;
$mus_id = $music->file_id;
$vid_id = $video->file_id;
$photo_id=$message->photo[1]->file_id;
$gif_id = $gif->file_id;
$voi_id = $voice->file_id;
$sti_id = $sticker->file_id;

$data = $update->callback_query->data;
$cmid = $update->callback_query->message->message_id;
$ccid = $update->callback_query->message->chat->id;
$cuid = $update->callback_query->message->from->id;
$qid = $update->callback_query->id; 

$ctext = $update->callback_query->message->text; 
$callfrid = $update->callback_query->from->id; 
$callfname = $update->callback_query->from->first_name;  
$callid = $update->callback_query->message->chat->id;
$callmid = $update->callback_query->message->chat->message_id;
$calltitle = $update->callback_query->message->chat->title; 
$calluser = $update->callback_query->message->chat->username; 
 
$channel = $update->channel_post; 
$channel_text = $channel->text;
$channel_mid = $channel->message_id; 
$channel_id = $channel->chat->id; 
$channel_user = $channel->chat->username; 

$vnote=$channel->video_note;
$chanel_doc = $channel->document; 
$chanel_vid = $channel->video; 
$chanel_mus = $channel->audio; 
$chanel_voi = $channel->voice; 
$chanel_gif = $channel->animation; 
$chanel_fot = $channel->photo; 
$caption=$channel->caption;
$cap=file_get_contents("baza/$channel_id.txt");
$usr = file_get_contents("referal/$refid.dat");
mkdir("like");
mkdir("baza");
mkdir("referal");

  $stt = "*🖐️😃 Assalomu alaykum hurmatli* [$name](tg://user?id=$fadmin)!
*Bu bot orqali siz kanalingizdagi xabarlar avtomatik ravishda “Layk” tugmachalarini qoʻshishingiz mumkin. Buning uchun shunchaki botni kanalingizga administrator qilib qoʻysangiz bas!

🛠️Yaratuvchi:* @UzxGroup
"; 

$key=json_encode(
['resize_keyboard'=>true,
'inline_keyboard' => [
[['text'=>'👨🏻‍💻Admin', 'url'=>"https://telegram.me/uzxzn"],],
[["text"=>"📊Statistika",'callback_data' =>"stat"],["text"=>"ℹ️Yordam",'callback_data'=>"help"]],
]
]);
  $gett = bot('getChatMember',[
  'chat_id' =>"@Abdurasilov",
  'user_id' => $fadmin,
  ]);

  $gget = $gett->result->status;

if($text=="/start"){ 
     if($gget == "left"){
bot('sendMessage',[ 
    'chat_id'=>$fadmin, 
    'text'=>"@Abdurasilov kanaliga aʼzo boʻlib qayta /start bosing", 
    'parse_mode'=>'markdown', 
    'disable_web_page_preview'=>true,
    'reply_to_message_id' => $mid,
 
 ]);
}else{
  bot('sendMessage',[ 
    'chat_id'=>$fadmin, 
    'text'=>$stt, 
    'parse_mode'=>'markdown', 
    'disable_web_page_preview'=>true,
    'reply_to_message_id' => $mid,
 'reply_markup'=>$key,
 ]);

  bot('sendmessage',[ 
    'chat_id'=>$console, 
    'text'=>"<b>Salom! Menga</b> <a href='tg://user?id=$chat_id'>$name</a> <b>start bosdi.</b>", 
    'parse_mode'=>'html',
 ]);
}}

//odamlar idsi 
if($chat_type=='private'){ 
  $baza=file_get_contents("yid.txt"); 
  if(mb_stripos($baza,$chat_id)!==false){ 
  }else{ 
    $baza=file_get_contents("yid.txt"); 
    $dat1="$chat_id\n"; 
    file_put_contents("yid.txt",$dat1,FILE_APPEND); 
  } 
}; 
//guruh idsi 
if($chat_type=='group'){ 
  $baza=file_get_contents("ygroup.txt"); 
  if(mb_stripos($baza,$chat_id)!==false){ 
  }else{ 
    $baza=file_get_contents("ygroup.txt"); 
    $dat1="$chat_id\n"; 
    file_put_contents("ygroup.txt",$dat1,FILE_APPEND); 
  } 
}; 
//Superguruh idsi 
if($chat_type=='supergroup'){ 
  $baza=file_get_contents("ysupergroup.txt"); 
  if(mb_stripos($baza,$chat_id)!==false){ 
  }else{ 
    $baza=file_get_contents("ysupergroup.txt"); 
    $dat1="$chat_id\n"; 
    file_put_contents("ysupergroup.txt",$dat1,FILE_APPEND);
}}


  $baza=file_get_contents("channels.txt"); 
  if(mb_stripos($baza,$channel_id)!==false){ 
  }else{ 
    $baza=file_get_contents("channels.txt"); 
    $dat1="$channel_id\n"; 
    file_put_contents("channels.txt",$dat1,FILE_APPEND); 
  }


//Foydalanuvchilar ma'lumotlari 
  $in_san = count(file("yid.txt")); 
  $gu_san = count(file("ygroup.txt")); 
  $su_san = count(file("ysupergroup.txt")); 
  $chansan = count(file("channels.txt"));
  $jami = $in_san+$gu_san+$su_san; 
  $sana = date('Y-m-d'); 

$refresh=json_encode(
['resize_keyboard'=>true,
'inline_keyboard' => [
[["text"=>"♻️Yangilash",'callback_data' =>"refresh"],],
]
]);
if($data=="stat"){
  bot('sendmessage',[ 
    'chat_id'=>$callfrid, 
    'text'=>"📊<b>Bot foydalanuvchilari:</b>\n<i>👤Odamlar:</i><b>$in_san</b>\n<b>📣Kanallar $chansan ta.</b>\n\n<b>👨🏻‍💻Dasturchi:</b> <a href='tg://user?id=$admin'>Xurshid Abdurasilov</a><b>\n📆Vaqt:</b> <code>$sana</code>", 
    'parse_mode'=>'html',
    'reply_markup'=>$refresh,
  ]); 
}
if($data=="refresh"){
bot('editMessageText',[
 'chat_id'=>$callfrid,
 'message_id'=>$cmid,
 'text'=>"📊<b>Bot foydalanuvchilari:</b>\n<i>👤Odamlar:</i><b>$in_san</b>\n<b>📣Kanallar $chansan ta.</b>\n\n<b>👨🏻‍💻Dasturchi:</b> <a href='tg://user?id=$admin'>Xurshid Abdurasilov</a><b>\n📆Vaqt:</b> <code>$sana</code>",
 'parse_mode'=>"html",
    'reply_markup'=>$refresh,
]);
}
if($data=="help"){
bot('sendMessage',[
 'chat_id'=>$callfrid,
 'text'=>"*1️⃣ Botdan foydalanish uchun kanalinizning administrator qoʻshish boʻlimidan* ```@LaykBot``` *deb izlang va barcha ruxsatnomalarini yoqib qoʻying!

2️⃣ Kanalingizdagi xabarlarga* _(postlarga)_ *avtomatik imzo qoʻyish uchun oʻz kanalingiz imzosini kiritishingiz kerak boʻladi. Buning uchun kanalingizga* ``!caption`` *soʻzidan keyin oʻz imzoingizni $mode turida yozasiz. Masalan:*
``` !caption [Ey Birodar](t.me/EyBirodar) *- oʻzgacha fikrlang!*```

*3️⃣ Kanalingizdagi  xabarlarga qoʻshilayotgan imzolarni toʻxtatish uchun* ``!del`` *soʻzini kanalingizga yuboring.*

_Taklif va murojaatlar uchun:_ [@uzxzn](tg://user?id=$admin)",
  'parse_mode'=>"Markdown",
]);
}
if(isset($vnote) or isset($chanel_doc) or isset($chanel_vid) or isset($channel_text) or isset($chanel_mus) or isset($chanel_voi) or isset($chanel_gif) or isset($chanel_fot)){
$captions=str_replace('!like','',$caption);
   bot('editmessagecaption',[
        'chat_id'=>$channel_id,
        'message_id'=>$channel_mid,
        'caption'=>"$captions\n\n$cap",
        'parse_mode'=>$mode,
      ]);

if($channel_text){
  bot('editMessageText',[
  'chat_id'=>$channel_id,
        'message_id'=>$channel_mid,
        'text'=>"$channel_text\n\n$cap",
        'disable_web_page_preview'=>true,
        'parse_mode'=>$mode,
      ]);
  }
    $tokenn=uniqid("true");

    bot('editMessageReplyMarkup',[
        'chat_id'=>$channel_id,
        'message_id'=>$channel_mid,
        'inline_query_id'=>$qid, 
        'reply_markup'=>json_encode([ 
        'inline_keyboard'=>[ 
       [['text'=>"✅Yoqdi", 'callback_data'=>"$tokenn=✅"],['text'=>"❎Yoqmadi",'callback_data'=>"$tokenn=❎"]],
       [['text'=>"♻️Doʻstlarga ulashish🔂", 'url'=>"https://telegram.me/share/url?url=https://telegram.me/$channel_user/$channel_mid"]]] 
       ]) 
       ]);
}


if(mb_stripos($data,"=")!==false){ 
$ex=explode("=",$data); 
$calltok=$ex[0]; 
$emoj=$ex[1]; 
$mylike=file_get_contents("like/$calltok.dat");

if($callfrid==$admin){
file_put_contents("like/$calltok.dat","$mylike\n$callfrid=$emoj$emoj$emoj$emoj"); 
$value=file_get_contents("like/$calltok.dat"); 
$lik=substr_count($value,"✅"); 
$des=substr_count($value,"❎"); 
         bot('editMessageReplyMarkup',[ 
        'chat_id'=>$ccid, 
        'message_id'=>$cmid,
        'inline_query_id'=>$qid,
        'reply_markup'=>json_encode([ 
        'inline_keyboard'=>[ 
       [['text'=>"✅ $lik", 'callback_data'=>"$calltok=✅"],['text'=>"❎ $des",'callback_data'=>"$calltok=❎"]], 
     [['text'=>"♻️Doʻstlarga ulashish♻️", 'url'=>"https://telegram.me/share/url?url=https://telegram.me/$channel_user/$channel_mid"]]  ] 
       ]) 
       ]);
       bot('answerCallbackQuery',[ 
        'callback_query_id'=>$qid, 
        'text'=>"☺️Xoʻjayin! Ovozingizni qabul qildim. Rahmat", 
        'show_alert'=>false, 
    ]);
}
if($callfrid!==$admin and mb_stripos($mylike,"$callfrid")!==false){ 
      bot('answerCallbackQuery',[ 
        'callback_query_id'=>$qid, 
        'text'=>"❌Ovozingiz qabul qilingan\n Faqat bir marta ovoz berish imkoniga egasiz.\n\n$calltitle bilan qoling!", 
        'show_alert'=>true, 
    ]); 
}else{ 
file_put_contents("like/$calltok.dat","$mylike\n$callfrid=$emoj"); 
$value=file_get_contents("like/$calltok.dat"); 
$lik=substr_count($value,"✅"); 
$des=substr_count($value,"❎"); 
     bot('editMessageReplyMarkup',[ 
        'chat_id'=>$ccid, 
        'message_id'=>$cmid,
        'inline_query_id'=>$qid,
        'reply_markup'=>json_encode([ 
        'inline_keyboard'=>[ 
       [['text'=>"✅ $lik", 'callback_data'=>"$calltok=✅"],['text'=>"❎ $des",'callback_data'=>"$calltok=❎"]], 
     [['text'=>"♻️Doʻstlarga ulashish♻️", 'url'=>"https://telegram.me/share/url?url=https://telegram.me/$channel_user/$channel_mid"]]  ] 
       ]) 
       ]);
       bot('answerCallbackQuery',[ 
        'callback_query_id'=>$qid, 
        'text'=>"✅Ovozingiz muvaffaqiyatli qabul qilindi.\nKatta rahmat!", 
        'show_alert'=>false, 
    ]);
  }
}

if((mb_stripos($data,"$calltok=❎")!==false) and (mb_stripos($callid,"-1001252367641")!==false)){
bot('sendMessage',[
    'chat_id'=>$console,
    'text'=>"<b>📋Post: t.me/$calluser/$cmid
📝Ovoz</b> <a href='tg://user?id=$callfrid'>$callfrid</a>
<b>✍️ Fikri: ❎ $des</b>",
    'parse_mode'=>"html",
    'disable_web_page_preview'=>true,
  ]);
}

if((mb_stripos($data,"$calltok=✅")!==false) and (mb_stripos($callid,"-1001252367641")!==false)){ 
bot('sendMessage',[
    'chat_id'=>$console,
    'text'=>"<b>📋Post: t.me/$calluser/$cmid
📝Ovoz</b> <a href='tg://user?id=$callfrid'>$callfrid</a><b>
✍️ Fikri: ✅ $lik</b>", 'parse_mode'=>"html",
    'disable_web_page_preview'=>true,
  ]);
}


if(mb_stripos($channel_text,"!caption")!==false){
  $ex=explode("!caption", $channel_text);
  $exe=$ex[1];
  file_put_contents("baza/$channel_id.txt", "$exe");
  bot('deletemessage',[
    'chat_id'=>$channel_id,
    'message_id'=>$channel_mid,
  ]);
}

if($channel_text=="!cap"){
  bot('deletemessage',[
    'chat_id'=>$channel_id,
    'message_id'=>$channel_mid,
  ]);
  bot('sendmessage',[
    'chat_id'=>$channel_id,
    'text'=>$cap,
    'parse_mode'=>'html',
  ]);
}

if($channel_text=="!del"){
  unlink("baza/$channel_id.txt");
  bot('deletemessage',[
    'chat_id'=>$channel_id,
    'message_id'=>$channel_mid,
  ]);
}

if($text=="/code"){
bot('sendDocument',[
'chat_id'=>$admin,
'document'=>new CURLFile(__FILE__),
'caption'=>"[Botingiz](tg://user?id=$bot) *kodi!*",
'parse_mode'=>"MarkDown",
]);
}
if($text=="/file" and $chat_id==$admin){
$eksp=explode(' ',$text);
$fayl=$eksp[1];
bot('sendDocument',[
'chat_id'=>$admin,
'document'=>$doc_id,
'caption'=>$fayl,
]);
}

if($text == "/send" and $chat_id == $admin){
      bot('sendMessage',[
      'chat_id'=>$chat_id,
      'text'=>"Xabarni kiriting!",
      'reply_markup'=>$back,
      ]);
    }
    if($reply_text=="Xabarni kiriting!" and $chat_id == $admin){
      $idss=file_get_contents("yid.txt");
      $idszs=explode("\n",$idss);
      foreach($idszs as $idlat){
      bot('sendMessage',[
      'chat_id'=>$idlat,
      'text'=>$text,
      'parse_mode'=>$mode,
      ]);
      }}
$idg=file_get_contents("ysupergroup.txt");
      $idgr=explode("\n",$idg);
      foreach($idgr as $idlar){
      bot('sendMessage',[
      'chat_id'=>$idlar,
      'text'=>$text,
      ]);
      }
if($text == "/sendchannel" and $chat_id == $admin){
      bot('sendMessage',[
      'chat_id'=>$chat_id,
      'text'=>"Kanallarga yuborish uchun xabarni kiriting!",
      'reply_markup'=>$back,
      ]);
    }
   if($reply_text=="Kanallarga yuborish uchun xabarni kiriting!" and $chat_id == $admin){
      $chanlist=file_get_contents("channels.txt");
      $chanex=explode("\n",$chanlist);
      foreach($chanex as $chanid){
      bot('sendMessage',[
      'chat_id'=>$chanid,
      'text'=>$text,
      'parse_mode'=>$mode,
      ]);
      }}



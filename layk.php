<?php
ob_start();
define('API_KEY','927731040:AAEdHEogpUQHAm40LGHAU5ASjn-mpcywFlY');

$admins =["403608126","473301762"];
$developer = "473301762";
$baza = "-1001178429416";
$bot_user = "@LaykBot";
$acces_token = "a07d40a2874bd75fd9972f76f5bf7526e1d90e7376fa5638913e95247406";

include 'fun.php';
include 'adminpanel.php';
include "sqldb.php";
include "uzb.php";
include "keyboard.php";

$botdata = new Db('bd.db');

if($update){
$step = $botdata->onerow("SELECT * FROM member WHERE user_id = '$user_id'")['step'];

if($text == '/test'){
    $get = get('https://yandex.ru/images/search?text=moon%20png&from=tabbar');
    //$json = json_encode($get);
    botsend($developer,"$get ok\n$json");
    put("test.dat",$get);
}

//============= USER REG =================================
if($text){
$getuse1 = $botdata->onerow("SELECT * FROM member WHERE user_id = $uid");
if(!$getuse1){
$botdata->query("INSERT INTO member ('user_id','user','name') VALUES ('$uid','$ulogin','$ufname')");
}
}

//================ BOSH MENU ==============================
$azo = bot('getChatMember',[ 'chat_id' =>"-1001252367641", 'user_id' => $uid,])->result->status;

if($text == $btn5){
if($azo=="creator" or $azo=="administrator" or $azo=="member"){
$botdata->query("UPDATE member SET step = 'null' WHERE user_id = $uid");
botsend($uid,$text,null,'markdown',$menu1);
}else{
botsend($uid,$azobol,null,'html',$kanalim);
}
}

//=============== START =====================================

if(mb_stripos($text,"/start")!==false){
$botdata->query("UPDATE member SET step = 'null' WHERE user_id = $uid");
if($azo=="creator" or $azo=="administrator" or $azo=="member"){
botsend($uid,$txt1,null,'html',$menu1);
}else{
botsend($uid,$azobol,null,'html',$kanalim);
}
}

//================== POST =======================================

if($text == $btn1){
if($azo=="creator" or $azo=="administrator" or $azo=="member"){
$botdata->query("UPDATE member SET step = 'post' WHERE user_id = $uid");
botsend($uid,$txt2,$mid,'markdown',$back);
}else{
botsend($uid,$azobol,null,'html',$kanalim);
}
}

//==================== QO'LLANMA ===========================================

if($text == $btn4){
if($azo=="creator" or $azo=="administrator" or $azo=="member"){
    botsend($user_id,$txt3,null,'markdown',$qollanma);
}else{
botsend($uid,$azobol,null,'html',$kanalim);
}
}

//================================================================================
//=================== POST QABUL QILISH===========================================
//================================================================================

if($step == 'post' && $text != $btn5 && $text != '/start' && $text != $btn1){
    $code = uniqid(true);
    $markup=[];
    array_push($markup,[['text'=>"👍 add Reactions",'callback_data'=>"add_like_$code"]]);
    array_push($markup,[['text'=>"🗯 add Alert",'callback_data'=>"add_alert_$code"]]);
    array_push($markup,[['text'=>"🔗 add Buttons",'callback_data'=>"add_url_$code"]]);
    if(!$text && !$sticker){
        array_push($markup,[['text'=>"🖋 add Caption",'callback_data'=>"add_caption_$code"]]);
    }
    array_push($markup,[['text'=>"🗑 Delete",'callback_data'=>"delete$code"]]);
    array_push($markup,[['text'=>"✅ Publish",'callback_data'=>"publish$code"]]);
    $reply=InlineKeyboard($markup);

    if($text){
        $send = botsend($uid,$text,null,'none',$reply,$entities);
        $post = "text";
    }elseif($photo){
        $send = sendphoto($uid,$pho_id,$caption,$centities,'none',$reply);
        $post = "photo";
    }elseif($video){
        $send = sendvideo($uid,$vid_id,$caption,$centities,'none',$reply);
        $post = "video";
    }elseif($music){
        $send = sendaudio($uid,$mus_id,$caption,$centities,'none',$reply);
        $post = "music";
    }elseif($document){
        $send = senddocument($uid,$file_id,$caption,$centities,'none',$reply);
        $post = "document";
    }elseif($voice){
        $send = sendvoice($uid,$voi_id,$caption,$centities,'none',$reply);
        $post = "voice";
    }elseif($sticker){
        $send = senddocument($uid,$sti_id,$caption,$centities,'none',$reply);
        $post = "sticker";
    }
    $sended = $send->ok;
    if($sended == true){
        $id = "$file_id$vid_id$pho_id$mus_id$voi_id$sti_id";
        $capt = urlencode("$text$caption");
        if($post == 'text'){
            $entit = $entities;
        }else{
            $entit = $centities;
        }
        $botdata->query("UPDATE member SET code = '$code', step = 'buttons' WHERE user_id = $uid");
        $botdata->query("INSERT INTO post ('user_id','post','file_id','caption','code','entities') VALUES ('$uid','$post','$id','$capt','$code','$entit')");
    }elseif($send->ok == false){
        $value = json_encode($send);
        $matn1 = "‼ #eror ‼\n🆔 #$uid\n📶 #$step\n\n$value\n\n$text";     //////// EROR
        $matn2 ="⚠  Xatolik yuz berdi. bu haqda Mamuriyatga xabar yuborildi\n Iltimos javobni kuting yoki namunadagidek qayta urunib koring\n\nBotdan unumli foydalanish uchun
        <a href='https://telegra.ph/Uz-Post-Bot-03-24'>📋 Qo'llanmani</a> o'qing";
        botsend($developer,$matn1);
        botsend($uid,$matn2,$mid,'html',$qollanma);
    }
}

//==================== POST TAYYORLASH DATA ==================================

if(mb_stripos($data,"_")!==false){
$ex = explode("_",$data);
$notif = $ex[0];
$type = $ex[1];
$code = $ex[2];

if($notif == 'add'){
    if($type == 'like'){
        $id = "AgACAgIAAxkBAAIsjV5bL6ro7rCwO5Y7p1pvKRUBfVChAAIUrjEbZizZSt00uF_v_RDbTW7BDwAEAQADAgADeAADrA4FAAEYBA";
        $matn = "👍 Like uchun emojelarni namunaga asoslangan holda memga yo'llang\nHar-bir knopka emojesi oralig'ida */* belgisi bo'lishi shart !\n\n*Namuna:*\n`💛/💙/💚\n❤/💔`";
    }elseif($type == 'url'){
        $id = "AgACAgIAAxkBAAIskV5bMI0DjFDE8vCt6YgL5RgXIMbTAAIfrDEbfF_YSrdYNuV47vJtt0yAkS4AAwEAAwIAA3gAA1twAAIYBA";
        $matn = "Knopka uchun manzilni menga quyidagi namunadan foydalangan holda yuboring\n\n*Namuna:*\n`🌐 Google = www.google.com/ + 🌐 Yahoo = www.yahoo.com/\n🌐 Yandex = www.yandex.uz/`";
    }elseif($type == 'caption'){
        $id = "AgACAgIAAxkBAAIsmV5bMfWa0QUuNu9B_OYbii032rctAAIgrDEbfF_YSt02CqVTvUQItE7LDgAEAQADAgADeAADfs0CAAEYBA";
        $matn = "Post tagiga yoziladigan izoh matnini kiriting";
    }elseif($type == 'alert'){
        $id = "AgACAgIAAxkBAAIslV5bML9LGNa0v1D2_vAD-Yukpz4CAAIVrjEbZizZSs6c7svesQ25KJPCDwAEAQADAgADeAAD3AgFAAEYBA";
        $matn = "Aler posti knopkasi uchun smaylik va biriktirilgan matnlarni kiriting\n\n*Namuna:*\n`⚪=White / ⚫=Blak\n🔵=Blue`";
    }

    $botdata->query("UPDATE member SET step = '$type', code = '$code' WHERE user_id = $callfrid");
    $post = $botdata->onerow("SELECT * FROM post WHERE code = '$code'")['post'];
    $emojes = urldecode($botdata->onerow("SELECT * FROM member WHERE user_id = '$callfrid'")['emojes']);

    if($type == 'like' && !empty($emojes)){
        $kyb = [];
        $ex = explode("\n\n",$emojes);
        foreach($ex as $em){
            array_push($kyb,[['text'=>$em]]);
        }
        array_push($kyb,[['text'=>$btn5]]);
        $mark = json_encode([
            'resize_keyboard'=>true,
            'keyboard'=>$kyb
            ]);
    }else{
        $mark = $back;
    }


    botdel($callfrid,$callmid);
    $send = sendphoto($callfrid,$id,$matn,null,'markdown',$mark);


}else{  // type del

    if($type == 'like'){
       $botdata->query("UPDATE post SET like = null WHERE code = '$code'");
    }elseif($type == 'url'){
       $botdata->query("UPDATE post SET url = null WHERE code = '$code'");
    }elseif($type == 'alert'){
       $botdata->query("UPDATE post SET alert = null WHERE code = '$code'");
    }
    $botdata->query("UPDATE member SET step = 'null', code = '$code' WHERE user_id = $callfrid");

    $like = urldecode($botdata->onerow("SELECT * FROM post WHERE code = '$code'")['like']);
    $url = urldecode($botdata->onerow("SELECT * FROM post WHERE code = '$code'")['url']);
    $alert = urldecode($botdata->onerow("SELECT * FROM post WHERE code = '$code'")['alert']);
    $post = $botdata->onerow("SELECT * FROM post WHERE code = '$code'")['post'];

    $markup=[];
    if(!empty($like)){  //////// LIKE
        $ex1 = explode("\n",$like);
        foreach($ex1 as $sym){
            $mar1=[];
            $ex2 = explode("/",$sym);
            foreach($ex2 as $emoje){
                array_push($mar1,['text'=>$emoje,'callback_data'=>$emoje]);
            }
            array_push($markup,$mar1);
        }
    }

    if(!empty($alert)){  //////// ALERT
        $ex1 = explode("\n",$alert);
        foreach($ex1 as $sym){
            $mar1=[];
            $ex2 = explode("/",$sym);
            foreach($ex2 as $emoje){
                $ex4=explode("=",$emoje);
                $izoh = trim($ex4[0]);
                $dd = trim($ex4[1]);
                array_push($mar1,['text'=>$izoh,'callback_data'=>"alert1$dd"]);
            }
            array_push($markup,$mar1);
        }
    }

    if(!empty($url)){  //////// URL
        $ex2=explode("\n",$url);
        foreach($ex2 as $value){
            $mar2=[];
            $ex3=explode("+",$value);
            foreach($ex3 as $value1){
                $ex4=explode("=",$value1);
                $izoh = trim($ex4[0]);
                $link = trim($ex4[1]);
                array_push($mar2,['text'=>$izoh,'url'=>$link]);
            }
            array_push($markup,$mar2);
        }
    }

    if(!empty($like)){
        array_push($markup,[['text'=>"👍 Remove Reactions",'callback_data'=>"del_like_$code"]]);
    }else{
        array_push($markup,[['text'=>"👍 add Reactions",'callback_data'=>"add_like_$code"]]);
    }
    if(!empty($alert)){
        array_push($markup,[['text'=>"🗯 Remove alert",'callback_data'=>"del_alert_$code"]]);
    }else{
        array_push($markup,[['text'=>"🗯 add Alert",'callback_data'=>"add_alert_$code"]]);
    }
    if(!empty($url)){
        array_push($markup,[['text'=>"🔗 Remove Buttons",'callback_data'=>"del_url_$code"]]);
    }else{
        array_push($markup,[['text'=>"🔗 add Buttons",'callback_data'=>"add_url_$code"]]);
    }

    if($post != 'sticker' && $post != 'text'){
        array_push($markup,[['text'=>"🖋 add Caption",'callback_data'=>"add_caption_$code"]]);
    }
    array_push($markup,[['text'=>"🗑 Delete",'callback_data'=>"delete$code"]]);
    array_push($markup,[['text'=>"✅ Publish",'callback_data'=>"publish$code"]]);
    $reply=InlineKeyboard($markup);

    editmarkup($callfrid,$callmid,$inmid,$reply);
}
}

//================ KNOPKA QABUL QILISH ==========================================

$code = $botdata->onerow("SELECT * FROM member WHERE user_id = '$user_id'")['code'];
$file = $botdata->onerow("SELECT * FROM post WHERE code = '$code'")['file_id'];
$post = $botdata->onerow("SELECT * FROM post WHERE code = '$code'")['post'];
$emojes = $botdata->onerow("SELECT * FROM member WHERE user_id = '$uid'")['emojes'];

if(($step == 'like' or $step == 'url' or $step == 'caption' or $step == 'alert') && $text != $btn5 && $text != '/start'){
    $text = urlencode($text);
    if($step == 'like'){
        $botdata->query("UPDATE post SET like = '$text' WHERE code = '$code'");
    }elseif($step == 'url'){
        $botdata->query("UPDATE post SET url = '$text' WHERE code = '$code'");
    }elseif($step == 'caption'){
        $botdata->query("UPDATE post SET caption = '$text',entities = '$entities' WHERE code = '$code'");
    }elseif($step == 'alert'){
        $botdata->query("UPDATE post SET alert = '$text' WHERE code = '$code'");
    }


    $code = $botdata->onerow("SELECT * FROM member WHERE user_id = '$user_id'")['code'];
    $like = urldecode($botdata->onerow("SELECT * FROM post WHERE code = '$code'")['like']);
    $url = urldecode($botdata->onerow("SELECT * FROM post WHERE code = '$code'")['url']);
    $alert = urldecode($botdata->onerow("SELECT * FROM post WHERE code = '$code'")['alert']);
    $caption = urldecode($botdata->onerow("SELECT * FROM post WHERE code = '$code'")['caption']);
    $post = $botdata->onerow("SELECT * FROM post WHERE code = '$code'")['post'];
    $entit = $botdata->onerow("SELECT * FROM post WHERE code = '$code'")['entities'];

    $markup=[];
    if(!empty($like)){  //////// LIKE
        $ex1 = explode("\n",$like);
        foreach($ex1 as $sym){
            $mar1=[];
            $ex2 = explode("/",$sym);
            foreach($ex2 as $emoje){
                array_push($mar1,['text'=>$emoje,'callback_data'=>$emoje]);
            }
            array_push($markup,$mar1);
        }
    }

    if(!empty($alert)){  //////// ALERT
        $ex1 = explode("\n",$alert);
        foreach($ex1 as $sym){
            $mar1=[];
            $ex2 = explode("/",$sym);
            foreach($ex2 as $emoje){
                $ex4=explode("=",$emoje);
                $izoh = trim($ex4[0]);
                $dd = trim($ex4[1]);
                array_push($mar1,['text'=>$izoh,'callback_data'=>"alert1$dd"]);
            }
            array_push($markup,$mar1);
        }
    }

    if(!empty($url)){  //////// URL
        $ex2=explode("\n",$url);
        foreach($ex2 as $value){
            $mar2=[];
            $ex3=explode("+",$value);
            foreach($ex3 as $value1){
                $ex4=explode("=",$value1);
                $izoh = trim($ex4[0]);
                $link = trim($ex4[1]);
                array_push($mar2,['text'=>$izoh,'url'=>$link]);
            }
            array_push($markup,$mar2);
        }
    }

    if(!empty($like)){
        array_push($markup,[['text'=>"👍 Remove Reactions",'callback_data'=>"del_like_$code"]]);
    }else{
        array_push($markup,[['text'=>"👍 add Reactions",'callback_data'=>"add_like_$code"]]);
    }
    if(!empty($alert)){
        array_push($markup,[['text'=>"🗯 Remove alert",'callback_data'=>"del_alert_$code"]]);
    }else{
        array_push($markup,[['text'=>"🗯 add Alert",'callback_data'=>"add_alert_$code"]]);
    }
    if(!empty($url)){
        array_push($markup,[['text'=>"🔗 Remove Buttons",'callback_data'=>"del_url_$code"]]);
    }else{
        array_push($markup,[['text'=>"🔗 add Buttons",'callback_data'=>"add_url_$code"]]);
    }

    if($post != 'sticker' && $post != 'text'){
        array_push($markup,[['text'=>"🖋 add Caption",'callback_data'=>"add_caption_$code"]]);
    }
    array_push($markup,[['text'=>"🗑 Delete",'callback_data'=>"delete$code"]]);
    array_push($markup,[['text'=>"✅ Publish",'callback_data'=>"publish$code"]]);
    $reply=InlineKeyboard($markup);

    if($post == 'text' ){
        $send = botsend($uid,$caption,null,'none',$reply,$entit);
    }elseif($post == 'photo'){
        $send = sendphoto($uid,$file,$caption,$entit,'none',$reply);
    }elseif($post == "video"){
        $send = sendvideo($uid,$file,$caption,$entit,'none',$reply);
    }elseif($post == "music"){
        $send = sendaudio($uid,$file,$caption,$entit,'none',$reply);
    }elseif($post == "document"){
        $send = senddocument($uid,$file,$caption,$entit,'none',$reply);
    }elseif($post == "voice"){
        $send = sendvoice($uid,$file,$caption,$entit,'none',$reply);
    }elseif($post == "sticker"){
        $send = senddocument($uid,$file,$caption,$entit,'none',$reply);
    }
    $sended = $send->ok;
    if($sended == true){
        if($step == 'like'){
            $exx = explode("\n",$emojes);
            botsend($uid,$save,null,'none',$back);
            if(!in_array($text,$exx)){
                $list = "$text\n\n";
                for($i=0; $i<=4; $i++){
                    if(!empty($exx[$i])){
                        $list.="$exx[$i]\n\n";
                    }
                }
                $botdata->query("UPDATE member SET emojes = '$list' WHERE user_id = '$uid'");
            }
        }
    $botdata->query("UPDATE member SET step = 'null' WHERE user_id = '$user_id'");
    }elseif($send->ok == false){
        $value = json_encode($send);
        $text = urldecode($text);
        $matn1 = "‼ #eror ‼\n🆔 #$uid\n📶 #$step\n\n$value\n\n$text";     //////// EROR
        $matn2 ="⚠  Xatolik yuz berdi. bu haqda Mamuriyatga xabar yuborildi\n Iltimos javobni kuting yoki namunadagidek qayta urunib koring\n\nBotdan unumli foydalanish uchun
        <a href='https://telegra.ph/Uz-Post-Bot-03-24'>📋 Qo'llanmani</a> o'qing";
        botsend($developer,$matn1);
        botsend($uid,$matn2,$mid,'html',$qollanma);
    }
}

//============== CANCEL =======================================

if(($step == 'like' or $step == 'url' or $step == 'caption' or $step == 'alert') && $text == $btn5 ){

    $code = $botdata->onerow("SELECT * FROM member WHERE user_id = '$user_id'")['code'];
    $like = urldecode($botdata->onerow("SELECT * FROM post WHERE code = '$code'")['like']);
    $url = urldecode($botdata->onerow("SELECT * FROM post WHERE code = '$code'")['url']);
    $alert = urldecode($botdata->onerow("SELECT * FROM post WHERE code = '$code'")['alert']);
    $caption = urldecode($botdata->onerow("SELECT * FROM post WHERE code = '$code'")['caption']);
    $post = $botdata->onerow("SELECT * FROM post WHERE code = '$code'")['post'];
    $entit = $botdata->onerow("SELECT * FROM post WHERE code = '$code'")['entities'];

    $markup=[];
    if(!empty($like)){  //////// LIKE
        $ex1 = explode("\n",$like);
        foreach($ex1 as $sym){
            $mar1=[];
            $ex2 = explode("/",$sym);
            foreach($ex2 as $emoje){
                array_push($mar1,['text'=>$emoje,'callback_data'=>$emoje]);
            }
            array_push($markup,$mar1);
        }
    }

    if(!empty($alert)){  //////// ALERT
        $ex1 = explode("\n",$alert);
        foreach($ex1 as $sym){
            $mar1=[];
            $ex2 = explode("/",$sym);
            foreach($ex2 as $emoje){
                $ex4=explode("=",$emoje);
                $izoh = trim($ex4[0]);
                $dd = trim($ex4[1]);
                array_push($mar1,['text'=>$izoh,'callback_data'=>"alert1$dd"]);
            }
            array_push($markup,$mar1);
        }
    }

    if(!empty($url)){  //////// URL
        $ex2=explode("\n",$url);
        foreach($ex2 as $value){
            $mar2=[];
            $ex3=explode("+",$value);
            foreach($ex3 as $value1){
                $ex4=explode("=",$value1);
                $izoh = trim($ex4[0]);
                $link = trim($ex4[1]);
                array_push($mar2,['text'=>$izoh,'url'=>$link]);
            }
            array_push($markup,$mar2);
        }
    }

    if(!empty($like)){
        array_push($markup,[['text'=>"👍 Remove Reactions",'callback_data'=>"del_like_$code"]]);
    }else{
        array_push($markup,[['text'=>"👍 add Reactions",'callback_data'=>"add_like_$code"]]);
    }
    if(!empty($alert)){
        array_push($markup,[['text'=>"🗯 Remove alert",'callback_data'=>"del_alert_$code"]]);
    }else{
        array_push($markup,[['text'=>"🗯 add Alert",'callback_data'=>"add_alert_$code"]]);
    }
    if(!empty($url)){
        array_push($markup,[['text'=>"🔗 Remove Buttons",'callback_data'=>"del_url_$code"]]);
    }else{
        array_push($markup,[['text'=>"🔗 add Buttons",'callback_data'=>"add_url_$code"]]);
    }

    if($post != 'sticker' && $post != 'text'){
        array_push($markup,[['text'=>"🖋 add Caption",'callback_data'=>"add_caption_$code"]]);
    }
    array_push($markup,[['text'=>"🗑 Delete",'callback_data'=>"delete$code"]]);
    array_push($markup,[['text'=>"✅ Publish",'callback_data'=>"publish$code"]]);
    $reply=InlineKeyboard($markup);

    if($post == 'text' ){
        $send = botsend($uid,$caption,null,'none',$reply,$entit);
    }elseif($post == 'photo'){
        $send = sendphoto($uid,$file,$caption,$entit,'none',$reply);
    }elseif($post == "video"){
        $send = sendvideo($uid,$file,$caption,$entit,'none',$reply);
    }elseif($post == "music"){
        $send = sendaudio($uid,$file,$caption,$entit,'none',$reply);
    }elseif($post == "document"){
        $send = senddocument($uid,$file,$caption,$entit,'none',$reply);
    }elseif($post == "voice"){
        $send = sendvoice($uid,$file,$caption,$entit,'none',$reply);
    }elseif($post == "sticker"){
        $send = senddocument($uid,$file,$caption,$entit,'none',$reply);
    }
    $sended = $send->ok;
    if($sended == true){
        $botdata->query("UPDATE member SET step = 'null' WHERE user_id = '$user_id'");
    }elseif($send->ok == false){
        $value = json_encode($send);
        $matn1 = "‼ #eror ‼\n🆔 #$uid\n📶 #$step\n\n$value\n\n$text";     //////// EROR
        $matn2 ="⚠  Xatolik yuz berdi. bu haqda Mamuriyatga xabar yuborildi\n Iltimos javobni kuting yoki namunadagidek qayta urunib koring\n\nBotdan unumli foydalanish uchun
        <a href='https://telegra.ph/Uz-Post-Bot-03-24'>📋 Qo'llanmani</a> o'qing";
        botsend($developer,$matn1);
        botsend($uid,$matn2,$mid,'html',$qollanma);
    }
}

//=============== ALERT DATA ==============================================

if(mb_stripos($data,'alert1')!==false){
    $matn = explode('alert1',$data)[1];
    alert($qid,$matn,true);
}

//============= PUBLISH ==========================

if(mb_stripos($data,'publish')!==false){
    $code = explode("publish",$data)[1];
    $like = urldecode($botdata->onerow("SELECT * FROM post WHERE code = '$code'")['like']);
    $url = urldecode($botdata->onerow("SELECT * FROM post WHERE code = '$code'")['url']);
    $alert = urldecode($botdata->onerow("SELECT * FROM post WHERE code = '$code'")['alert']);
    $caption = urldecode($botdata->onerow("SELECT * FROM post WHERE code = '$code'")['caption']);
    $post = $botdata->onerow("SELECT * FROM post WHERE code = '$code'")['post'];

    $markup=[];
    if(!empty($like)){  //////// LIKE
        $ex1 = explode("\n",$like);
        foreach($ex1 as $sym){
            $mar1=[];
            $ex2 = explode("/",$sym);
            foreach($ex2 as $emoje){
                array_push($mar1,['text'=>$emoje,'callback_data'=>$emoje]);
            }
            array_push($markup,$mar1);
        }
    }

    if(!empty($alert)){  //////// ALERT
        $ex1 = explode("\n",$alert);
        foreach($ex1 as $sym){
            $mar1=[];
            $ex2 = explode("/",$sym);
            foreach($ex2 as $emoje){
                $ex4=explode("=",$emoje);
                $izoh = trim($ex4[0]);
                $dd = trim($ex4[1]);
                array_push($mar1,['text'=>$izoh,'callback_data'=>"alert1$dd"]);
            }
            array_push($markup,$mar1);
        }
    }

    if(!empty($url)){  //////// URL
        $ex2=explode("\n",$url);
        foreach($ex2 as $value){
            $mar2=[];
            $ex3=explode("+",$value);
            foreach($ex3 as $value1){
                $ex4=explode("=",$value1);
                $izoh = trim($ex4[0]);
                $link = trim($ex4[1]);
                array_push($mar2,['text'=>$izoh,'url'=>$link]);
            }
            array_push($markup,$mar2);
        }
    }

    array_push($markup,[['text'=>"⚙ Edit",'callback_data'=>"edit$code"]]);
    array_push($markup,[['text'=>"📥 Share",'switch_inline_query'=>$code]]);
    $reply=InlineKeyboard($markup);
    editmarkup($callfrid,$callmid,$inmid,$reply);
    $matn = "Postni Yaqinlaringizga ulashish uchun *📥 Share* Knopkasidan foydalaning\n\nAgarda fikringizdan qaytsangiz *⚙ Edit* Knopkasidan foydalaning";

if($azo=="creator" or $azo=="administrator" or $azo=="member"){
    botsend($callfrid,$matn,null,'markdown',$menu1);
}else{
botsend($uid,$azobol,null,'html',$kanalim);
}
}

//============ EDITED ================================

if(mb_stripos($data,'edit')!==false){
    $code = explode("edit",$data)[1];
    $like = urldecode($botdata->onerow("SELECT * FROM post WHERE code = '$code'")['like']);
    $url = urldecode($botdata->onerow("SELECT * FROM post WHERE code = '$code'")['url']);
    $alert = urldecode($botdata->onerow("SELECT * FROM post WHERE code = '$code'")['alert']);
    $caption = urldecode($botdata->onerow("SELECT * FROM post WHERE code = '$code'")['caption']);
    $post = $botdata->onerow("SELECT * FROM post WHERE code = '$code'")['post'];

    $markup=[];
    if(!empty($like)){  //////// LIKE
        $ex1 = explode("\n",$like);
        foreach($ex1 as $sym){
            $mar1=[];
            $ex2 = explode("/",$sym);
            foreach($ex2 as $emoje){
                array_push($mar1,['text'=>$emoje,'callback_data'=>$emoje]);
            }
            array_push($markup,$mar1);
        }
    }

    if(!empty($alert)){  //////// ALERT
        $ex1 = explode("\n",$alert);
        foreach($ex1 as $sym){
            $mar1=[];
            $ex2 = explode("/",$sym);
            foreach($ex2 as $emoje){
                $ex4=explode("=",$emoje);
                $izoh = trim($ex4[0]);
                $dd = trim($ex4[1]);
                array_push($mar1,['text'=>$izoh,'callback_data'=>"alert1$dd"]);
            }
            array_push($markup,$mar1);
        }
    }

    if(!empty($url)){  //////// URL
        $ex2=explode("\n",$url);
        foreach($ex2 as $value){
            $mar2=[];
            $ex3=explode("+",$value);
            foreach($ex3 as $value1){
                $ex4=explode("=",$value1);
                $izoh = trim($ex4[0]);
                $link = trim($ex4[1]);
                array_push($mar2,['text'=>$izoh,'url'=>$link]);
            }
            array_push($markup,$mar2);
        }
    }

    if(!empty($like)){
        array_push($markup,[['text'=>"👍 Remove Reactions",'callback_data'=>"del_like_$code"]]);
    }else{
        array_push($markup,[['text'=>"👍 add Reactions",'callback_data'=>"add_like_$code"]]);
    }
    if(!empty($alert)){
        array_push($markup,[['text'=>"🗯 Remove alert",'callback_data'=>"del_alert_$code"]]);
    }else{
        array_push($markup,[['text'=>"🗯 add Alert",'callback_data'=>"add_alert_$code"]]);
    }
    if(!empty($url)){
        array_push($markup,[['text'=>"🔗 Remove Buttons",'callback_data'=>"del_url_$code"]]);
    }else{
        array_push($markup,[['text'=>"🔗 add Buttons",'callback_data'=>"add_url_$code"]]);
    }

    if($post != 'sticker' && $post != 'text'){
        array_push($markup,[['text'=>"🖋 add Caption",'callback_data'=>"add_caption_$code"]]);
    }
    array_push($markup,[['text'=>"🗑 Delete",'callback_data'=>"delete$code"]]);
    array_push($markup,[['text'=>"✅ Publish",'callback_data'=>"publish$code"]]);
    $reply=InlineKeyboard($markup);
    editmarkup($callfrid,$callmid,$inmid,$reply);
}

//=========== SEND INLINE MESSAGE =========================

$inline = $update->inline_query->query;
if ($inline){

    $like = urldecode($botdata->onerow("SELECT * FROM post WHERE code = '$inline'")['like']);
    $url = urldecode($botdata->onerow("SELECT * FROM post WHERE code = '$inline'")['url']);
    $alert = urldecode($botdata->onerow("SELECT * FROM post WHERE code = '$inline'")['alert']);
    $caption = urldecode($botdata->onerow("SELECT * FROM post WHERE code = '$inline'")['caption']);
    $file = $botdata->onerow("SELECT * FROM post WHERE code = '$inline'")['file_id'];
    $post = $botdata->onerow("SELECT * FROM post WHERE code = '$inline'")['post'];
    $entit = $botdata->onerow("SELECT * FROM post WHERE code = '$inline'")['entities'];

    $markup=[];
    if(!empty($like)){  //////// LIKE
        $ex1 = explode("\n",$like);
        foreach($ex1 as $sym){
            $mar1=[];
            $ex2 = explode("/",$sym);
            foreach($ex2 as $emoje){
                $user = $botdata->row("SELECT user_id FROM like WHERE code = '$inline' AND emoje = '$emoje'");
                $count = count($user);
                $count = num($count);
                array_push($mar1,['text'=>"$emoje $count",'callback_data'=>"$emoje=$inline"]);
            }
            array_push($markup,$mar1);
        }
    }

    if(!empty($alert)){  //////// ALERT
        $ex1 = explode("\n",$alert);
        foreach($ex1 as $sym){
            $mar1=[];
            $ex2 = explode("/",$sym);
            foreach($ex2 as $emoje){
                $ex4=explode("=",$emoje);
                $izoh = trim($ex4[0]);
                $dd = trim($ex4[1]);
                array_push($mar1,['text'=>$izoh,'callback_data'=>"alert1$dd"]);
            }
            array_push($markup,$mar1);
        }
    }

    if(!empty($url)){  //////// URL
        $ex2=explode("\n",$url);
        foreach($ex2 as $value){
            $mar2=[];
            $ex3=explode("+",$value);
            foreach($ex3 as $value1){
                $ex4=explode("=",$value1);
                $izoh = trim($ex4[0]);
                $link = trim($ex4[1]);
                array_push($mar2,['text'=>$izoh,'url'=>$link]);
            }
            array_push($markup,$mar2);
        }
    }

//////  INLINE

    if($post == 'text'){
        $result = json_encode([[
            'type'=>'article',
            'id'=>base64_encode(1),
            'title'=>"Yuborish",
            'input_message_content'=>[
            'disable_web_page_preview'=>true,
            'parse_mode' => 'none',
            'message_text'=>$caption],
            'entities'=>$entit,
            'reply_markup'=>([
            'inline_keyboard'=>$markup,
            ])
            ]]);
    }elseif($post == 'photo'){
        $result =json_encode([[
            'type'=>'photo',
            'id'=>base64_encode(1),
            'title'=>"Yuborish",
            'photo_file_id'=>$file,
            'caption'=>$caption,
            'caption_entities'=>$entit,
            'reply_markup'=>([
            'inline_keyboard'=>$markup,
            ])
            ]]);
    }elseif($post == 'video'){
        $result =json_encode([[
            'type'=>'video',
            'id'=>base64_encode(1),
            'title'=>"Yuborish",
            'video_file_id'=>$file,
            'caption'=>$caption,
            'caption_entities'=>$entit,
            'reply_markup'=>([
            'inline_keyboard'=>$markup,
            ])
            ]]);
    }elseif($post == 'music'){
        $result =json_encode([[
            'type'=>'audio',
            'id'=>base64_encode(1),
            'title'=>"Yuborish",
            'audio_file_id'=>$file,
            'caption'=>$caption,
            'caption_entities'=>$entit,
            'reply_markup'=>([
            'inline_keyboard'=>$markup,
            ])
            ]]);
    }elseif($post == 'sticker'){
        $result =json_encode([[
            'type'=>'sticker',
            'id'=>base64_encode(1),
            'title'=>"Yuborish",
            'sticker_file_id'=>$file,
            'reply_markup'=>([
            'inline_keyboard'=>$markup,
            ])
            ]]);
    }elseif($post == 'document'){
        $result =json_encode([[
            'type'=>'document',
            'id'=>base64_encode(1),
            'title'=>"Yuborish",
            'document_file_id'=>$file,
            'caption'=>$caption,
            'caption_entities'=>$entit,
            'reply_markup'=>([
            'inline_keyboard'=>$markup,
            ])
            ]]);
    }

   $send = bot('answerInlineQuery', [
        'inline_query_id'=>$update->inline_query->id,
        'cache_time'=>4,
        'results'=>$result
    ]);

    if($send->ok == false && !empty($result)){
        $json = json_encode($send);
        $matn1 = "‼ #eror ‼\n🆔 #$inline_from\n\n$result\n\n$json\n\n$inline";     //////// EROR
        $matn2 ="⚠  Xatolik yuz berdi. bu haqda Mamuriyatga xabar yuborildi\n Iltimos javobni kuting yoki namunadagidek qayta urunib koring";
        botsend($developer,$matn1);
        botsend($inline_from,$matn2);
    }
    if(!empty($result)){
        if($send->ok == true){
            $type = '✅✅✅';
        }elseif($send->ok == false){
            $type = '❌❌❌';
        }
        $vaqt = date('d-M.H.i', strtotime("4 hour"));
        $value = json_encode($send);
        $matn = "$result\n\n$value";
        $caption = "#$inline_from\n$vaqt\n\n$type";
        baza($inline_from,$matn,$caption);
    }
}

if($inline_mid){
    $msgid = $botdata->onerow("SELECT * FROM post WHERE code = '$inline_query'")['message_id'];
    $botdata->query("UPDATE post SET message_id = '$msgid\n$inline_mid', user_id = '$inline_uid' WHERE code = '$inline_query'");
}

//=============== LIKE ==============================

if(mb_stripos($data,'=')!==false){
    $ex = explode("=",$data);
    $code = $ex[1];
    $emoje = $ex[0];
    $user = $botdata->onerow("SELECT * FROM like WHERE code = '$code' AND user_id = '$callfrid'")['user_id'];
    $emoj1 = $botdata->onerow("SELECT * FROM like WHERE code = '$code' AND user_id = '$callfrid'")['emoje'];
    $option = $botdata->onerow("SELECT * FROM like WHERE code = '$code' AND user_id = '$callfrid'")['option'];
    $bosildi = "Fikr bildirganiz uchun rahmat";

        if($user && $option == 'true'){
        if($emoje == $emoj1){
        $bosildi = "Siz Fikringizdan qaytdingiz";
        $botdata->query("DELETE FROM like WHERE code = '$code' AND user_id = '$callfrid'");
        }else{
        $botdata->query("UPDATE like SET emoje = '$emoje', option = 'false' WHERE code = '$code' AND user_id = '$callfrid'");
        }
        alert($qid,$bosildi,false);
    }elseif($user && $option == 'false'){
        $matn = "Kechirasiz Siz Avvalroq fikr bildirgansiz";
        alert($qid,$matn,true);
        $botdata->query("UPDATE like SET option = 'true' WHERE code = '$code' AND user_id = '$callfrid'");
    }
    if(!$user){
        alert($qid,$bosildi,false);
        $botdata->query("INSERT INTO like ('user_id','code','emoje','option') VALUES ('$callfrid','$code','$emoje','false')");
    }

    if(!$user or ($user && $option == 'true')){
        $like = urldecode($botdata->onerow("SELECT * FROM post WHERE code = '$code'")['like']);
        $url = urldecode($botdata->onerow("SELECT * FROM post WHERE code = '$code'")['url']);
        $alert = urldecode($botdata->onerow("SELECT * FROM post WHERE code = '$code'")['alert']);
        $msgid = $botdata->onerow("SELECT * FROM post WHERE code = '$code'")['message_id'];
        $post = $botdata->onerow("SELECT * FROM post WHERE code = '$code'")['post'];

        $markup=[];
        if(!empty($like)){  //////// LIKE
            $ex1 = explode("\n",$like);
            foreach($ex1 as $sym){
                $mar1=[];
                $ex2 = explode("/",$sym);
                foreach($ex2 as $emoje){
                $user = $botdata->row("SELECT user_id FROM like WHERE code = '$code' AND emoje = '$emoje'");
                $count = count($user);
                $count = num($count);
                array_push($mar1,['text'=>"$emoje $count",'callback_data'=>"$emoje=$code"]);
                }
                array_push($markup,$mar1);
            }
        }

        if(!empty($alert)){  //////// ALERT
            $ex1 = explode("\n",$alert);
            foreach($ex1 as $sym){
                $mar1=[];
                $ex2 = explode("/",$sym);
                foreach($ex2 as $emoje){
                    $ex4=explode("=",$emoje);
                    $izoh = trim($ex4[0]);
                    $dd = trim($ex4[1]);
                    array_push($mar1,['text'=>$izoh,'callback_data'=>"alert1$dd"]);
                }
                array_push($markup,$mar1);
            }
        }

        if(!empty($url)){  //////// URL
            $ex2=explode("\n",$url);
            foreach($ex2 as $value){
                $mar2=[];
                $ex3=explode("+",$value);
                foreach($ex3 as $value1){
                    $ex4=explode("=",$value1);
                    $izoh = trim($ex4[0]);
                    $link = trim($ex4[1]);
                    array_push($mar2,['text'=>$izoh,'url'=>$link]);
                }
                array_push($markup,$mar2);
            }
        }

        $reply=InlineKeyboard($markup);
        $ex = explode("\n",$msgid);
        foreach($ex as $inmid){
        editmarkup(null,null,$inmid,$reply);
        }

    }
}

if(mb_stripos($data,'delete')!==false){
    $del = botdel($callfrid,$callmid);
    $code = explode("delete",$data)[1];
    $post = $botdata->onerow("SELECT * FROM post WHERE code = '$code'")['post'];
    $matn = "Sizning *$post* turdagi postingiz malumotlar bazasidan o'chirib tashlandi\n\n*Eslatma\n*Siz postingizni o'chirishingiz, sizni ushu postni yangi foydalanuvchilarga yuborishdan cheklaydi lekin avvalroq tarqatilgan ushbu postning like knopkalarini ishlashidan to'xtatmaydi";
    botsend($callfrid,$matn,null,'markdown',$menu1);
}}

<?php
  $menu1 =json_encode([
    'resize_keyboard'=>true,
    'keyboard'=>[
       [['text'=>$btn1],['text'=>$btn4]],
      ]
    ]);
  $menu2 =json_encode([
    'resize_keyboard'=>true,
    'keyboard'=>[
       [['text'=>$kyb9],['text'=>$kyb10]],
       [['text'=>$kyb11],['text'=>$kyb6]]
      ]
    ]);
   $menu3 =json_encode([
    'resize_keyboard'=>true,
    'keyboard'=>[
       [['text'=>$kyb9],['text'=>$kyb10]],
       [['text'=>$kyb11],['text'=>$kyb12]],
       [['text'=>$kyb6]]
      ]
    ]);
    $back =json_encode([
    'resize_keyboard'=>true,
    'keyboard'=>[
       [['text'=>$btn5]]
      ]
    ]);

//=======================================================================================================
  $keyb1 =json_encode([
    'resize_keyboard'=>true,
    'keyboard'=>[
       [['text'=>$btn1],['text'=>$btn2]],
       [['text'=>$btn3],['text'=>$btn4]],
       [['text'=>$btn5],['text'=>$btn6]]
      ]
    ]);
  $keyb2 =json_encode([
    'resize_keyboard'=>true,
    'keyboard'=>[
       [['text'=>$btn1],['text'=>$btn2]],
       [['text'=>$btn3],['text'=>$btn4]],
       [['text'=>$btn5],['text'=>$btn6]],
       [['text'=>$btn7]]
      ]
    ]);
  $keyb3 =json_encode([
    'resize_keyboard'=>true,
    'keyboard'=>[
       [['text'=>$btn8],['text'=>$btn9]],
       [['text'=>$kyb6]]
      ]
    ]);

    //==================================================
    $qollanma = json_encode([
      'inline_keyboard'=>[
        [['text'=>"📋Qoʻllanma",'url'=>'http://telegra.ph/Uz-Post-Bot-03-01']],
      ]
    ]);
  $kanalim = json_encode([
      'inline_keyboard'=>[
        [['text'=>"✅AʼZO BOʻLISH",'url'=>'https://telegram.me/Abdurasilov']],
      ]
    ]);
?>

<?php
$modversion = array();
$modversion['name'] = "二年級複試計算系統";
$modversion['version'] = "1.0";
$modversion['description'] = "一整個超級不爽";
$modversion['credits'] = "";
$modversion['author'] = "moyamoya(moyamoya@mail.shmps.kh.edu.tw)";
$modversion['license'] = "GPL see LICENSE";
$modversion['official'] = "0";
$modversion['image'] = "images/logo.png";
$modversion['dirname'] = "secondRetry";


//---使用者主選單設定---//
$modversion['hasMain'] = 1;


//---資料表架構---//
$modversion['sqlfile']['mysql'] = "sql/mysql.sql";
//學生名單
$modversion['tables'][1] = "secondRetry_student";
//語言對照表
$modversion['tables'][2] = "secondRetry_check1";
//非語言對照表
$modversion['tables'][3] = "secondRetry_check2";
//全測驗對照表
$modversion['tables'][4] = "secondRetry_check3";
//學生成績
$modversion['tables'][5] = "secondRetry_grade";



//---管理介面設定---//
$modversion['hasAdmin'] = 1;
$modversion['adminindex'] = "admin/index.php";
$modversion['adminmenu'] = "admin/menu.php";




?>

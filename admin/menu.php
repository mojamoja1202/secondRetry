<?php
$adminmenu = array();
$i         = 0;

$adminmenu[$i]['title'] = "首頁";
$adminmenu[$i]['link']  = 'admin/index.php';

$i++;
$adminmenu[$i]['title'] = "匯入";
$adminmenu[$i]['link']  = 'admin/import.php';

$i++;
$adminmenu[$i]['title'] = "名單";
$adminmenu[$i]['link']  = 'admin/list.php';

$i++;
$adminmenu[$i]['title'] = "語文對照表";
$adminmenu[$i]['link']  = 'admin/check1.php';

$i++;
$adminmenu[$i]['title'] = "非語文對照表";
$adminmenu[$i]['link']  = 'admin/check2.php';

$i++;
$adminmenu[$i]['title'] = "總分對照表";
$adminmenu[$i]['link']  = 'admin/check3.php';

$i++;
$adminmenu[$i]['title'] = "匯出";
$adminmenu[$i]['link']  = 'admin/export.php';



?>

<?php
include "../../../include/cp_header.php";
include_once XOOPS_ROOT_PATH."/Frameworks/art/functions.php";
include_once XOOPS_ROOT_PATH."/Frameworks/art/functions.admin.php";
//-----函數區-----

//上傳的表格
function importForm(){
  $excelUploadform="<form action='check3.php?op=importExcel' method='post' enctype='multipart/form-data'><table><tr><td><Input Type='File' Name='excel'></td></tr><tr><td><Input Type='Reset' Value='清除'><Input Type='Submit' Value='傳送'></td></tr></table></form>";
  return $excelUploadform;
}

//show出目前所有的對照表
function check3Show(){
  global $xoopsDB;
  $sql="select * from `" . $xoopsDB->prefix('second_check3') . "` order by right_num3";
  $result=$xoopsDB->query($sql);
  $check1Num=$xoopsDB->getRowsNum($result);
  if ($check1Num==0){
    $check1List="<h2><font color='blue'>目前沒有對照表3</font></h2>";
  }else{
    $check1List="<h1 align='center'>對照表3</h1>";
    $check1List.="<table>";
    $check1List.="<tr><th>答對題數</th><th>T分數</th><th>PR值</th></tr>";
    while(list($sn,$right_num3,$T3,$PR3)=$xoopsDB->fetchRow($result)){
      $check1List.="<tr align='center'><td>$right_num3</td><td>$T3</td><td>$PR3</td></tr>";
    }
    $check1List.="</table>";
  }
  return $check1List;
}

//匯入excel
function importExcel(){
  global $xoopsDB;
  //die($_FILES['excel']['name']);
  if(!$_FILES['excel']['name']){
    redirect_header("check2.php", 3, "未選取檔案");
  }

  //匯入的基本架構
  //include_once "../class/PHPExcel/IOFactory.php";

  include_once XOOPS_ROOT_PATH.'/modules/tadtools/PHPExcel/IOFactory.php';
  
  if (preg_match('/\.(xlsx)$/i', $_FILES['excel']['name'])) {
        $reader = PHPExcel_IOFactory::createReader('Excel2007');
        //die('excel2007');
    } else {
        $reader = PHPExcel_IOFactory::createReader('Excel5');
    }
    $PHPExcel      = $reader->load($_FILES['excel']['tmp_name']); //檔案名稱
    $sheet         = $PHPExcel->getSheet(0); // 讀取第一個工作中工作表(0)
    $highestRow    = $sheet->getHighestRow(); // 取得總列數

    //讀取出每一列
    for ($row = 2; $row <= $highestRow; $row++) {
      $val="";
      $v="";
      for ($col = 0; $col <= 2; $col++) {  
        $val.= $sheet->getCellByColumnAndRow($col, $row)->getValue() . '\\';
        $v = explode("\\",$val);
      }
      $sql = "insert into `" . $xoopsDB->prefix('second_check3') . "` (`right_num3`, `T3`, `PR3`) values ('{$v[0]}' , '{$v[1]}' , '{$v[2]}')";
      $xoopsDB->queryF($sql) or die($sql);
    }


}

//刪除second_check2所有資料
function delAll(){
  global $xoopsDB;
  $sql="delete from `" . $xoopsDB->prefix('second_check3') . "`";
  $xoopsDB->queryF($sql) or die($sql);
}


//-----判斷區-----
$op=(empty($_REQUEST['op']))?"":$_REQUEST['op'];
$sn=(empty($_REQUEST['sn']))?"":$_REQUEST['sn'];
$main="";
switch ($op)
{
  case "importExcel":

  importExcel();
  redirect_header("check3.php", 3, "上傳完成");
  
  break;

  case "delAll":

  delAll();
  redirect_header("check3.php", 3, "刪除成功");

  break;

  default:
  $main = importForm();
}






//-----顯示區-----
xoops_cp_header();
loadModuleAdminMenu(5);
echo "<a href='../sample/sample_checktable.xlsx'>上傳的範例格式</a>" . " | ";
echo "<a href='check3.php?op=delAll'>刪除本對照表</a>";
echo $main;
echo check3Show();
xoops_cp_footer();
?>
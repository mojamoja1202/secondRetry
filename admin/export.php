<?php
include "../../../include/cp_header.php";
include_once XOOPS_ROOT_PATH."/Frameworks/art/functions.php";
include_once XOOPS_ROOT_PATH."/Frameworks/art/functions.admin.php";
//-----函數區-----
//最後彙整的資料，本表格是隔天鑑輔會的教授要看的
/*
function excel(){
  include_once XOOPS_ROOT_PATH.'/modules/tadtools/PHPExcel/IOFactory.php';  //引入 PHPExcel_IOFactory 物件庫
  include_once XOOPS_ROOT_PATH.'/modules/tadtools/PHPExcel.php';  //引入 PHPExcel 物件庫
  $objPHPExcel = new PHPExcel();  //實體化Excel
  //----------內容-----------//
  $objPHPExcel->setActiveSheetIndex(0);
  $objPHPExcel->getActiveSheet()->setCellValue('A1','中文'); 
  $objPHPExcel->getActiveSheet()->setCellValue('B2','許'); 
  $objPHPExcel->getActiveSheet()->setCellValue('C3','test3'); 
  $objPHPExcel->getActiveSheet()->setCellValue('D3','test4');
  $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007'); 
  $objWriter->save('test.xlsx');
  /*
  
  //第一張表匯出所有學生編號及成績
  $objPHPExcel->setActiveSheetIndex(0);  //設定預設顯示的工作表
  $objActSheet = $objPHPExcel->getActiveSheet(); //指定預設工作表為 $objActSheet
  $objActSheet->setTitle("縮修學生");  //設定標題
  $objPHPExcel->createSheet(); //建立新的工作表，上面那三行再來一次，編號要改
  $objPHPExcel->getActiveSheet()->setCellValue('A1','中文'); 
  $objPHPExcel->getActiveSheet()->setCellValue('B2','許'); 
  $objPHPExcel->getActiveSheet()->setCellValue('C3','test3'); 
  $objPHPExcel->getActiveSheet()->setCellValue('D3','test4');

  //第二張表匯出所有縮修學生成績
  $objPHPExcel->setActiveSheetIndex(1);  //設定預設顯示的工作表
  $objActSheet = $objPHPExcel->getActiveSheet(); //指定預設工作表為 $objActSheet
  $objActSheet->setTitle("成績總表");  //設定標題
  $objPHPExcel->createSheet(); //建立新的工作表，上面那三行再來一次，編號要改
  $objPHPExcel->getActiveSheet()->setCellValue('A1','中文'); 
  $objPHPExcel->getActiveSheet()->setCellValue('B2','許'); 
  $objPHPExcel->getActiveSheet()->setCellValue('C3','test3'); 
  $objPHPExcel->getActiveSheet()->setCellValue('D3','test4');

  //第三張表匯出各校統計數據
  $objPHPExcel->setActiveSheetIndex(2);  //設定預設顯示的工作表
  $objActSheet = $objPHPExcel->getActiveSheet(); //指定預設工作表為 $objActSheet
  $objActSheet->setTitle("成績總表");  //設定標題
  $objPHPExcel->createSheet(); //建立新的工作表，上面那三行再來一次，編號要改
  $objPHPExcel->getActiveSheet()->setCellValue('A1','中文'); 
  $objPHPExcel->getActiveSheet()->setCellValue('B2','許'); 
  $objPHPExcel->getActiveSheet()->setCellValue('C3','test3'); 
  $objPHPExcel->getActiveSheet()->setCellValue('D3','test4');
  

  //-------------------------------------
  
  header('Content-Type: application/vnd.ms-excel');
  header('Content-Disposition: attachment;filename=統計.xls');
  header('Cache-Control: max-age=0');
  $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
  $objWriter->setPreCalculateFormulas(false);$objWriter->save('php://output');
  exit;
  */




//-----判斷區-----
$op=(empty($_REQUEST['op']))?"":$_REQUEST['op'];
$sn=(empty($_REQUEST['sn']))?"":$_REQUEST['sn'];
switch ($op)
{
  default:
  $main="<br><br><h1><a href='excel.php'>下載統計表格</a></h1><br><br>";
  $main.="<h1>注意事項：</h1><br>";
  $main.="<h1>1.第一張表是有報名縮修學生的成績表，當天要交給承辦縮修的學校</h1>";
  $main.="<h1>2.第二張表匯出所有學生的成績</h1>";
  $main.="<h1>3.第三張表匯出各校統計數據</h1>";
  $main.="<h1>4.該系統僅匯出必要的資料，請自行依據承辦人的開會需求修改成符合的格式</h1>";
}





//-----顯示區-----
xoops_cp_header();
loadModuleAdminMenu(7);
echo $main;
xoops_cp_footer();
?>

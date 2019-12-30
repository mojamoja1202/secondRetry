<?php
include "../../../include/cp_header.php";
include_once XOOPS_ROOT_PATH."/Frameworks/art/functions.php";
include_once XOOPS_ROOT_PATH."/Frameworks/art/functions.admin.php";
//-----函數區-----
function importExcel(){
	global $xoopsDB;
	//die($_FILES['excel']['name']);
	if(!$_FILES['excel']['name']){
		redirect_header("import.php", 3, "未選取檔案");
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
    $highestColumn = $sheet->getHighestColumn(); // 取得總欄數
    //die($highestColumn);
    //$colNumber     = PHPExcel_Cell::columnIndexFromString($highestColumn);
    //die($colNumber);

    $val="";
    //讀取出每一列
    for ($row = 2; $row <= $highestRow; $row++) {
    	$val="";
    	$v="";
  		for ($col = 0; $col <= 10; $col++) {	
    		$val.= $sheet->getCellByColumnAndRow($col, $row)->getValue() . '\\';
    		$v = explode("\\",$val);
  		}
  		//echo $val;
  		//echo "<br>";
  		//這邊要把資料放入兩張資料表：second_student && second_grade
  		//處理second_student
  		$sql_student = "insert into `" . $xoopsDB->prefix('second_student') . "` (`id`, `name`, `sex`, `year`, `month`, `day`, `school`, `class`, `phone`, `note`, `place`) values ('{$v[0]}' , '{$v[1]}' , '{$v[2]}' , '{$v[3]}' , '{$v[4]}' , '{$v[5]}' , '{$v[6]}' , '{$v[7]}' , '{$v[8]}' , '{$v[9]}' , '{$v[10]}')";
  		$xoopsDB->queryF($sql_student) or die($sql_student);

  		//處理second_grade
  		$sql_grade = "insert into `" . $xoopsDB->prefix('second_grade') . "` (`place`, `id`) values ('{$v[10]}' , '{$v[0]}')";
  		$xoopsDB->queryF($sql_grade) or die($sql_grade);
		
	}


}


function importForm(){
	$excelUploadform="<form action='import.php?op=importExcel' method='post' enctype='multipart/form-data'><table><tr><td><Input Type='File' Name='excel'></td></tr><tr><td><Input Type='Reset' Value='清除'><Input Type='Submit' Value='傳送'></td></tr></table></form>";
	return $excelUploadform;
}

//刪除second_student所有資料
function delAll(){
  global $xoopsDB;
  $sql="delete from `" . $xoopsDB->prefix('second_student') . "`";
  $xoopsDB->queryF($sql) or die($sql);
  $sqlDelgrade="delete from `" . $xoopsDB->prefix('second_grade') . "`";
  $xoopsDB->queryF($sqlDelgrade);
}




//-----判斷區-----
$op=(empty($_REQUEST['op']))?"":$_REQUEST['op'];
$sn=(empty($_REQUEST['sn']))?"":$_REQUEST['sn'];
switch ($op)
{
  case "importExcel":

  importExcel();
  redirect_header("list.php", 3, "上傳完成");
  
  break;

  case "importForm":

  break;
  
  case "delAll":

  delAll();
  redirect_header("index.php", 3, "全部刪掉了！！！");

  break;

  default:
  $main = importForm();
}



//-----顯示區-----
xoops_cp_header();
loadModuleAdminMenu(1);
echo "<a href='../sample/sample_student.xlsx'>上傳的範例格式</a>" . " | ";
echo "<a href='import.php?op=delAll'>刪除所有學生名單</a>";
echo $main;
xoops_cp_footer();
?>
<?php
include_once "../../../mainfile.php";
require_once "../../tadtools/PHPExcel.php";    //引入 PHPExcel 物件庫
require_once "../../tadtools/PHPExcel/IOFactory.php";    //引入 PHPExcel_IOFactory 物件庫
$objPHPExcel = new PHPExcel();  //實體化Excel
//----------內容-----------//

//第一張表格
$objPHPExcel->setActiveSheetIndex(0);  //設定預設顯示的工作表
$objActSheet = $objPHPExcel->getActiveSheet(); //指定預設工作表為 $objActSheet
$objActSheet->setTitle("縮修學生");  //設定標題
$objPHPExcel->createSheet(); //建立新的工作表，上面那三行再來一次，編號要改

//標題
$objActSheet->setCellValueByColumnAndRow(0, 1, "報名縮修學生成績表");
$objActSheet->setCellValueByColumnAndRow(0, 2, "編號");
$objActSheet->setCellValueByColumnAndRow(1, 2, "姓名");
$objActSheet->setCellValueByColumnAndRow(2, 2, "測驗1");
$objActSheet->setCellValueByColumnAndRow(3, 2, "測驗1T分數");
$objActSheet->setCellValueByColumnAndRow(4, 2, "測驗2");
$objActSheet->setCellValueByColumnAndRow(5, 2, "測驗2T分數");
$objActSheet->setCellValueByColumnAndRow(6, 2, "測驗3");
$objActSheet->setCellValueByColumnAndRow(7, 2, "測驗3T分數");
$objActSheet->setCellValueByColumnAndRow(8, 2, "T分數總合");
$objActSheet->setCellValueByColumnAndRow(9, 2, "全測驗T分數");
$objActSheet->setCellValueByColumnAndRow(10, 2, "PR");

//縮修的學生
$sql_short="select id,name from " . $xoopsDB->prefix('second_student') . " where note='縮修'";
$result_short=$xoopsDB->query($sql_short);
$i=3;
while(list($id,$name)=$xoopsDB->fetchRow($result_short)){
	$sql_shortstudent="select * from " . $xoopsDB->prefix('second_grade') . " where id='$id'";
	$result_shortstudent=$xoopsDB->query($sql_shortstudent);
	list($sn, $place, $id, $test1, $t1, $test2, $t2, $test3, $t3, $tall, $allt, $PR, $note)=$xoopsDB->fetchRow($result_shortstudent);
	$objActSheet->setCellValueByColumnAndRow(0, $i, $id);
	$objActSheet->setCellValueByColumnAndRow(1, $i, $name);
	$objActSheet->setCellValueByColumnAndRow(2, $i, $test1);
	$objActSheet->setCellValueByColumnAndRow(3, $i, $t1);
	$objActSheet->setCellValueByColumnAndRow(4, $i, $test2);
	$objActSheet->setCellValueByColumnAndRow(5, $i, $t2);
	$objActSheet->setCellValueByColumnAndRow(6, $i, $test3);
	$objActSheet->setCellValueByColumnAndRow(7, $i, $t3);
	$objActSheet->setCellValueByColumnAndRow(8, $i, $tall);
	$objActSheet->setCellValueByColumnAndRow(9, $i, $allt);
	$objActSheet->setCellValueByColumnAndRow(10, $i, $PR);
	$i++;
}

//第二張表格
$objPHPExcel->setActiveSheetIndex(1);  //設定預設顯示的工作表
$objActSheet = $objPHPExcel->getActiveSheet(); //指定預設工作表為 $objActSheet
$objActSheet->setTitle("成績總表");  //設定標題
$objPHPExcel->createSheet(); //建立新的工作表，上面那三行再來一次，編號要改

//標題
$Y=date("Y")-1911;
$objActSheet->setCellValueByColumnAndRow(0, 1, "高雄市" . $Y . "學年度一般智能資賦優異學生鑑定初試成績統計表(二年級)");
$objActSheet->setCellValueByColumnAndRow(0, 2, "編號");
$objActSheet->setCellValueByColumnAndRow(1, 2, "測驗1");
$objActSheet->setCellValueByColumnAndRow(2, 2, "測驗1T分數");
$objActSheet->setCellValueByColumnAndRow(3, 2, "測驗2");
$objActSheet->setCellValueByColumnAndRow(4, 2, "測驗2T分數");
$objActSheet->setCellValueByColumnAndRow(5, 2, "測驗3");
$objActSheet->setCellValueByColumnAndRow(6, 2, "測驗3T分數");
$objActSheet->setCellValueByColumnAndRow(7, 2, "T分數總合");
$objActSheet->setCellValueByColumnAndRow(8, 2, "全測驗T分數");
$objActSheet->setCellValueByColumnAndRow(9, 2, "PR");

$sql="select * from " . $xoopsDB->prefix('second_grade');
$result=$xoopsDB->query($sql);
$j=3;
while(list($sn, $place, $id, $test1, $t1, $test2, $t2, $test3, $t3, $tall, $allt, $PR, $note)=$xoopsDB->fetchRow($result)){
	if ($note==1){
		$objActSheet->setCellValueByColumnAndRow(0, $j, $id);
		$objActSheet->setCellValueByColumnAndRow(1, $j, "缺考");
		$objActSheet->setCellValueByColumnAndRow(2, $j, "缺考");
		$objActSheet->setCellValueByColumnAndRow(3, $j, "缺考");
		$objActSheet->setCellValueByColumnAndRow(4, $j, "缺考");
		$objActSheet->setCellValueByColumnAndRow(5, $j, "缺考");
		$objActSheet->setCellValueByColumnAndRow(6, $j, "缺考");
		$objActSheet->setCellValueByColumnAndRow(7, $j, "缺考");
		$objActSheet->setCellValueByColumnAndRow(8, $j, "缺考");
		$objActSheet->setCellValueByColumnAndRow(9, $j, "缺考");
		$j++;
	}else{
		$objActSheet->setCellValueByColumnAndRow(0, $j, $id);
		$objActSheet->setCellValueByColumnAndRow(1, $j, $test1);
		$objActSheet->setCellValueByColumnAndRow(2, $j, $t1);
		$objActSheet->setCellValueByColumnAndRow(3, $j, $test2);
		$objActSheet->setCellValueByColumnAndRow(4, $j, $t2);
		$objActSheet->setCellValueByColumnAndRow(5, $j, $test3);
		$objActSheet->setCellValueByColumnAndRow(6, $j, $t3);
		$objActSheet->setCellValueByColumnAndRow(7, $j, $tall);
		$objActSheet->setCellValueByColumnAndRow(8, $j, $allt);
		$objActSheet->setCellValueByColumnAndRow(9, $j, $PR);
		$j++;
	}
}



//第三張表格
$objPHPExcel->setActiveSheetIndex(2);  //設定預設顯示的工作表
$objActSheet = $objPHPExcel->getActiveSheet(); //指定預設工作表為 $objActSheet
$objActSheet->setTitle("統計總表");  //設定標題
$objPHPExcel->createSheet(); //建立新的工作表，上面那三行再來一次，編號要改

//標題
$Y=date("Y")-1911;
$objActSheet->setCellValueByColumnAndRow(0, 1, "高雄市" . $Y . "學年度一般智能資賦優異學生鑑定初試學生成績暨鑑定結果一覽表(二年級)");
$objActSheet->setCellValueByColumnAndRow(0, 2, "編號");
$objActSheet->setCellValueByColumnAndRow(1, 2, "學校");
$objActSheet->setCellValueByColumnAndRow(2, 2, "報名人數");
$objActSheet->setCellValueByColumnAndRow(3, 2, "到考人數");
$objActSheet->setCellValueByColumnAndRow(4, 2, "T分數68分以上");
$objActSheet->setCellValueByColumnAndRow(5, 2, "T分數67分以上");
$objActSheet->setCellValueByColumnAndRow(6, 2, "T分數66分以上");
$objActSheet->setCellValueByColumnAndRow(7, 2, "T分數65分以上");
$objActSheet->setCellValueByColumnAndRow(8, 2, "T分數64分以上");
$objActSheet->setCellValueByColumnAndRow(9, 2, "T分數63分以上");
$objActSheet->setCellValueByColumnAndRow(10, 2, "T分數62分以上");
$objActSheet->setCellValueByColumnAndRow(11, 2, "T分數61分以上");
$objActSheet->setCellValueByColumnAndRow(12, 2, "缺考人數");

$item=array("01","02","03","04","05","06","07","08","09","10","11","12","13","14","15","16","17","18","19","20","21","22","23","24","25","26","27","28","29","30","31","32","33","34","35");
$gg=0;
$k=3;

while($gg<34){

	
	//先將變數歸0
	$student_num=0;
	$come_num=0;
	$absense=0;
	$t68=0;
	$t67=0;
	$t66=0;
	$t65=0;
	$t64=0;
	$t63=0;
	$t62=0;
	$t61=0;
	//抓取各間學校資料
	$sql_getschool="select allt,note from " . $xoopsDB->prefix('second_grade') . " where id like '____" . $item[$gg] . "___'";
	$result_getschool=$xoopsDB->query($sql_getschool) or die($sql_getschool);
	$student_num=$xoopsDB->getRowsNum($result_getschool);
	while(list($allt,$note)=$xoopsDB->fetchRow($result_getschool)){
		if($allt>=68){$t68++;}
		if($allt>=67){$t67++;}
		if($allt>=66){$t66++;}
		if($allt>=65){$t65++;}
		if($allt>=64){$t64++;}
		if($allt>=63){$t63++;}
		if($allt>=62){$t62++;}
		if($allt>=61){$t61++;}
		if($note==1){$absense++;}
	}
		//計算到考人數
		$come_num=$student_num-$absense;
		//將所有的數據放入表格
		$objActSheet->setCellValueByColumnAndRow(0, $k, $item[$gg]);
		$objActSheet->setCellValueByColumnAndRow(1, $k, "校名");
		$objActSheet->setCellValueByColumnAndRow(2, $k, $student_num);
		$objActSheet->setCellValueByColumnAndRow(3, $k, $come_num);
		$objActSheet->setCellValueByColumnAndRow(4, $k, $t68);
		$objActSheet->setCellValueByColumnAndRow(5, $k, $t67);
		$objActSheet->setCellValueByColumnAndRow(6, $k, $t66);
		$objActSheet->setCellValueByColumnAndRow(7, $k, $t65);
		$objActSheet->setCellValueByColumnAndRow(8, $k, $t64);
		$objActSheet->setCellValueByColumnAndRow(9, $k, $t63);
		$objActSheet->setCellValueByColumnAndRow(10, $k, $t62);
		$objActSheet->setCellValueByColumnAndRow(11, $k, $t61);
		$objActSheet->setCellValueByColumnAndRow(12, $k, $absense);
		$k++;
		$gg++;
}

$objActSheet->setCellValue("C37", "=SUM(C3:C36)");
$objActSheet->setCellValue("D37", "=SUM(D3:D36)");
$objActSheet->setCellValue("E37", "=SUM(E3:E36)");
$objActSheet->setCellValue("F37", "=SUM(F3:F36)");
$objActSheet->setCellValue("G37", "=SUM(G3:G36)");
$objActSheet->setCellValue("H37", "=SUM(H3:H36)");
$objActSheet->setCellValue("I37", "=SUM(I3:I36)");
$objActSheet->setCellValue("J37", "=SUM(J3:J36)");
$objActSheet->setCellValue("K37", "=SUM(K3:K36)");
$objActSheet->setCellValue("L37", "=SUM(L3:L36)");
$objActSheet->setCellValue("M37", "=SUM(M3:M36)");

$objPHPExcel->getActiveSheet()->getStyle('E38')->getNumberFormat()->setFormatCode('0.00%');
$objPHPExcel->getActiveSheet()->getStyle('F38')->getNumberFormat()->setFormatCode('0.00%');
$objPHPExcel->getActiveSheet()->getStyle('G38')->getNumberFormat()->setFormatCode('0.00%');
$objPHPExcel->getActiveSheet()->getStyle('H38')->getNumberFormat()->setFormatCode('0.00%');
$objPHPExcel->getActiveSheet()->getStyle('I38')->getNumberFormat()->setFormatCode('0.00%');
$objPHPExcel->getActiveSheet()->getStyle('J38')->getNumberFormat()->setFormatCode('0.00%');
$objPHPExcel->getActiveSheet()->getStyle('K38')->getNumberFormat()->setFormatCode('0.00%');
$objPHPExcel->getActiveSheet()->getStyle('L38')->getNumberFormat()->setFormatCode('0.00%');
$objPHPExcel->getActiveSheet()->getStyle('M38')->getNumberFormat()->setFormatCode('0.00%');

$objActSheet->setCellValue("E38", "=E37/D37");
$objActSheet->setCellValue("F38", "=F37/D37");
$objActSheet->setCellValue("G38", "=G37/D37");
$objActSheet->setCellValue("H38", "=H37/D37");
$objActSheet->setCellValue("I38", "=I37/D37");
$objActSheet->setCellValue("J38", "=J37/D37");
$objActSheet->setCellValue("K38", "=K37/D37");
$objActSheet->setCellValue("L38", "=L37/D37");
$objActSheet->setCellValue("M38", "=M37/D37");

$objActSheet->setCellValueByColumnAndRow(0, 40, "委員綜合研判：錄取標準為全測驗T分數        (含)分以上，計        人通過");
$objActSheet->setCellValueByColumnAndRow(0, 41, "委員簽名：");



$objPHPExcel->setActiveSheetIndex(0);  //設定預設顯示的工作表


//匯出的檔頭
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename='.iconv('UTF-8','Big5','二年級總表').'.xls');
header('Cache-Control: max-age=0');
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter->setPreCalculateFormulas(false);
$objWriter->save('php://output');
exit;
?>

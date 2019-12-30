<?php
/*
聲明：
1.本程式為新民智障生設計製作
2.依據106年度資賦優異鑑定的初試流程規劃設計的，所以若有不合適的地方，請自行看情況處理
3.106年度複試有重大變動，個人感覺初試的變動可能性較小，因此僅設計適合初試的系統
4.版權自然屬於新民智障生所有

開始撰寫時間：2017/05/28
完成撰寫時間：2017/08/29
程式設計者：葉大炮
系統架設：xoops

*/





//-----引入區-----
include "../../mainfile.php";
include "../../header.php";


//-----函數區-----

//選擇要輸入的試場

function choseForm(){
	$form="<form method='post' action='index.php?op=showList'>";
	$form.="<table align='center'>";
	$form.="<tr><td>輸入第<input type='text' name='place' size='1'>試場成績<Input Type='Reset' Value='清除'><Input Type='Submit' Value='傳送'></td></tr>";
	$form.="</table>";
	$form.="</form>";
	return $form;
}

//秀出考場的學生
function showList($place){
	global $xoopsDB;
	//不知道是哪來的bug，只能這樣解決…很怪，可能得要請教高手才可以了
	$p=$place;
	$sql="select * from `" . $xoopsDB->prefix('second_grade') . "` where `place`=$p order by id";
	$result=$xoopsDB->query($sql);
	//貼上表格的java和style
	$placeList="
	<script type='text/javascript'>
	window.onload=function(){
	    var tfrow = document.getElementById('tfhover').rows.length;
	    var tbRow=[];
	    for (var i=1;i<tfrow;i++) {
	        tbRow[i]=document.getElementById('tfhover').rows[i];
	        tbRow[i].onmouseover = function(){
	            this.style.backgroundColor = '#ffffff';
	        };
	        tbRow[i].onmouseout = function() {
	            this.style.backgroundColor = '#d4e3e5';
	        };
	    }
	};
	</script>
	";
	$placeList.="
	<style type='text/css'>
	table.tftable {font-size:12px;color:#333333;width:100%;border-width: 1px;border-color: #729ea5;border-collapse: collapse;}
	table.tftable th {font-size:14px;font-weight:bold;background-color:#acc8cc;border-width: 1px;padding: 8px;border-style: solid;border-color: #729ea5;text-align:center;}
	table.tftable tr {background-color:#d4e3e5;}
	table.tftable td {font-size:14px;border-width: 1px;padding: 8px;border-style: solid;border-color: #729ea5;}
	</style>
	";
	//這邊開始處理表單的部份
	$placeList.="<form action=\"index.php?op=save\" method=\"post\">";
	$placeList.="<table id='tfhover' class='tftable'>";
	$placeList.="<tr><th>序號</th><th>考生編號</th><th>測驗1</th><th>測驗1<br>T分數</th><th>測驗2</th><th>測驗2<br>T分數</th><th>測驗3</th><th>測驗3<br>T分數</th><th>T分數<br>總分</th><th>全測驗<br>T分數</th><th>PR</th><th>缺考</th></tr>";
	$t=1;
	while(list($sn, $place, $id, $test1, $t1, $test2, $t2, $test3, $t3, $tall, $allt, $PR, $note)=$xoopsDB->fetchRow($result)){
		$check=($note==1)?"checked":"";
		$placeList.="<tr align=\"center\"><td>$t</td><td>$id</td><td><input type=\"text\" size=\"1\" name=\"test1[$sn]\" id=\"test1$sn\" value=$test1 onchange=\"fuck()\"></td><td><p id=\"T1$sn\">$t1</p></td><td><input type=\"text\" size=\"1\" name=\"test2[$sn]\" id=\"test2$sn\" value=$test2 onchange=\"fuck()\"></td><td><p id=\"T2$sn\">$t2</p></td><td><input type=\"text\" size=\"1\" name=\"test3[$sn]\" id=\"test3$sn\" value=$test3 onchange=\"fuck()\"></td><td><p id=\"T3$sn\">$t3</p></td><td><p id=\"test4$sn\">$tall</p></td><td><p id=\"T4$sn\">$allt</p></td><td><p id=\"PR$sn\">$PR</p></td><td><input type=\"checkbox\" name=\"absense[$sn]\" value=\"1\" $check></td></tr>";
		$t++;
	}
	$placeList.="</table>";
	$placeList.="<input type='hidden' name='place' value=$p>";
	$placeList.="<div align=\"center\"><Input Type=\"Submit\" Value=\"儲存\"></div>";
	
	
	//開始java撰寫
	$placeList.="</form>
				<script type='text/javascript'>
				function fuck(){";
	//製作T1,T2,T3,T4,PR4四張表格
	//T1 array
	$tableT1=array_fill(0, 100, 1000);
  	$sql_getT1="select * from `" . $xoopsDB->prefix('second_check1') . "` order by right_num1";
  	$result_getT1=$xoopsDB->query($sql_getT1);
    while(list($sn,$right_num1,$T1,$PR1)=$xoopsDB->fetchRow($result_getT1)){
      $tableT1[$right_num1]=$T1;
    }
    $tableT1="[" . implode(",", $tableT1) . "]";
	//T2 array
	$tableT2=array_fill(0, 100, 1000);
  	$sql_getT2="select * from `" . $xoopsDB->prefix('second_check2') . "` order by right_num2";
  	$result_getT2=$xoopsDB->query($sql_getT2);
    while(list($sn,$right_num2,$T2,$PR2)=$xoopsDB->fetchRow($result_getT2)){
      $tableT2[$right_num2]=$T2;
    }
	$tableT2="[" . implode(",", $tableT2) . "]";
	//T3 array
	$tableT3=array_fill(0, 100, 1000);
  	$sql_getT3="select * from `" . $xoopsDB->prefix('second_check3') . "` order by right_num3";
  	$result_getT3=$xoopsDB->query($sql_getT3);
    while(list($sn,$right_num3,$T3,$PR3)=$xoopsDB->fetchRow($result_getT3)){
      $tableT3[$right_num3]=$T3;
    }
	$tableT3="[" . implode(",", $tableT3) . "]";
	//T4 & PR4 array
	$tableT4=array_fill(0, 300, 1000);
	$tablePR4=array_fill(0, 300, 0);
  	$sql_getT4="select * from `" . $xoopsDB->prefix('second_check4') . "` order by right_num4";
  	$result_getT4=$xoopsDB->query($sql_getT4);
    while(list($sn,$right_num4,$T4,$PR4)=$xoopsDB->fetchRow($result_getT4)){
      $tableT4[$right_num4]=$T4;
      $tablePR4[$right_num4]=$PR4;
    }
    $tableT4="[" . implode(",", $tableT4) . "]";
    $tablePR4="[" . implode(",", $tablePR4) . "]";	
	
	$placeList.="
				var T1=$tableT1;
				var T2=$tableT2;
				var T3=$tableT3;
				var T4=$tableT4;
				var PR4=$tablePR4;
				";
	//先取得該試場所有學生的sn
	$sql_sn="select `sn` from `" . $xoopsDB->prefix('second_grade') . "` where `place`=$p order by id";
	$result_sn=$xoopsDB->query($sql_sn);
	while(list($sn)=$xoopsDB->fetchRow($result_sn)){
		//開始撰寫各個變數計數
		$placeList.="
			var grade1$sn = document.getElementById(\"test1$sn\").value;
			var grade2$sn = document.getElementById(\"test2$sn\").value;
			var grade3$sn = document.getElementById(\"test3$sn\").value;
			var gradeTotal$sn = T1[grade1$sn]+T2[grade2$sn]+T3[grade3$sn];
			document.getElementById(\"T1$sn\").innerHTML = T1[grade1$sn];
			document.getElementById(\"T2$sn\").innerHTML = T2[grade2$sn];
			document.getElementById(\"T3$sn\").innerHTML = T3[grade3$sn];
			document.getElementById(\"test4$sn\").innerHTML = gradeTotal$sn;
			document.getElementById(\"T4$sn\").innerHTML = T4[gradeTotal$sn];
			document.getElementById(\"PR$sn\").innerHTML = PR4[gradeTotal$sn];

			";
	}
	$placeList.="}
				</script>
				";
	
	return $placeList;
}

//確認是否是有註冊過的帳號
function checkUser(){
	global $xoopsUser;
	if(empty($xoopsUser)){redirect_header(XOOPS_URL . "/index.php", 3, "請先登入");}
}

//將所有的資料儲存起來
function save($place,$test1,$test2,$test3,$absense){
	global $xoopsDB;
	//製作T1 T2 T3 T4 PR4四個矩陣
	//T1 array
  	$sql_getT1="select * from `" . $xoopsDB->prefix('second_check1') . "` order by right_num1";
  	$result_getT1=$xoopsDB->query($sql_getT1);
    while(list($sn,$right_num1,$T1,$PR1)=$xoopsDB->fetchRow($result_getT1)){
      $tableT1[$right_num1]=$T1;
    }

	//T2 array
  	$sql_getT2="select * from `" . $xoopsDB->prefix('second_check2') . "` order by right_num2";
  	$result_getT2=$xoopsDB->query($sql_getT2);
    while(list($sn,$right_num2,$T2,$PR2)=$xoopsDB->fetchRow($result_getT2)){
      $tableT2[$right_num2]=$T2;
    }
	
	//T3 array
  	$sql_getT3="select * from `" . $xoopsDB->prefix('second_check3') . "` order by right_num3";
  	$result_getT3=$xoopsDB->query($sql_getT3);
    while(list($sn,$right_num3,$T3,$PR3)=$xoopsDB->fetchRow($result_getT3)){
      $tableT3[$right_num3]=$T3;
    }
	
	//T4 & PR4 array
  	$sql_getT4="select * from `" . $xoopsDB->prefix('second_check4') . "` order by right_num4";
  	$result_getT4=$xoopsDB->query($sql_getT4);
    while(list($sn,$right_num4,$T4,$PR4)=$xoopsDB->fetchRow($result_getT4)){
      $tableT4[$right_num4]=$T4;
      $tablePR4[$right_num4]=$PR4;
    }
	
	//抓取該試場所有的sn
	$sql="select sn from " . $xoopsDB->prefix('second_grade')  . " where place=$place order by id";
	//die($sql);
	$result=$xoopsDB->query($sql);
	while(list($sn)=$xoopsDB->fetchRow($result)){
		$g1=$test1[$sn];
		$gt1=$tableT1[$g1];
		$g2=$test2[$sn];
		$gt2=$tableT2[$g2];
		$g3=$test3[$sn];
		$gt3=$tableT3[$g3];
		$g4=$gt1+$gt2+$gt3;
		$gt4=$tableT4[$g4];
		$gpr=$tablePR4[$g4];
		$noCome=$absense[$sn];
		$sql_update="update " . $xoopsDB->prefix('second_grade') . " set test1='$g1',t1='$gt1',test2='$g2',t2='$gt2',test3='$g3',t3='$gt3',tall='$g4',allt='$gt4',PR='$gpr',note='$noCome' where sn=$sn";
		$xoopsDB->queryF($sql_update) or die($sql_update);
	}
	
}

//列印出試場的表格
function printContent($place){
	global $xoopsDB;
	$p=$place;
	$sql="select * from `" . $xoopsDB->prefix('second_grade') . "` where `place`=$p order by id";
	//die($sql);
	$result=$xoopsDB->query($sql);

//	$content="<script type='text/javascript'>";
//	$content.="window.print()";
//	$content.="</script>";

	$content="

<script language=\"javascript\">
var hkey_root,hkey_path,hkey_key
hkey_root=\"HKEY_CURRENT_USER\"
hkey_path=\"//Software//Microsoft//Internet Explorer//PageSetup//\"
function pagesetup_null(){
try{
var RegWsh = new ActiveXObject(\"WScript.Shell\")
hkey_key=\"header\"
RegWsh.RegWrite(hkey_root+hkey_path+hkey_key,\"\")
hkey_key=\"footer\"
RegWsh.RegWrite(hkey_root+hkey_path+hkey_key,\"\")
}catch(e){}
}
pagesetup_null()
self.print()
</script>
";
	$content.="<h2 align='center'>高雄市107學年度一般智能資優資源班入班甄選</h2>";
	$content.="<h3 align='center'>初試成績計算表（二年級）</h3>";
	$content.="<h6>試場編號：" . $p . "</h6>";
	$content.="<table border='2'>";
	$content.="<tr style=\"text-align:center;\"><th>序號</th><th>考生編號</th><th>測驗1</th><th>測驗1<br>T分數</th><th>測驗2</th><th>測驗2<br>T分數</th><th>測驗3</th><th>測驗3<br>T分數</th><th>T分數<br>總分</th><th>全測驗<br>T分數</th><th>PR</th></tr>";
	$i=1;
	while(list($sn, $place, $id, $test1, $t1, $test2, $t2, $test3, $t3, $tall, $allt, $PR, $note)=$xoopsDB->fetchRow($result)){
		if ($note==1){
			$content.="<tr align=\"center\" border=\"2\"><td>$i</td><td>$id</td><td>缺考</td><td>0</td><td>缺考</td><td>0</td><td>缺考</td><td>0</td><td>0</td><td>0</td><td>0</td></tr>";
		}else{
			$content.="<tr align=\"center\" border=\"2\"><td>$i</td><td>$id</td><td>$test1</td><td>$t1</td><td>$test2</td><td>$t2</td><td>$test3</td><td>$t3</td><td>$tall</td><td>$allt</td><td>$PR</td></tr>";
		}
		$i++;
	}
	$content.="</table><br>";
	$content.="輸入人員：　　　　　　　　　　　　　　主試人員：　　　　　　　　　　　　" . date("Y-m-d h:i:sa") . "<br>";
//	$content.="<a href='#' class='notprint' onclick='pagesetup_null();self.print();'>列印</a>";
	echo $content;
}



//-----判斷區-----
$op=(empty($_REQUEST['op']))?"":$_REQUEST['op'];
$sn=(empty($_REQUEST['sn']))?"":$_REQUEST['sn'];
$place=(empty($_REQUEST['place']))?"":$_REQUEST['place'];
$print=(empty($_REQUEST['print']))?"":$_REQUEST['print'];
$test1=(empty($_POST['test1']))?"":$_REQUEST['test1'];
$test2=(empty($_REQUEST['test2']))?"":$_REQUEST['test2'];
$test3=(empty($_REQUEST['test3']))?"":$_REQUEST['test3'];
$absense=(empty($_REQUEST['absense']))?"":$_REQUEST['absense'];
switch($op){
	case "showList":

	$main=showList($place);

	break;

	case "print":

	printContent($place);

	break;

	case "save":

	save($place,$test1,$test2,$test3,$absense);
	redirect_header("index.php?op=print&place=$place", 3 ,"輸入完成");

	break;

	default:
	$main=choseForm();
}


//-----顯示區-----

checkUser();
echo $main;
include "../../footer.php";
?>

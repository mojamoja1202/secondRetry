<?php
include "../../../include/cp_header.php";
include_once XOOPS_ROOT_PATH."/Frameworks/art/functions.php";
include_once XOOPS_ROOT_PATH."/Frameworks/art/functions.admin.php";
//-----函數區-----


//整理所有的學生名單
function studentList(){
  global $xoopsDB;
  $main="";
  //抓取所有的學生名單
  
  $sql="select * from `" . $xoopsDB->prefix('second_student') . "` order by id";
  $result=$xoopsDB->query($sql) or die($sql);
  while (list($sn, $id, $name, $sex, $year, $month, $day, $school, $class, $phone, $note, $place)=$xoopsDB->fetchRow($result)){
    $birthday="$year-$month-$day";
    $main.="<tr align='center'><td>$id</td><td>$name</td><td>$sex</td><td>$birthday</td><td>$school</td><td>$class</td><td>$phone</td><td>$note</td><td>$place</td></tr>";

  }

return $main;  
}

function del($sn){
  global $xoopsDB;
  $sql="delete from `" . $xoopsDB->prefix('second_student') . "` where `sn`=$sn";
  $xoopsDB->queryF($sql) or die($sql);
}

function add(){
  global $xoopsDB;
   $sql = "insert into " . $xoopsDB->prefix('second_student') . " (`id`, `name`, `sex`, `year`, `month`, `day`, `school`, `class`, `phone`, `note`, `place`) values ('{$_POST['id']}','{$_POST['name']}','{$_POST['sex']}','{$_POST['year']}','{$_POST['month']}','{$_POST['day']}','{$_POST['school']}','{$_POST['class']}','{$_POST['phone']}','{$_POST['note']}','{$_POST['place']}')";
  $xoopsDB->query($sql) or redirect_header("list.php",3,"新增失敗"); 
}


//修改的表單
function updateForm($sn){
  global $xoopsDB;
  $sql="select * from `" . $xoopsDB->prefix('second_student') . "` where `sn`=$sn";
  $result=$xoopsDB->query($sql) or die($sql);
  list($sn,$id,$name,$sex,$year,$month,$day,$school,$class,$phone,$note,$place)=$xoopsDB->fetchRow($result);
  $main="<h1>修改$name</h1>";
  $main.="<form action='list.php?op=update&sn=$sn' method='POST'>";
  $main.="<table>";
  $main.="<tr><th>編號</th><td><input type='text' name='id' value=$id></td></tr>";
  $main.="<tr><th>姓名</th><td><input type='text' name='name' value=$name></td></tr>";
  $main.="<tr><th>性別</th><td><input type='text' name='sex' value=$sex></td></tr>";
  $main.="<tr><th>年</th><td><input type='text' name='year' value=$year></td></tr>";
  $main.="<tr><th>月</th><td><input type='text' name='month' value=$month></td></tr>";
  $main.="<tr><th>日</th><td><input type='text' name='day' value=$day></td></tr>";
  $main.="<tr><th>就讀學校</th><td><input type='text' name='school' value=$school></td></tr>";
  $main.="<tr><th>班級</th><td><input type='text' name='class' value=$class></td></tr>";
  $main.="<tr><th>電話</th><td><input type='text' name='phone' value=$phone></td></tr>";
  $main.="<tr><th>備註</th><td><input type='text' name='note' value=$note></td></tr>";
  $main.="<tr><th>考場編號</th><td><input type='text' name='place' value=$place></td></tr>";
  $main.="<tr><td></td><td><input type='hidden' name='sn' value=$sn></td></tr>";
  $main.="<tr><td></td><td><input type='submit' value='修改'></td></tr>";
  $main.="</table>";
  $main.="</form>";

  return $main;
}

//修改資料
function update($sn){
  global $xoopsDB;
  $sql="update `" . $xoopsDB->prefix('second_student') . "` set
  `id`    =   '{$_POST['id']}',
  `name`  =   '{$_POST['name']}',
  `sex`   =   '{$_POST['sex']}',
  `year`  =   '{$_POST['year']}',
  `month` =   '{$_POST['month']}',
  `day`   =   '{$_POST['day']}',
  `school`=   '{$_POST['school']}',
  `class` =   '{$_POST['class']}',
  `phone` =   '{$_POST['phone']}',
  `note`  =   '{$_POST['note']}'
  where sn=$sn";
  $xoopsDB->queryF($sql) or die($sql);

}

//新增學生的表單
function addForm(){
  $main="<h1>新增學生</h1>";
  $main.="<form action='list.php?op=add' method='POST'>";
  $main.="<table>";
  $main.="<tr><th>編號</th><td><input type='text' name='id'></td></tr>";
  $main.="<tr><th>姓名</th><td><input type='text' name='name'></td></tr>";
  $main.="<tr><th>性別</th><td><input type='text' name='sex'></td></tr>";
  $main.="<tr><th>年</th><td><input type='text' name='year'></td></tr>";
  $main.="<tr><th>月</th><td><input type='text' name='month'></td></tr>";
  $main.="<tr><th>日</th><td><input type='text' name='day'></td></tr>";
  $main.="<tr><th>就讀學校</th><td><input type='text' name='school'></td></tr>";
  $main.="<tr><th>班級</th><td><input type='text' name='class'></td></tr>";
  $main.="<tr><th>電話</th><td><input type='text' name='phone'></td></tr>";
  $main.="<tr><th>備註</th><td><input type='text' name='note'></td></tr>";
  $main.="<tr><th>考場編號</th><td><input type='text' name='place'></td></tr>";
  $main.="<tr><td></td><td><input type='submit' value='新增'></td></tr>";
  $main.="</table>";
  $main.="</form>";

  return $main;
}



//-----判斷區-----
$op=(empty($_REQUEST['op']))?"":$_REQUEST['op'];
$sn=(empty($_REQUEST['sn']))?"":$_REQUEST['sn'];
switch ($op)
{
  case "studentList":
  
  break;

  case "addForm":

  break;
  
  case "add":

  break;

  case "updateForm":

  break;

  case "update":

  break;

  case "del":

  del($sn);
  redirect_header("list.php", 3, "刪除成功");

  break;

  case "updateForm":

  break;

  default:
  $main = studentList();
}



//-----顯示區-----
xoops_cp_header();
loadModuleAdminMenu(2);
//style
echo "
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
//css
echo "
<style type='text/css'>
table.tftable {font-size:12px;color:#333333;width:100%;border-width: 1px;border-color: #729ea5;border-collapse: collapse;}
table.tftable th {font-size:14px;font-weight:bold;background-color:#acc8cc;border-width: 1px;padding: 8px;border-style: solid;border-color: #729ea5;text-align:center;}
table.tftable tr {background-color:#d4e3e5;}
table.tftable td {font-size:14px;border-width: 1px;padding: 8px;border-style: solid;border-color: #729ea5;}
</style>
";
echo "<h1>學生名單</h1><br>";
echo "<table id='tfhover' class='tftable'>";
echo "<tr><th>編號</th><th>姓名</th><th width='30'>性別</th><th width='80'>出生年月日</th><th>學校</th><th width='30'>班級</th><th>電話</th><th>備註</th><th width='30'>考場</th></tr>";
echo $main;
echo "</table>";
xoops_cp_footer();
?>

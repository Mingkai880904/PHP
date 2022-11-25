<?php
 $dept=str_replace("'","''",$_REQUEST['dept']);

 $db_host = "localhost";
 $db_name = "ksu_database";
 $db_table = "ksu_std_table";
 $db_user = "root";
 $db_password = "";
 
 // 連結檢測
 $conn = mysqli_connect($db_host, $db_user, $db_password);
 if(empty($conn)){
	print  mysqli_error ($conn);
    die ("無法對資料庫連線！" );
	exit;
 }  
 if(!mysqli_select_db( $conn, $db_name)){
	die("資料庫不存在!");
	exit;
 }  

 //自型設定  
 mysqli_set_charset($conn,'utf8');
      
 echo "ksu_std_table  學生於各系人數顯示如下:". "<br/><br/>"; 
 $result = mysqli_query($conn,
                        "SELECT ksu_std_name, ksu_std_grade
						 FROM ksu_std_table
						 WHERE ksu_std_department = '$dept'
						 ORDER BY ksu_std_grade");
 echo "<table border='1'>
 <tr>
   <th>學生姓名</th> <th>姓名長度</th> <th>學生成績</th> <th>備註</th>
 </tr>";
 
 //使用 mysqli_fetch_array() 取回資料庫資料
 $row_num=0;
 while($row = mysqli_fetch_array($result))
 {   
   echo "<tr>";
   echo "<td>" . $row['ksu_std_name'] . "</td>";
   echo "<td>" . strlen($row['ksu_std_name']) . "</td>";
   echo "<td>" . $row['ksu_std_grade'] . "</td>";
   
   if($row['ksu_std_grade'] < 60)
   {	echo "<td style=\"background-color:yellow\">" . "補考" . "</td>";
   }
   else
   {	echo "<td>" . "" . "</td>";
   }   
   echo "</tr>";
   $row_num = $row_num + 1;
 }
 echo "</table>";
 
 echo $row_num . " records found!"."<br/><br/>";
?> 
<form enctype="multipart/form-data"  method="post" action="ksu_select7.html">
<input type="submit" name="sub" value="返回"/>
</form>
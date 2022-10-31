<?
//config 파일 불러오기
include_once "./config.php";
?>

<?
echo "test_page";

$con = mysqli_connect($mysql_host,$mysql_name,$mysql_password,$mysql_db);
if (mysqli_error($con)){
    echo "MySQL 연결오류 : ".mysqli_error($con);
}

mysqli_set_charset($con,"utf8");

/* insert */
$insert_sql  = "
insert into `tg_member`(mb_name , mb_tel) 
VALUES ('오무개','010-0000-000');";

$res = mysqli_query($con,$insert_sql);

if($res === false){
    echo mysqli_error($con);
}
/********/

/* select */
$select_sql  = "select * from tg_member";

$res = mysqli_query($con,$select_sql);

while($row = mysqli_fetch_array($res)) {
    echo '<h2>'.$row['mb_name'].'</h2>';
    echo $row['mb_tel'];
}
/********/

/* count */
$count_query = "select * from tg_member";
$res = mysqli_query($con, $count_query);
$total_rows = mysqli_num_rows($res);

echo "<br>".$total_rows;
/********/
?>
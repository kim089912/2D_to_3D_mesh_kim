<?
//config 파일 불러오기
include_once "./config.php";
?>

<?
$con = mysqli_connect("localhost","root","654987","tiger");
if (mysqli_connect_errno()){
    echo "MySQL 연결오류 : ".mysqli_connect_errno();
}

mysqli_set_charset($con,"utf8");
?>
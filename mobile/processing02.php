<?
include "../inc/head.php";
include "../lib/connect.php";
?>

<?
$db_name = 'tg_history';
?>

<?
$dir = $_GET['dir'];
$input_output = $dir;

//Pifuhd 쉘스크립트 실행
chdir("../pifuhd");
$result = exec('sudo sh ./scripts/start.sh -i '.$input_output.' -o '.$input_output);

//3D mesh 화 성공&실패시
$is_same = './output/'.$input_output.'/'.$input_output.'_result.obj';
if($result==$is_same){

    //DB 에 지금 변환 내용 저장
    $hs_transdate = date("Y-m-d H:i:s");
    $hs_name = $_SESSION['mb_name'];
    $hs_tel = $_SESSION['mb_tel'];

    $insert_sql  = "
    insert into ".$db_name."(hs_name , hs_tel , hs_dir , hs_transdate , hs_1) 
    VALUES ('".$hs_name."','".$hs_tel."','".$dir."','".$hs_transdate."','1');";

    $res = mysqli_query($con,$insert_sql);

    if($res === false){
        echo mysqli_error($con);
        echo "<script>alert('데이터 처리 오류입니다.');</script>";
        echo "<script>location.href='./trans.php'</script>";
    }

    echo "<script>location.href='./trans02.php?dir=".$dir."'</script>";
} else {
    echo "<script>location.href='./trans03.php'</script>";
}
?>





<!--    사용한 DB TABLE CREATE 소스

    	CREATE TABLE `tg_history` (
		`hs_no` int(11) NOT NULL AUTO_INCREMENT,
		`hs_name` varchar(255) NOT NULL DEFAULT '',
		`hs_tel` varchar(255) NOT NULL DEFAULT '',
		`hs_hash` varchar(255) NOT NULL DEFAULT '',
        `hs_dir` varchar(255) NOT NULL DEFAULT '',
		`hs_transdate` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
		`hs_1` varchar(255) NOT NULL DEFAULT '',
		`hs_2` varchar(255) NOT NULL DEFAULT '',
		`hs_3` varchar(255) NOT NULL DEFAULT '',
		`hs_4` varchar(255) NOT NULL DEFAULT '',
		`hs_5` varchar(255) NOT NULL DEFAULT '',
		PRIMARY KEY (`hs_no`),
        UNIQUE KEY (`hs_dir`)
		) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8
-->
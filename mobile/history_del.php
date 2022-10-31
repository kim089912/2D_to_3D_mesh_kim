<? include "../inc/head.php"; ?>

<?
include "../lib/connect.php";
?>

<?
$db_name = 'tg_history';
?>

<?
//기본 변수 지정
$hs_name = $_SESSION['mb_name'];
$hs_tel = $_SESSION['mb_tel'];
$hs_no = $_GET['hs_no'];
$page_hs = $_GET['page'];
$sch = $_GET['sch'];

/* 본인의 데이터인지 확인 */
$where = " where hs_no = '".$hs_no."'and hs_name = '".$hs_name."'and hs_tel = '".$hs_tel."'and hs_1 = '1'";
$count_query = "select * from ".$db_name.$where;
$res = mysqli_query($con, $count_query);

$total_rows = mysqli_num_rows($res);

if($total_rows > 0){
    
    //실제로 삭제하지는 않고 hs_1 을 0 으로 변경
    $where = " where hs_no = '".$hs_no."'and hs_name = '".$hs_name."'and hs_tel = '".$hs_tel."'and hs_1 = '1'";
    $update_sql  = "
        update ".$db_name."
        set hs_1 = '0' ".$where;

    $res = mysqli_query($con,$update_sql);

    if($res === false){
        echo mysqli_error($con);
        echo "<script>alert('데이터 처리 오류입니다.');</script>";
        echo "<script>location.href='./history.php?page=".$page_hs."&sch=".$sch."'</script>";
    }

    echo "<script>location.href='./history.php?page=".$page_hs."&sch=".$sch."'</script>";

} else {
    echo "<script>alert('본인만 삭제할 수 있습니다.');</script>";
    echo "<script>location.href='./history.php'</script>";
}
?>
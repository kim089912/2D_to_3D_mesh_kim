<?
include "../lib/connect.php";
?>

<?
$db_name = 'tg_member';
?>

<?
$mb_name = $_POST['mb_gen_name'];
$mb_tel = $_POST['mb_gen_tel'];


//이름 백엔드 유효성검사
if($mb_name == ""){

    echo "<script>alert('이름을 입력해주세요');</script>";
    echo "<script>history.back();</script>";
}

//휴대폰 백엔드 유효성검사1
if($mb_tel == ""){

    echo "<script>alert('이름을 입력해주세요');</script>";
    echo "<script>history.back();</script>";
}

//휴대폰 백엔드 유효성검사2
$phonePattern_a = '/^(010)-[0-9]{3,4}-[0-9]{4}$/';
$phonePattern_b = '/^(010)[0-9]{3,4}[0-9]{4}$/';

if(!preg_match($phonePattern_a, $mb_tel, $match)&&!preg_match($phonePattern_b, $mb_tel, $match)){
    echo "<script>alert('휴대폰번호가 올바르지 않습니다.');</script>";
    echo "<script>history.back();</script>";
}

//echo "동과";

//하이픈 없이 들어온 경우 DB 조회 및 INSERT를 위해 하이픈 추가
if(!preg_match($phonePattern_a, $mb_tel, $match)){
    $mb_tel = preg_replace("/([0-9]{3})([0-9]{3,4})([0-9]{4})$/","\\1-\\2-\\3" ,$mb_tel);
}

/* 세션 저장 */
session_start();

$_SESSION['mb_name'] = $mb_name;
$_SESSION['mb_tel'] = $mb_tel;
/********* */

/* 있는 데이터인지 확인 */
$where = "where mb_name = '".$mb_name."'and mb_tel = '".$mb_tel."'";
$count_query = "select * from ".$db_name." ".$where;
$res = mysqli_query($con, $count_query);

$total_rows = mysqli_num_rows($res);

if($total_rows > 0){
    // 있는 데이터면 mb_logindate update
    $mb_logindate = date("Y-m-d H:i:s");

    $update_sql  = "
        update ".$db_name."
        set mb_logindate = '".$mb_logindate."' ".$where;

    $res = mysqli_query($con,$update_sql);

    if($res === false){
        echo mysqli_error($con);
        echo "<script>alert('데이터 처리 오류입니다.');</script>";
        echo "<script>history.back();</script>";
    }

    echo "<script>location.href='./guide.php'</script>";
}
/******************* */

/* 없는 데이터인 경우 */
if($total_rows == 0){
    // 없는 데이터면 mb_signdate , mb_logindate 와 함께 정보를 insert
    $mb_signdate = date("Y-m-d H:i:s");
    $mb_logindate = $mb_signdate;

    $insert_sql  = "
    insert into ".$db_name."(mb_name , mb_tel , mb_signdate , mb_logindate) 
    VALUES ('".$mb_name."','".$mb_tel."','".$mb_signdate."','".$mb_logindate."');";

    $res = mysqli_query($con,$insert_sql);

    if($res === false){
        echo mysqli_error($con);
        echo "<script>alert('데이터 처리 오류입니다.');</script>";
        echo "<script>history.back();</script>";
    }

    echo "<script>location.href='./guide.php'</script>";
}
/***************** */
?>
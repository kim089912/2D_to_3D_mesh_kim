
<?
/* 세션 확인 */
session_start();

if((isset($_SESSION['mb_name']))&&(isset($_SESSION['mb_tel']))){
    if($_SERVER[ "PHP_SELF" ] == "/mobile/index.php"){
        echo "<script>location.href='./guide.php'</script>";
    }
} else {
    if($_SERVER[ "PHP_SELF" ] != "/mobile/index.php"){
        echo "<script>location.href='./index.php'</script>";
    }
}
/********* */
?>
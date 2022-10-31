<? include "../inc/head.php"; ?>
<? include "../inc/top.php"; ?>

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

if($total_rows <= 0){

    echo "<script>alert('본인의 변환 결과만 볼 수 있습니다.');</script>";
    echo "<script>location.href='./history.php'</script>";
}
?>
<!-- top -->
<div class="header">
	<h1>3D 변환</h1>
</div>
<!-- con -->
<div class="page" id="transform">
	<div class="wrap">
		<!-- con -->
		<div class="transform_con">
			<?
			while($row = mysqli_fetch_array($res)) {
			?>
			<h2><?=$row['hs_dir']?>의 결과 다시보기</h2>
				<div class="rgs_group">
					<div class="line_mesh_movie">
						<?
						$dir = $row['hs_dir'];
						$input_output = $dir;
						$movie_dir = '../pifuhd/output/'.$input_output.'/'.$input_output.'_result.mp4';
						$temp_linkfile = str_replace('mms','http',$movie_dir);

						$is_ios = preg_match('/(iphone|ipod|ipad)/i', $_SERVER['HTTP_USER_AGENT']);

						//아이폰 or 안드로이드
						if($is_ios) {
							echo "<div style='text-align:center; margin-top:20px;'><video id='video' width='500' height='400' controls autoplay loop=''>";
							echo "<source src='$temp_linkfile'/>";
							echo "</video></div>";
						} else {
							echo "<video src='$temp_linkfile' id='video_player' class='video-js vjs-default-skin' controls autoplay loop='' width='100%' height='400' data-setup='{}'></video>";
						}
						?>
					</div>
					<div class="mb_mesh_download">
						<?
                        $dir = $row['hs_dir'];
                        $input_output = $dir;
                        $obj_file_dir = 'pifuhd/output/'.$input_output;
                        $obj_file_name = $input_output.'_result.obj';
                        ?>
						<a href="<?=$server_ip?>/mobile/download.php?file=<?=$obj_file_name?>&target_Dir=<?=$obj_file_dir?>" target="_blank">3D mesh 다운로드</a>
					</div>
					<p>mesh 파일은 OBJ 형식입니다.</p>
				</div>
				<div class="history_btn">
					<a href="history.php?page=<?=$page_hs?>&sch=<?=$sch?>">목록</a>
					<a href="history_del.php?page=<?=$page_hs?>&hs_no=<?=$row['hs_no']?>&sch=<?=$sch?>" 
					onclick="return confirm('정말로 삭제하시겠습니까 ?');">삭제</a>
				</div>
			<?
			}
			?>
		</div>
		<!-- con -->
	</div>
</div>

<? include "../inc/footer.php"; ?>
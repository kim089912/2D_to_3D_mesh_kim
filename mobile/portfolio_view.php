<? include "../inc/head.php"; ?>
<? include "../inc/top.php"; ?>

<?
include "../lib/connect.php";
?>

<?
$db_name = 'tg_portfolio';
?>

<?
//기본 변수 지정
$pf_no = $_GET['pf_no'];

/* 데이터 확인 */
$where = " where pf_no = '".$pf_no."'";
$count_query = "select * from ".$db_name.$where;
$res = mysqli_query($con, $count_query);

$total_rows = mysqli_num_rows($res);

if($total_rows <= 0){

    echo "<script>alert('데이터 출력 오류입니다.');</script>";
    echo "<script>location.href='./portfolio.php'</script>";
}
?>
<!-- top -->
<div class="header">
	<h1>3D 포트폴리오</h1>
</div>
<!-- con -->
<div class="page" id="transform">
	<div class="wrap">
		<!-- con -->
		<div class="transform_con">
            <?
			while($row = mysqli_fetch_array($res)) {
			?>
			<h2><?=$row['pf_1']?> 상세 보기</h2>
				<div class="rgs_group">
					<div class="line_mesh_movie">
						<?
						$source_name = $row['pf_source'];
						$input_output = $source_name;
						$obj_file_dir = 'img/data';
						$obj_file_name = $source_name.".obj";
						$movie_dir = '../img/data/'.$source_name.'.mp4';
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
						<a href="<?=$server_ip?>/mobile/download.php?file=<?=$obj_file_name?>&target_Dir=<?=$obj_file_dir?>" target="_blank">3D mesh 다운로드</a>
					</div>
					<p>mesh 파일은 OBJ 형식입니다.</p>
				</div>
				<div class="history_btn">
					<a href="portfolio.php">목록</a>
				</div>
			<?
			}
			?>
		</div>
		<!-- con -->
	</div>
</div>
<!-- con -->

<? include "../inc/footer.php"; ?>
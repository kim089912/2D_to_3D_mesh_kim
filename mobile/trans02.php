<? include "../inc/head.php"; ?>
<? include "../inc/top.php"; ?>

<?
$dir = $_GET['dir'];
$input_output = $dir;
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
			<h2>3D mesh화를 완료했습니다.</h2>
			<div class="rgs_group">
				<div class="line_mesh_movie">
					<?
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
					$obj_file_dir = 'pifuhd/output/'.$input_output;
					$obj_file_name = $input_output.'_result.obj';
					?>
					<a href="<?=$server_ip?>/mobile/download.php?file=<?=$obj_file_name?>&target_Dir=<?=$obj_file_dir?>" target="_blank">3D mesh 다운로드</a>
				</div>
				<p>mesh 파일은 OBJ 형식입니다.</p>
				<!-- https://github.com/facebookresearch/pifuhd/issues/72 -->
				<!--
				<div class="mesh_btn">
					<a href="trans.php">이미지 재선택</a>
					<a href="trans03.php">종료</a>
				</div>
				-->
		</div>
		<!-- con -->
		<div class="history_btn">
			<a href="trans.php">이미지 재선택</a>
		</div>
	</div>
</div>
<!-- con -->

<? include "../inc/footer.php"; ?>
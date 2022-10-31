<? include "../inc/head.php"; ?>
<? include "../inc/top.php"; ?>

<?
$mb_file_name = $_FILES['mb_gen_file']['name'];

//파일명에 특수문자 제거 (업로드에 문제 생김 종종)
$mb_file_name = str_replace(array("#", "'", ";","[","]","(",")","*"), '', $mb_file_name);

//파일 존재 백엔드 유효성검사
if($mb_file_name == ""){

    echo "<script>alert('jpg/png 이미지 파일을 첨부해야 합니다');</script>";
    echo "<script>location.href='./trans.php'</script>";	
}

//파일 png 확인 유효성 검사
$fp = fopen($_FILES["mb_gen_file"]["tmp_name"], "r");
$image_stream = fread($fp, 64);
if (!preg_match( '/^\x89PNG\x0d\x0a\x1a\x0a/', $image_stream)&&!preg_match( '/^\xff\xd8/', $image_stream)){
    echo "<script>alert('jpg/png 이미지 파일만 업로드 가능합니다');</script>";
    echo "<script>location.href='./trans.php'</script>";	
}

//이미지 파일 담을 디렉토리와 파일명 변수 지정
if(preg_match( '/^\x89PNG\x0d\x0a\x1a\x0a/', $image_stream)){
	$file_type = "png";
	$base_name = basename($mb_file_name,".png");
} else if(preg_match( '/^\xff\xd8/', $image_stream)){
	$file_type = "jpg";
	$base_name = basename($mb_file_name,".jpg");
}

$ndate = date("Y-m-d_H-i-s");
$save_front_directory = "../pifuhd/input/";
$save_back_directory = $base_name."_".$ndate."/";
if($file_type == 'png'){
	$save_file_name = $base_name."_".$ndate.".png";
} else if($file_type == 'jpg'){
	$save_file_name = $base_name."_".$ndate.".jpg";
}
$target_file = $save_front_directory.$save_back_directory.'origin/'.$save_file_name;
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
			<h2>3D 변환 중입니다...</h2>
			<p>약 30초 정도가 소요됩니다.<br>요청이 많은 경우 시간이 더 소요될 수 있습니다.</p>
			<style>
				.progress_bar{
					text-align: center;
				}
				.progressing_img{
					text-align: center;
					margin-top: 35px;
				}				
			</style>
			<div class="progress_bar">
				<progress value="0" max="100"></progress><br><b>10%</b><br><br><p style="color:#969696;"><span id="processing_now"></span><span id="dotted"></span></p>
			</div>
			<div class="progressing_img">
				<img src="../img/progressing.gif"/>
			</div>
			<!-- 프로그레스 바용 소스 코드 -->
			<?
			$i_dir = $save_front_directory.$save_back_directory;
			$o_dir = "../pifuhd/output/".$save_back_directory;

			//키포인트 제이슨, 결과png , 결과obj , 결과mp4 를 조회하는 변수지정
			$key_json = $i_dir.$base_name."_".$ndate.'_keypoints.json';
			$result_img = $o_dir.$base_name."_".$ndate.'_result.png'; //pifuhd 는 항상 result img 를 png 형식으로 냄
			$result_obj = $o_dir.$base_name."_".$ndate.'_result.obj';
			$result_mp4 = $o_dir.$base_name."_".$ndate.'_result.mp4';

			?>
			<script>
				// 현재 프로그레스바 수치 변수
				cnt = 0;
				// 멈춤 변수
				stopCheck = false;

				//4종 파일이 조회되었는지 변수 지정
				$check_key_json = 0;
				$check_result_img = 0;
				$check_result_obj = 0;
				$check_result_mp4 = 0;

				//4종 파일이 존재할 경우 프로그레스바 퍼센트 변수 지정
				$check_key_json_bar = 7;
				$check_result_img_bar = 25;
				$check_result_obj_bar = 85;
				$check_result_mp4_bar = 100;
				
				// ... 변수 초기화
				$("#dotted").text(".");

				var roof_1 = setInterval(function(){
					if(stopCheck == false) {
						
						if($("#dotted").text()=="."){
							$("#dotted").text("..");
						} else if($("#dotted").text()==".."){
							$("#dotted").text("...");
						} else if($("#dotted").text()=="..."){
							$("#dotted").text("....");
						} else if($("#dotted").text()=="...."){
							$("#dotted").text(".....");
						} else if($("#dotted").text()=="....."){
							$("#dotted").text(".");
						}
					}
				},500);

				var roof_1 = setInterval(function(){
					if(stopCheck == false) {
						
						//지정한 4종 프레그레스바 변수가 해당 파일이 없는 경우 프로그레스바 수치가 초과하지 않도록 함
						if(($check_key_json == 0)&&(cnt>=$check_key_json_bar)){
							cnt = $check_key_json_bar;
						}
						if(($check_result_img == 0)&&(cnt>=$check_result_img_bar)){
							cnt = $check_result_img_bar;
						}
						if(($check_result_obj == 0)&&(cnt>=$check_result_obj_bar)){
							cnt = $check_result_obj_bar;
						}
						if(($check_result_mp4 == 0)&&(cnt>=$check_result_mp4_bar)){
							cnt = $check_result_mp4_bar;
						}

						//정한 시간길이마다 프로그레스바 수치가 증가하도록 함
						document.getElementsByTagName('progress')[0].value = cnt;
						document.getElementsByTagName('b')[0].innerText = cnt + '%';
						cnt = (cnt + 0.1)*10;
						cnt = Math.round(cnt) / 10;
						if (cnt > 100) {
							stopCheck = true;
							$("#dotted").text("");
						}
					}
					
					//key_json 확인
					if($check_key_json==0){
						$.ajax({
							url:'<?=$key_json?>',
							type:'HEAD',
							error: function()
							{
								$("#processing_now").text("이미지에서 사람 인식, 배경 제거, 이미지 자동 회전 중");
							},
							success: function()
							{
								document.getElementsByTagName('progress')[0].value = $check_key_json_bar;
								document.getElementsByTagName('b')[0].innerText = $check_key_json_bar + '%';
								cnt = $check_key_json_bar;
								$check_key_json = 1;
								
							}
						});
					}

					//result_img 확인
					if($check_key_json==1&&$check_result_img==0){
						$.ajax({
							url:'<?=$result_img?>',
							type:'HEAD',
							error: function()
							{
								$("#processing_now").text("전면,후면 그래픽이미지 생성 중");
							},
							success: function()
							{
								document.getElementsByTagName('progress')[0].value = $check_result_img_bar;
								document.getElementsByTagName('b')[0].innerText = $check_result_img_bar + '%';
								cnt = $check_result_img_bar;
								$check_result_img = 1;
								
							}
						});
					}

					//check_result_obj 확인
					if($check_key_json==1&&$check_result_img==1&&$check_result_obj==0){
						$.ajax({
							url:'<?=$result_obj?>',
							type:'HEAD',
							error: function()
							{
								$("#processing_now").text("3D Mesh 화 중");
							},
							success: function()
							{
								document.getElementsByTagName('progress')[0].value = $check_result_obj_bar;
								document.getElementsByTagName('b')[0].innerText = $check_result_obj_bar + '%';
								cnt = $check_result_obj_bar;
								$check_result_obj = 1;
								
							}
						});
					}


					//check_result_mp4 확인
					if($check_key_json==1&&$check_result_img==1&&$check_result_obj==1&&$check_result_mp4==0){
						$.ajax({
							url:'<?=$result_mp4?>',
							type:'HEAD',
							error: function()
							{
								$("#processing_now").text("렌더링 영상처리 중");
							},
							success: function()
							{
								document.getElementsByTagName('progress')[0].value = $check_result_mp4_bar;
								document.getElementsByTagName('b')[0].innerText = $check_result_mp4_bar + '%';
								cnt = $check_result_mp4_bar;
								$check_result_mp4 = 1;
								$("#processing_now").text("완료 되었습니다.");
							}
						});
					}
				},50);
			</script>
		</div>
		<!-- con -->
	</div>
</div>

<? include "../inc/footer.php"; ?>

<!-- 페이지부터 띄우고 프로세싱이 시작되어야 html 뷰단을 볼 수 있다 
(아래에서 location href 때문에 이 코드들이 상단에 있으면 위의 html 뷰를 볼 수 없음)-->
<?

//이미지 파일 담을 디렉토리 생성
$makeDir = mkdir($save_front_directory.$save_back_directory, '777');
$shell_code = 'sudo chmod 777 '.$save_front_directory.$save_back_directory;
echo shell_exec($shell_code);

//이미지 파일 담을 origin 디렉토리 생성
$makeDir = mkdir($save_front_directory.$save_back_directory.'/origin', '777');
$shell_code = 'sudo chmod 777 '.$save_front_directory.$save_back_directory.'/origin';
echo shell_exec($shell_code);

if(!$makeDir){
	echo "<script>alert('이미지 파일 폴더 생성에 오류가 있습니다.');</script>";
    echo "<script>location.href='./trans.php'</script>";	
}

//이미지 파일 업로드
if (move_uploaded_file($_FILES["mb_gen_file"]["tmp_name"], $target_file)) {
	$target_file = $save_front_directory.$save_back_directory.$save_file_name;
	?>
	<script>
		<?
		if($file_type == 'png'){
		
			//배경제거와 이미지자동회전
			$shell_code = 'sh ../pifuhd/bg_remove_and_auto_rotate/rmbg_rotate.sh -n '.basename($save_file_name,".png").' -t png';
			$result = exec($shell_code);

			if(!$result){
				echo "alert('이미지 파일 변환에 오류가 있습니다.');";
    			echo "location.href='./trans.php'";
			} else if($result){
			?>

			location.href='./processing02.php?dir=<?=basename($save_file_name,".png");?>';
		<?
			}
		} else if($file_type == 'jpg'){

			//배경제거와 이미지자동회전
			$shell_code = 'sh ../pifuhd/bg_remove_and_auto_rotate/rmbg_rotate.sh -n '.basename($save_file_name,".jpg").' -t jpg';
			$result = exec($shell_code);

			if(!$result){
				echo "alert('이미지 파일 변환에 오류가 있습니다.');";
    			echo "location.href='./trans.php'";
			} else if($result) {
			?>

			location.href='./processing02.php?dir=<?=basename($save_file_name,".jpg");?>';
		<?
			}
		}
		?>
	</script>
	<?
} else {
	echo "<script>alert('이미지 파일 업로드에 오류가 있습니다. <br>이미지 이름에 특수문자가 없도록 해주세요.');</script>";
    echo "<script>location.href='./trans.php'</script>";	
}

?>
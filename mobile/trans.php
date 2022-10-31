<? include "../inc/head.php"; ?>
<? include "../inc/top.php"; ?>
<!-- top -->
<div class="header">
	<h1>3D 변환</h1>
</div>
<!-- con -->
<div class="page" id="transform">
	<div class="wrap">
		<!-- con -->
		<div class="transform_con">
			<h2>2D 이미지를 넣어주세요.</h2>
			<p>이미지는 JPG/PNG형식이어야 합니다.</p>
			<form name="" id="" action="./processing.php" method="post" enctype="multipart/form-data" onsubmit="return check_file()">
				<div class="rgs_group">
                            <div class="mb_gen_file">
                                <label for="">파일선택</label>
                                <input type="file" name="mb_gen_file" id="mb_gen_file" accept=".png, .jpg, .PNG, .JPG" onchange="showimg(this);">
                            </div>
							<div class="line_input_img">
                                <img src="" id="trans_preview" alt="" style="border: #737373 1px solid;">
                            </div>
							<div class="line_input_detel">
                                <input type="button" onclick="img_delete();" value="이미지 삭제">
                            </div>
				</div>
				<!-- 이미지 미리보기 스크립트 -->
				<script>
					function showimg(input) {
						if (input.files && input.files[0]) {
							var reader = new FileReader();
							reader.onload = function(e) {
							document.getElementById('trans_preview').src = e.target.result;
							};
							reader.readAsDataURL(input.files[0]);
						} else {
							document.getElementById('trans_preview').src = "";
						}
					}

					function img_delete(){
    					$('#mb_gen_file').val("");
						$("#trans_preview").attr("src","");
					}
				</script>
				<!---------------------------->
				<!-- 이미지 유효성 검사 스크립트-->
				<script>
					function check_file(){
						var imgFile = $('#mb_gen_file').val();
						var fileForm = /(.*?)\.(jpg|png|JPG|PNG)$/;
						
						// 파일이 비었는지 유효성 검사
						if($('#mb_gen_file').val() == "") {
							alert("jpg/png 이미지 파일을 첨부해야 합니다");
							$("#mb_gen_file").focus();
							return false;
						}
						
						// 파일이 png 인지 유효성 검사
						if(imgFile != "" && imgFile != null) {
							
							if(!imgFile.match(fileForm)) {
								alert("jpg/png 이미지 파일만 업로드 가능합니다");
								return false;
							}
						}

						return true;
					}
				</script>
				<div class="privacy_btn">
					<input type="submit" value="3D 변환" style="cursor:pointer">
				</div>
			</form>
		</div>
		<!-- con -->
	</div>
</div>

<? include "../inc/footer.php"; ?>
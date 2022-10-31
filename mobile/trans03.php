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
			<h2>3D mesh화 변환에 오류가 발생했습니다.</h2>
			<p class="transform_txt">※ 아래를 확인해주세요</p>
			<div class="rgs_group">
                     <ul>
					 <li>이미지 파일 형식은 JPG/PNG 이어야 합니다.</li>
					 <li>3D mesh 화 중 네트워크 연결 상태를 확인해주세요.</li>
					 <li>여러명의 사람이 있는 이미지가 아닌지 확인해주세요.</li>
					 <li>사람과 배경의 경계선이 모호한 경우 배경을 제거해야할 수도 있습니다.</li>
					 </ul>
				</div>
				<div class="mesh_btn">
					<a href="trans.php">이미지 재선택</a>
					<!--<a href="trans.php">종료</a>-->
				</div>
		</div>
		<!-- con -->
	</div>
</div>

<? include "../inc/footer.php"; ?>
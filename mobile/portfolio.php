<? include "../inc/head.php"; ?>
<? include "../inc/top.php"; ?>
<?
//참고 db sql
//INSERT INTO `tg_portfolio`(`pf_source`) VALUES ('09_model-image_01_result');
include "../lib/connect.php";
?>
<?
$db_name = "tg_portfolio";
?>
<?
$many = 12;

/* db 에서 img src 가져오기 */
$select_sql  = "select pf_no , pf_source , pf_1 from ".$db_name." ORDER by pf_no DESC LIMIT ".$many;

$res = mysqli_query($con,$select_sql);
/************************ */
?>
<!-- top -->
<div class="header">
	<h1>3D 포트폴리오</h1>
</div>
<!-- con -->
<div class="page" id="portfolio">
	<div class="wrap">
		<!-- con -->
		<div class="portfolio_con">
			<p class="port_txt">
				사진을 클릭하시면 상세 내용을 볼 수 있습니다.
			</p>
			<!-- 페이지용 일단은 주석처리
			<p class="port_txt">
				총 15건 페이지 1/2
			</p>
			-->
			<ul>
				<?
				$img_dir = "../img/data/";
				for($i = 1; $row = mysqli_fetch_array($res); $i++) {
				?>
				<li>
					<a href="portfolio_view.php?pf_no=<?=$row['pf_no']?>">
						<img src="<?=$img_dir.$row['pf_source']?>" alt="">
						<p><?=$row['pf_1']?></p>
					</a>
				</li>
				<?
				}
				?>
			</ul>
			<!-- paging 일단은 주석 처리 -->
			<!--
			<div id="pagination" class="pagination">
			  <nav>
				<ul class="pagination">
				  <li class="page-item"><span class="page-link">&lt;</span></li>
				  <li class="page-item active"><span class="page-link">1</span></li>
				  <li class="page-item"><a class="page-link" href="">2</a></li>
				  <li class="page-item"><a class="page-link" href="" rel="next" aria-label="Next »">&gt;</a></li>
				</ul>
			  </nav>
			</div>
			-->
			<!-- paging -->
		</div>
		<!-- con -->
	</div>
</div>

<? include "../inc/footer.php"; ?>



<!-- DB 테이블 생성 소스 
	CREATE TABLE `tg_portfolio` (
	`pf_no` int(11) NOT NULL AUTO_INCREMENT,
	`pf_source` varchar(255) NOT NULL DEFAULT '',
	`pf_1` varchar(255) NOT NULL DEFAULT '',
	`pf_2` varchar(255) NOT NULL DEFAULT '',
	`pf_3` varchar(255) NOT NULL DEFAULT '',
	`pf_4` varchar(255) NOT NULL DEFAULT '',
	`pf_5` varchar(255) NOT NULL DEFAULT '',
	PRIMARY KEY (`pf_no`),
	UNIQUE KEY (`pf_source`)
	) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;
-->
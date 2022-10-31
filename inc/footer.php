</div>


<div id="navi-area">
	<div class="m_action_bar">
		<ul class="action_icon_list">
			<li class="active guide_li">
				<a href="../mobile/guide.php" class="guide_a"><img src="../img/bottom_icon01.png" class="off" alt=""><img src="../img/bottom_icon01_on.png" class="on" alt=""><span>가이드</span></a>
			</li>
			<li class="trans_li">
				<a href="../mobile/trans.php" class="trans_a"><img src="../img/bottom_icon03.png" class="off" alt=""><img src="../img/bottom_icon03_on.png" class="on" alt=""><span>3D변환</span></a>
			</li>
			<li class="portfolio_li">
				<a href="../mobile/portfolio.php" class="portfolio_a"><img src="../img/bottom_icon02.png" class="off" alt=""><img src="../img/bottom_icon02_on.png" class="on" alt=""><span>3D포트폴리오</span></a>
			</li>
			<li class="history_li">
				<a href="../mobile/history.php" class="history_a"><img src="../img/bottom_icon04.png" class="off" alt=""><img src="../img/bottom_icon04_on.png" class="on" alt=""><span>히스토리</span></a>
			</li>
		</ul>
		<!-- 메뉴 클릭시 해당 페이지의 메뉴가 불들어오는 것 처리 -->
		<?
		$location = $_SERVER[ "PHP_SELF" ];
		?>
		<script>
			$(function(){
				function shot_down(){
					$(".action_icon_list li").removeClass('active');
					$(".action_icon_list a img:nth-child(1)").attr('class','off');
					$(".action_icon_list a img:nth-child(2)").attr('class','on');
				}
				if("<?=$location?>" == "/mobile/guide.php"){
					shot_down();
					$(".guide_li").addClass('active');
					$(".guide_a img:nth-child(0)").attr('class','on');
					$(".guide_a img:nth-child(1)").attr('class','off');
				}
				if(("<?=$location?>" == "/mobile/portfolio.php")||("<?=$location?>" == "/mobile/portfolio_view.php")){
					shot_down();
					$(".portfolio_li").addClass('active');
					$(".portfolio_a img:nth-child(0)").attr('class','on');
					$(".portfolio_a img:nth-child(1)").attr('class','off');
				}
				if(("<?=$location?>" == "/mobile/processing.php")||("<?=$location?>" == "/mobile/processing02.php")||("<?=$location?>" == "/mobile/trans.php")||("<?=$location?>" == "/mobile/trans02.php")||("<?=$location?>" == "/mobile/trans03.php")){
					shot_down();
					$(".trans_li").addClass('active');
					$(".trans_a img:nth-child(0)").attr('class','on');
					$(".trans_a img:nth-child(1)").attr('class','off');
				}
				if(("<?=$location?>" == "/mobile/history.php")||("<?=$location?>" == "/mobile/history_view.php")){
					shot_down();
					$(".history_li").addClass('active');
					$(".history_a img:nth-child(0)").attr('class','on');
					$(".history_a img:nth-child(1)").attr('class','off');
				}
			});
		</script>
		<!----------------------------------------------------->
	</div>
</div>


</body>
</html>
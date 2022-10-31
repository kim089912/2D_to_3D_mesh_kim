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

//검색어를 쿼리스트링으로 받았는지
$sch = "";
if(isset($_GET['sch'])){
	$sch = $_GET['sch'];
}

//where 절 지정
$where = " where hs_name = '".$hs_name."'and hs_tel = '".$hs_tel."'and hs_1 = '1' and SUBSTRING_INDEX(hs_dir,right(hs_dir,20), 1) like '%".$sch."%'";

//order by 절 지정
$order = " order by hs_transdate desc";

//페이징할 히스토리 갯수
$default_page_hs = 5;

//총 히스토리 수 구하기
$count_query = "select * from ".$db_name.$where;
$res = mysqli_query($con, $count_query);
$total_hs = mysqli_num_rows($res);

//총 페이지 수 구하기
$total_page_hs = sprintf('%d', $total_hs / $default_page_hs);
if($total_hs%$default_page_hs){
	$total_page_hs++;
}

//페이지를 쿼리스트링으로 받았는지
$page_hs = 1;
if(isset($_GET['page'])){
	$page_hs = $_GET['page'];
}

//리미트 변수구하기
$f_limit = ($page_hs-1)*5;
$b_limit = $default_page_hs;

//limit 절 지정
$limit = " limit ".$f_limit.",".$b_limit;

//쿼리 날리기
$select_sql  = "select hs_no , hs_dir , hs_transdate from ".$db_name.$where.$order.$limit;
$res = mysqli_query($con,$select_sql);
?>

<script>
function data_chk(){

    //검색어 유효성 검사
    if($("#query").val() == ""){
        alert("검색어를 입력해주세요");
        $("#query").focus();
        return false;
    }

    return true;
}
</script>

<!-- top -->
<div class="header">
	<h1>3D변환 히스토리</h1>
</div>
<!-- con -->
<div class="page" id="history">
	<div class="wrap">
		<!-- con -->
		<div class="history_con">
			<div class="board_search_box">
				<form name="searchform" action="<?=$_SERVER['PHP_SELF']?>" method="get" onsubmit="return sch_chk()">
					<label class="blind" for="searchWord">검색어 입력</label>
					<input id="query" type="text" class="txt_search" name="sch" placeholder="검색어 입력" value="" maxlength="255">
					<button type="submit" class="btn_search">검색</button>
				</form>
			</div>
			<ul>
				<?
				while($row = mysqli_fetch_array($res)) {
					$image_src = "../pifuhd/input/".$row['hs_dir']."/origin"."/".$row['hs_dir'];
					$file_name = substr($row['hs_dir'],0,-20);
				?>
					<li>
						<div class="his_con">
							<img src="<?=$image_src?>" alt="">
							<div class="his_li_con">
								<h3><?=$file_name?></h3>
								<p>변환일자: <?=$row['hs_transdate']?></p>
								<div class="his_li_btn">
									<a href="history_view.php?page=<?=$page_hs?>&hs_no=<?=$row['hs_no']?>&sch=<?=$sch?>">결과보기</a> 
									<a href="history_del.php?page=<?=$page_hs?>&hs_no=<?=$row['hs_no']?>&sch=<?=$sch?>" 
									onclick="return confirm('정말로 삭제하시겠습니까 ?');">삭제</a>
								</div> 
							</div>
						</div>
					</li>
				<?
				}
				?>		
			</ul>
			<!-- paging -->
			<div id="pagination" class="pagination">
			  <nav>
				<ul class="pagination">
				  <li class="page-item"><span class="page-link">&lt;</span></li>
				  <?
					for ($i = 1; $i <= $total_page_hs; $i++){
					?>
						<li class="page-item cr_page_<?=$i?>"><a class="page-link" href="./history.php?page=<?=$i?>&sch=<?=$sch?>"><?=$i?></a></li>
					<?
					}
					?>
					<script>
						$(function(){
							$(".cr_page_<?=$page_hs?>").addClass("active");
						});
					</script>
				  <li class="page-item"><a class="page-link" href="" rel="next" aria-label="Next »">&gt;</a></li>
				</ul>
			  </nav>
			</div>
			<!-- paging -->
		</div>
		<!-- con -->
	</div>
</div>

<? include "../inc/footer.php"; ?>
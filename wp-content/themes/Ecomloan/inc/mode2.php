<?php 
$lang = "zh-cn";  //get_bloginfo('language');
if( $lang == "zh-TW" ) {
	$title1 = "查看貸款利率";
	$title2 = "查詢貸款產品";
	$title3 = "在線申請貸款";
	$desc1 = "查詢萬通當前利息, 找到符合您條件的最佳产品";
	$desc2 = "了解萬通的貸款產品，多種貸款方式任您選擇";
	$desc3 = "您可以在線申請貸款，我們為您解答任何疑問";
} elseif( $lang == "en-US" ) {
	$title1 = "ECOM Today's Rates";
	$title2 = "ECOM Loan Programs";
	$title3 = "Apply Loan online";
	$desc1 ="Check ECOM Today's Rates, find the best loan that you are qualified to";
	$desc2 ="Check out our loan programs, we offer various of programs to meet your needs";
	$desc3 ="Apply for your loan online, we will help you with any problem you have";
} else{
	$title1 = "查看贷款利率";
	$title2 = "查询贷款产品";
	$title3 = "在线申请贷款";
	$desc1 = "利息瞬息万变，您可以查询万通当前利息及每日利率，可以输入您的条件进行查询，欢迎和同行比价";
	$desc2 = "您可以在线申请贷款，我们为您解答任何疑问";
	$desc3 = "了解万通的贷款产品，多种贷款方式任您选择";
} ?>
<div class="news">
	<div class="container">
		<div class="col-lg-4">
			<div class="news-list">
				<a class="news-img" href="#"><img src="<?php bloginfo('template_url');?>/img/a.jpg"/></a>
				<div class="news-info">
					<h2><a href="#"><?php echo $title1; ?></a></h2>
					<p><?php echo $desc1; ?></p>
				</div>
			</div>
		</div>
		<div class="col-lg-4">
			<div class="news-list">
				<a class="news-img" href="#"><img src="<?php bloginfo('template_url');?>/img/b.jpg"/></a>
				<div class="news-info">
					<h2><a href="#"><?php echo $title3; ?></a></h2>
					<p><?php echo $desc2; ?></p>
				</div>
			</div>
		</div>
		<div class="col-lg-4">
			<div class="news-list">
				<a class="news-img" href="#"><img src="<?php bloginfo('template_url');?>/img/c.jpg"/></a>
				<div class="news-info">
					<h2><a href="#"><?php echo $title2; ?></a></h2>
					<p><?php echo $desc3; ?></p>
				</div>
			</div>
		</div>
	</div>
</div>
<?php $lang = get_bloginfo('language'); ?>

<div class="footer">
	<div class="footer-content">
		<div class="container">
		   <div class="footer-item-s col-lg-1"><a alt="lendinghouse" href="http://www.hud.gov/" target="_blank"><img src="<?php bloginfo('template_url');?>/img/lending_logo.gif"/></a></div>
		    <div class="footer-nav col-lg-11">
				<ul>
					<li><a id="LOLogin" class="topmenu" href="wp-login">LO Login</a></li>
					<?php echo strip_tags(wp_nav_menu( array( 'container' => false,'items_wrap' => '%3$s','depth' => 1,'theme_location' =>'footer')), '<li><a>' ); ?>
				</ul>
				<div class="footer_sel">
					<select id="familyUrls" name="family" onchange="if(this.value) window.open(this.value);" class="footer-dropdown">
						<option value="#"><?php if( $lang == "zh-TW" ) {echo "萬通其他網站";} elseif( $lang == "en-US" ) {echo "Family Website";} else {echo "万通其他网站";} ?></option>
						<option value="http://www.ecommtg.com/"><?php if( $lang == "zh-TW" ) {echo "萬通Wholesale";} elseif( $lang == "en-US" ) {echo "ECOM Wholesale";} else {echo "万通Wholesale";} ?></option>
						<option value="http://www.ecomcorrespondent.com/"><?php if( $lang == "zh-TW" ) {echo "萬通Correspondent";} elseif( $lang == "en-US" ) {echo "ECOM Correspondent";} else {echo "万通Correspondent";} ?></option>
						<option value="http://www.ecomescrowinc.com/"><?php if( $lang == "zh-TW" ) {echo "萬通公證";} elseif( $lang == "en-US" ) {echo "ECOM Escrow";} else {echo "万通公证";} ?></option>
						<option value="http://www.kysonco.com/"><?php if( $lang == "zh-TW" ) {echo "萬通證券";} elseif( $lang == "en-US" ) {echo "ECOM Kyson Co.";} else {echo "万通证券";} ?></option>
					</select>
				</div>
            </div>
            <?php if( $lang == "zh-TW" ) { ?>
		    <div class="footer-item col-lg-5"><p><b>Covina 辦公室:</b><br>10号高速 E. Holt Ave.出口<br>1055 Park View Drive #355, Covina, CA 91724<br>T. (626) 678-9000 | F. (626) 678-9081</p></div>
		   <div class="footer-item col-lg-5"><p><b>San Gabriel 辦公室:</b><br>聖蓋博希爾頓酒店一樓<br>225 West Valley Blvd, Suite # H-133, San Gabriel, CA 91776<br>T. (626) 678-9076 | F. (626) 678-9081</p></div>
            <?php } elseif( $lang == "en-US" ) { ?>
		    <div class="footer-item col-lg-5"><p><b>Covina Office:</b><br>10 Freeway E. Holt Ave. Exit<br>1055 Park View Drive #355, Covina, CA 91724<br>T. (626) 678-9000 | F. (626) 678-9081</p></div>
		   <div class="footer-item col-lg-5"><p><b>San Gabriel Office:</b><br>San Gabriel Hiltion Hotel Plaza<br>225 West Valley Blvd, Suite # H-133, San Gabriel, CA 91776<br>T. (626) 678-9076 | F. (626) 678-9081</p></div>
            <?php } else { ?> 
		    <div class="footer-item col-lg-5"><p><b>Covina 办公室:</b><br>10号高速 E. Holt Ave.出口<br>1055 Park View Drive #355, Covina, CA 91724<br>T. (626) 678-9000 | F. (626) 678-9081</p></div>
		   <div class="footer-item col-lg-5"><p><b>San Gabriel 办公室:</b><br>圣盖博希尔顿酒店一楼<br>225 West Valley Blvd, Suite # H-133, San Gabriel, CA 91776<br>T. (626) 678-9076 | F. (626) 678-9081</p></div>
		   <?php } ?>
		</div>
	</div>
   <div class="copyright"><div class="container"><p>Copyright © 2016 Home Loan Mortgage Company All Rights Reserved. NMLS:315655&nbsp;&nbsp;RE.License:01291043</p></div></div>
</div>

<?php 
include('inc/mode5.php'); //资料
wp_footer(); ?>
</body>

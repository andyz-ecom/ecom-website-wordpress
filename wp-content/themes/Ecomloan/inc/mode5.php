<?php $lang = get_bloginfo('language'); ?>

<div class="consoult_form_container" style="right: -340px;">
<div class="consult_form_button"><span><?php if( $lang == "zh-TW" ) {echo "咨詢萬通";} elseif( $lang == "en-US" ) {echo "Consult ECOM";} else {echo "咨询万通";} ?></span>
</div>
<div class="consult_form">
<table class="consult_form_table">
<tbody><tr><td>&nbsp;</td></tr>
<tr><td><?php if( $lang == "zh-TW" ) {echo "您需要貸款用來？";} elseif( $lang == "en-US" ) {echo "Mortgage Goal?";} else {echo "您需要贷款用来？";} ?></td></tr>
<tr><td><select name="LoanPurposeDropdown" id="LoanPurposeDropdown" class="input_dropdown">
<option value="Purchase"><?php if( $lang == "zh-TW" ) {echo "購買新房";} elseif( $lang == "en-US" ) {echo "Purchase";} else {echo "购买新房";} ?></option>
<option value="Refinance with no Cash-out"><?php if( $lang == "zh-TW" ) {echo "重新貸款";} elseif( $lang == "en-US" ) {echo "Refinance with no Cash-out";} else {echo "重新贷款";} ?></option>
<option value="Refinance with Cash-out"><?php if( $lang == "zh-TW" ) {echo "重貸提現";} elseif( $lang == "en-US" ) {echo "Refinance with Cash-out";} else {echo "重贷提现";} ?></option>
</select></td></tr>
<tr><td><?php if( $lang == "zh-TW" ) {echo "您大概需要貸款的金額?";} elseif( $lang == "en-US" ) {echo "Estimated Mortgage Amount?";} else {echo "您大概需要贷款的金额?";} ?></td></tr>
<tr><td><input name="MortgageAmtText" id="MortgageAmtText" type="text"></td></tr>
<tr><td><?php if( $lang == "zh-TW" ) {echo "名字";} elseif( $lang == "en-US" ) {echo "First Name";} else {echo "名字";} ?></td></tr>
<tr><td><input name="FirstNameText" id="FirstNameText" type="text"></td></tr>
<tr><td><?php if( $lang == "zh-TW" ) {echo "姓氏";} elseif( $lang == "en-US" ) {echo "Last Name";} else {echo "姓氏";} ?></td></tr>
<tr><td><input name="LastNameText" id="LastNameText" type="text"></td></tr>
<tr><td><?php if( $lang == "zh-TW" ) {echo "州/省";} elseif( $lang == "en-US" ) {echo "State";} else {echo "州/省";} ?></td></tr>
<tr><td><select><option>California</option></select></td></tr>
<tr><td><?php if( $lang == "zh-TW" ) {echo "電話";} elseif( $lang == "en-US" ) {echo "Phone";} else {echo "电话";} ?></td></tr>
<tr><td><input name="PhoneNumText" id="PhoneNumText" type="text"></td></tr>
<tr><td><?php if( $lang == "zh-TW" ) {echo "電子郵件";} elseif( $lang == "en-US" ) {echo "Email";} else {echo "电子邮件";} ?></td></tr>
<tr><td><input name="EmailText" id="EmailText" type="text"></td></tr>
<tr><td><?php if( $lang == "zh-TW" ) {echo "貸款問題";} elseif( $lang == "en-US" ) {echo "Mortgage Questions";} else {echo "贷款问题";} ?></td></tr>
<tr><td><textarea name="QuestionText" rows="2" cols="20" id="QuestionText" style="height:106px;width:305px;"></textarea></td></tr>
<tr><td><div class="g-recaptcha" style="margin-top:12px;" data-sitekey="6LevAR8TAAAAAO_iQ1gXzlh5D70301uxn7UVU159"></div></td></tr>
</tbody></table>
<div id="msgblock" class="logon_warn" style="display: none;">
<p id="apply_msg" style="color:red;font-weight:bold;"></p>
</div>
<div class="bottm_btn">
<input name="ApplyBtn" value="<?php if( $lang == "zh-TW" ) {echo "咨詢";} elseif( $lang == "en-US" ) {echo "SEND";} else {echo "咨询";} ?>" onclick="return validate();" id="ApplyBtn" class="consult_form_submit" type="submit">
</div>
</div>
</div>
<script type="text/javascript">
//## Consultation Form at side
$(".consult_form_button").click(function () {
    var right = $(".consoult_form_container").css('right');
    if (right === '0px') {
        $(".consoult_form_container").animate({ right: "-340px" });
    }
    else if (right === '-340px') {
        $(".consoult_form_container").animate({ right: "0px" });
    }
    return false;
});
</script>
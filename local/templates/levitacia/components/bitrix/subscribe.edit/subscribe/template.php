<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
global $USER?>
<div class="lk-form subscribe">
    <svg class="lk-form_line" width="51" height="1" viewBox="0 0 51 1" fill="none" xmlns="http://www.w3.org/2000/svg">
        <line y1="0.5" x2="51" y2="0.5" stroke="#747474"></line>
    </svg>
<?foreach($arResult["MESSAGE"] as $itemID=>$itemValue)
	echo ShowMessage(array("MESSAGE"=>$itemValue, "TYPE"=>"OK"));
foreach($arResult["ERROR"] as $itemID=>$itemValue)
	echo ShowMessage(array("MESSAGE"=>$itemValue, "TYPE"=>"ERROR"));

//whether to show the forms
if($arResult["ID"] == 0 && empty($_REQUEST["action"]) || CSubscription::IsAuthorized($arResult["ID"])){


/*	//show current authorization section
	if($USER->IsAuthorized() && ($arResult["ID"] == 0 || $arResult["SUBSCRIPTION"]["USER_ID"] == 0)){
		include("authorization.php");
	}
*/
	//show authorization section for new subscription
	if($arResult["ID"]==0 && !$USER->IsAuthorized()){
		if($arResult["ALLOW_ANONYMOUS"]=="N" || ($arResult["ALLOW_ANONYMOUS"]=="Y" && $arResult["SHOW_AUTH_LINKS"]=="Y"))
		{
			include("authorization_new.php");
		}
	}
	//setting section
	include("setting.php");
    //status and unsubscription/activation section
    if($arResult["ID"]>0){
        include("status.php");
    }
    //show confirmation form
    if($arResult["ID"]>0 && $arResult["SUBSCRIPTION"]["CONFIRMED"] <> "Y"){
        include("confirmation.php");
    }?>
<!--	<p><span class="starrequired">*</span>--><?//echo GetMessage("subscr_req")?><!--</p>-->
<?}
else{
	//subscription authorization form
	include("authorization_full.php");
}?>
</div>
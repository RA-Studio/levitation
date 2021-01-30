<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
use Bitrix\Main\Localization\Loc;
/**
 * @var array $arParams
 * @var array $arResult
 * @var $APPLICATION CMain
 */
if ($arParams["SET_TITLE"] == "Y"){
	$APPLICATION->SetTitle(Loc::getMessage("SOA_ORDER_COMPLETE"));
}?>
<? if (!empty($arResult["ORDER"])):
    $arOrder = CSaleOrder::GetByID($arResult['ORDER']['ID'])
    ?>
    <script>
        window.onload = function() {
            ym(54643042, 'reachGoal', 'order_success');
            fbq('track', 'Purchase', {value: <?=$arOrder['PRICE']?>, currency: '<?=$arOrder['CURRENCY']?>'});
        }
    </script>
	<table class="sale_order_full_table">
		<tr>
			<td>
				<svg width="100" height="100" viewBox="0 0 100 100" fill="none" xmlns="http://www.w3.org/2000/svg">
					<circle cx="50" cy="50" r="49" stroke="black" stroke-opacity="0.9" stroke-width="2"/>
					<path d="M29.3848 50.9768L42.389 63.981L70.8251 35.545" stroke="black" stroke-opacity="0.9" stroke-width="2" stroke-linecap="round"/>
				</svg>
				<span class="sale_order_full_table__numOrder"><?=Loc::getMessage("SOA_ORDER_SUC", array(
					"#ORDER_DATE#" => $arResult["ORDER"]["DATE_INSERT"]->toUserTime()->format('d.m.Y H:i'),
					"#ORDER_ID#" => $arResult["ORDER"]["ACCOUNT_NUMBER"]
				))?></span><br>
				<span class="sale_order_full_table__numPayment"><? if (!empty($arResult['ORDER']["PAYMENT_ID"])): ?>
					<?=Loc::getMessage("SOA_PAYMENT_SUC", array(
						"#PAYMENT_ID#" => $arResult['PAYMENT'][$arResult['ORDER']["PAYMENT_ID"]]['ACCOUNT_NUMBER']
					))?>
				<? endif ?></span><br>
				<span class="sale_order_full_table__text"><? if ($arParams['NO_PERSONAL'] !== 'Y'): ?>
					<br /><br />
					<?=Loc::getMessage('SOA_ORDER_SUC1', ['#LINK#' => $arParams['PATH_TO_PERSONAL']])?>
				<? endif; ?></span>
			</td>
		</tr>
	</table>
	<?if ($arResult["ORDER"]["IS_ALLOW_PAY"] === 'Y')
	{
		if (!empty($arResult["PAYMENT"]))
		{
			foreach ($arResult["PAYMENT"] as $payment)
			{
				if ($payment["PAID"] != 'Y')
				{
					if (!empty($arResult['PAY_SYSTEM_LIST'])
						&& array_key_exists($payment["PAY_SYSTEM_ID"], $arResult['PAY_SYSTEM_LIST'])
					)
					{
						$arPaySystem = $arResult['PAY_SYSTEM_LIST_BY_PAYMENT_ID'][$payment["ID"]];

						if (empty($arPaySystem["ERROR"]))
						{
							?>
							<br /><br />

							<table class="sale_order_full_table">
								<tr>
									<td class="ps_logo">
                                        <!--<div class="ps_logo_wrapper">-->
										<div class="pay_name"><?=Loc::getMessage("SOA_PAY") ?></div>
										<?=CFile::ShowImage($arPaySystem["LOGOTIP"], 100, 100, "border=0\"", "", false) ?>
										<div class="paysystem_name"><?=$arPaySystem["NAME"] ?></div>
                                        <!--</div>-->
									</td>
								</tr>
								<tr>
									<td>
                                        <?global $USER;?>
                                        <?if($USER->IsAdmin()){?>
                                            <?
                                           /* $fd = fopen($_SERVER['DOCUMENT_ROOT']."/array.txt", 'w') or die("не удалось создать файл");
                                            $data = serialize($arResult);
                                            fwrite($fd, $data);
                                            fclose($fd);*/
                                            $arPaySystem["BUFFERED_OUTPUT"] = preg_replace('#(<script>.*</script>)#sU', '', $arPaySystem["BUFFERED_OUTPUT"]);
                                            $arPaySystem["BUFFERED_OUTPUT"] = str_ireplace('Оплатить, Вы будете перенаправлены на страницу оплаты', 'Оплатить', $arPaySystem["BUFFERED_OUTPUT"]);
                                            }?>
										<? if (strlen($arPaySystem["ACTION_FILE"]) > 0 && $arPaySystem["NEW_WINDOW"] == "Y" && $arPaySystem["IS_CASH"] != "Y"){?>
											<?
                                            $orderAccountNumber = urlencode(urlencode($arResult["ORDER"]["ACCOUNT_NUMBER"]));
                                            $paymentAccountNumber = $payment["ACCOUNT_NUMBER"];
                                          ?>
<?/**/?>
                                            <script>
                                                window.open('<?=$arParams["PATH_TO_PAYMENT"]?>?ORDER_ID=<?=$orderAccountNumber?>&PAYMENT_ID=<?=$paymentAccountNumber?>');
                                            </script>
                                            <?=Loc::getMessage("SOA_PAY_LINK", array("#LINK#" => $arParams["PATH_TO_PAYMENT"]."?ORDER_ID=".$orderAccountNumber."&PAYMENT_ID=".$paymentAccountNumber))?>
                                            <? if (CSalePdf::isPdfAvailable() && $arPaySystem['IS_AFFORD_PDF']){?>
                                            <br/>
                                                <?=Loc::getMessage("SOA_PAY_PDF", array("#LINK#" => $arParams["PATH_TO_PAYMENT"]."?ORDER_ID=".$orderAccountNumber."&pdf=1&DOWNLOAD=Y"))?>
                                            <?}?>
                                        <?}else{?>
											<?=$arPaySystem["BUFFERED_OUTPUT"]?>
										<?}?>
									</td>
								</tr>
							</table>

							<?
						}
						else
						{
							?>
							<span style="color:red;"><?=Loc::getMessage("SOA_ORDER_PS_ERROR")?></span>
							<?
						}
					}
					else
					{
						?>
						<span style="color:red;"><?=Loc::getMessage("SOA_ORDER_PS_ERROR")?></span>
						<?
					}
				}
			}
		}
		//LocalRedirect("personal/#serviceTab2");
?>
        <?/*
	<script>
		window.open('https://internation.co/personal/#serviceTab2', '_blank');
		$.ajax({ 
    	url:  "https://internation.co/personal/#serviceTab2", 
    	async: false, 
    	dataType: "json", 
    	data:  {}, 
    	success: function(status) { 
     	if (status == null) { 
      	alert("Error in verifying the status."); 
     	} else if(!status) { 
      	$("#agreement").dialog("open"); 
     	} else { 
      	window.open(redirectionURL);
     	} 
    	} 
	}); 
	</script>
        */?><?
	}
	else {
		?>
		<br /><strong><?=$arParams['MESS_PAY_SYSTEM_PAYABLE_ERROR']?></strong>
	<?}?>
<? else:?>
	<b><?=Loc::getMessage("SOA_ERROR_ORDER")?></b>
	<br /><br />
	<table class="sale_order_full_table">
		<tr>
			<td>
				<?=Loc::getMessage("SOA_ERROR_ORDER_LOST", ["#ORDER_ID#" => htmlspecialcharsbx($arResult["ACCOUNT_NUMBER"])])?>
				<?=Loc::getMessage("SOA_ERROR_ORDER_LOST1")?>
			</td>
		</tr>
	</table>
<? endif ?>

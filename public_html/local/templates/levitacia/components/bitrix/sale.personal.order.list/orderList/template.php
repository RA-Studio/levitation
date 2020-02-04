<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
use Bitrix\Main,
	Bitrix\Main\Localization\Loc,
	Bitrix\Main\Page\Asset,
    Bitrix\Sale;
Asset::getInstance()->addJs("/bitrix/components/bitrix/sale.order.payment.change/templates/.default/script.js");
Asset::getInstance()->addCss("/bitrix/components/bitrix/sale.order.payment.change/templates/.default/style.css");
CJSCore::Init(array('clipboard', 'fx'));
Loc::loadMessages(__FILE__);
?>
<?
if (!empty($arResult['ERRORS']['FATAL'])){

	?>
<?}
else {
	?>
<?if(count($arResult['ORDERS'])>0) { ?>
        <?
            $paymentChangeData = array();
            $orderHeaderStatus = null; ?>
<div class="lk-tab tab-wide active" id="lk-info1">
    <div class="lk-tab-orders">
        <div class="lk-tab-orders-row lk-tab-orders-header">
            <div class="lk-tab-orders-row-col">
            </div>
            <?$arStatuses = CSaleStatus::GetList(array("SORT"=>'ASC'),array("LID" => "ru"))?>
            <?while ($status = $arStatuses->GetNext()){
                ?><div class="lk-tab-orders-row-col" title="<?=$status['DESCRIPTION']?>">
                    <?=$status['NAME']?>
                </div><?
            }?>
            <div class="lk-tab-orders-row-col">
            </div>
        </div><?
        foreach ($arResult['ORDERS'] as $key => $order) {
                if ($orderHeaderStatus !== $order['ORDER']['STATUS_ID'] && $arResult['SORT_TYPE'] == 'STATUS') {
                    $orderHeaderStatus = $order['ORDER']['STATUS_ID'];
                }
                switch ($order['ORDER']['STATUS_ID']){
                    case 'N':?>
                        <div class="lk-tab-orders-row">
                            <div class="lk-tab-orders-row-col">
                                №<?=$order['ORDER']['ID']?>
                            </div>
                            <div class="lk-tab-orders-row-col current">
                                1
                            </div>
                            <div class="lk-tab-orders-row-col">
                                2
                            </div>
                            <div class="lk-tab-orders-row-col">
                                3
                            </div>
                            <div class="lk-tab-orders-row-col">
                                4
                            </div>
                            <div class="lk-tab-orders-row-col">
                                <?=$order['ORDER']['DATE_INSERT_FORMATED']?>
                            </div>
                        </div>
                        <?
                        break;
                    case 'S':?>
                        <div class="lk-tab-orders-row">
                            <div class="lk-tab-orders-row-col">
                                №<?=$order['ORDER']['ID']?>
                            </div>
                            <div class="lk-tab-orders-row-col done">
                                1
                            </div>
                            <div class="lk-tab-orders-row-col current">
                                2
                            </div>
                            <div class="lk-tab-orders-row-col">
                                3
                            </div>
                            <div class="lk-tab-orders-row-col">
                                4
                            </div>
                            <div class="lk-tab-orders-row-col">
                                <?=$order['ORDER']['DATE_INSERT_FORMATED']?>
                            </div>
                        </div>
                        <?
                        break;
                    case 'T':?>
                        <div class="lk-tab-orders-row">
                            <div class="lk-tab-orders-row-col">
                                №<?=$order['ORDER']['ID']?>
                            </div>
                            <div class="lk-tab-orders-row-col done">
                                1
                            </div>
                            <div class="lk-tab-orders-row-col done">
                                2
                            </div>
                            <div class="lk-tab-orders-row-col current">
                                3
                            </div>
                            <div class="lk-tab-orders-row-col">
                                4
                            </div>
                            <div class="lk-tab-orders-row-col">
                                <?=$order['ORDER']['DATE_INSERT_FORMATED']?>
                            </div>
                        </div>
                        <?
                        break;
                    case 'F':?>
                        <div class="lk-tab-orders-row done">
                            <div class="lk-tab-orders-row-col">
                                №<?=$order['ORDER']['ID']?>
                            </div>
                            <div class="lk-tab-orders-row-col done">
                                1
                            </div>
                            <div class="lk-tab-orders-row-col done">
                                2
                            </div>
                            <div class="lk-tab-orders-row-col done">
                                3
                            </div>
                            <div class="lk-tab-orders-row-col done">
                                4
                            </div>
                            <div class="lk-tab-orders-row-col">
                                <?=$order['ORDER']['DATE_INSERT_FORMATED']?>
                            </div>
                        </div>
                        <?
                        break;
                }
            }
        echo $arResult["NAV_STRING"];
        ?>
        </div>
</div><?
    }else{?>
        <div class="lk-tab active" id="lk-info1">
            <div class="lk-tab-orders empty-orders">
                <div class="">
                    <img src="" alt="">
                </div>
                <div class="">У Вас нет текущих заказов</div>
                <div class="empty-orders-row">
                    <a href="/">Нажмите здесь</a>, чтобы перейти в каталог
                </div>
            </div>
        </div>
    <?}?>
<?}?>

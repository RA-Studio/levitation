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


            <div class="lk-orderListNew">
            <?
            foreach ($arResult['ORDERS'] as $key => $order) {
                if ($orderHeaderStatus !== $order['ORDER']['STATUS_ID'] && $arResult['SORT_TYPE'] == 'STATUS') {
                    $orderHeaderStatus = $order['ORDER']['STATUS_ID'];
                }
                $arStatus = CSaleStatus::GetByID($order['ORDER']['STATUS_ID']);
                ?>
                <?$items = array();
                foreach ($order['BASKET_ITEMS'] as $item){
                    $itemFilter = Array("IBLOCK_ID"=>3, "ID"=>$item['PRODUCT_ID'] );
                    $resItem = CIBlockElement::GetList(Array(), $itemFilter, false);
                    while($ob = $resItem->GetNextElement()){
                        $arFields = $ob->GetFields();
                        $arFields['PROPERTIES'] = $ob->GetProperties();
                        $arFields['BASKET'] = $item;
                        $items[$item['PRODUCT_ID']]=$arFields;
                    }
                }?>
                <div class="lk-orderListNew-item">
                    <div class="lk-orderListNew-item-info">
                        <div class="lk-orderListNew-item-info-head">
                            <div class="lk-orderListNew-item-ceil lk-orderListNew-item-info-head__OrderNum">
                                Заказ №<?=$order['ORDER']['ID']?>
                            </div>
                            <div class="lk-orderListNew-item-ceil lk-orderListNew-item-ceil_3 lk-orderListNew-item-info-head__status" title="<?=$arStatus['DESCRIPTION']?>">
                                <?=$arStatus['NAME']?>
                            </div>
                            <div class="lk-orderListNew-item-ceil lk-orderListNew-item-info-head__close">
                                <svg width="16" height="10" viewBox="0 0 16 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M1 9L8 2L15 9" stroke="black" stroke-width="2"/>
                                </svg>
                            </div>
                        </div>
                        <div class="lk-orderListNew-item-info-main">
                            <?if (empty($order['ORDER'][0]['TRACKING_NUMBER'])){?>
                                <div class="lk-orderListNew-item-ceil">
                                    <div class="lk-orderListNew-item-info-main__title">
                                        Доставка
                                    </div>
                                    <?$arDeliv = CSaleDelivery::GetByID($order['SHIPMENT'][0]['DELIVERY_ID']);?>
                                    <div class="lk-orderListNew-item-info-main__text" title="<?=$arDeliv['DESCRIPTION']?>">
                                        <?=$order['SHIPMENT'][0]['DELIVERY_NAME']?>
                                    </div>
                                </div>
                            <?}else{?>
                                <div class="lk-orderListNew-item-ceil">
                                    <div class="lk-orderListNew-item-info-main__title">
                                        Дата отправки
                                    </div>
                                    <div class="lk-orderListNew-item-info-main__text">
                                        <?=$order['ORDER']['DATE_UPDATE_FORMATED']?>
                                    </div>
                                </div>
                                <div class="lk-orderListNew-item-ceil">
                                    <div class="lk-orderListNew-item-info-main__title">
                                        Номер отправки
                                    </div>
                                    <div class="lk-orderListNew-item-info-main__text">
                                        <?=$order['ORDER'][0]['TRACKING_NUMBER']?>
                                    </div>
                                </div>
                            <?}?>
                            <div class="lk-orderListNew-item-ceil">
                                <div class="lk-orderListNew-item-info-main__title">
                                    Цена доставки
                                </div>
                                <div class="lk-orderListNew-item-info-main__text">
                                    <?=$order['SHIPMENT'][0]['FORMATED_DELIVERY_PRICE']?>
                                </div>
                            </div>
                            <div class="lk-orderListNew-item-ceil">
                                <div class="lk-orderListNew-item-info-main__title">
                                    Оплата
                                </div>
                                <div class="lk-orderListNew-item-info-main__text">
                                    <?=$order['PAYMENT'][0]['PAY_SYSTEM_NAME']?>
                                </div>
                            </div>
                            <div class="lk-orderListNew-item-ceil">
                                <div class="lk-orderListNew-item-info-main__title">
                                    Сумма заказа
                                </div>
                                <div class="lk-orderListNew-item-info-main__text">
                                    <?=$order['PAYMENT'][0]['FORMATED_SUM']?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?if (!empty($items)){?>
                        <div class="lk-orderListNew-item-goods">
                            <?foreach ($items as $item){?>
                                <div class="lk-orderListNew-item-goods-item">
                                    <div class="lk-orderListNew-item-ceil lk-orderListNew-item-goods-item__imgPreview">
                                        <?if(!empty($item['PREVIEW_PICTURE'])){?>
                                        <img src="<?=CFile::GetPath($item['PREVIEW_PICTURE'])?>" alt="<?=$item['NAME']?>">
                            <?}else{?>
                                        <img src="<?=CFile::GetPath($item['PROPERTIES']['MORE_PHOTO']['VALUE'][0])?>" alt="<?=$item['NAME']?>">
                            <?}?>
                                    </div>
                                    <div class="lk-orderListNew-item-ceil lk-orderListNew-item-ceil_3 lk-orderListNew-item-goods-item-desc">
                                        <div class="lk-orderListNew-item-goods-item-desc__title"><?=$item['NAME']?></div>
                                        <?if(!empty($item['PROPERTIES']['RAZMER']['VALUE'])){?>
                                        <div class="lk-orderListNew-item-goods-item-desc__text">Размер: <?=$item['PROPERTIES']['RAZMER']['VALUE']?></div>
                                         <?}?>
                                        <?if(!empty($item['PROPERTIES']['TSVET']['VALUE'])){?>
                                        <div class="lk-orderListNew-item-goods-item-desc__text">Цвет: <?=$item['PROPERTIES']['TSVET']['VALUE']?></div>
                                        <?}?>
                                        <div class="lk-orderListNew-item-goods-item-desc__text"><?=CurrencyFormat($item['BASKET']['PRICE'], $item['BASKET']['CURRENCY']);?> | <?=$item['BASKET']['QUANTITY']?> <?=$item['BASKET']['MEASURE_NAME']?></div>
                                    </div>
                                    <div class="lk-orderListNew-item-ceil lk-orderListNew-item-goods-item__price">
                                        Итого: <?=CurrencyFormat($item['BASKET']['PRICE']*$item['BASKET']['QUANTITY'], $item['BASKET']['CURRENCY']);?>
                                    </div>
                                </div>
                            <?}?>
                        </div>
                    <?}?>
                    <div class="lk-orderListNew-item-info-down">
                        <?if (empty($order['ORDER']['TRACKING_NUMBER'])){?>
                            <div class="lk-orderListNew-item-info-down__code">Код отслеживания пока недоступен</div>
                        <?}else{?>
                            <div class="lk-orderListNew-item-info-down__code">Код отслеживания: <?=$order['ORDER']['TRACKING_NUMBER']?></div>
                            <a href="https://cdek.ru/tracking?order_id=<?=$order['ORDER']['TRACKING_NUMBER']?>" target="_blank" class="lk-orderListNew-item-info-down__look">Отследить<svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M7.85714 5.57141H1V15H10.4286V8.14284" stroke="black" stroke-linecap="round"/>
                                    <path d="M13.4997 2.99997C13.4997 2.72383 13.2759 2.49997 12.9997 2.49997L8.49972 2.49997C8.22358 2.49997 7.99972 2.72383 7.99972 2.99997C7.99972 3.27612 8.22358 3.49997 8.49972 3.49997L12.4997 3.49997L12.4997 7.49997C12.4997 7.77612 12.7236 7.99997 12.9997 7.99997C13.2759 7.99997 13.4997 7.77612 13.4997 7.49997L13.4997 2.99997ZM6.49613 10.2107L13.3533 3.35353L12.6462 2.64642L5.78902 9.50356L6.49613 10.2107Z" fill="black"/>
                                </svg>
                            </a>
                        <?}?>
                        <?
                        if ($order['ORDER']['CAN_CANCEL'] !== 'N')
                        {?>
                            <a href="/personal/payment/?ORDER_ID=<?=$order['ORDER']['ID']?>" class="lk-orderListNew-item-info-down__return" target="_blank">Оплатить заказ</a>
                            <a href="<?=htmlspecialcharsbx($order["ORDER"]["URL_TO_CANCEL"])?>" class="lk-orderListNew-item-info-down__cancel"><?=Loc::getMessage('SPOL_TPL_CANCEL_ORDER')?></a>
                        <?}else{?>
                            <?global $USER;
                            if($USER->IsAdmin()){?>
                                <?if ($arStatus['ID']=='F'){?>
                                <a href="/return/?ORDER_ID=<?=$order['ORDER']['ID']?>" class="lk-orderListNew-item-info-down__return">Оформить возврат</a>
                                <?}?>
                            <?}?>
                        <?}?>


                    </div>
                </div>
                <?
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

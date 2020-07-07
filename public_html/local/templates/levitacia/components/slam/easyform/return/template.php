<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
    die();

use \Bitrix\Main\Localization\Loc;

$FORM_ID           = trim($arParams['FORM_ID']);
$FORM_AUTOCOMPLETE = $arParams['FORM_AUTOCOMPLETE'] ? 'on' : 'off';
$FORM_ACTION_URI   = "";
$WITH_FORM = strlen($arParams['WIDTH_FORM']) > 0 ? 'style="max-width:'.$arParams['WIDTH_FORM'].'"' : '';

if (isset($_GET['ORDER_ID']) && !empty($_GET['ORDER_ID'])) {
    $arOrder = CSaleOrder::GetByID($_GET['ORDER_ID']);
    $dbOrderProps = CSaleOrderPropsValue::GetList(
        array("SORT" => "ASC"),
        array("ORDER_ID" => $arOrder['ID'])
    );
    while ($arOrderProps = $dbOrderProps->GetNext()){

        if ($arOrderProps['CODE'] == 'LOCATION'){
            $arOrderProps['LOACTION_NAME']= CSaleLocation::GetByID($arOrderProps['VALUE'], LANGUAGE_ID);
        }
        $arOrder['PROPERTIES'][$arOrderProps['CODE']]=$arOrderProps;
    }
    $arOrder['BASKET_ITEMS'] = BasketItems($arOrder['ID']);
    
    $arFilter = Array("IBLOCK_ID"=>5, "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y", "CODE" => md5(sha1($_REQUEST['ORDER_ID'])), "PROPERTY_UF_STATUS" => "Подтверждено");
    $res = CIBlockElement::GetList(Array("ID"=>"DESC"), $arFilter, false, Array("nPageSize"=>1), Array("ID", "IBLOCK_ID", "PROPERTY_*", "CODE"));
    global $USER;
    while($ob = $res->GetNextElement()) {
        $sing = $ob->GetFields();
        $sing['PROPERTIES'] = $ob->GetProperties();
    }
    
}
function BasketItems($order_id){
    $dbBasketItems = CSaleBasket::GetList(
        array("NAME" => "ASC", "ID" => "ASC"),
        array(

            "LID" => SITE_ID,
            "ORDER_ID" => $order_id,
            "CAN_BUY" => "Y"
        ),
        false,
        false
    );
    $arBasketItems = array();
    while ($arItems = $dbBasketItems->Fetch())
    {
        $itemFilter = Array("IBLOCK_ID"=>3, "ID"=>$arItems['PRODUCT_ID']);
        $resItem = CIBlockElement::GetList(Array(), $itemFilter, false);
        while($ob = $resItem->GetNextElement()){
            $arFields = $ob->GetFields();
            $arFields['PROPERTIES'] = $ob->GetProperties();
            $arFields['BASKET'] = $arItems;
            $arBasketItems[$arItems['PRODUCT_ID']]=$arFields;
        }
    }
    return $arBasketItems;
}
?>

<div class="return">
    <div class="text">
        <h1 class="title"><?$APPLICATION->ShowTitle(false)?></h1>
    </div>
    <?/*
    <pre><?print_r($arOrder)?></pre>

    <form class="return-form">
        <div class="return-mainRow">
            <label class="return-label">
                Ф.И.О.
                <input type="text" required name="fio">
            </label>
            <label class="return-label">
                Номер паспорта
                <input type="text" required name="passport">
            </label>
            <label class="return-label">
                Адрес
                <input type="text" required name="address">
            </label>
            <label class="return-label">
                Код подразделения
                <input type="text" required name="codePodrazdeleniya">
            </label>

            <label class="return-label">
                Номер заказа
                <input type="text" required name="orderNum">
            </label>
            <label class="return-label">
                Когда, кем выдан
                <input type="text" required name="whenPass">
            </label>
            <label class="return-label">
                Номер телефона
                <input type="tel" required name="phone">
            </label>
            <div class="return-label">
                <label class="return-label_file">
                    Загрузить скан
                    <input type="file" name="passScan">
                </label>
                <div class="return-label_success">
                    <span></span>
                    <div class="return-label_success__delete"></div>
                </div>
            </div>
        </div>

        <div class="return-goods">
            <div class="return-goods-row">
                <label class="return-label">
                    <p>Артикул</p>
                    <input type="text" required name="goodsArticul">
                </label>
                <label class="return-label">
                    <p>Наименование</p>
                    <input type="text" required name="googsName">
                </label>
                <label class="return-label">
                    <p>Цвет / размер</p>
                    <input type="text" required name="goodsColor">
                </label>
                <label class="return-label">
                    <p>Причина возврата</p>
                    <input type="text" required name="goodsReason">
                </label>
                <div class="return-goods__delete"></div>
            </div>
            <div class="return-goods-addGoods"></div>
        </div>

        <label class="return-label return-label_sum">
            Сумма возврата
            <input type="text" required name="orderSum">
        </label>

        <label class="return-labelRadio">
            <input type="radio" name="cardIsActive" value="Карта активна">
            <span class="return-radioSpan"></span>
            Моя карта активна. Прошу вернуть средства на карту, с которой была произведена оплата заказа.
        </label>
        <label class="return-labelRadio">
            <input type="radio" name="cardIsActive" value="По реквизитам">
            <span class="return-radioSpan"></span>
            Моя карта утеряна/заблокирована. Прошу перечислить денежные средства по реквизитам:
        </label>

        <div class="return-requisites">
            <label class="return-label">
                Ф.И.О. полностью
                <input type="text" name="reqUserName">
            </label>
            <label class="return-label">
                БИК банка
                <input type="text" name="reqUserBic">
            </label>
            <label class="return-label">
                Номер счета получателя
                <input type="text" name="reqSchetNum">
            </label>
        </div>


        <button type="submit" class="return__submit">
            Подписать
        </button>
    </form>
*/?>

    <form id="<?=$FORM_ID?>"
          enctype="multipart/form-data"
          method="POST"
          action="<?=$FORM_ACTION_URI;?>"
          autocomplete="<?=$FORM_AUTOCOMPLETE?>"
          novalidate="novalidate"
          class="return-form"
    >
        <input type="hidden" name="FORM_ID" value="<?=$FORM_ID?>">
        <input type="text" name="ANTIBOT[NAME]" value="<?=$arResult['ANTIBOT']['NAME'];?>" style="display: none" class="hidden">
        <?//hidden fields
        foreach($arResult['FORM_FIELDS'] as $fieldCode => $arField)
        {
            if($arField['TYPE'] == 'hidden')
            {
                if($arField['CODE'] == 'SIGNATURE'){
                    ?>
                    <input type="hidden" name="<?=$arField['NAME']?>" value="<?=$sing['PROPERTIES']['UF_SIGNATURE']['VALUE']?>"/>
                    <?
                }else{
                ?>
                <input type="hidden" name="<?=$arField['NAME']?>" value="<?=$arField['VALUE'];?>"/>
                <?}

                unset($arResult['FORM_FIELDS'][$fieldCode]);
            }
        }
        ?>
            <?
            if(!empty($arResult['FORM_FIELDS'])){?>
                <div class="return-mainRow">
                    <?foreach($arResult['FORM_FIELDS'] as $fieldCode => $arField){

                        if(!$arParams['HIDE_ASTERISK'] && !$arParams['HIDE_FIELD_NAME']){
                            $asteriks = ':';
                            if($arField['REQUIRED']) {
                                $asteriks = '<span class="asterisk">*</span>:';
                            }
                            $arField['TITLE'] = $arField['TITLE'].$asteriks;
                        }

                        ?>
                        <?if($fieldCode == 'SUM' || $fieldCode == 'cardIsActive' || $fieldCode == 'FIO_FULL'|| $fieldCode == 'BIK'|| $fieldCode == 'PAY_ACCOUNT') continue;?>

                        <?if($fieldCode == 'TITLE'):?>
                            <label class="return-label" for="<?=$arField['ID']?>">
                                <? if(!$arParams['HIDE_FIELD_NAME']){?>
                                    <?=$arField['TITLE']?>
                                <?}?>
                                <input class="form-control" type="<?=$arField['TYPE'];?>" id="<?=$arField['ID']?>" name="<?=$arField['NAME']?>" value="<?=$arOrder['PROPERTIES']['FIO']['VALUE']?$arOrder['PROPERTIES']['FIO']['VALUE']:''?>" <?=$arField['PLACEHOLDER_STR'];?> <?=$arField['REQ_STR']?> <?=$arField['MASK_STR']?>>
                            </label>
                        <?elseif($fieldCode == 'ADDRESS'):?>
                            <label class="return-label" for="<?=$arField['ID']?>">
                                <? if(!$arParams['HIDE_FIELD_NAME']){?>
                                    <?=$arField['TITLE']?>
                                <?}?>
                                <input class="form-control" type="<?=$arField['TYPE'];?>" id="<?=$arField['ID']?>" name="<?=$arField['NAME']?>"
                                value="<?=$arOrder['PROPERTIES']['LOCATION']['LOACTION_NAME']['CITY_NAME']?'г.'.$arOrder['PROPERTIES']['LOCATION']['LOACTION_NAME']['CITY_NAME']:''?> <?=$arOrder['PROPERTIES']['STREET']['VALUE']?'ул.'.$arOrder['PROPERTIES']['STREET']['VALUE']:''?> <?=$arOrder['PROPERTIES']['HOUSE']['VALUE']?'д.'.$arOrder['PROPERTIES']['HOUSE']['VALUE']:''?>"
                                    <?=$arField['PLACEHOLDER_STR'];?> <?=$arField['REQ_STR']?> <?=$arField['MASK_STR']?>>
                            </label>
                        <?elseif($fieldCode == 'PASSPORT_NUMBER'):?>
                            <label class="return-label" for="<?=$arField['ID']?>">
                                <? if(!$arParams['HIDE_FIELD_NAME']){?>
                                    <?=$arField['TITLE']?>
                                <?}?>
                                <input class="form-control" type="<?=$arField['TYPE'];?>" id="<?=$arField['ID']?>" name="<?=$arField['NAME']?>" value="" <?=$arField['PLACEHOLDER_STR'];?> <?=$arField['REQ_STR']?> <?=$arField['MASK_STR']?>>
                            </label>
                        <?elseif($fieldCode == 'DEVISION_CODE'):?>
                            <label class="return-label" for="<?=$arField['ID']?>">
                                <? if(!$arParams['HIDE_FIELD_NAME']){?>
                                    <?=$arField['TITLE']?>
                                <?}?>
                                <input class="form-control" type="<?=$arField['TYPE'];?>" id="<?=$arField['ID']?>" name="<?=$arField['NAME']?>" value="<?=$arField['VALUE'];?>" <?=$arField['PLACEHOLDER_STR'];?> <?=$arField['REQ_STR']?> <?=$arField['MASK_STR']?>>
                            </label>
                        <?elseif($fieldCode == 'ORDER_ID'):?>
                            <label class="return-label" for="<?=$arField['ID']?>">
                                <? if(!$arParams['HIDE_FIELD_NAME']){?>
                                    <?=$arField['TITLE']?>
                                <?}?>
                                <input class="form-control" type="<?=$arField['TYPE'];?>" id="<?=$arField['ID']?>" name="<?=$arField['NAME']?>" value="<?=$arOrder['ID']?>" <?=$arField['PLACEHOLDER_STR'];?> <?=$arField['REQ_STR']?> <?=$arField['MASK_STR']?>>
                            </label>
                        <?elseif($fieldCode == 'WHO_ISSUED'):?>
                            <label class="return-label" for="<?=$arField['ID']?>">
                                <? if(!$arParams['HIDE_FIELD_NAME']){?>
                                    <?=$arField['TITLE']?>
                                <?}?>
                                <input class="form-control" type="<?=$arField['TYPE'];?>" id="<?=$arField['ID']?>" name="<?=$arField['NAME']?>" value="<?=$arField['VALUE'];?>" <?=$arField['PLACEHOLDER_STR'];?> <?=$arField['REQ_STR']?> <?=$arField['MASK_STR']?>>
                            </label>
                        <?elseif($fieldCode == 'PHONE'):?>
                            <label class="return-label" for="<?=$arField['ID']?>">
                                <? if(!$arParams['HIDE_FIELD_NAME']){?>
                                    <?=$arField['TITLE']?>
                                <?}?>
                                <input class="form-control" type="<?=$arField['TYPE'];?>" id="<?=$arField['ID']?>" name="<?=$arField['NAME']?>" value="<?=$arOrder['PROPERTIES']['PHONE']['VALUE']?$arOrder['PROPERTIES']['PHONE']['VALUE']:''?>" <?=$arField['PLACEHOLDER_STR'];?> <?=$arField['REQ_STR']?> <?=$arField['MASK_STR']?>>
                            </label>
                        <?elseif($arField['TYPE'] == 'file'):?>
                            <div class="return-label">
                                <? $CID = $GLOBALS["APPLICATION"]->IncludeComponent(
                                    'bitrix:main.file.input',
                                    $arField['DROPZONE_INCLUDE'] ? 'drag_n_drop' : '.default',
                                    array(
                                        'HIDE_FIELD_NAME' => $arParams['HIDE_FIELD_NAME'],
                                        'INPUT_NAME' => $arField['CODE'],
                                        'INPUT_TITLE' => $arField['TITLE'],
                                        'INPUT_NAME_UNSAVED' => $arField['CODE'],
                                        'MAX_FILE_SIZE' => $arField['FILE_MAX_SIZE'],//'20971520', //20Mb
                                        'MULTIPLE' => 'Y',
                                        'CONTROL_ID' => $arField['ID'],
                                        'MODULE_ID' => 'slam.easyform',
                                        'ALLOW_UPLOAD' => 'F',
                                        'INPUT_CAPTION'=>$arField['TITLE'],
                                        'ALLOW_UPLOAD_EXT' => $arField['FILE_EXTENSION'],
                                    ),
                                    $component,
                                    array("HIDE_ICONS" => "Y")
                                );?>
                                <?/*
                                <div class="return-label_success">
                                    <span></span>
                                    <div class="return-label_success__delete"></div>
                                </div>
*/?>
                            </div>
                        <?else:?>
                            <label class="return-label" for="<?=$arField['ID']?>">
                                <? if(!$arParams['HIDE_FIELD_NAME']){?>
                                    <?=$arField['TITLE']?>
                                <?}?>
                                <input class="form-control" type="<?=$arField['TYPE'];?>" id="<?=$arField['ID']?>" name="<?=$arField['NAME']?>" value="<?=$arField['VALUE'];?>" <?=$arField['PLACEHOLDER_STR'];?> <?=$arField['REQ_STR']?> <?=$arField['MASK_STR']?>>
                            </label>
                        <?endif;
                    }?>
                </div>


                <?if (!empty($arOrder['BASKET_ITEMS'])){?>
                    <div class="return-goods">
                        <?foreach ($arOrder['BASKET_ITEMS'] as $item){?>
                            <?$mxResult = CCatalogSku::GetProductInfo($item['ID']);?>
                            <?$db_props = CIBlockElement::GetProperty($mxResult['IBLOCK_ID'], $mxResult['ID'], array("sort" => "asc"), Array("CODE"=>"CML2_ARTICLE"));?>
                            <?$ar_props = $db_props->Fetch()?>
                            <div class="return-goods-row">
                                <label class="return-label">
                                    <p>Артикул</p>
                                    <input type="text" required value="<?=$ar_props['VALUE']?>" name="goodsArticul">
                                </label>
                                <label class="return-label">
                                    <p>Наименование</p>
                                    <input type="text" required value="<?=$item['NAME']?>" name="googsName">
                                </label>
                                <label class="return-label">
                                    <p>Цвет / размер</p>
                                    <input type="text" value="<?=$item['PROPERTIES']['TSVET']['VALUE']?> <?=$item['PROPERTIES']['RAZMER']['VALUE']?>" required name="goodsColor">
                                </label>
                                <label class="return-label">
                                    <p>Причина возврата</p>
                                    <input type="text" required name="goodsReason">
                                </label>
                                <!--div class="return-goods__delete"></div-->
                            </div>
                        <?}?>
                            <div class="return-goods-row">
                                <label class="return-label">
                                    <p>Артикул</p>
                                    <input type="text" required value="" name="goodsArticul">
                                </label>
                                <label class="return-label">
                                    <p>Наименование</p>
                                    <input type="text" required value="" name="googsName">
                                </label>
                                <label class="return-label">
                                    <p>Цвет / размер</p>
                                    <input type="text" value="" required name="goodsColor">
                                </label>
                                <label class="return-label">
                                    <p>Причина возврата</p>
                                    <input type="text" required name="goodsReason">
                                </label>
                                <div class="return-goods__delete"></div>
                            </div>
                        <div class="return-goods-addGoods"></div>
                    </div>
                <?}else{?>
                    <div class="return-goods">
                        <div class="return-goods-row">
                            <label class="return-label">
                                <p>Артикул</p>
                                <input type="text" required name="goodsArticul">
                            </label>
                            <label class="return-label">
                                <p>Наименование</p>
                                <input type="text" required name="googsName">
                            </label>
                            <label class="return-label">
                                <p>Цвет / размер</p>
                                <input type="text" required name="goodsColor">
                            </label>
                            <label class="return-label">
                                <p>Причина возврата</p>
                                <input type="text" required name="goodsReason">
                            </label>
                            <div class="return-goods__delete"></div>
                        </div>
                        <div class="return-goods-addGoods"></div>
                    </div>
                <?}?>
                <?foreach($arResult['FORM_FIELDS'] as $fieldCode => $arField){

                    if(!$arParams['HIDE_ASTERISK'] && !$arParams['HIDE_FIELD_NAME']){
                        $asteriks = ':';
                        if($arField['REQUIRED']) {
                            $asteriks = '<span class="asterisk">*</span>:';
                        }
                        $arField['TITLE'] = $arField['TITLE'].$asteriks;
                    }

                    ?>
                    <?if($fieldCode == 'SUM'){
                    ?><label class="return-label return-label_sum">
                        <? if(!$arParams['HIDE_FIELD_NAME']){?>
                            <?=$arField['TITLE']?>
                        <?}?>
                        <input type="<?=$arField['TYPE'];?>" id="<?=$arField['ID']?>" name="<?=$arField['NAME']?>" value="<?=CurrencyFormat($arOrder['PRICE'],'NUN')?>" <?=$arField['PLACEHOLDER_STR'];?> <?=$arField['REQ_STR']?> <?=$arField['MASK_STR']?>>
                        </label><?
                    }elseif ($fieldCode == 'cardIsActive'){
                    ?>
                        <?foreach($arField['VALUE'] as $key => $arVal):?>
                            <?if(!empty($arVal)):?>
                                <label class="return-labelRadio">
                                <input  type="<?=$arField['TYPE']?>" name="<?=$arField['NAME']?>" value="<?=$arVal?>" <?=$arField['REQ_STR']?>>
                                <span class="return-radioSpan"></span>
                                <?=$arVal?>
                                </label>
                            <? endif; ?>
                        <?endforeach;?>
                        <?
                    }
                }?>
                <div class="return-requisites">
                <?foreach($arResult['FORM_FIELDS'] as $fieldCode => $arField){

                    if(!$arParams['HIDE_ASTERISK'] && !$arParams['HIDE_FIELD_NAME']){
                        $asteriks = ':';
                        if($arField['REQUIRED']) {
                            $asteriks = '<span class="asterisk">*</span>:';
                        }
                        $arField['TITLE'] = $arField['TITLE'].$asteriks;
                    }

                    ?>
                    <?if($fieldCode == 'FIO_FULL'){
                        ?><label class="return-label" for="<?=$arField['ID']?>">
                            <? if(!$arParams['HIDE_FIELD_NAME']){?>
                                <?=$arField['TITLE']?>
                            <?}?>
                            <input class="form-control" type="<?=$arField['TYPE'];?>" id="<?=$arField['ID']?>" name="<?=$arField['NAME']?>" value="<?=$arField['VALUE'];?>" <?=$arField['PLACEHOLDER_STR'];?> <?=$arField['REQ_STR']?> <?=$arField['MASK_STR']?>>
                        </label><?

                    }
                    elseif ($fieldCode == 'BIK'){
                        ?><label class="return-label" for="<?=$arField['ID']?>">
                            <? if(!$arParams['HIDE_FIELD_NAME']){?>
                                <?=$arField['TITLE']?>
                            <?}?>
                            <input class="form-control" type="<?=$arField['TYPE'];?>" id="<?=$arField['ID']?>" name="<?=$arField['NAME']?>" value="<?=$arField['VALUE'];?>" <?=$arField['PLACEHOLDER_STR'];?> <?=$arField['REQ_STR']?> <?=$arField['MASK_STR']?>>
                        </label><?

                    }
                    elseif($fieldCode == 'PAY_ACCOUNT'){
                        ?><label class="return-label" for="<?=$arField['ID']?>">
                            <? if(!$arParams['HIDE_FIELD_NAME']){?>
                                <?=$arField['TITLE']?>
                            <?}?>
                            <input class="form-control" type="<?=$arField['TYPE'];?>" id="<?=$arField['ID']?>" name="<?=$arField['NAME']?>" value="<?=$arField['VALUE'];?>" <?=$arField['PLACEHOLDER_STR'];?> <?=$arField['REQ_STR']?> <?=$arField['MASK_STR']?>>
                        </label><?
                    }
                }?>
                </div>
                <?if($arParams["USE_CAPTCHA"]):?>
                <div class="col-xs-12">
                    <div class="form-group">
                        <? if(!$arParams['HIDE_FIELD_NAME'] && strlen($arParams['CAPTCHA_TITLE']) > 0): ?>
                            <label for="<?=$FORM_ID?>-captchaValidator" class="control-label"><?=htmlspecialcharsBack($arParams['CAPTCHA_TITLE'])?></label>
                        <? endif; ?>
                        <input id="<?=$FORM_ID?>-captchaValidator"  class="form-control" type="text" required data-bv-notempty-message="<?=GetMessage("SLAM_REQUIRED_MESS");?>" name="captchaValidator" style="border: none; height: 0; padding: 0; visibility: hidden;">
                        <div id="<?=$FORM_ID?>-captchaContainer"></div>
                    </div>
                </div>
            <?endif;?>
                <?if($_GET['ORDER_ID']):?>
                    <div class="cart__item-info-item-row-sign-content">
                        <?if(!$sing['PROPERTIES']['UF_SIGNATURE']['VALUE']):?>
                            <div class="cart__item-info-item-row-sign-content-col">
                                <div class="cart__item-info-item-row-sign-content-col__btn">Отправить СМС</div> 
                            </div> 
                        <?endif?>
                        <div class="cart__item-info-item-row-sign-content-whiteblock">
                            <?if($sing['PROPERTIES']['UF_SIGNATURE']['VALUE']):?>
                                <img src="<?=preg_replace('#^data:image/[^;]+;base64,#', '@', $sing['PROPERTIES']['UF_SIGNATURE']['VALUE'])?>" alt="подпись">
                            <?else:?>
                                <span>Здесь будет отображаться Ваша подпись</span>
                            <?endif?>
                        </div>
                    </div>
                <?endif?>
                <button type="submit" class="return__submit" data-default="<?=$arParams['FORM_SUBMIT_VALUE']?>"><?=$arParams['FORM_SUBMIT_VALUE']?></button>
            <?}?>
    </form>
</div>
<script type="text/javascript">
    var easyForm = new JCEasyForm(<?echo CUtil::PhpToJSObject($arParams)?>);
    function success_<?=$FORM_ID?>() {
        $('#<?=$FORM_ID?>').addClass('success');
        $('#<?=$FORM_ID?>').find('button[type="submit"]').text('Отправлено');
        $('#<?=$FORM_ID?>').find('input').removeClass('input-border').prop("disabled", true );
        $('#<?=$FORM_ID?>').find('textarea').removeClass('input-border').prop("disabled", true );
        setTimeout( () => {
            $('#<?=$FORM_ID?>').removeClass('success');
            $('#<?=$FORM_ID?>').find('button[type="submit"]').text('Отправить');
            $('#<?=$FORM_ID?>').find('input').prop("disabled", false );
            $('#<?=$FORM_ID?>').find('textarea').prop("disabled", false );
            $('#<?=$FORM_ID?>').find('.general-itemInput__label_top').removeClass('general-itemInput__label_top');
        }, 1000);
    }
    $(document).on('click','button[type="submit"]',function(e){
        e.preventDefault();
        var form = $(this).closest('form');
        var $this = $(this);
        var data = form.serialize();
        $.ajax({
            method:'POST',
            url:'/testPDF.php',
            data: data,
            success:function (result) {
                form.find('[name="FIELDS[PDF]"]').val(result);
                form.submit();
            }
        })

    })
    document.querySelector(`.cart__item-info-item-row-sign-content .cart__item-info-item-row-sign-content-col__btn`).onclick = () => {
        var data = new FormData();
        var xhr = new XMLHttpRequest();
        
        var phone = document.getElementById('return_FIELD_PHONE');
        var order = document.getElementById('return_FIELD_ORDER_ID');
        
        //return_FIELD_PHONE
        
        data.append('phone', phone.value);
        data.append('order', order.value);
        //data.append('sign', JSON.stringify(_this.sign));
        
        xhr.open('POST', "/return/signature/ajax.php?action=SendConfirmation", true);
        
        xhr.onload = function() {
            var data = JSON.parse(this.response);
            if(data.isSuccess) {
                alert('Смс отправлено на Ваш телефон');
                
                var intervalId = setInterval(() => {
                    //
                    var data = new FormData();
                    var xhr = new XMLHttpRequest();
                    xhr.open('POST', "/return/signature/ajax.php?action=GetSignature", true);
                    data.append('order', order.value);
                    xhr.onload = function() {
                        var data = JSON.parse(this.response);
                        if(data.isSuccess && data.data.sign != false) {
                            console.log(data, data.data);
                            var img = document.createElement("img");
                            img.setAttribute('src', data.data.sign);
                            document.querySelector(`.cart__item-info-item-row-sign-content .cart__item-info-item-row-sign-content-col`).style.display = 'none';
                            document.querySelector(`.cart__item-info-item-row-sign-content .cart__item-info-item-row-sign-content-whiteblock`).innerHTML = "";
                            document.querySelector(`.cart__item-info-item-row-sign-content .cart__item-info-item-row-sign-content-whiteblock`).appendChild(img);
                            clearInterval(intervalId);
                        }
                        if(data.isSuccess === false) {
                            clearInterval(intervalId);
                        }
                    }
                    xhr.send(data);
                    console.log("check");
                }, 2000);
                
            } else {
                alert(`Произошла ошибка`);
            }
        };
        
        xhr.send(data);
        
    };
</script>

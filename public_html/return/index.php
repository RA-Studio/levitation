<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("TITLE", "Правила возврата товара / _Levitacia^");
$APPLICATION->SetPageProperty("keywords", "Правила возврата товара / _Levitacia^");
$APPLICATION->SetPageProperty("description", "Правила возврата товара / _Levitacia^");
$APPLICATION->SetTitle("Правила возврата товара");
?>
<?global $USER;
if($USER->IsAdmin()){?>
    <style>
        .cart__item-info-item-row-sign-content {
            display: flex;
            align-items: center;
                margin-bottom: 20px;
        }
        .cart__item-info-item-row-sign-content-col__btn {
            background: #000000;
            border: 1px solid #000000;
            border-radius: 5px;
            display: flex;
            justify-content: center;
            align-items: center;
            width: 100%;
            height: 50px;
            margin-bottom: 20px;
            /* font-weight: 600; */
            /* font-size: 16px; */
            color: #FFFFFF;
            cursor: pointer;
            transition: .3s;
            min-width: 200px;
        }
        .cart__item-info-item-row-sign-content-col__text {
            font-size: 16px;
            line-height: 19px;
            color: rgba(51, 51, 51, 0.6);
            margin-bottom: 20px;
        }
        .cart__item-info-item-row-sign-content-whiteblock {
            flex: 0 0 68%;
            margin-left: 20px;
            background: #FFFFFF;
            border-radius: 10px;
            height: 290px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }
    </style>
    <?$APPLICATION->IncludeComponent(
	"slam:easyform", 
	"return", 
	array(
		"COMPONENT_TEMPLATE" => "return",
		"FORM_ID" => "return",
		"FORM_NAME" => "Оформление возврата",
		"WIDTH_FORM" => "500px",
		"DISPLAY_FIELDS" => array(
			0 => "TITLE",
			1 => "PHONE",
			2 => "ORDER_ID",
			3 => "ADDRESS",
			4 => "PASSPORT_NUMBER",
			5 => "DEVISION_CODE",
			6 => "WHO_ISSUED",
			7 => "SCAN",
			8 => "SUM",
			9 => "BASKET",
			10 => "cardIsActive",
			11 => "FIO_FULL",
			12 => "BIK",
			13 => "PAY_ACCOUNT",
			14 => "SIGNATURE",
			15 => "PDF",
			16 => "",
		),
		"REQUIRED_FIELDS" => array(
			0 => "TITLE",
			1 => "PHONE",
			2 => "ORDER_ID",
			3 => "ADDRESS",
			4 => "PASSPORT_NUMBER",
			5 => "DEVISION_CODE",
			6 => "WHO_ISSUED",
			7 => "SCAN",
			8 => "SUM",
			9 => "BASKET",
		),
		"FIELDS_ORDER" => "TITLE,PASSPORT_NUMBER,ADDRESS,DEVISION_CODE,ORDER_ID,WHO_ISSUED,PHONE,SCAN,BASKET,SUM,FIO_FULL,BIK,PAY_ACCOUNT,cardIsActive,SIGNATURE,PDF",
		"FORM_AUTOCOMPLETE" => "Y",
		"HIDE_FIELD_NAME" => "N",
		"HIDE_ASTERISK" => "Y",
		"FORM_SUBMIT_VALUE" => "Отправить",
		"SEND_AJAX" => "Y",
		"SHOW_MODAL" => "N",
		"_CALLBACKS" => "success_return",
		"OK_TEXT" => "Ваше сообщение отправлено. Мы свяжемся с вами в течение 2х часов",
		"ERROR_TEXT" => "Произошла ошибка. Сообщение не отправлено.",
		"ENABLE_SEND_MAIL" => "Y",
		"CREATE_SEND_MAIL" => "",
		"EVENT_MESSAGE_ID" => array(
			0 => "54",
		),
		"EMAIL_TO" => "",
		"EMAIL_BCC" => "",
		"MAIL_SUBJECT_ADMIN" => "#SITE_NAME#: Сообщение из формы обратной связи",
		"EMAIL_FILE" => "N",
		"USE_IBLOCK_WRITE" => "N",
		"CATEGORY_TITLE_TITLE" => "Ф.И.О.",
		"CATEGORY_TITLE_TYPE" => "text",
		"CATEGORY_TITLE_PLACEHOLDER" => "",
		"CATEGORY_TITLE_VALUE" => "",
		"CATEGORY_TITLE_VALIDATION_ADDITIONALLY_MESSAGE" => "",
		"CATEGORY_PHONE_TITLE" => "Номер телефона",
		"CATEGORY_PHONE_TYPE" => "tel",
		"CATEGORY_PHONE_PLACEHOLDER" => "",
		"CATEGORY_PHONE_VALUE" => "",
		"CATEGORY_PHONE_VALIDATION_ADDITIONALLY_MESSAGE" => "",
		"CATEGORY_PHONE_INPUTMASK" => "N",
		"CATEGORY_PHONE_INPUTMASK_TEMP" => "+7 (999) 999-9999",
		"CATEGORY_ORDER_ID_TITLE" => "Номер заказа",
		"CATEGORY_ORDER_ID_TYPE" => "text",
		"CATEGORY_ORDER_ID_PLACEHOLDER" => "",
		"CATEGORY_ORDER_ID_VALUE" => "",
		"CATEGORY_ORDER_ID_VALIDATION_ADDITIONALLY_MESSAGE" => "",
		"CATEGORY_ADDRESS_TITLE" => "Адрес",
		"CATEGORY_ADDRESS_TYPE" => "text",
		"CATEGORY_ADDRESS_PLACEHOLDER" => "",
		"CATEGORY_ADDRESS_VALUE" => "",
		"CATEGORY_ADDRESS_VALIDATION_ADDITIONALLY_MESSAGE" => "",
		"CATEGORY_PASSPORT_NUMBER_TITLE" => "Номер паспорта",
		"CATEGORY_PASSPORT_NUMBER_TYPE" => "text",
		"CATEGORY_PASSPORT_NUMBER_PLACEHOLDER" => "",
		"CATEGORY_PASSPORT_NUMBER_VALUE" => "",
		"CATEGORY_PASSPORT_NUMBER_VALIDATION_ADDITIONALLY_MESSAGE" => "",
		"CATEGORY_DEVISION_CODE_TITLE" => "Код подразделения",
		"CATEGORY_DEVISION_CODE_TYPE" => "text",
		"CATEGORY_DEVISION_CODE_PLACEHOLDER" => "",
		"CATEGORY_DEVISION_CODE_VALUE" => "",
		"CATEGORY_DEVISION_CODE_VALIDATION_ADDITIONALLY_MESSAGE" => "",
		"CATEGORY_WHO_ISSUED_TITLE" => "Когда, кем выдан",
		"CATEGORY_WHO_ISSUED_TYPE" => "text",
		"CATEGORY_WHO_ISSUED_PLACEHOLDER" => "",
		"CATEGORY_WHO_ISSUED_VALUE" => "",
		"CATEGORY_WHO_ISSUED_VALIDATION_ADDITIONALLY_MESSAGE" => "",
		"CATEGORY_SCAN_TITLE" => "Загрузить скан",
		"CATEGORY_SCAN_TYPE" => "file",
		"CATEGORY_SCAN_PLACEHOLDER" => "",
		"CATEGORY_SCAN_VALUE" => "",
		"CATEGORY_SCAN_VALIDATION_ADDITIONALLY_MESSAGE" => "",
		"CATEGORY_SUM_TITLE" => "Сумма возврата",
		"CATEGORY_SUM_TYPE" => "text",
		"CATEGORY_SUM_PLACEHOLDER" => "",
		"CATEGORY_SUM_VALUE" => "",
		"CATEGORY_SUM_VALIDATION_ADDITIONALLY_MESSAGE" => "",
		"CATEGORY_BASKET_TITLE" => "BASKET",
		"CATEGORY_BASKET_TYPE" => "hidden",
		"CATEGORY_BASKET_PLACEHOLDER" => "",
		"CATEGORY_BASKET_VALUE" => "",
		"CATEGORY_BASKET_VALIDATION_ADDITIONALLY_MESSAGE" => "",
		"CATEGORY_CARD_ACTIVE_TITLE" => "Моя карта активна. Прошу вернуть средства на карту, с которой была произведена оплата заказа.",
		"CATEGORY_CARD_ACTIVE_TYPE" => "checkbox",
		"CATEGORY_CARD_ACTIVE_PLACEHOLDER" => "",
		"CATEGORY_CARD_ACTIVE_VALUE" => array(
			0 => "Моя карта активна. Прошу вернуть средства на карту, с которой была произведена оплата заказа.",
		),
		"CATEGORY_CARD_ACTIVE_VALIDATION_ADDITIONALLY_MESSAGE" => "",
		"USE_MODULE_VARNING" => "N",
		"USE_CAPTCHA" => "N",
		"USE_FORMVALIDATION_JS" => "N",
		"HIDE_FORMVALIDATION_TEXT" => "N",
		"INCLUDE_BOOTSRAP_JS" => "Y",
		"USE_JQUERY" => "N",
		"USE_BOOTSRAP_CSS" => "N",
		"USE_BOOTSRAP_JS" => "N",
		"CATEGORY_FIO_FULL_TITLE" => "Ф.И.О. Полностью",
		"CATEGORY_FIO_FULL_TYPE" => "text",
		"CATEGORY_FIO_FULL_PLACEHOLDER" => "",
		"CATEGORY_FIO_FULL_VALUE" => "",
		"CATEGORY_FIO_FULL_VALIDATION_ADDITIONALLY_MESSAGE" => "",
		"CATEGORY_BIK_TITLE" => "БИК",
		"CATEGORY_BIK_TYPE" => "text",
		"CATEGORY_BIK_PLACEHOLDER" => "",
		"CATEGORY_BIK_VALUE" => "",
		"CATEGORY_BIK_VALIDATION_ADDITIONALLY_MESSAGE" => "",
		"CATEGORY_PAY_ACCOUNT_TITLE" => "Номер счета",
		"CATEGORY_PAY_ACCOUNT_TYPE" => "text",
		"CATEGORY_PAY_ACCOUNT_PLACEHOLDER" => "",
		"CATEGORY_PAY_ACCOUNT_VALUE" => "",
		"CATEGORY_PAY_ACCOUNT_VALIDATION_ADDITIONALLY_MESSAGE" => "",
		"CATEGORY_CARD_BLOCKED_TITLE" => "Моя карта утеряна/заблокирована. Прошу перечислить средства по реквизитам:",
		"CATEGORY_CARD_BLOCKED_TYPE" => "checkbox",
		"CATEGORY_CARD_BLOCKED_PLACEHOLDER" => "",
		"CATEGORY_CARD_BLOCKED_VALUE" => array(
			0 => "Моя карта утеряна/заблокирована. Прошу перечислить средства по реквизитам:",
			1 => "",
		),
		"CATEGORY_CARD_BLOCKED_VALIDATION_ADDITIONALLY_MESSAGE" => "",
		"CATEGORY_CARD_BLOCKED_SHOW_INLINE" => "Y",
		"FORM_SUBMIT_VARNING" => "Нажимая на кнопку \"#BUTTON#\", вы даете согласие на обработку <a target=\"_blank\" href=\"#\">персональных данных</a>",
		"CATEGORY_SCAN_FILE_EXTENSION" => "doc, docx, xls, xlsx, txt, rtf, pdf, png, jpeg, jpg, gif",
		"CATEGORY_SCAN_FILE_MAX_SIZE" => "20971520",
		"CATEGORY_SCAN_DROPZONE_INCLUDE" => "N",
		"CATEGORY_CARD_ACTIVE_SHOW_INLINE" => "Y",
		"CATEGORY_cardIsActive_TITLE" => "cardIsActive",
		"CATEGORY_cardIsActive_TYPE" => "radio",
		"CATEGORY_cardIsActive_VALUE" => array(
			0 => "Моя карта активна. Прошу вернуть средства на карту, с которой была произведена оплата заказа.",
			1 => "Моя карта утеряна/заблокирована. Прошу перечислить денежные средства по реквизитам:",
			2 => "",
		),
		"CATEGORY_cardIsActive_SHOW_INLINE" => "N",
		"CATEGORY_SIGNATURE_TITLE" => "SIGNATURE",
		"CATEGORY_SIGNATURE_TYPE" => "hidden",
		"CATEGORY_SIGNATURE_VALUE" => "",
		"CATEGORY_PDF_TITLE" => "PDF",
		"CATEGORY_PDF_TYPE" => "hidden",
		"CATEGORY_PDF_VALUE" => ""
	),
	false
);?>
<?}else{?>
<div class="container inner">
  <div class="text">
    <h1 class="title"><?=$APPLICATION->ShowTitle(false)?></h1>
  </div>
    <div class="text__content">
        При оплате картами возврат наличными денежными средствами не допускается. Порядок возврата регулируется правилами международных платежных систем.
        <br><br>
        Процедура возврата товара регламентируется статьей 26.1 федерального закона «О защите прав потребителей».<br><br>
        — Потребитель вправе отказаться от товара в любое время до его передачи, а после передачи товара - в течение семи дней;<br>
        — Возврат товара надлежащего качества возможен в случае, если сохранены его товарный вид, потребительские свойства, а также документ, подтверждающий факт и условия покупки указанного товара;<br>
        — Потребитель не вправе отказаться от товара надлежащего качества, имеющего индивидуально-определенные свойства, если указанный товар может быть использован исключительно приобретающим его человеком;<br>
        — При отказе потребителя от товара продавец должен возвратить ему денежную сумму, уплаченную потребителем по договору, за исключением расходов продавца на доставку от потребителя возвращенного товара, не позднее чем через десять дней со дня предъявления потребителем соответствующего требования;<br>
        <br>
        Для возврата денежных средств на банковскую карту необходимо заполнить «Заявление о возврате денежных средств», которое высылается по требованию компанией на электронный адрес и оправить его вместе с приложением копии паспорта по адресу  zakaz@levitacia.co<br>
        <br>
        Возврат денежных средств будет осуществлен на банковскую карту в течение 21 (двадцати одного) рабочего дня со дня получения «Заявление о возврате денежных средств» Компанией.
        <br>
        <br>
        Для возврата денежных средств по операциям проведенными с ошибками необходимо обратиться с письменным заявлением и приложением копии паспорта и чеков/квитанций, подтверждающих ошибочное списание. Данное заявление необходимо направить по адресу zakaz@levitacia.co
        <br><br>
        Сумма возврата будет равняться сумме покупки. Срок рассмотрения Заявления и возврата денежных средств начинает исчисляться с момента получения Компанией Заявления и рассчитывается в рабочих днях без учета праздников/выходных дней.
        <br><br>
        На всю текстильную продукцию _levitacia^ действует гарантия от производителя 30 дней.
    </div>
</div>
<?}?>


<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("TITLE", "Вход / _Levitacia^");
$APPLICATION->SetPageProperty("description", "Вход / _Levitacia^");
$APPLICATION->SetTitle("Вход / _Levitacia^");
global $USER;
global $USER;
if (!$USER->IsAdmin()):
    if ($USER->IsAuthorized()) {
        LocalRedirect('/personal/');
    }
endif;

?><div class="lk-acc tabs">
	<div class="lk-nav">
        <a href="#lk-acc1" class="lk-nav__item active">Вход</a> <a href="#lk-acc2" class="lk-nav__item">Создать аккаунт</a>
	</div>
    <?$APPLICATION->IncludeComponent(
        "bitrix:system.auth.authorize",
        ".default",
        Array(
            "COMPONENT_TEMPLATE" => ".default",
            "FORGOT_PASSWORD_URL" => "",
            "PROFILE_URL" => SITE_DIR."personal/",
            "REGISTER_URL" => "",
            "SHOW_ERRORS" => "Y",
            "AUTH_SERVICES" => "Y"
        )
    );
    $APPLICATION->IncludeComponent(
        "bitrix:system.auth.registration",
        ".default",
        Array(
            "AUTH" => "Y",
            "COMPONENT_TEMPLATE" => ".default",
            "REQUIRED_FIELDS" => array(),
            "SET_TITLE" => "N",
            "SHOW_FIELDS" => array(),
            "SUCCESS_PAGE" => SITE_DIR."personal/",
            "USER_PROPERTY" => array(),
            "USER_PROPERTY_NAME" => "",
            "USE_BACKURL" => "Y",
            "SHOW_ERRORS" => "Y",
        )
    );?>
</div>
<script>

    
    IMask(document.getElementById('email'), {
        mask: '+{7}(000)000-00-00'
            /*[
          {
            mask: '+00 {21} 0 000 0000',
            startsWith: '30',
            lazy: false,
            country: 'Greece'
          },
          {
            mask: '+0 (000) 000-00-00',
            startsWith: '7',
            maxLength: 11,
            lazy: false,
            country: 'Russia'
          },
          {
            mask: '+00-0000-000000',
            startsWith: '91',
            lazy: false,
            country: 'India'
          },
          {
            mask: '',
            startsWith: '8',
            country: 'unknown'
          },
          {
            mask: /^\S*@?\S*$/,
            startsWith: '',
            country: 'unknown'
          },
        ]*/,
        dispatch: function (appended, dynamicMasked) {
          var number = (dynamicMasked.value + appended).replace(/\D/g,'');
    
          return dynamicMasked.compiledMasks.find(function (m) {
            return number.indexOf(m.startsWith) === 0;
          });
        }
      }
    );
    IMask(document.querySelector('[name="USER_EMAIL"]'), {
        mask: [
          {
            mask: '+0 (000) 000-00-00',
            startsWith: '7',
            maxLength: 11,
            country: 'Russia'
          },
          {
            mask: '',
            startsWith: '8',
            country: 'unknown'
          },
          {
            mask: /^\S*@?\S*$/,
            startsWith: '',
            country: 'unknown'
          },
        ],
        dispatch: function (appended, dynamicMasked) {
          var number = (dynamicMasked.value + appended).replace(/\D/g,'');
    
          return dynamicMasked.compiledMasks.find(function (m) {
            return number.indexOf(m.startsWith) === 0;
          });
        }
      }
    );
</script>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
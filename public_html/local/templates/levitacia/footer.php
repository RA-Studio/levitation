<?
if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
	die();
?>
<?global $USER;
if($USER->IsAdmin()){?>
    <?if (CSite::InDir('/index.php')){?>
        <?$APPLICATION->IncludeComponent(
            "bitrix:sender.subscribe",
            "bottomSubscribe",
            array(
                "AJAX_MODE" => "Y",
                "AJAX_OPTION_ADDITIONAL" => "",
                "AJAX_OPTION_HISTORY" => "N",
                "AJAX_OPTION_JUMP" => "N",
                "AJAX_OPTION_STYLE" => "Y",
                "CACHE_TIME" => "3600",
                "CACHE_TYPE" => "N",
                "CONFIRMATION" => "N",
                "HIDE_MAILINGS" => "Y",
                "SET_TITLE" => "N",
                "SHOW_HIDDEN" => "Y",
                "USER_CONSENT" => "N",
                "USER_CONSENT_ID" => "0",
                "USER_CONSENT_IS_CHECKED" => "N",
                "USER_CONSENT_IS_LOADED" => "N",
                "USE_PERSONALIZATION" => "N",
                "COMPONENT_TEMPLATE" => "bottomSubscribe"
            ),
            false
        );?>
    <?}?>
<?}else{?>

<?}?>

</div>
<?

if(ERROR_404 !== 'Y') {
    ?><footer class="footer">
    <div class="footer-toTop <?$APPLICATION->ShowProperty('toTopClass')?>"></div>
    <div class="footer-top">
        <div class="footer-top-col"><?
            $APPLICATION->IncludeFile(
                SITE_TEMPLATE_PATH . "/include/copyright.php",
                array(),
                array(
                    "NAME" => "Копирайт",
                    "MODE" => "html"
                )
            );
            $APPLICATION->IncludeFile(
                SITE_TEMPLATE_PATH . "/include/developer.php",
                array(),
                array(
                    "NAME" => "Данные о разработчике",
                    "MODE" => "html"
                )
            ); ?>
        </div><?
        $APPLICATION->IncludeComponent(
            "bitrix:menu",
            "bottom",
            Array(
                "ALLOW_MULTI_SELECT" => "N",
                "CHILD_MENU_TYPE" => "left",
                "COMPONENT_TEMPLATE" => ".default",
                "DELAY" => "Y",
                "MAX_LEVEL" => "1",
                "MENU_CACHE_GET_VARS" => "",
                "MENU_CACHE_TIME" => "3600",
                "MENU_CACHE_TYPE" => "N",
                "MENU_CACHE_USE_GROUPS" => "Y",
                "ROOT_MENU_TYPE" => "bottom",
                "USE_EXT" => "Y"
            )
        );
        ?></div>
</footer>
<?
}
?></div>

<?if(isset($_GET['ORDER_ID'])):?>
    <script>
        $(document).ready(function () {
            let products = JSON.parse(localStorage.getItem('products'));
            let orderID = `<?=$_GET['ORDER_ID']?$_GET['ORDER_ID']:''?>`;
            let total = localStorage.getItem('purcaseSum');
            if(products && orderID){
                ga('require', 'ecommerce');
                ga('ecommerce:addTransaction', {
                    'id': orderID,
                    'revenue': total,
                    'affiliation': 'levitacia.co',
                    'currency': 'RUB',
                });
                for (var i = 0; i < products.length; i++) {
                    ga('ecommerce:addItem', {
                        'id': orderID,
                        'name': products[i].name,
                        'sku': products[i].id,
                        'price': products[i].price,
                        'quantity': products[i].quantity,
                        'category': products[i].variant
                    });
                }
                gtag('event', 'purchase', {
                    "transaction_id": orderID,
                    "items": products
                });
                ga('ecommerce:send');

                dataLayer.push({
                    "ecommerce": {
                        "purchase": {
                            "actionField": {
                                "id": orderID
                            },
                            "products": products

                        }
                    },
                    'event': 'gtm-ee-event',
                    'gtm-ee-event-category': 'Enhanced Ecommerce',
                    'gtm-ee-event-action': 'Purchase',
                    'gtm-ee-event-non-interaction': 'False',
                });
                setTimeout(() => {
                    localStorage.removeItem('products');
                    localStorage.removeItem('purcaseSum');
                    ga('ecommerce:clear');
                }, 400);
                console.log(dataLayer);
                console.log(window.gtag);
                console.log(window.ga);
                console.log('Google Analytics Send');
            }
        });
    </script>
<?endif;?>

<script type="text/javascript">
    window.addEventListener('onBitrixLiveChat', function(event)
    {
        var widget = event.detail.widget;
        widget.subscribe({
            type: BX.LiveChatWidget.SubscriptionType.widgetOpen,
            callback: function(data) {
                if (typeof(dataLayer) == 'undefined')
                {
                    dataLayer = [];
                }
                dataLayer.push({
                    "ecommerce": {
                        "purchase": {
                            "actionField": {
                                "id" : "chatsend1",
                                "goal_id" : "96903822"
                            },
                            "products": [ {} ]
                        }
                    }
                });
                //console.log(dataLayer);
                ym(54643042, 'reachGoal', 'chatsend1');
                return true;
            }
        });
    });

</script>

</body>
</html>

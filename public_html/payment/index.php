<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("TITLE", "Оплата");
$APPLICATION->SetTitle("Оплата");
?>

  <div class="container inner">
    <div class="text__content">
      <h1 class="title"><?=$APPLICATION->ShowTitle(false)?></h1>
      <p>
         Оплатить товар отправленный в корзину Интернет-магазина можно на сайте банковской картой.
      </p>
      <p>
         Принимаются к оплате:<br>
      </p>

      <div class="payment-imgbox">
        <img alt="visa" src="https://internation.co/upload/iblock/svg_sposobi_oplati/visa.svg">
        <img alt="mastercard" src="https://internation.co/upload/iblock/svg_sposobi_oplati/mastercard.svg">
        <img alt="maestro.svg" src="https://internation.co/upload/iblock/svg_sposobi_oplati/maestro.svg">
        <img alt="mir" src="https://internation.co/upload/iblock/svg_sposobi_oplati/mir.svg">
        <img alt="alfabank" src="<?=SITE_TEMPLATE_PATH?>/assets/images/AlfaBank.png">
      </div>

      <p>
         • выбрали понравившийся товар<br>
         • определились с цветом и размером<br>
         • добавили в корзину<br>
         • выбрали способ доставки и оплаты<br>
         • совершили оплату или выбрали оплату наличными/картой, курьеру/ПВЗ*, после чего Вы получите на почту письмо с номером Вашего заказа и чеком в электронном виде (при оплате на сайте). Когда товар будет передан курьеру, Вам так же придёт уведомление на почту, что Ваш товар уже в пути и скоро будет у Вас.
      </p><br>
      <p>
         Мы заботимся о Вашей безопасности и наш сайт поддерживает безопасную передачу данных по протоколу SSL. Наличие и актуальность протокола безопасности (передача данных и ввод каких-либо цифровых и буквенных значений зашифрован) определяется автоматически вашим браузером с устройства которого вы заходите, Вы поймёте это увидев значок замка или выделенную зелёным цветом адресную строку.
      </p>
    </div>
  </div>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
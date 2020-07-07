<?php
// подключаем библиотеку
require_once('tcpdf/tcpdf.php');

function num2str($num)
{
    $nul = 'ноль';
    $ten = array(
        array('', 'один', 'два', 'три', 'четыре', 'пять', 'шесть', 'семь', 'восемь', 'девять'),
        array('', 'одна', 'две', 'три', 'четыре', 'пять', 'шесть', 'семь', 'восемь', 'девять'),
    );
    $a20 = array('десять', 'одиннадцать', 'двенадцать', 'тринадцать', 'четырнадцать', 'пятнадцать', 'шестнадцать', 'семнадцать', 'восемнадцать', 'девятнадцать');
    $tens = array(2 => 'двадцать', 'тридцать', 'сорок', 'пятьдесят', 'шестьдесят', 'семьдесят', 'восемьдесят', 'девяносто');
    $hundred = array('', 'сто', 'двести', 'триста', 'четыреста', 'пятьсот', 'шестьсот', 'семьсот', 'восемьсот', 'девятьсот');
    $unit = array( // Units
        array('копейка', 'копейки', 'копеек', 1),
        array('рубль', 'рубля', 'рублей', 0),
        array('тысяча', 'тысячи', 'тысяч', 1),
        array('миллион', 'миллиона', 'миллионов', 0),
        array('миллиард', 'милиарда', 'миллиардов', 0),
    );
    //
    list($rub, $kop) = explode('.', sprintf("%015.2f", floatval($num)));
    $out = array();
    if (intval($rub) > 0) {
        foreach (str_split($rub, 3) as $uk => $v) { // by 3 symbols
            if (!intval($v)) continue;
            $uk = sizeof($unit) - $uk - 1; // unit key
            $gender = $unit[$uk][3];
            list($i1, $i2, $i3) = array_map('intval', str_split($v, 1));
            // mega-logic
            $out[] = $hundred[$i1]; # 1xx-9xx
            if ($i2 > 1) $out[] = $tens[$i2] . ' ' . $ten[$gender][$i3]; # 20-99
            else $out[] = $i2 > 0 ? $a20[$i3] : $ten[$gender][$i3]; # 10-19 | 1-9
            // units without rub & kop
            if ($uk > 1) $out[] = morph($v, $unit[$uk][0], $unit[$uk][1], $unit[$uk][2]);
        } //foreach
    } else $out[] = $nul;
    $out[] = morph(intval($rub), $unit[1][0], $unit[1][1], $unit[1][2]); // rub
    $out[] = $kop . ' ' . morph($kop, $unit[0][0], $unit[0][1], $unit[0][2]); // kop
    return trim(preg_replace('/ {2,}/', ' ', join(' ', $out)));
}

function morph($n, $f1, $f2, $f5)
{
    $n = abs(intval($n)) % 100;
    if ($n > 10 && $n < 20) return $f5;
    $n = $n % 10;
    if ($n > 1 && $n < 5) return $f2;
    if ($n == 1) return $f1;
    return $f5;
}

// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

$fontname = TCPDF_FONTS::addTTFfont($_SERVER['DOCUMENT_ROOT'] . 'tcpdf/fonts/arial.ttf', 'TrueTypeUnicode', '', 32);
$pdf->SetFont($fontname, '', 12);

$pdf->AddPage();
$html = '
<div >
    <div >';
$pdf->writeHTML($html, false, false, false, false, '');
$html = '
        <div><span>Директору ООО «РИВОЛТА»</span></div>
        <div><span>Мелконяну А. А.</span></div>
        <div><span >от, Василевича Александра Сергеевича,</span></div>
        <div><span class="cls_002">Проживающей(его) по адресу:</span></div>
        <div><span class="cls_002">г.Санкт-Петербург ул.Плуталова д.4</span></div>
        <div><span class="cls_002">Паспорт серия: ВМ №1895707</span></div>
        <div><span class="cls_002">Выдан: Полоцким ГОВД Витебской области</span></div>
        <div><span class="cls_002"> 21.10.2018</span></div>
        <div><span class="cls_002">Телефон: +79215795833</span></div>
        ';
$pdf->writeHTML($html, false, false, false, false, 'R');
$html = '
        <div><span class="cls_003">ЗАЯВЛЕНИЕ</span></div>
        <div><span class="cls_004">на возврат товара</span></div>
        <div><span class="cls_004">20.04.2020 г. я приобрел(а) в вашем магазине товар(ы)</span></div>
        <div><span class="cls_004"> Артикул: 4iPXSMAX06191; Наименование: Азиатский ремень (синий); Цвет / размер: синий;</span></div>
        <div><span class="cls_004">Возвращаю товар в связи с тем, что он Херовый</span></div>
        <div ><span class="cls_004">Товар не был в употреблении, сохранен товарный вид, потребительские свойства, пломбы, фабричные ярлыки. </span></div>
        <div ><span class="cls_004">В соответствии с п. 2 ст. 25 Закона РФ от 07.02.1992 № 2300-1 «О защите прав потребителей» я отказываюсь от исполнения договора куплипродажи и прошу вернуть мне уплаченную за товар денежную сумму в размере: </span><span class="cls_004">' . num2str(21000) . '</span></div>
        <div><span class="cls_004">Возвращаемые денежные средства прошу перечислить по банковским реквизитам:</span></div>
        <div><span class="cls_002">наименование и реквизиты банка: БИК, кор./счет, расчетный счет получателя</span></div>
        ';
$pdf->writeHTML($html, false, false, false, false, 'C');
$html = '<div></div>
        <div><span class="cls_002">«13» МАРТА 2020 г.</span></div>
        <div><span class="cls_002">';
//$img_base64_encoded = $_POST['FIELDS']['SIGNATURE'];
//$img = '<img src="@' . preg_replace('#^data:image/[^;]+;base64,#', '', $img_base64_encoded) . '">';
//$pdf->writeHTML($img, true, false, true, false, '');
$html = '</span> <span class="cls_002">(расшифровка)</span></div>
       ';
$pdf->writeHTML($html, false, false, false, false, 'L');
$html = '
    </div>
</div>';
$pdf->writeHTML($html, false, false, false, false, '');

//Close and output PDF document
//$pdf->Output('example_1.pdf', 'I');
ob_clean();
$pdf->Output($_SERVER['DOCUMENT_ROOT'] . 'output.pdf', 'F');
?>
<?= $_SERVER['HTTP_ORIGIN'] . '/output.pdf' ?>


<!--<div class="banners">
    <a class="banners-item" href="#" style="background-image:url('<?/*=SITE_TEMPLATE_PATH*/?>/assets/images/banners-item.jpg')">
        <span style="bottom: 100px">Special Offer</span>
    </a>
    <a class="banners-item" href="#" style="background-image:url('<?/*=SITE_TEMPLATE_PATH*/?>/assets/images/banners-item.jpg')">
        <span style="bottom: 100px">Special Offer</span>
    </a>
    <a class="banners-item" href="#" style="background-image:url('<?/*=SITE_TEMPLATE_PATH*/?>/assets/images/banners-item.jpg')">
        <span style="bottom: 100px">Special Offer</span>
    </a>
</div>-->
<?$APPLICATION->IncludeComponent(
    "bitrix:news.list",
    "stockSide",
    array(
        "ACTIVE_DATE_FORMAT" => "d.m.Y",
        "ADD_SECTIONS_CHAIN" => "N",
        "AJAX_MODE" => "N",
        "AJAX_OPTION_ADDITIONAL" => "",
        "AJAX_OPTION_HISTORY" => "N",
        "AJAX_OPTION_JUMP" => "N",
        "AJAX_OPTION_STYLE" => "Y",
        "CACHE_FILTER" => "N",
        "CACHE_GROUPS" => "Y",
        "CACHE_TIME" => "36000000",
        "CACHE_TYPE" => "A",
        "CHECK_DATES" => "Y",
        "COMPONENT_TEMPLATE" => "stockSide",
        "DETAIL_URL" => "",
        "DISPLAY_BOTTOM_PAGER" => "N",
        "DISPLAY_DATE" => "Y",
        "DISPLAY_NAME" => "Y",
        "DISPLAY_PICTURE" => "Y",
        "DISPLAY_PREVIEW_TEXT" => "Y",
        "DISPLAY_TOP_PAGER" => "N",
        "FIELD_CODE" => array(
            0 => "",
            1 => "",
        ),
        "FILE_404" => "",
        "FILTER_NAME" => "",
        "HIDE_LINK_WHEN_NO_DETAIL" => "N",
        "IBLOCK_ID" => "1",
        "IBLOCK_TYPE" => "content",
        "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
        "INCLUDE_SUBSECTIONS" => "N",
        "NEWS_COUNT" => "20",
        "PAGER_BASE_LINK_ENABLE" => "N",
        "PAGER_DESC_NUMBERING" => "N",
        "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
        "PAGER_SHOW_ALL" => "N",
        "PAGER_SHOW_ALWAYS" => "N",
        "PAGER_TEMPLATE" => ".default",
        "PAGER_TITLE" => "Новости",
        "PARENT_SECTION" => "",
        "PARENT_SECTION_CODE" => "",
        "PREVIEW_TRUNCATE_LEN" => "100",
        "PROPERTY_CODE" => array(
            0 => "UF_BOTTOM",
            1 => "",
        ),
        "SET_BROWSER_TITLE" => "N",
        "SET_LAST_MODIFIED" => "N",
        "SET_META_DESCRIPTION" => "N",
        "SET_META_KEYWORDS" => "N",
        "SET_STATUS_404" => "Y",
        "SET_TITLE" => "N",
        "SHOW_404" => "Y",
        "SORT_BY1" => "ACTIVE_FROM",
        "SORT_BY2" => "SORT",
        "SORT_ORDER1" => "DESC",
        "SORT_ORDER2" => "ASC",
        "STRICT_SECTION_CHECK" => "N"
    ),
    false
);?>


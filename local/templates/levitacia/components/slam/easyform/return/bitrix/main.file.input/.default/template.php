<?if(!defined("B_PROLOG_INCLUDED")||B_PROLOG_INCLUDED!==true)die();
/**
 * @var array $arParams
 * @var array $arResult
 */
/*?><input type="radio" name="tabs" id="file" value="file" /><label class="mfi-tab-header mfi-tab-header-file" for="file">File</label>
<input type="radio" name="tabs" id="camera" value="camera" /><label class="mfi-tab-header mfi-tab-header-camera" for="camera">Camera</label>
<ul class="tabs">
	<li class="mfi-tab-body-canvas">
		<div class="webform-field-upload">
			<span class="webform-small-button webform-button-upload" id="mfi-#id#-snapshot" >Try again</span>
		</div>
		<canvas id="mfi-#id#-snapshot-canvas"></canvas>
	</li>
	<li class="mfi-tab-body-file">
		<input type="file" >
	</li>
	<li class="mfi-tab-body-camera">
		<div id="mfi-#id#-snapshot-area">
			<video autoplay id="mfi-#id#-snapshot-video"></video>
			<div id="mfi-#id#-snapshot-button">Take snapshot</div>
		</div>
	</li>
</ul>
<?*/

if ($arParams["SHOW_AVATAR_EDITOR"] == "Y")
{
	\CJSCore::Init(array("webrtc_adapter", "avatar_editor"));
}
else
{
	\CJSCore::Init(array("uploader"));
}

$request = \Bitrix\Main\Context::getCurrent()->getRequest();
if ($arParams["ALLOW_UPLOAD"] == "N" && empty($arResult['FILES']))
	return "";
$cnt = count($arResult['FILES']);
$id = CUtil::JSEscape($arParams['CONTROL_ID']);
if ($arParams['MULTIPLE'] == 'Y' && substr($arParams['INPUT_NAME'], -2) !== "[]")
	$arParams['INPUT_NAME'] .= "[]";
$thumbForUploaded = <<<HTML
<a href="#url#" target="_blank" data-bx-role="file-name" class="upload-file-name">#name#</a>&nbsp;<span class="upload-file-size" data-bx-role="file-size">#size#</span>
<input id="file-#file_id#" data-bx-role="file-id" type="hidden" name="#input_name#" value="#file_id#" />
<div class="return-label_success__delete" data-bx-role="file-delete"></div>
HTML;
$thumb = <<<HTML
<div class="webform-field-item-wrap"><span class="webform-field-upload-icon webform-field-upload-icon-#ext#" data-bx-role="file-preview"></span>
<a href="#" target="_blank" data-bx-role="file-name" class="upload-file-name">#name#</a>&nbsp;<span class="upload-file-size" data-bx-role="file-size">#size#</span><div class="return-label_success__delete" data-bx-role="file-delete"></div></div>
HTML;
?>
<div class="file-input file-extended">
    <div class="return-label_success"  id="mfi-<?=$arParams['CONTROL_ID']?>"><?
        foreach ($arResult['FILES'] as $file)
        {
            $ext = GetFileExtension($file['ORIGINAL_NAME']);
            $isImage = CFile::IsImage($file["ORIGINAL_NAME"], $file["CONTENT_TYPE"]);
            $t = ($isImage ? CFile::ResizeImageGet($file, array( "width" => 100, "height" => 100 ), BX_RESIZE_IMAGE_EXACT, false) : array("src" => "/bitrix/images/1.gif"));
            ?><span><?=str_replace(
            array("#input_name#", "#file_id#", "#name#", "#size#", "#url#", "#url_delete#", "#preview_url#", "#ext#"),
            array($arParams['INPUT_NAME'],
                intval($file['ID']),
                htmlspecialcharsEx($file['ORIGINAL_NAME']),
                CFile::FormatSize($file["FILE_SIZE"]),
                $file["URL"],
                $file["URL_DELETE"],
                $t["src"],
                $ext
            ),
            $thumbForUploaded
        )?></span><?
        }
        ?></div>


	<?if ($arParams["ALLOW_UPLOAD"] != "N")
	{
		?><label for="file_input_<?=$arParams['CONTROL_ID']?>" class="webform-field-upload return-label_file" id="mfi-<?=$arParams['CONTROL_ID']?>-button"><?
			if (isset($arParams["INPUT_CAPTION"]) && !empty($arParams["INPUT_CAPTION"]))
			{
				$inputCaption = $arParams["INPUT_CAPTION"];
			}
			else
			{
				$inputCaption = ($arParams["ALLOW_UPLOAD"] == "I" ? GetMessage('MFI_INPUT_CAPTION_ADD_IMAGE') : GetMessage('MFI_INPUT_CAPTION_ADD'));
			}
			?><span class="btn btn-primary webform-small-button webform-button-upload"><?=$inputCaption?></span><?
			if ($arParams["MULTIPLE"] == "N")
			{
				?><span class="webform-small-button webform-button-replace"><?=($arParams["ALLOW_UPLOAD"] == "I" ? GetMessage('MFI_INPUT_CAPTION_REPLACE_IMAGE') : GetMessage('MFI_INPUT_CAPTION_REPLACE'))?></span><?
			}
			if ($arParams["SHOW_AVATAR_EDITOR"] == "Y" && $arParams["ALLOW_UPLOAD"] == "I")
			{
				?><input type="button" id="mfi-<?=$arParams['CONTROL_ID']?>-editor" /><?
			}
			else
			{
				?><input type="file" id="file_input_<?=$arParams['CONTROL_ID']?>" <?=$arParams["MULTIPLE"] === 'Y' ? ' multiple="multiple"' : ''?> /><?
			}
		?></label><?
	} ?>


</div>
<script type="text/javascript">
    BX.message(<?=CUtil::PhpToJSObject(array(
        "MFI_THUMB" => $thumb,
        "MFI_THUMB2" => $thumbForUploaded,
        "MFI_UPLOADING_ERROR" => GetMessage("MFI_UPLOADING_ERROR")
    ))?>);
    BX.ready(function(){
        BX.MFInput.init(<?=CUtil::PhpToJSObject(array(
            "controlId" => $arParams['CONTROL_ID'],
            "controlUid" => $arParams['CONTROL_UID'],
            "controlSign" => $arParams["CONTROL_SIGN"],
            "inputName" => $arParams['INPUT_NAME'],
            "maxCount" => $arParams["MULTIPLE"] == "N" ? 1 : 0,
            "moduleId" => $arParams["MODULE_ID"],
            "forceMd5" => $arParams["FORCE_MD5"],

            "allowUpload" => $arParams["ALLOW_UPLOAD"],
            "allowUploadExt" => $arParams["ALLOW_UPLOAD_EXT"],
            "uploadMaxFilesize" => $arParams['MAX_FILE_SIZE'],
            "enableCamera" => $arParams['ENABLE_CAMERA'] !== "N",

            "urlUpload" => $arParams["URL_TO_UPLOAD"]
        ))?>);
    });
</script>
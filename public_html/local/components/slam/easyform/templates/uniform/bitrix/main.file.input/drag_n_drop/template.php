<?if(!defined("B_PROLOG_INCLUDED")||B_PROLOG_INCLUDED!==true)die();
if ($arParams["ALLOW_UPLOAD"] == "N" && empty($arResult['FILES']))
	return "";

CJSCore::Init(array('fx', 'ajax', 'dd'));
$APPLICATION->AddHeadScript('/bitrix/js/main/file_upload_agent.js');
$uid = $arParams['CONTROL_ID'];
$controller = "BX('file-selectdialog-".$uid."')";
$switcher = "BX('file-selectdialogswitcher-".$uid."')";
$controlName = $arParams['INPUT_NAME'];
$controlNameFull = $controlName . (($arParams['MULTIPLE'] == 'Y') ? '[]' : '');
$arValue = $arResult['FILES'];
$addClass = ((strpos($_SERVER['HTTP_USER_AGENT'], 'Mac OS') !== false) ? 'file-filemacos' : '');
$controlNameFull1 = htmlspecialcharsbx($controlNameFull);
$thumb = <<<HTML
<tr class="file-inline-file" id="wd-doc#element_id#">
	<td class="files-name">
		<span class="files-text">
			<span class="f-wrap">#name#</span>
		</span>
	</td>
	<td class="files-size">#size#</td>
	<td class="files-storage">
		<div class="files-storage-block">&nbsp;
			<span class='del-but' onclick="BfileFD{$uid}.agent.StopUpload(BX('wd-doc#element_id#'));"></span>
			<span class="files-placement">&nbsp;</span>
			<input id="file-doc#element_id#" type="hidden" name="{$controlNameFull1}" value="#element_id#" />
		</div>
	</td>
</tr>
HTML;

if ($arParams["ALLOW_UPLOAD"] != "N")
{
?>
<!--a href="javascript:void(0);" id="file-selectdialogswitcher-<?=$uid?>" class="file-selectdialog-switcher" <?
	?>onclick="BX.onCustomEvent(this.parentNode, 'BFileDLoadFormController');return false;"><span><?
		?><?=($arParams["ALLOW_UPLOAD"] == "I" ? GetMessage("BFDND_UPLOAD_IMAGES") : GetMessage("BFDND_UPLOAD_FILES"))?></span></a-->
<div id="file-selectdialog-<?=$uid?>" class="file-selectdialog">
	<table id="file-file-template" style='display:none;'>
		<tr class="file-inline-file" id="file-doc">
			<td class="files-name">
				<span class="files-text">
					<span class="f-wrap" data-role='name'>#name#</span>
				</span>
			</td>
			<td class="files-size" data-role='size'>#size#</td>
			<td class="files-storage">
				<div class="files-storage-block">
					<span class="files-placement">&nbsp;</span>
				</div>
			</td>
		</tr>
	</table>
	<div id="file-image-template" style='display:none;'>
		<span class="feed-add-photo-block">
			<span class="feed-add-img-wrap">
				<img width="90" height="90" border="0" data-role='image'>
			</span>
			<span class="feed-add-img-title" data-role='name'>#name#</span>
			<span class="feed-add-post-del-but"></span>
		</span>
	</div>
	<div class="file-extended">
	<?
	if($arParams['HIDE_FIELD_NAME']):
		?>
		<span class="file-label"><?=$arParams['INPUT_TITLE'] ? : GetMessage('BFDND_FILES')?></span>
	<?endif?>
		<div class="file-placeholder">
			<table class="files-list" cellspacing="0">
				<tbody class="file-placeholder-tbody">
				<?if (is_array($arValue) && sizeof($arValue) > 0)
				{
					foreach ($arValue as $arElement)
					{
						?><?=str_replace(
							array("#element_id#", "#name#", "#size#"),
							array(intval($arElement['ID']), htmlspecialcharsEx($arElement['ORIGINAL_NAME']), CFile::FormatSize($arElement["FILE_SIZE"])),
							$thumb
						);
					}
				}?>
				</tbody>
			</table>
		</div>
		<label class="general-itemInput_file__label">
            <p style="display: flex;">
                <!--<div class="general-itemInput__exit">
                    <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="14px" height="14px" viewBox="0 0 357 357" style="enable-background:new 0 0 357 357;" xml:space="preserve"><g id="close"><polygon points="357,35.7 321.3,0 178.5,142.8 35.7,0 0,35.7 142.8,178.5 0,321.3 35.7,357 178.5,214.2 321.3,357 357,321.3 214.2,178.5 "></polygon></g></svg>
                </div>-->
            <svg width="17" height="20" viewBox="0 0 17 20" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M10 11.5V6C10 4.93913 9.57857 3.92172 8.82843 3.17157C8.07828 2.42143 7.06087 2 6 2C4.93913 2 3.92172 2.42143 3.17157 3.17157C2.42143 3.92172 2 4.93913 2 6V11.5C2 13.2239 2.68482 14.8772 3.90381 16.0962C5.12279 17.3152 6.77609 18 8.5 18C10.2239 18 11.8772 17.3152 13.0962 16.0962C14.3152 14.8772 15 13.2239 15 11.5V2H17V11.5C17 13.7543 16.1045 15.9163 14.5104 17.5104C12.9163 19.1045 10.7543 20 8.5 20C6.24566 20 4.08365 19.1045 2.48959 17.5104C0.895533 15.9163 0 13.7543 0 11.5V6C0 4.4087 0.632141 2.88258 1.75736 1.75736C2.88258 0.632141 4.4087 0 6 0C7.5913 0 9.11742 0.632141 10.2426 1.75736C11.3679 2.88258 12 4.4087 12 6V11.5C12 12.4283 11.6313 13.3185 10.9749 13.9749C10.3185 14.6313 9.42826 15 8.5 15C7.57174 15 6.6815 14.6313 6.02513 13.9749C5.36875 13.3185 5 12.4283 5 11.5V6H7V11.5C7 11.8978 7.15804 12.2794 7.43934 12.5607C7.72064 12.842 8.10218 13 8.5 13C8.89782 13 9.27936 12.842 9.56066 12.5607C9.84196 12.2794 10 11.8978 10 11.5Z" fill="black" fill-opacity="0.5"/></svg>
            <?=$arParams['TITLE']?>
            </p>
			<span class="file-uploader">
                <input class="file-fileUploader <?=$addClass?>" id="file-fileUploader-<?=$uid?>" type="file" multiple='multiple' size='1' />
            </span>
			<?
			if (!empty($arParams["ALLOW_UPLOAD_EXT"]) || $arParams['MAX_FILE_SIZE'] > 0)
			{
				$message = ((!empty($arParams["ALLOW_UPLOAD_EXT"]) && $arParams['MAX_FILE_SIZE'] > 0) ? GetMessage("MFI_NOTICE_1") : (
				!empty($arParams["ALLOW_UPLOAD_EXT"]) ? GetMessage("MFI_NOTICE_2") : GetMessage("MFI_NOTICE_3")
				));
				?><div STYLE="display: none" class="webform-field-upload-notice"><?=str_replace(array("#ext#", "#size#"), array(htmlspecialcharsBx($arParams["ALLOW_UPLOAD_EXT"]), CFile::FormatSize($arParams['MAX_FILE_SIZE'])), $message);?></div><?
			}
			?>
		</label>
	</div>
	<div class="file-simple" style='padding:0; margin:0;'>
	<?
	if($arParams['HIDE_FIELD_NAME']):
		?>
		<span class="file-label"><?=$arParams['INPUT_TITLE'] ? : GetMessage('BFDND_FILES')?></span>
	<?endif;?>
		<div class="file-placeholder">
			<table class="files-list" cellspacing="0">
				<tbody class="file-placeholder-tbody">
					<tr style='display: none;'><td colspan='3'></td></tr><?
					if (is_array($arValue) && sizeof($arValue) > 0)
					{
						foreach ($arValue as $arElement)
						{
							?><?=str_replace(
								array("#element_id#", "#name#", "#size#"),
								array(intval($arElement['ID']), htmlspecialcharsEx($arElement['ORIGINAL_NAME']), CFile::FormatSize($arElement["FILE_SIZE"])),
								$thumb
							);
						}
					}?>
				</tbody>
			</table>
		</div>
		<div class="file-selector"><span class="file-uploader"><span class="file-uploader-left"></span><span class="file-but-text"><?=GetMessage('BFDND_SELECT_LOCAL');?></span><span class="file-uploader-right"></span><input class="file-fileUploader <?=$addClass?>" id="file-fileUploader-<?=$uid?>" type="file" <?/*multiple='multiple'*/?> size='1' /></span></div></div>
	<script>
	BX.ready(function(){

		BX.message({
			'loading' : "<?=(GetMessageJS('BFDND_FILE_LOADING'))?>",
			'file_exists':"<?=(GetMessageJS('BFDND_FILE_EXISTS'))?>",
			'upload_error':"<?=(GetMessageJS('BFDND_UPLOAD_ERROR'))?>",
			'access_denied':"<p style='margin-top:0;'><?=(GetMessageJS('BFDND_ACCESS_DENIED'))?></p>"
		});
		BX.addCustomEvent(<?=$controller?>.parentNode, "BFileDLoadFormController", function(status) {
			MFIDD({
					uid : '<?=$uid?>',
					controller : <?=$controller?>,
					switcher : <?=$switcher?>,
					CID : "<?=$arResult['CONTROL_UID']?>",
					id : "<?=$arParams['CONTROL_ID']?>",
					upload_path : "<?=CUtil::JSEscape(htmlspecialcharsback(POST_FORM_ACTION_URI))?>",
					multiple : <?=( $arParams['MULTIPLE'] == 'N' ? 'false' : 'true' )?>,
					inputName : "<?=CUtil::JSEscape($controlName)?>",
					status : status,
					url_css: "<?=str_replace($_SERVER['DOCUMENT_ROOT'], '', realpath(dirname(__FILE__))).'/style.css'?>"
			});
		});


		BX.onCustomEvent(<?=$controller?>, "BFileDLoadFormControllerWasBound", [{id : "<?=$arParams['CONTROL_ID']?>"}]);

		BX.onCustomEvent(<?=$controller?>.parentNode, "BFileDLoadFormController", ['show']);

	});
	</script>
</div>
<?
}
else if (!empty($arValue))
{
?>
<div id="file-selectdialog-<?=$uid?>" class="file-selectdialog">
	<div class="general-itemInput general-itemInput_file">
		<?
		if($arParams['HIDE_FIELD_NAME']):
		?>
		<span class="file-label"><?=$arParams['INPUT_TITLE'] ? : GetMessage('BFDND_FILES')?></span>
		<?endif;?>
		<div class="file-placeholder">
			<table class="files-list" cellspacing="0">
				<tbody class="file-placeholder-tbody">
					<?if (is_array($arValue) && sizeof($arValue) > 0)
					{
						foreach ($arValue as $arElement)
						{
							?><?=str_replace(
								array("#element_id#", "#name#", "#size#"),
								array(intval($arElement['ID']), htmlspecialcharsEx($arElement['ORIGINAL_NAME']), CFile::FormatSize($arElement["FILE_SIZE"])),
								$thumb
							);
						}

					}?>
				</tbody>
			</table>
		</div>
	</div>
	<script>
	BX.ready(function(){
		BX.addCustomEvent(<?=$controller?>.parentNode, "BFileDLoadFormController", function(status) {
		MFIS({
					uid : '<?=$uid?>',
					controller : <?=$controller?>,
					CID : "<?=$arResult['CONTROL_UID']?>",
					id : "<?=$arParams['CONTROL_ID']?>",
					upload_path : "<?=CUtil::JSEscape(htmlspecialcharsback(POST_FORM_ACTION_URI))?>",
					status : status
			});
		});
		BX.onCustomEvent(<?=$controller?>, "BFileDLoadFormControllerWasBound", [{id : "<?=$arParams['CONTROL_ID']?>"}]);
		BX.onCustomEvent(<?=$controller?>.parentNode, "BFileDLoadFormController");
	});
	</script>
</div>
<? } ?>
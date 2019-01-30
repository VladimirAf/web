<?php echo $header; ?>
<div id="content">
	<div class="breadcrumb">
		<?php foreach($breadcrumbs as $breadcrumb) { ?>
		<?php echo $breadcrumb['separator']; ?><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a>
		<?php } ?>
	</div>
	<?php if ($error_warning) { ?>
	<div class="warning"><?php echo $error_warning; ?></div>
	<?php } ?>
	<div class="box">
		<div class="heading">
			<h1><img src="view/image/module.png" alt="" /> <?php echo $heading_title; ?></h1>
			<div class="buttons"><a onClick="$('#form').submit();" class="button"><?php echo $button_save; ?></a> <a href="<?php echo $cancel; ?>" class="button"><?php echo $button_cancel; ?></a></div>
		</div>
		<div class="content">
			<form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form">
				<table class="form">
					<tr>
						<td><?php echo $entry_store; ?></td>
						<td><select name="store_id">
						<?php foreach ($stores as $store) { ?>
						<?php if ($store['store_id'] == $store_id) { ?>
							<option value="<?php echo $store['store_id']; ?>" selected="selected"><?php echo $store['name']; ?></option>
						<?php } else { ?>
							<option value="<?php echo $store['store_id']; ?>"><?php echo $store['name']; ?></option>
						<?php } ?>
						<?php } ?>
						</select></td>
					</tr>
					<tr>
						<td><?php echo $entry_of_text; ?></td>
						<td>
							<div id="languages" class="htabs">
								<?php foreach($languages as $language) { ?>
								<a href="#language<?php echo $language['language_id']; ?>"><img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" /> <?php echo $language['name']; ?></a>
								<?php } ?>
							</div>
							<?php foreach($languages as $language) { ?>
							<div id="language<?php echo $language['language_id']; ?>">
								<textarea name="of[<?php echo $language['language_id']; ?>]" id="description<?php echo $language['language_id']; ?>">
									<?php if (isset($of[$language['language_id']])) { ?>
									<?php echo $of[$language['language_id']]; ?>
									<?php } ?>
								</textarea>
							</div>
							<?php } ?>
						</td>
					</tr>
					<tr>
						<td><?php echo $entry_another_text_if_in_stock; ?></td>
						<td>
							<?php if ($if_stock) { ?>
							<input type="radio" name="if_stock" value="1" checked="checked" />
							<?php echo $text_yes; ?>
							<input type="radio" name="if_stock" value="0" />
							<?php echo $text_no; ?>
							<?php } else { ?>
							<input type="radio" name="if_stock" value="1" />
							<?php echo $text_yes; ?>
							<input type="radio" name="if_stock" value="0" checked="checked" />
							<?php echo $text_no; ?>
							<?php } ?>
						</td>
					</tr>
					<tr>
						<td><?php echo $entry_of_stock; ?></td>
						<td>
							<div id="stock-languages" class="htabs">
								<?php foreach($languages as $language) { ?>
								<a href="#stock-language<?php echo $language['language_id']; ?>"><img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" /> <?php echo $language['name']; ?></a>
								<?php } ?>
							</div>
							<?php foreach($languages as $language) { ?>
							<div id="stock-language<?php echo $language['language_id']; ?>">
								<textarea name="of_stock[<?php echo $language['language_id']; ?>]" id="stock-description<?php echo $language['language_id']; ?>">
									<?php if (isset($of_stock[$language['language_id']])) { ?>
									<?php echo $of_stock[$language['language_id']]; ?>
									<?php } ?>
								</textarea>
							</div>
							<?php } ?>
						</td>
					</tr>
				</table>
			</form>
		</div>
	</div>
</div>
<script type="text/javascript" src="view/javascript/ckeditor/ckeditor.js"></script> 
<script type="text/javascript"><!--
<?php foreach ($languages as $language) { ?>
CKEDITOR.replace('description<?php echo $language['language_id']; ?>', {
	filebrowserBrowseUrl: 'index.php?route=common/filemanager&token=<?php echo $token; ?>',
	filebrowserImageBrowseUrl: 'index.php?route=common/filemanager&token=<?php echo $token; ?>',
	filebrowserFlashBrowseUrl: 'index.php?route=common/filemanager&token=<?php echo $token; ?>',
	filebrowserUploadUrl: 'index.php?route=common/filemanager&token=<?php echo $token; ?>',
	filebrowserImageUploadUrl: 'index.php?route=common/filemanager&token=<?php echo $token; ?>',
	filebrowserFlashUploadUrl: 'index.php?route=common/filemanager&token=<?php echo $token; ?>'
});
CKEDITOR.replace('stock-description<?php echo $language['language_id']; ?>', {
	filebrowserBrowseUrl: 'index.php?route=common/filemanager&token=<?php echo $token; ?>',
	filebrowserImageBrowseUrl: 'index.php?route=common/filemanager&token=<?php echo $token; ?>',
	filebrowserFlashBrowseUrl: 'index.php?route=common/filemanager&token=<?php echo $token; ?>',
	filebrowserUploadUrl: 'index.php?route=common/filemanager&token=<?php echo $token; ?>',
	filebrowserImageUploadUrl: 'index.php?route=common/filemanager&token=<?php echo $token; ?>',
	filebrowserFlashUploadUrl: 'index.php?route=common/filemanager&token=<?php echo $token; ?>'
});
<?php } ?>
//--></script>
<script type="text/javascript"><!--
$('#languages a').tabs();
$('#stock-languages a').tabs();
//--></script>
<script type="text/javascript">
$("select[name='store_id']").bind('change', function() {
	window.location = 'index.php?route=module/oftext&token=<?php echo $token; ?>&store_id=' + $("select[name='store_id']").val();
});
</script>
<?php echo $footer; ?>
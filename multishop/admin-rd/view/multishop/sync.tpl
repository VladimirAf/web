<?php echo $header; ?>
<div id="content">
  <div class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
    <?php echo $breadcrumb['separator']; ?><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a>
    <?php } ?>
  </div>
 <?php  if(isset($error_warning)) { ?>
  <?php foreach($error_warning as $error) { ?>

  <div class="warning">

 <?php echo $error; ?>
 </div>
 <?php } ?>
  
 <?php } else if (isset($success)) { ?>
  <div class="success"><?php echo $success; ?></div>
  <?php } ?>
  <div class="box">
    
    <div class="content">

	<?php 
	if ($show_del) { ?>
	<form id="form_del" action="<?php echo $delete; ?>" method="post">
		<input type="hidden" name="city" value="<?php echo $city; ?>">
		<input type="hidden" name="table_bd" value="<?php echo UNDER_DOMEN; ?>">
		<p><input type="submit" value="удалить старые записи"></p>
	</form>
	<?php } ?>
	
	<form id="form_ins" action="<?php echo $insert; ?>" method="post" >
		<input type="hidden" name="city" value="<?php echo $city; ?>">
		<p>Город:<br />
			<select size="3" multiple="multiple" name="city_view">
	    <?php echo $options_cities; ?>
	        </select>
		</p>
		
		<p>Cуффикс таблиц в БД:<br/><input type="text" name="table_bd" value="<?php echo UNDER_DOMEN; ?>" readonly/>
			<br/><span style="font-style:italic">Данные будут загружены в след.таблицы:<br/>
					product_description_суффикс, product_discount_суффикс,product_special_суффикс,category_to_store,product_to_store</span></p>
		<p><span>Что синхронизируем?</span></p>
	    <p><input name="whtsync" type="radio" value="cat">Только категории</p>
		<p><input name="whtsync" type="radio" value="des_cat_pr" checked>Только описания категорий и товаров</p>
	    <p><input name="whtsync" type="radio" value="alltbl"> Все таблицы (уникальные цены будут утеряны до новой синхронизации с 1С)</p>
		<p><input type="submit" value="Синхронизировать со Смоленском"></p>
	</form>

	<p style="font-style:italic">Все товары Смоленска появятся в выбранном городе. Отличаться будут title,html-h1,meta-description</p>
	
    </div>
  </div>
</div>
<?php echo $footer; ?>
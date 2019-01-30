<?php

class ModelMultishopSync extends Model {
	
   public function getCities() {

	    $query = $this->db->query("SELECT store_id,name,url FROM " . DB_PREFIX . "store ");
	    return $query->rows;
	  }
  
  
  
  public function delete_records(){

	  $query = $this->db->query("SHOW TABLE STATUS IN " .DB_DATABASE ." like '" . DB_PREFIX ."product_description_" .$this->request->post['table_bd'] ."'");
		if ($query->num_rows > 0) {
					$this->db->query("TRUNCATE TABLE " . DB_PREFIX . "product_description_" .$this->request->post['table_bd']);
				}
	  $query = $this->db->query("SHOW TABLE STATUS IN " .DB_DATABASE ." like '" . DB_PREFIX ."product_discount_" .$this->request->post['table_bd'] ."'");
		if ($query->num_rows > 0) {
			$this->db->query("TRUNCATE TABLE " . DB_PREFIX . "product_discount_" .$this->request->post['table_bd']);
		}
	  $query = $this->db->query("SHOW TABLE STATUS IN " .DB_DATABASE ." like '" . DB_PREFIX ."product_special_" .$this->request->post['table_bd'] ."'");
		if ($query->num_rows > 0) {
			 $this->db->query("TRUNCATE TABLE " . DB_PREFIX . "product_special_" .$this->request->post['table_bd']);
		}
	 
	 	  $query = $this->db->query("SHOW TABLE STATUS IN " .DB_DATABASE ." like '" . DB_PREFIX ."category_description_" .$this->request->post['table_bd'] ."'");
		if ($query->num_rows > 0) {
			 $this->db->query("TRUNCATE TABLE " . DB_PREFIX . "category_description_" .$this->request->post['table_bd']);
		}
	
		if ($this->request->post['city'] !=0) {
			$this->db->query("DELETE FROM " . DB_PREFIX . "product_to_store WHERE store_id = '" .$this->request->post['city'] ."'");
			$this->db->query("DELETE FROM " . DB_PREFIX . "category_to_store WHERE store_id = '" .$this->request->post['city'] ."'");
		}
	  return true;
	  
  }
  
  public function validateBD () {
	  
		 $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "category_to_store WHERE store_id='" .$this->request->post['city']  ."' LIMIT 1");
		 $this->log->write("SELECT * FROM " . DB_PREFIX . "category_to_store WHERE store_id='" .$this->request->post['city']  ."' LIMIT 1");	
				if ($query->num_rows > 0) {
					return false;
				}
				
		
		 $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product_to_store WHERE store_id='" .$this->request->post['city']  ."' LIMIT 1");
				if ($query->num_rows > 0) {
					return false;
				}
							
		$query = $this->db->query("SHOW TABLE STATUS IN " .DB_DATABASE ." like '" . DB_PREFIX ."product_description_" .$this->request->post['table_bd'] ."'");

		if ($query->num_rows > 0 && $query->rows[0]['Rows']>0) {
					return false;
				}
				
		$query = $this->db->query("SHOW TABLE STATUS IN " .DB_DATABASE ." like '" . DB_PREFIX ."product_discount_" .$this->request->post['table_bd'] ."'");
		if ($query->num_rows > 0 && $query->rows[0]['Rows']>0) {
					return false;
				}
				
		$query = $this->db->query("SHOW TABLE STATUS IN " .DB_DATABASE ." like '" . DB_PREFIX ."product_special_" .$this->request->post['table_bd'] ."'");
		if ($query->num_rows > 0 && $query->rows[0]['Rows']>0) {
					return false;
				}	

		$query = $this->db->query("SHOW TABLE STATUS IN " .DB_DATABASE ." like '" . DB_PREFIX ."category_description_" .$this->request->post['table_bd'] ."'");
		if ($query->num_rows > 0 && $query->rows[0]['Rows']>0) {
					return false;
				}					
			
		return true;		
	  
  }
  
  public function insert_categories(){

		$this->db->query("CREATE TABLE IF NOT EXISTS `" .DB_PREFIX ."category_description_" .$this->request->post['table_bd'] ."` (
		`category_id` int(11) NOT NULL,
		`meta_description` varchar(255) CHARACTER SET utf8mb4 NOT NULL,
		`description2` text CHARACTER SET utf8mb4 NOT NULL,
		`meta_keyword` varchar(255) DEFAULT NULL,
		`seo_title` varchar(255) CHARACTER SET utf8mb4 NOT NULL,
		`seo_h1` varchar(255) NOT NULL
		) ENGINE=MyISAM DEFAULT CHARSET=utf8;");
		
		if($this->db->query("SHOW INDEX FROM " .DB_PREFIX ."category_description_" .$this->request->post['table_bd'])->num_rows == 0)
			$this->db->query("ALTER TABLE `" .DB_PREFIX ."category_description_" .$this->request->post['table_bd'] ."` ADD UNIQUE KEY `category_id` (`category_id`)");	
		
		$this->db->query("TRUNCATE TABLE " . DB_PREFIX . "category_description_" .$this->request->post['table_bd']);
		
		
		$city_name = $this->db->query("SELECT city,decline FROM " .DB_PREFIX ."store_options WHERE store_id='" .$this->request->post['city'] ."'");
		$city_decline = explode(",",$city_name->rows[0]['decline']);
		$city_name = $city_name->rows[0]['city'];
		
		$this->db->query("UPDATE " .DB_PREFIX ."category_description SET meta_description=REPLACE(REPLACE(REPLACE(REPLACE(meta_description,'+7 (4812) 62-00-00',''),'+7 (4812) 620000',''),'',''),'620000',''),description2=REPLACE(REPLACE(REPLACE(REPLACE(description2,'+7 (4812) 62-00-00',''),'+7 (4812) 620000',''),'',''),'620000','') WHERE meta_description LIKE '%+7 (4812) 62-00-00%' OR meta_description LIKE '%+7 (4812) 620000%' OR meta_description LIKE '%620000%' OR  description2 LIKE '%+7 (4812) 62-00-00%' OR  description2 LIKE '%+7 (4812) 620000%' OR  description2 LIKE '%620000%'");
		$this->db->query("UPDATE " .DB_PREFIX ."category_description SET description=REPLACE(REPLACE(REPLACE(REPLACE(description,'https://remontdoma24.ru',''),'http://remontdoma24.ru',''),'//remontdoma24.ru',''),'remontdoma24.ru',''),description2=REPLACE(REPLACE(REPLACE(REPLACE(description2,'https://remontdoma24.ru',''),'http://remontdoma24.ru',''),'//remontdoma24.ru',''),'remontdoma24.ru','') WHERE description LIKE '%remontdoma24.ru%' OR description2 LIKE '%remontdoma24.ru%'");

		
		$this->db->query("INSERT INTO " . DB_PREFIX . "category_description_" .$this->request->post['table_bd'] ." (category_id,meta_description,seo_title,seo_h1,description2)
						  SELECT category_id,REPLACE(REPLACE(REPLACE(REPLACE(meta_description,'Смоленску','" .$city_decline[1] ."'),'Смоленске','" .$city_decline[0] ."'),'Смоленск','" .$city_name ."'),'".$city_name."ой','" .$city_decline[2] ."'),REPLACE(REPLACE(REPLACE(seo_title,'Смоленску','" .$city_decline[1] ."'),'Смоленске','" .$city_decline[0] ."'),'Смоленск','" .$city_name ."'),REPLACE(REPLACE(REPLACE(seo_h1,'Смоленску','" .$city_decline[1] ."'),'Смоленске','" .$city_decline[0] ."'),'Смоленск','" .$city_name ."'),REPLACE(REPLACE(REPLACE(REPLACE(description2,'Смоленску','" .$city_decline[1] ."'),'Смоленске','" .$city_decline[0] ."'),'Смоленск','" .$city_name ."'),'".$city_name."ой','" .$city_decline[2] ."') FROM " . DB_PREFIX . "category_description");
		
		return true;
  }

  
  public function insert() {

		  $this->db->query("CREATE TABLE IF NOT EXISTS " .DB_PREFIX ."product_description_" .$this->request->post['table_bd'] ."(
			   `product_id` int(11) NOT NULL DEFAULT '0',
		  `language_id` int(11) NOT NULL DEFAULT '1',
		  `price` int(11) NOT NULL DEFAULT '0',
		  `price_as_24` tinyint(1) NOT NULL DEFAULT '1',
		  `name` varchar(120) NOT NULL DEFAULT '',
		  `name_as_24` tinyint(1) NOT NULL DEFAULT '1',
		  `description` text NOT NULL DEFAULT '',
		  `description_as_24` tinyint(1) NOT NULL DEFAULT '1',
		  `meta_description` varchar(255) CHARACTER SET utf8mb4 NOT NULL,
		  `metadescription_as_24` tinyint(1) NOT NULL DEFAULT '0',
		  `meta_keyword` varchar(255) CHARACTER SET utf8mb4 DEFAULT '',
		  `keywords_as_24` tinyint(1) NOT NULL DEFAULT '1',
		  `seo_title` varchar(255) CHARACTER SET utf8mb4 NOT NULL,
		  `title_as_24` tinyint(1) NOT NULL DEFAULT '0',
		  `seo_h1` varchar(255) CHARACTER SET utf8mb4 NOT NULL,
		  `h1_as_24` tinyint(1) NOT NULL DEFAULT '0',
		  `tag` text NOT NULL DEFAULT '',
		  `tag_as_24` tinyint(1) NOT NULL DEFAULT '1',
		  `discount_as_24` tinyint(1) NOT NULL DEFAULT '1',
		  `special_as_24` int(1) NOT NULL DEFAULT '1'
		) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 ROW_FORMAT=FIXED
			  ");
	  
		if($this->db->query("SHOW INDEX FROM " .DB_PREFIX ."product_description_" .$this->request->post['table_bd'])->num_rows == 0)
				$this->db->query("ALTER TABLE `" .DB_PREFIX ."product_description_" .$this->request->post['table_bd'] ."` ADD UNIQUE KEY `product_id` (`product_id`)");

		$this->db->query("CREATE TABLE IF NOT EXISTS " .DB_PREFIX ."product_discount_" .$this->request->post['table_bd'] ." LIKE product_discount");
		$this->db->query("CREATE TABLE IF NOT EXISTS " .DB_PREFIX ."product_special_" .$this->request->post['table_bd'] ." LIKE product_special");
		
		$city_name = $this->db->query("SELECT city,decline FROM " .DB_PREFIX ."store_options WHERE store_id='" .$this->request->post['city'] ."'");
		$city_decline = explode(",",$city_name->rows[0]['decline']);
		$city_name = $city_name->rows[0]['city'];
	
	    $this->db->query("UPDATE " .DB_PREFIX ."product_description SET meta_description=REPLACE(REPLACE(REPLACE(REPLACE(meta_description,'+7 (4812) 62-00-00',''),'+7 (4812) 620000',''),'',''),'620000',''),description=REPLACE(REPLACE(REPLACE(REPLACE(description,'+7 (4812) 62-00-00',''),'+7 (4812) 620000',''),'',''),'620000','') WHERE meta_description LIKE '%+7 (4812) 62-00-00%' OR meta_description LIKE '%+7 (4812) 620000%' OR meta_description LIKE '%620000%' OR  description LIKE '%+7 (4812) 62-00-00%' OR  description LIKE '%+7 (4812) 620000%' OR  description LIKE '%620000%'");

	
		$this->db->query("
			INSERT INTO " .DB_PREFIX ."product_description_" .$this->request->post['table_bd'] ." (product_id,meta_description,keywords_as_24,seo_title,seo_h1,tag_as_24,discount_as_24,special_as_24)
		SELECT product_id,
		/*
		--meta_description
		*/

		ELT(0.5+RAND()*9,CONCAT((SELECT name FROM " .DB_PREFIX ."product_description dsc2 WHERE dsc1.product_id=dsc2.product_id),'— есть на складе. ✓ Доставка в тот же день, разгрузка ✓ Подъем на этаж ✓ Интернет-магазин Remont Doma'),CONCAT((SELECT name FROM " .DB_PREFIX ."product_description dsc2 WHERE dsc1.product_id=dsc2.product_id),'— покупайте с выгодой в интернет-магазине Remont Doma. Широкий выбор и доступные цены. Доставка по всей ','" .$city_decline[2] ."',' области.')
		,CONCAT('На сайте Remont Doma вы можете посмотреть ',(SELECT name FROM " .DB_PREFIX ."product_description dsc2 WHERE dsc1.product_id=dsc2.product_id),' и другие товары из категории ',(SELECT name FROM " .DB_PREFIX ."category_description ctg2 WHERE ctg2.category_id IN (SELECT prct.category_id FROM " .DB_PREFIX ."product_to_category prct WHERE prct.product_id = dsc1.product_id) LIMIT 1))
		,' Большой выбор качественных товаров для ремонта по низким ценам. Выбирайте в нашем онлайн-каталоге.',
		CONCAT((SELECT name FROM " .DB_PREFIX ."product_description dsc2 WHERE dsc1.product_id=dsc2.product_id),' - купить в ','" .$city_decline[0] ."',': цена и характеристики в интернет-магазине Remont Doma. Доставка в любой город ', '" .$city_decline[2] ."',' области, гарантия'),
		CONCAT((SELECT name FROM " .DB_PREFIX ."category_description ctg2 WHERE ctg2.category_id IN (SELECT prct.category_id FROM " .DB_PREFIX ."product_to_category prct WHERE prct.product_id = dsc1.product_id) LIMIT 1),' интернет магазина Remont Doma Купить ',(SELECT name FROM " .DB_PREFIX ."product_description dsc2 WHERE dsc1.product_id=dsc2.product_id),'  в ','" .$city_decline[0] ."', ' в Интернет-магазине Remont Doma '),
		CONCAT('Купить ',(SELECT name FROM " .DB_PREFIX ."product_description dsc2 WHERE dsc1.product_id=dsc2.product_id),' в Remont Doma. Фотографии и цены. Доставка! Смотрите также другие товары в разделе каталога ',(SELECT name FROM " .DB_PREFIX ."category_description ctg2 WHERE ctg2.category_id IN (SELECT prct.category_id FROM " .DB_PREFIX ."product_to_category prct WHERE prct.product_id = dsc1.product_id) LIMIT 1)),
		CONCAT('Купить ',(SELECT name FROM " .DB_PREFIX ."product_description dsc2 WHERE dsc1.product_id=dsc2.product_id),': цены, характеристики, отзывы. Забрать из любого магазина Remont Doma в ','" .$city_decline[0] ."','. Продажа в розницу, каталог и прайс лист.'),
		CONCAT('У нас самая низкая цена на товар ✓ ',(SELECT name FROM " .DB_PREFIX ."product_description dsc2 WHERE dsc1.product_id=dsc2.product_id),' ➜ ',(SELECT name FROM " .DB_PREFIX ."category_description ctg2 WHERE ctg2.category_id IN (SELECT prct.category_id FROM " .DB_PREFIX ."product_to_category prct WHERE prct.product_id = dsc1.product_id) LIMIT 1),' Купить в интернет-магазине Remont Doma')

		)
		,1,
		/*
		--seo_title
		*/
		ELT(0.5+RAND()*9,CONCAT((SELECT name FROM " .DB_PREFIX ."product_description dsc2 WHERE dsc1.product_id=dsc2.product_id),' — купить в ','" .$city_decline[0] ."',': цена за штуку, характеристики, фото'),
		CONCAT((SELECT name FROM " .DB_PREFIX ."product_description dsc2 WHERE dsc1.product_id=dsc2.product_id),', цена – купить в ','" .$city_decline[0] ."'),
		CONCAT((SELECT name FROM " .DB_PREFIX ."product_description dsc2 WHERE dsc1.product_id=dsc2.product_id),' ',(SELECT name FROM " .DB_PREFIX ."category_description ctg2 WHERE ctg2.category_id IN (SELECT prct.category_id FROM " .DB_PREFIX ."product_to_category prct WHERE prct.product_id = dsc1.product_id) LIMIT 1),'- Каталог Remont Doma'),
		CONCAT((SELECT name FROM " .DB_PREFIX ."product_description dsc2 WHERE dsc1.product_id=dsc2.product_id),' - купить по низкой цене | Remont Doma'),
		CONCAT((SELECT name FROM " .DB_PREFIX ."product_description dsc2 WHERE dsc1.product_id=dsc2.product_id),'- купить, цена и фото в интернет-магазине Remont Doma'),
		CONCAT((SELECT name FROM " .DB_PREFIX ."product_description dsc2 WHERE dsc1.product_id=dsc2.product_id),' купить недорого в ','" .$city_decline[0] ."'),
		CONCAT((SELECT name FROM " .DB_PREFIX ."product_description dsc2 WHERE dsc1.product_id=dsc2.product_id),'- купить в Remont Doma| Каталог с ценами на сайте, доставка.'),
		CONCAT((SELECT name FROM " .DB_PREFIX ."product_description dsc2 WHERE dsc1.product_id=dsc2.product_id),': цены, описания, отзывы в ','" .$city_decline[0] ."'),
		CONCAT((SELECT name FROM " .DB_PREFIX ."product_description dsc2 WHERE dsc1.product_id=dsc2.product_id),' купить в ','" .$city_decline[0] ."')
		)
		,
		/*
		--seo_h1
		*/
		CONCAT('Купить ',(SELECT name FROM " .DB_PREFIX ."product_description dsc2 WHERE dsc1.product_id=dsc2.product_id),' в ','" .$city_decline[0] ."',' в Интернет-магазине Remont Doma')
		,

		1,1,1 FROM " .DB_PREFIX ."product_description dsc1");


		$this->db->query("
		INSERT INTO " .DB_PREFIX ."category_to_store (category_id,store_id)
		SELECT category_id," .$this->request->post['city']
		  ." FROM " .DB_PREFIX ."category_to_store WHERE store_id='0'");

		$this->db->query(
		"INSERT INTO " .DB_PREFIX ."product_to_store (product_id,store_id)
		SELECT product_id," .$this->request->post['city']
		 ." FROM " .DB_PREFIX ."product_to_store WHERE store_id='0'");

		$this->insert_categories();

			return true;

	}
	

	public function updateSEO() {

	 
	$city_name = $this->db->query("SELECT city,decline FROM " .DB_PREFIX ."store_options WHERE store_id='" .$this->request->post['city'] ."'");
	$city_decline = explode(",",$city_name->rows[0]['decline']);
	$city_name = $city_name->rows[0]['city'];
	
	
	$this->db->query("UPDATE " .DB_PREFIX ."product_description SET meta_description=REPLACE(REPLACE(REPLACE(REPLACE(meta_description,'+7 (4812) 62-00-00',''),'+7 (4812) 620000',''),'',''),'620000',''),description=REPLACE(REPLACE(REPLACE(REPLACE(description,'+7 (4812) 62-00-00',''),'+7 (4812) 620000',''),'',''),'620000','') WHERE meta_description LIKE '%+7 (4812) 62-00-00%' OR meta_description LIKE '%+7 (4812) 620000%' OR meta_description LIKE '%620000%' OR  description LIKE '%+7 (4812) 62-00-00%' OR  description LIKE '%+7 (4812) 620000%' OR  description LIKE '%620000%'");

	
	$this->db->query("
		UPDATE " .DB_PREFIX ."product_description_" .$this->request->post['table_bd'] ." dsc1 SET
	meta_description =
	/*
	--meta_description
	*/
	ELT(0.5+RAND()*9,CONCAT((SELECT name FROM " .DB_PREFIX ."product_description dsc2 WHERE dsc1.product_id=dsc2.product_id),'— есть на складе. ✓ Доставка в тот же день, разгрузка ✓ Подъем на этаж ✓ Интернет-магазин Remont Doma'),CONCAT((SELECT name FROM " .DB_PREFIX ."product_description dsc2 WHERE dsc1.product_id=dsc2.product_id),'— покупайте с выгодой в интернет-магазине Remont Doma. Широкий выбор и доступные цены. Доставка по всей ','" .$city_decline[2] ."',' области.')
	,CONCAT('На сайте Remont Doma вы можете посмотреть ',(SELECT name FROM " .DB_PREFIX ."product_description dsc2 WHERE dsc1.product_id=dsc2.product_id),' и другие товары из категории ',(SELECT name FROM " .DB_PREFIX ."category_description ctg2 WHERE ctg2.category_id IN (SELECT prct.category_id FROM " .DB_PREFIX ."product_to_category prct WHERE prct.product_id = dsc1.product_id) LIMIT 1))
	,' Большой выбор качественных товаров для ремонта по низким ценам. Выбирайте в нашем онлайн-каталоге.',
	CONCAT((SELECT name FROM " .DB_PREFIX ."product_description dsc2 WHERE dsc1.product_id=dsc2.product_id),' - купить в ','" .$city_decline[0] ."',': цена и характеристики в интернет-магазине Remont Doma. Доставка в любой город ','" .$city_decline[2] ."',' области, гарантия'),
	CONCAT((SELECT name FROM " .DB_PREFIX ."category_description ctg2 WHERE ctg2.category_id IN (SELECT prct.category_id FROM " .DB_PREFIX ."product_to_category prct WHERE prct.product_id = dsc1.product_id) LIMIT 1),' интернет магазина Remont Doma Купить ',(SELECT name FROM " .DB_PREFIX ."product_description dsc2 WHERE dsc1.product_id=dsc2.product_id),'  в ','" .$city_decline[0] ."', ' в Интернет-магазине Remont Doma '),
	CONCAT('Купить ',(SELECT name FROM " .DB_PREFIX ."product_description dsc2 WHERE dsc1.product_id=dsc2.product_id),' в Remont Doma. Фотографии и цены. Доставка! Смотрите также другие товары в разделе каталога ',(SELECT name FROM " .DB_PREFIX ."category_description ctg2 WHERE ctg2.category_id IN (SELECT prct.category_id FROM " .DB_PREFIX ."product_to_category prct WHERE prct.product_id = dsc1.product_id) LIMIT 1)),
	CONCAT('Купить ',(SELECT name FROM " .DB_PREFIX ."product_description dsc2 WHERE dsc1.product_id=dsc2.product_id),': цены, характеристики, отзывы. Забрать из любого магазина Remont Doma в ','" .$city_decline[0] ."','. Продажа в розницу, каталог и прайс лист.'),
	CONCAT('У нас самая низкая цена на товар ✓ ',(SELECT name FROM " .DB_PREFIX ."product_description dsc2 WHERE dsc1.product_id=dsc2.product_id),' ➜ ',(SELECT name FROM " .DB_PREFIX ."category_description ctg2 WHERE ctg2.category_id IN (SELECT prct.category_id FROM " .DB_PREFIX ."product_to_category prct WHERE prct.product_id = dsc1.product_id) LIMIT 1),' Купить в интернет-магазине Remont Doma')

	),
	seo_title =
	/*
	--seo_title
	*/
	ELT(0.5+RAND()*9,CONCAT((SELECT name FROM " .DB_PREFIX ."product_description dsc2 WHERE dsc1.product_id=dsc2.product_id),' — купить в ','" .$city_decline[0] ."',': цена за штуку, характеристики, фото'),
	CONCAT((SELECT name FROM " .DB_PREFIX ."product_description dsc2 WHERE dsc1.product_id=dsc2.product_id),', цена – купить в ','" .$city_decline[0] ."'),
	CONCAT((SELECT name FROM " .DB_PREFIX ."product_description dsc2 WHERE dsc1.product_id=dsc2.product_id),' ',(SELECT name FROM " .DB_PREFIX ."category_description ctg2 WHERE ctg2.category_id IN (SELECT prct.category_id FROM " .DB_PREFIX ."product_to_category prct WHERE prct.product_id = dsc1.product_id) LIMIT 1),'- Каталог Remont Doma'),
	CONCAT((SELECT name FROM " .DB_PREFIX ."product_description dsc2 WHERE dsc1.product_id=dsc2.product_id),' - купить по низкой цене | Remont Doma'),
	CONCAT((SELECT name FROM " .DB_PREFIX ."product_description dsc2 WHERE dsc1.product_id=dsc2.product_id),'- купить, цена и фото в интернет-магазине Remont Doma'),
	CONCAT((SELECT name FROM " .DB_PREFIX ."product_description dsc2 WHERE dsc1.product_id=dsc2.product_id),' купить недорого в ','" .$city_decline[0] ."'),
	CONCAT((SELECT name FROM " .DB_PREFIX ."product_description dsc2 WHERE dsc1.product_id=dsc2.product_id),'- купить в Remont Doma| Каталог с ценами на сайте, доставка.'),
	CONCAT((SELECT name FROM " .DB_PREFIX ."product_description dsc2 WHERE dsc1.product_id=dsc2.product_id),': цены, описания, отзывы в ','" .$city_decline[0] ."'),
	CONCAT((SELECT name FROM " .DB_PREFIX ."product_description dsc2 WHERE dsc1.product_id=dsc2.product_id),' купить в ','" .$city_decline[0] ."')
	),
	seo_h1 =
	/*
	--seo_h1
	*/
	CONCAT('Купить ',(SELECT name FROM " .DB_PREFIX ."product_description dsc2 WHERE dsc1.product_id=dsc2.product_id),' в ','" .$city_decline[0] ."',' в Интернет-магазине Remont Doma')
	WHERE dsc1.product_id IN (SELECT product_id FROM " .DB_PREFIX ."product_description)
	");

	$this->db->query("UPDATE " . DB_PREFIX . "category_description_" .$this->request->post['table_bd'] ." as cpy LEFT JOIN " .DB_PREFIX ."category_description as orig ON (cpy.category_id = orig.category_id) SET 
						  cpy.meta_description = REPLACE(REPLACE(REPLACE(REPLACE(orig.meta_description,'Смоленску','" .$city_decline[1] ."'),'Смоленске','" .$city_decline[0] ."'),'Смоленск','" .$city_name ."'),'".$city_name."ой','" .$city_decline[2] ."'),cpy.seo_title = REPLACE(REPLACE(REPLACE(orig.seo_title,'Смоленску','" .$city_decline[1] ."'),'Смоленске','" .$city_decline[0] ."'),'Смоленск','" .$city_name ."'),cpy.seo_h1 = REPLACE(REPLACE(REPLACE(orig.seo_h1,'Смоленску','" .$city_decline[1] ."'),'Смоленске','" .$city_decline[0] ."'),'Смоленск','" .$city_name ."'),cpy.description2 = REPLACE(REPLACE(REPLACE(REPLACE(orig.description2,'Смоленску','" .$city_decline[1] ."'),'Смоленске','" .$city_decline[0] ."'),'Смоленск','" .$city_name ."'),'".$city_name."ой','" .$city_decline[2] ."') 						  
						  ");		  
						  
	$this->db->query("
		INSERT INTO " .DB_PREFIX ."product_description_" .$this->request->post['table_bd'] ." (product_id,meta_description,keywords_as_24,seo_title,seo_h1,tag_as_24,discount_as_24,special_as_24)
	SELECT dsc1.product_id,
	/*
	--meta_description
	*/
	ELT(0.5+RAND()*9,CONCAT((SELECT name FROM " .DB_PREFIX ."product_description dsc2 WHERE dsc1.product_id=dsc2.product_id),'— есть на складе. ✓ Доставка в тот же день, разгрузка ✓ Подъем на этаж ✓ Интернет-магазин Remont Doma'),CONCAT((SELECT name FROM " .DB_PREFIX ."product_description dsc2 WHERE dsc1.product_id=dsc2.product_id),'— покупайте с выгодой в интернет-магазине Remont Doma. Широкий выбор и доступные цены. Доставка по всей ','" .$city_decline[2] ."',' области.')
	,CONCAT('На сайте Remont Doma вы можете посмотреть ',(SELECT name FROM " .DB_PREFIX ."product_description dsc2 WHERE dsc1.product_id=dsc2.product_id),' и другие товары из категории ',(SELECT name FROM " .DB_PREFIX ."category_description ctg2 WHERE ctg2.category_id IN (SELECT prct.category_id FROM " .DB_PREFIX ."product_to_category prct WHERE prct.product_id = dsc1.product_id) LIMIT 1))
	,' Большой выбор качественных товаров для ремонта по низким ценам. Выбирайте в нашем онлайн-каталоге.',
	CONCAT((SELECT name FROM " .DB_PREFIX ."product_description dsc2 WHERE dsc1.product_id=dsc2.product_id),' - купить в ','" .$city_decline[0] ."',': цена и характеристики в интернет-магазине Remont Doma. Доставка в любой город ','" .$city_decline[2] ."',' области, гарантия'),
	CONCAT((SELECT name FROM " .DB_PREFIX ."category_description ctg2 WHERE ctg2.category_id IN (SELECT prct.category_id FROM " .DB_PREFIX ."product_to_category prct WHERE prct.product_id = dsc1.product_id) LIMIT 1),' интернет магазина Remont Doma Купить ',(SELECT name FROM " .DB_PREFIX ."product_description dsc2 WHERE dsc1.product_id=dsc2.product_id),'  в ','" .$city_decline[0] ."', ' в Интернет-магазине Remont Doma '),
	CONCAT('Купить ',(SELECT name FROM " .DB_PREFIX ."product_description dsc2 WHERE dsc1.product_id=dsc2.product_id),' в Remont Doma. Фотографии и цены. Доставка! Смотрите также другие товары в разделе каталога ',(SELECT name FROM " .DB_PREFIX ."category_description ctg2 WHERE ctg2.category_id IN (SELECT prct.category_id FROM " .DB_PREFIX ."product_to_category prct WHERE prct.product_id = dsc1.product_id) LIMIT 1)),
	CONCAT('Купить ',(SELECT name FROM " .DB_PREFIX ."product_description dsc2 WHERE dsc1.product_id=dsc2.product_id),': цены, характеристики, отзывы. Забрать из любого магазина Remont Doma в ','" .$city_decline[0] ."','. Продажа в розницу, каталог и прайс лист.'),
	CONCAT('У нас самая низкая цена на товар ✓ ',(SELECT name FROM " .DB_PREFIX ."product_description dsc2 WHERE dsc1.product_id=dsc2.product_id),' ➜ ',(SELECT name FROM " .DB_PREFIX ."category_description ctg2 WHERE ctg2.category_id IN (SELECT prct.category_id FROM " .DB_PREFIX ."product_to_category prct WHERE prct.product_id = dsc1.product_id) LIMIT 1),' Купить в интернет-магазине Remont Doma')

	)
	,1,
	/*
	--seo_title
	*/
	ELT(0.5+RAND()*9,CONCAT((SELECT name FROM " .DB_PREFIX ."product_description dsc2 WHERE dsc1.product_id=dsc2.product_id),' — купить в ','" .$city_decline[0] ."',': цена за штуку, характеристики, фото'),
	CONCAT((SELECT name FROM " .DB_PREFIX ."product_description dsc2 WHERE dsc1.product_id=dsc2.product_id),', цена – купить в ','" .$city_decline[0] ."'),
	CONCAT((SELECT name FROM " .DB_PREFIX ."product_description dsc2 WHERE dsc1.product_id=dsc2.product_id),' ',(SELECT name FROM " .DB_PREFIX ."category_description ctg2 WHERE ctg2.category_id IN (SELECT prct.category_id FROM " .DB_PREFIX ."product_to_category prct WHERE prct.product_id = dsc1.product_id) LIMIT 1),'- Каталог Remont Doma'),
	CONCAT((SELECT name FROM " .DB_PREFIX ."product_description dsc2 WHERE dsc1.product_id=dsc2.product_id),' - купить по низкой цене | Remont Doma'),
	CONCAT((SELECT name FROM " .DB_PREFIX ."product_description dsc2 WHERE dsc1.product_id=dsc2.product_id),'- купить, цена и фото в интернет-магазине Remont Doma'),
	CONCAT((SELECT name FROM " .DB_PREFIX ."product_description dsc2 WHERE dsc1.product_id=dsc2.product_id),' купить недорого в ','" .$city_decline[0] ."'),
	CONCAT((SELECT name FROM " .DB_PREFIX ."product_description dsc2 WHERE dsc1.product_id=dsc2.product_id),'- купить в Remont Doma| Каталог с ценами на сайте, доставка.'),
	CONCAT((SELECT name FROM " .DB_PREFIX ."product_description dsc2 WHERE dsc1.product_id=dsc2.product_id),': цены, описания, отзывы в ','" .$city_decline[0] ."'),
	CONCAT((SELECT name FROM " .DB_PREFIX ."product_description dsc2 WHERE dsc1.product_id=dsc2.product_id),' купить в ','" .$city_decline[0] ."')
	)
	,
	/*
	--seo_h1
	*/
	CONCAT('Купить ',(SELECT name FROM " .DB_PREFIX ."product_description dsc2 WHERE dsc1.product_id=dsc2.product_id),' в ','" .$city_decline[0] ."',' в Интернет-магазине Remont Doma')
	,

	1,1,1 FROM " .DB_PREFIX ."product_description dsc1 LEFT JOIN " .DB_PREFIX ."product_description_" .$this->request->post['table_bd'] ." dsc3 ON (dsc1.product_id = dsc3.product_id) WHERE dsc3.product_id IS NULL ");


	$this->db->query("UPDATE " .DB_PREFIX ."category_description SET meta_description=REPLACE(REPLACE(REPLACE(REPLACE(meta_description,'+7 (4812) 62-00-00',''),'+7 (4812) 620000',''),'',''),'620000',''),description2=REPLACE(REPLACE(REPLACE(REPLACE(description2,'+7 (4812) 62-00-00',''),'+7 (4812) 620000',''),'',''),'620000','') WHERE meta_description LIKE '%+7 (4812) 62-00-00%' OR meta_description LIKE '%+7 (4812) 620000%' OR meta_description LIKE '%620000%' OR  description2 LIKE '%+7 (4812) 62-00-00%' OR  description2 LIKE '%+7 (4812) 620000%' OR  description2 LIKE '%620000%'");

	$this->db->query("UPDATE " .DB_PREFIX ."category_description SET description=REPLACE(REPLACE(REPLACE(REPLACE(description,'https://remontdoma24.ru',''),'http://remontdoma24.ru',''),'//remontdoma24.ru',''),'remontdoma24.ru',''),description2=REPLACE(REPLACE(REPLACE(REPLACE(description2,'https://remontdoma24.ru',''),'http://remontdoma24.ru',''),'//remontdoma24.ru',''),'remontdoma24.ru','') WHERE description LIKE '%remontdoma24.ru%' OR description2 LIKE '%remontdoma24.ru%'");


	$this->db->query("INSERT INTO " . DB_PREFIX . "category_description_" .$this->request->post['table_bd'] ." (category_id,meta_description,seo_title,seo_h1,description2)
						  SELECT ct1.category_id,REPLACE(REPLACE(REPLACE(REPLACE(ct1.meta_description,'Смоленску','" .$city_decline[1] ."'),'Смоленске','" .$city_decline[0] ."'),'Смоленск','" .$city_name ."'),'".$city_name."ой','" .$city_decline[2] ."'),REPLACE(REPLACE(REPLACE(ct1.seo_title,'Смоленску','" .$city_decline[1] ."'),'Смоленске','" .$city_decline[0] ."'),'Смоленск','" .$city_name ."'),REPLACE(REPLACE(REPLACE(ct1.seo_h1,'Смоленску','" .$city_decline[1] ."'),'Смоленске','" .$city_decline[0] ."'),'Смоленск','" .$city_name ."'),REPLACE(REPLACE(REPLACE(REPLACE(ct1.description2,'Смоленску','" .$city_decline[1] ."'),'Смоленске','" .$city_decline[0] ."'),'Смоленск','" .$city_name ."'),'".$city_name."ой','" .$city_decline[2] ."') FROM " . DB_PREFIX . "category_description ct1
						  LEFT JOIN " .DB_PREFIX ."category_description_" .$this->request->post['table_bd'] ." ct2 ON (ct1.category_id = ct2.category_id) WHERE ct2.category_id IS NULL
						  ");
		
						  
		return true;
	
	}
}


?>
<?php 
class ModelExtensionModuleBlacklist extends Model 
{
	private static $db;

	public function injection($connection) 
	{
		self::$db = $connection;
	}

	public function creatTable() 
	{		
		self::$db->query("  
			CREATE TABLE IF NOT EXISTS `ap_blacklist` 
			(
				`blacklist_id` INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
				`store` 	VARCHAR(255) NOT NULL,
				`order`     INT(11) NOT NULL,
				`firstname` VARCHAR(255) NOT NULL,
				`lastname`  VARCHAR(255) NOT NULL,
				`email` 	VARCHAR(255) NOT NULL,
				`telephone` BIGINT(20) NOT NULL,
				`comment` 	TEXT NOT NULL
			) 
			ENGINE = myISAM, 
			CHARACTER SET = utf8, 
			COLLATE = utf8_unicode_ci 
		");
	}

	public function checkTable() 
	{
		$check = self::$db->query("SHOW TABLES LIKE 'ap_blacklist'");

		return $check->num_rows;
	}	

	public function getList(array $filter) 
	{
		$start = !empty($filter['start']) ? $filter['start'] : 0; 
		$stop  = !empty($filter['limit']) ? $filter['limit'] : 15; 

		$result = self::$db->query("  
			SELECT * FROM `ap_blacklist`
				ORDER BY blacklist_id DESC
				LIMIT ". (int) $filter['start'] .",". (int) $filter['limit'] ."
		");

		return $result->rows;
	}

	public function getListTotal() 
	{	
		return self::$db->query("SELECT count(blacklist_id) AS total FROM `ap_blacklist`")->row['total'];
	}

	public function checkCustomer(array $data, $all = false) 
	{
		$data = $this->preparation($data);

		$customer = 
		"  
			(UPPER(CONCAT(lastname, firstname)) = '". $this->db->escape(mb_strtoupper($data['lastname'] . $data['firstname'])) ."' 
			OR UPPER(CONCAT(lastname, firstname)) = '". $this->db->escape(mb_strtoupper($data['firstname'] . $data['lastname']))  ."')
			AND (lastname <> '' OR firstname <> '')
		";

		$phone = 
		"  
			telephone = '". (int) $data['telephone'] ."' AND telephone <> '' AND telephone <> '0'
		";

		$email = 
		"  
			UPPER(email) = '". $this->db->escape(mb_strtoupper($data['email'])) ."' AND email <> '' {IGNORE}
		";

		$ignore = $this->config->get('blacklist_email_ignore');

		if (!empty($ignore)) {
			$ignore = explode(',', $ignore);

			array_walk($ignore, function(&$val, $idx) {
				$val =  '\'' . $this->db->escape(trim(mb_strtoupper($val)))  .'\'';
			});
		
			$ignore = ' AND UPPER(email) NOT IN ('. implode(',', $ignore) .')';
		} else {
			$ignore = '';
		}	

		$email = str_replace('{IGNORE}', $ignore, $email);

		$sql = 
		"  
			SELECT blacklist_id FROM ap_blacklist 
				WHERE ({CUSTOMER}) OR ({PHONE}) OR ({EMAIL}) 
				{LIMIT}
		";
	
		$result = self::$db->query(
			str_replace(
				['{CUSTOMER}', '{PHONE}', '{EMAIL}', '{LIMIT}'], 
				[$customer, $phone, $email, (!$all ? 'LIMIT 1' : '')], 
				$sql
			)
		);

		return $all ? ($result->num_rows ? $result->rows : []) : $result->num_rows;
	}		

	public function getCustomer($blacklist_id) 
	{
		$info = self::$db->query("  
			SELECT * FROM `ap_blacklist` 
				WHERE blacklist_id = '". (int) $blacklist_id ."'
			LIMIT 1
		");

		return $info->num_rows ? $info->row : [];
	}

	public function addCustomer(array $data) 
	{	
		$data = $this->preparation($data);

		self::$db->query("  
			INSERT INTO `ap_blacklist` 
				SET 
					store 	  = '". $this->db->escape($data['store'])     ."',
					`order`   = '". (int) $data['order']     			  ."',
					email 	  = '". $this->db->escape($data['email'])     ."',
					comment   = '". $this->db->escape($data['comment'])   ."',
					lastname  = '". $this->db->escape($data['lastname'])  ."',
					firstname = '". $this->db->escape($data['firstname']) ."',
					telephone = '". (int) $data['telephone'] ."'
		");

		return self::$db->countAffected() ? self::$db->getLastId() : false;
	}

	public function editCustomer(array $data) 
	{
		$data = $this->preparation($data);

		self::$db->query("  
			UPDATE `ap_blacklist` 
				SET 
					store 	  = '". $this->db->escape($data['store'])     ."',
					`order`	  = '". (int) $data['order'] 				  ."',
					email 	  = '". $this->db->escape($data['email'])     ."',
					comment   = '". $this->db->escape($data['comment'])   ."',
					lastname  = '". $this->db->escape($data['lastname'])  ."',
					firstname = '". $this->db->escape($data['firstname']) ."',
					telephone = '". $this->db->escape($data['telephone']) ."'
				WHERE blacklist_id = '". (int) $data['blacklist_id'] ."'
		");
	}

	public function getOrder($order_id)
	{
		// use $this->db !!!

		$result = $this->db->query("
			SELECT firstname, lastname, email, telephone, payment_firstname, payment_lastname, shipping_firstname, shipping_lastname
			FROM `" . DB_PREFIX . "order`
			WHERE order_id = '" . (int)$order_id . "'
			LIMIT 1 
		");

		return $result->row;
	}

	public function delateCustomer($blacklist_id) 
	{
		self::$db->query("DELETE FROM `ap_blacklist` WHERE blacklist_id = '". (int) $blacklist_id ."'");
	}

	private function preparation(array $data) 
	{
		if (!empty($data['telephone'])) {
			$data['telephone'] = preg_replace('~[^0-9]~', '', $data['telephone']);
		} else {
			$data['telephone'] = '';
		}

		if (!empty($data['order'])) {
			$data['order'] = preg_replace('~[^0-9]~', '', $data['order']);
		} else {
			$data['order'] = '';
		}		

		if (!empty($data['firstname'])) {
			$data['firstname'] = trim(preg_replace('~[^а-яА-ЯЁёa-zA-Z\-\s]~u', '', $data['firstname']));
		} else {
			$data['firstname'] = '';
		}

		if (!empty($data['lastname'])) {
			$data['lastname'] = trim(preg_replace('~[^а-яА-ЯЁёa-zA-Z\-\s]~u', '', $data['lastname']));
		} else {
			$data['lastname'] = '';
		}				

		if (!empty($data['email'])) { 
			$data['email'] = trim(strip_tags(html_entity_decode($data['email'])));
		} else {
			$data['email'] = '';
		}

		if (!empty($data['comment'])) { 
			$data['comment'] = trim(strip_tags(html_entity_decode($data['comment'])));
		} else {
			$data['comment'] = '';
		}		
	
		return $data;	
	}
}
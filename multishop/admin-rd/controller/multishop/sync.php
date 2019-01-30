<?php
class ControllerMultishopSync extends Controller {
	private $error = array();

	public function index() {
		
		$this->getForm();

	}
	
	
	public function insert() {
		
		if(!isset($this->request->post['city'])) {
			$this->data['error_warning'][]='Не выбран город<br/>';
			$this->getForm();
			return false; 
		}
		
		if (empty($this->request->post['table_bd'])) { 
				$this->data['error_warning'][]='Не указан суффикс<br/>';
				$this->getForm();
				return false; 				
				}
		

			$this->load->model('multishop/sync');

	/*Только для категорий*/
			if($this->request->post['whtsync'] == 'cat') {
				
				if($this->model_multishop_sync->insert_categories()) $this->data['success']='Синхронихация выполнена успешно<br/>';
				  else $this->data['error_warning']='Синхронихация по каким-то причинам не выполнена<br/>';
				$this->getForm();
				return; 	
			}
			
	/*Только описания категорий и товаров*/
		if($this->request->post['whtsync'] == 'des_cat_pr') {
				
				if($this->model_multishop_sync->updateSEO()) $this->data['success']='Синхронихация выполнена успешно<br/>';
				  else $this->data['error_warning']='Синхронихация по каким-то причинам не выполнена<br/>';
				$this->getForm();
				return; 	
			}
	
	/*Для всех таблиц*/
			if(!$this->model_multishop_sync->validateBD($this->request->post['city'],$this->request->post['table_bd'])) {     
						$this->data['error_warning'][]='В БД уже есть записи для данного города';
						$this->getForm(1);
						return false;
			}
			
			

			if ($this->model_multishop_sync->insert()) $this->data['success']='Синхронихация выполнена успешно<br/>';
				else $this->data['error_warning']='Синхронихация по каким-то причинам не выполнена<br/>';
			   
			   
		$this->getForm();
		
		
		
	}
	
	public function delete_records(){
		$this->load->model('multishop/sync');		
	    if ($this->model_multishop_sync->delete_records())
			$this->data['success']='Таблицы успешно удалены<br/>';
		$this->getForm();
	}
	
	public function getForm($show_del = 0) {
		$this->load->model('multishop/sync');
		
		$cities = $this->model_multishop_sync->getCities();
		$options = '';
		foreach($cities as $city){
			
			$underdm = explode('.',str_replace('http://', '', $city['url']));
			$this->log->write($underdm[0]);
			if ($underdm[0] == UNDER_DOMEN){	
				$options .='<option value="' .$city['store_id'] .'" selected>' .$city['name'] .'</option>';
				$this->data['city']=$city['store_id'];
			 }
			else 
				$options .='<option value="' .$city['store_id'] .'">' .$city['name'] .'</option>';
		}
		
		$this->data['show_del']=$show_del;
		$this->data['options_cities']=$options;
		$this->data['delete']=$this->url->link('multishop/sync/delete_records', 'token=' . $this->session->data['token'], 'SSL');
		$this->data['insert']=$this->url->link('multishop/sync/insert', 'token=' . $this->session->data['token'], 'SSL');
		$this->data['updateSEO']=$this->url->link('multishop/sync/insert', 'token=' . $this->session->data['token'], 'SSL');
		$this->template = 'multishop/sync.tpl';
		$this->children = array(
			'common/header',
			'common/footer'
		);
		

		$this->response->setOutput($this->render(TRUE), $this->config->get('config_compression'));
		
	}
	
	
}
?>
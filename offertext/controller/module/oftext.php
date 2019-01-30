<?php

class ControllerModuleOfText extends Controller {
	private $error = array();
	
	public function index() {
		$this->language->load('module/oftext');
		$this->document->setTitle($this->language->get('heading_title'));
		
		if (isset($this->request->get['store_id'])) {
			$store_id = $this->request->get['store_id'];
		} else {
			$store_id = 0;
		}
		
		$this->load->model('setting/setting');
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && ($this->validate())) {
			$this->model_setting_setting->editSetting('oftext', $this->request->post, $store_id);
			$this->session->data['success'] = $this->language->get('text_success');
			$this->redirect($this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL'));
		}
		
		$settings = $this->model_setting_setting->getSetting('oftext', $store_id);
		
		$this->data['heading_title'] = $this->language->get('heading_title');
		
		$this->data['text_yes'] = $this->language->get('text_yes');
		$this->data['text_no'] = $this->language->get('text_no');
		
		$this->data['entry_store'] = $this->language->get('entry_store');
		$this->data['entry_of_text'] = $this->language->get('entry_of_text');
		$this->data['entry_another_text_if_in_stock'] = $this->language->get('entry_another_text_if_in_stock');
		$this->data['entry_of_stock'] = $this->language->get('entry_of_stock');
		
		$this->data['button_save'] = $this->language->get('button_save');
		$this->data['button_cancel'] = $this->language->get('button_cancel');
		
		if (isset($this->error['warning'])) {
			$this->data['error_warning'] = $this->error['warning'];
		} else {
			$this->data['error_warning'] = '';
		}
		
		$this->data['breadcrumbs'] = array();
		$this->data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
			'separator' => false
		);
		$this->data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_module'),
			'href' => $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL'),
			'separator' => ' :: '
		);
		$this->data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('module/oftext', 'token=' . $this->session->data['token'], 'SSL'),
			'separator' => ' :: '
		);
		
		$this->data['action'] = $this->url->link('module/oftext', 'token=' . $this->session->data['token'] . '&store_id=' . $store_id, 'SSL');
		$this->data['cancel'] = $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL');
		$this->data['token'] = $this->session->data['token'];
		
		if (isset($this->request->post['store_id'])) {
			$this->data['store_id'] = $this->request->post['store_id'];
		} else {
			$this->data['store_id'] = (isset($settings['store_id'])?$settings['store_id']:array());
		}
		
		$this->data['of'] = array();
		if (isset($this->request->post['of'])) {
			$this->data['of'] = $this->request->post['of'];
		} else {
			$this->data['of'] = (isset($settings['of'])?$settings['of']:array());
		}
		
		if (isset($this->request->post['if_stock'])) {
			$this->data['if_stock'] = $this->request->post['if_stock'];
		} else {
			$this->data['if_stock'] = (isset($settings['if_stock'])?$settings['if_stock']:0);
		}
		
		$this->data['of_stock'] = array();
		if (isset($this->request->post['of_stock'])) {
			$this->data['of_stock'] = $this->request->post['of_stock'];
		} else {
			$this->data['of_stock'] = (isset($settings['of_stock'])?$settings['of_stock']:array());
		}
		
		$this->load->model('setting/store');
		$stores = array();
		$stores[] = array(
			'store_id' => 0,
			'name' => $this->config->get('config_name')
		);
		foreach ($this->model_setting_store->getStores() as $store) {
			$stores[] = array(
				'store_id' => $store['store_id'],
				'name' => $store['name']
			);
		}
		$this->data['stores'] = $stores;
		
		$this->load->model('localisation/language');
		$this->data['languages'] = $this->model_localisation_language->getLanguages();
		
		$this->template = 'module/oftext.tpl';
		$this->children = array(
			'common/header',
			'common/footer'
		);
		
		$this->response->setOutput($this->render());
	}
	
	protected function validate() {
		if (!$this->user->hasPermission('modify','module/oftext')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}
		
		if (!$this->error) {
			return true;
		} else {
			return false;
		}
	}
}

?>
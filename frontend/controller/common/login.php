<?php
	class ControllerCommonLogin extends Controller {
		protected $error = array();
		public function index() {
			// Loading libraries
			$this->language->load("common/login");
			$this->load->model("account/account");
			// Setup page title
			$this->data['heading_title'] = $this->language->get('heading_title');
			$this->document->setTitle($this->data['heading_title']);
			// Retrieving form data
			if($this->request->server['REQUEST_METHOD'] == 'POST' && $this->validate()) {
				$this->session->data['success'] = $this->langauge->get('text_success_login');
				if(isset($this->request->post['redirect']) && preg_match("/http(s)?:\/\/[\w-.]+\/.*/i", $this->request->post['redirect']))
					$this->response->redirect($this->request->post['redirect']);
				else
					$this->response->redirect($this->url->link('common/home'));
			}
			// Setup page data
			$this->data['action'] = $this->url->link('common/login', '', $this->config->get("connection"));
			$this->data['text_username'] = $this->language->get('text_username');
			$this->data['text_password'] = $this->language->get('text_password');
			$this->data['username'] = isset($this->request->post['username']) ? $this->request->post['username'] : '';
			$this->data['redirect'] = $this->url->link('common/home')
			
			// Rendering...
			if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/common/login.tpl'))
				$this->template = $this->config->get('config_template') . '/template/common/login.tpl';
			else
				$this->template = 'default/template/common/login.tpl';
			$this->children = array("common/header", "common/footer");
			$this->response->setOutput($this->render(), $this->config->get("config_compression"));
		}

		public function validate() {
			if(!$this->user->login($this->request->post['username'], $this->request->post['password']))
				$this->error['warning'] = $this->language->get('error_authorize');
			return ($this->error) ? false : true;
		}
	}
?>
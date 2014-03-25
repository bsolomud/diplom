<?php   
class ControllerCommonHeader extends Controller {
	protected function index() {
		// Loadign libraries
		$this->language->load('common/header');
		// Base HTTP url
		if (isset($this->request->server['HTTPS']) && (($this->request->server['HTTPS'] == 'on') || ($this->request->server['HTTPS'] == '1')))
			$server = $this->config->get('config_ssl');
		else
			$server = $this->config->get('config_url');
		if (isset($this->session->data['error']) && !empty($this->session->data['error'])) {
			$this->data['error'] = $this->session->data['error'];
			unset($this->session->data['error']);
		} else
			$this->data['error'] = '';
		// Header info
		$this->data['base'] = $server;
		$this->data['description'] = $this->document->getDescription();
		$this->data['keywords'] = $this->document->getKeywords();
		$this->data['links'] = $this->document->getLinks();	 
		$this->data['styles'] = $this->document->getStyles();
		$this->data['scripts'] = $this->document->getScripts();
		$this->data['lang'] = $this->language->get('code');
		$this->data['direction'] = $this->language->get('direction');
		$this->data['name'] = $this->config->get('config_name');
		$this->data['title'] = $this->document->getTitle();
		$this->data['noscript'] = $this->url->link('error/handler', 'type=javascript');
		// Icon
		if ($this->config->get('config_icon') && file_exists(DIR_IMAGE . $this->config->get('config_icon')))
			$this->data['icon'] = $server . 'image/' . $this->config->get('config_icon');
		else
			$this->data['icon'] = '';
		// Logo
		if ($this->config->get('config_logo') && file_exists(DIR_IMAGE . $this->config->get('config_logo')))
			$this->data['logo'] = $server . 'image/' . $this->config->get('config_logo');
		else
			$this->data['logo'] = '';
		// Setup page data
		$this->data['action'] = $this->url->link('video/search');
		$this->data['text_search'] = $this->language->get('text_search');
			// Authorization form
		$this->data['text_login'] = $this->language->get('text_login');
		$this->data['redirect'] = $this->url->link((isset($this->request->get['route'])) ? $this->request->get['route'] : 'common/home');
		$this->data['login_action'] = $this->url->link('common/login');
		// If user is signed in
		if($this->user->signedIn()) {
			$this->data['navigation'] = array(
				array(
					"text"	=> $this->language->get("text_signout"),
					"href"	=> $this->url->link("account/account/signout"),
				),
				array(
					"text"	=> $this->language->get("text_account"),
					"href"	=> $this->url->link("account/account")
				)
			);
		} else {
			$this->data['navigation'] = array(
				array(
					"text"	=> $this->language->get("text_signup"),
					"href"	=> $this->url->link("account/account/signup"),
				),
				array(
					"text"	=> $this->language->get("text_signin"),
					"href"	=> $this->url->link("account/account/signin"),
				),
			);
		}

		// Retrievign session actions data
		$this->data['message'] = array();
		if(isset($this->session->data['success'])) {
			$this->data['message']['success'] = $this->session->data['success'];
			unset($this->session->data['success']);
		}
		if(isset($this->session->data['notice'])) {
			$this->data['message']['notice'] = $this->session->data['notice'];
			unset($this->session->data['notice']);
		}
		if(isset($this->session->data['warning'])) {
			$this->data['message']['warning'] = $this->session->data['warning'];
			unset($this->session->data['warning']);
		}
		if(isset($this->session->data['info'])) {
			$this->data['message']['info'] = $this->session->data['info'];
			unset($this->session->data['info']);
		}
		$this->data['keyword'] = isset($this->request->get['keyword']) ? $this->request->get['keyword'] : '';

		$this->data['config_template'] = $this->config->get('config_template');
		// Renderign...
		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/common/header.tpl'))
			$this->template = $this->config->get('config_template') . '/template/common/header.tpl';
		else
			$this->template = 'default/template/common/header.tpl';
		$this->render();
	} 	
}
?>

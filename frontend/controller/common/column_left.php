<?php
	class ControllerCommonColumnLeft extends Controller {
		public function index() {
			$this->language->load("common/column_left");
			$this->load->model("tool/image");


			$this->data['full_mode'] = $this->language->get("text_full_mode");
			$this->data['navigation'] = array(
				array(
					"text"	=> $this->language->get("text_home"),
					"href"	=> $this->url->link("common/home"),
				)
			);
			if($this->user->isLogged()) {
				$this->data['navigation'][] = array(
					"text"	=> $this->langauge->get("text_account"),
					"href"	=> $this->url->link("account/account"),
				);
				if($this->user->hasPermission("modify", "setting/setting")) {
					$this->data['navigation'][] = array(
						"text"	=> $this->langauge->get("text_setting"),
						"href"	=> $this->url->link("setting/setting"),
					);
				}
				$this->data['navigation'][] = array(
					"text"	=> $this->language->get("text_signout"),
					"href"	=> $this->url->link("account/account/signout"),
				);
			} else {
				$this->data['navigation'][] = array(
					"text"	=> $this->language->get("text_signup"),
					"href"	=> $this->url->link("account/account/signup"),
				);
				$this->data['navigation'][] = array(
					"text"	=> $this->language->get("text_signin"),
					"href"	=> $this->url->link("account/account/signin"),
				);
			}

			// Renderign...
			if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/common/column_left.tpl'))
				$this->template = $this->config->get('config_template') . '/template/common/column_left.tpl';
			else
				$this->template = 'default/template/common/column_left.tpl';
			$this->render();
		}
	}
?>
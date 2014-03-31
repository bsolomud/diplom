<?php
	class ControllerSettingSetting extends Controller {
		public function index() {
			$this->language->load("setting/setting");
			$this->load->model("setting/setting");

			if(!$this->user->hasPermission("modify", "common/header"))
				$this->response->redirect($this->url->link("common/home"));

			if($this->request->server["REQUEST_METHOD"] == "POST" && $this->validate()) {
				$this->model_setting_setting->updateSettig("config", $this->request->post);
				$this->session->data["success"] = $this->language->get("success_update");
				$this->response->redirect($this->url->link("setting/setting"));
			}

			$this->document->setTitle($this->language->get("heading_title"));

			$this->data["language"] = array();
			// Configs
			$configs = $this->model_setting_setting->getSetting("config");
			$this->data["config"] = array();
			$this->data["language"]["configs"] = $this->language->get("tab_configs");
			foreach($configs->rows as $config) {
				$this->data["config"][$config["key"]] = ($config["serialized"]) ? unserialize($config["value"]) : $config["value"];
				$this->data["language"][$config["key"]] = $this->language->get("field_" . $config["key"]);
			}

			// users
			$this->load->model("user/user");
			$this->data["language"]["users"] = $this->language->get("tab_users");
			$users = $this->model_user_user->getUsersList($this->user->get("user_id"));
			$this->data["users"] = array();
			foreach($users->rows as $user) {
				
			}

			// Rendering...
			if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/setting/setting.tpl'))
				$this->template = $this->config->get('config_template') . '/template/setting/setting.tpl';
			else
				$this->template = 'default/template/setting/setting.tpl';
			$this->children = array("common/header", "common/column_left", "common/footer");
			$this->response->setOutput($this->render());
		}
	}
?>
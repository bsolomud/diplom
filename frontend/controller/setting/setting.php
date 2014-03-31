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

			$this->data["settings"] = array();
			$this->data["language"] = array();
			$this->data["language"]["config"] = $this->language->get("text_config");
			$configs = $this->model_setting_setting->getSetting("config");
			foreach($configs->rows as $config) {
				$this->data["settings"]["config"][$config["key"]] = ($config["serialized"]) ? unserialize($config["value"]) : $config["value"];
				$this->data["language"][$config["key"]] = $this->language->get("field_" . $config["key"]);
			}
			$this->data["post"] = array();
			if(!empty($this->request->post))
				foreach($this->request->post as $key => $value)
					$this->data["post"][$key] = $value;

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
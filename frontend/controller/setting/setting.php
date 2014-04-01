<?php
	class ControllerSettingSetting extends Controller {
		protected $error = array();
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

			$this->data["radio"] = array(
				0	=> $this->language->get("text_0"),
				1	=> $this->language->get("text_1")
			);

			$this->data["language"] = array();
			// Configs
			$this->data["tabs"]["config"] = $this->language->get("tab_config");
			// Config Title
			$this->data["config_title"] = array(
				"text"	=> $this->language->get("field_title"),
				"value"	=> isset($this->request->post["config_title"]) ? $this->request->post["config_title"] : $this->config->get("config_title")
			);
			$this->data["config_error_filename"] = array(
				"text"	=> $this->language->get("field_error_filename"),
				"value"	=> isset($this->request->post["config_error_filename"]) ? $this->request->post["config_error_filename"] : $this->config->get("config_error_filename")
			);
			$this->data["config_error_log"] = array(
				"text"	=> $this->language->get("field_error_log"),
				"value"	=> isset($this->request->post["config_error_log"]) ? $this->request->post["config_error_log"] : $this->config->get("config_error_log"),
			);
			$this->data["config_error_display"] = array(
				"text"	=> $this->language->get("field_error_display"),
				"value"	=> isset($this->request->post["config_error_display"]) ? $this->request->post["config_error_display"] : $this->config->get("config_error_display"),
			);
			$this->data["config_seo_url"] = array(
				"text"	=> $this->language->get("field_seo_url"),
				"value"	=> isset($this->request->post["config_seo_url"]) ? $this->request->post["config_seo_url"] : $this->config->get("config_seo_url"),
			);
			$this->data["config_icon"] = array(
				"text"	=> $this->language->get("field_icon"),
				"value"	=> isset($this->request->post["config_icon"]) ? $this->config->get("config_icon") : $this->config->get("config_icon"),
			);
			$this->data["config_logo"] = array(
				"text"	=> $this->language->get("field_logo"),
				"value"	=> isset($this->request->post["config_logo"]) ? $this->request->post["config_logo"] : $this->config->get("config_logo"),
			);
			$this->data["connection"] = array(
				"text"	=> $this->language->get("field_connection"),
				"value"	=> isset($this->request->post["connection"]) ? $this->request->post["connection"] : $this->config->get("connection"),
			);
			$this->data["config_name"] = array(
				"text"	=> $this->language->get("field_name"),
				"value"	=> isset($this->request->post["config_name"]) ? $this->request->post["config_name"] : $this->config->get("config_name"),
			);
			$this->data["config_email"] = array(
				"text"	=> $this->language->get("field_email"),
				"value"	=> isset($this->request->post["config_email"]) ? $this->request->post["config_email"] : $this->config->get("config_email"),
			);
			$this->data["config_meta_description"] = array(
				"text"	=> $this->language->get("field_meta_description"),
				"value"	=> isset($this->request->post["config_meta_description"]) ? $this->request->post["config_meta_description"] : $this->config->get("config_meta_description"),
			);
			$this->data["config_template"] = array(
				"text"	=> $this->language->get("field_template"),
				"value"	=> isset($this->request->post["config_template"]) ? $this->request->post["config_template"] : $this->config->get("config_template"),
			);
			$this->data["config_language"] = array(
				"text"	=> $this->language->get("field_language"),
				"value"	=> isset($this->request->post["config_language"]) ? $this->request->post["config_language"] : $this->config->get("config_language"),
			);
			$this->data["config_url"] = array(
				"text"	=> $this->language->get("field_url"),
				"value"	=> isset($this->request->post["config_url"]) ? $this->request->post["config_url"] : $this->config->get("config_url"),
			);
			$this->data["config_video_limit"] = array(
				"text"	=> $this->language->get("config_video_limit"),
				"value"	=> isset($this->request->post["config_video_limit"]) ? $this->request->post["config_video_limit"] : $this->config->get("config_video_limit"),
			);
			// users
			$this->load->model("user/user");
			$this->data["tabs"]["users"] = $this->language->get("tab_users");

			if($this->error) {
				$this->session->data["warning"] = $this->error["warning"];
				unset($this->error["warning"]);
				foreach($this->error as $key => $value)
					$this->data["error"][$key] = $value;
			}

			// Rendering...
			if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/setting/setting.tpl'))
				$this->template = $this->config->get('config_template') . '/template/setting/setting.tpl';
			else
				$this->template = 'default/template/setting/setting.tpl';
			$this->children = array("common/header", "common/column_left", "common/footer");
			$this->response->setOutput($this->render());
		}

		private function validate() {

			return ($this->error) ? false : true;
		}
	}
?>
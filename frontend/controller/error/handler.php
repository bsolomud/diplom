<?php
	class ControllerErrorHandler extends Controller {
		public function index() {
			$this->language->load("error/error");

			if(!isset($this->request->get["type"]))
				$this->response->redirect($this->url->link("common/home"));

			$this->document->setTitle(sprintf($this->language->get("heading_title"), $this->language->get("error_" . $this->request->get["type"])));

			$this->data["content"]	= $this->language->get("text_error_" . $this->request->get["type"]);
			$this->data["button"]	= array(
				"href"	=> $this->url->link("common/home"),
				"text"	=> $this->language->get("text_retry")
			);
			// Rendering...
			if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/error/handler.tpl'))
				$this->template = $this->config->get('config_template') . '/template/error/handler.tpl';
			else
				$this->template = 'default/template/error/handler.tpl';
			$this->children = array("common/header", "common/column_left", "common/footer");
			$this->response->setOutput($this->render(true));
		}
	}
?>
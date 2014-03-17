<?php  
class ControllerCommonHome extends Controller {
	public function index() {
		// Load libraries
		$this->language->load("common/home");
		$this->load->model("tool/youtube");
		// Setup document data
		$this->document->setTitle($this->config->get('config_title'));
		$this->document->setDescription($this->config->get('config_meta_description'));

		// Rendering...
		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/common/home.tpl'))
			$this->template = $this->config->get('config_template') . '/template/common/home.tpl';
		else
			$this->template = 'default/template/common/home.tpl';
		$this->children = array("common/header", "common/footer");
		$this->response->setOutput($this->render());
	}
}
?>
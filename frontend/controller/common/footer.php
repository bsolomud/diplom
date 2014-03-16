<?php  
class ControllerCommonFooter extends Controller {
	protected function index() {
		// Loading libraries
		$this->language->load('common/footer');
		// Rendering...
		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/common/footer.tpl'))
			$this->template = $this->config->get('config_template') . '/template/common/footer.tpl';
		else
			$this->template = 'default/template/common/footer.tpl';
		$this->render();
	}
}
?>
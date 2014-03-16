<?php
class ControllerCommonSeoUrl extends Controller {
	public function index() {
		// Add rewrite to url class
		if ($this->config->get('config_seo_url'))
			$this->url->addRewrite($this);
		// Decode URL
		if (isset($this->request->get['_route_'])) {
			$this->request->get['route'] = $this->request->get['_route_'];
			if (isset($this->request->get['route'])) {
				return $this->forward($this->request->get['route']);
			}
		}
	}
}
?>
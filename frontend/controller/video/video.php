<?php
	class ControllerVideoVideo extends Controller {
		public function index() {
			echo '<pre>'; print_r($this->request->cookie); echo '</pre>';
		}
	}
?>
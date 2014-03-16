<?php
	final class Config {
		protected $data = array();
		public function get($key) {
			return (array_key_exists($key, $this->data)) ? $this->data[$key] : false;
		}
		public function set($key, $value) {
			$this->data[$key] = $value;
		}
	}
?>
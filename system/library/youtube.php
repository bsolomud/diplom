<?php
	final class Youtube {
		protected $data = array();
		protected $registry = null;
		protected $host = "http://googleleapis.com/youtube/v3";

		public function __construct($registry) {
			$this->registry = $registry;
			$this->registry->get("load")->helper("json");
		}
		// Youtube get video list
		public function getVideoList($key, $numb = 25) {
			$args = array(
				'part'			=> 'id,snippet,contentDetails,fileDetails,player,statistics,status',
				'key' 			=> GYAKEY,
				'maxResults'	=> $numb
			);
			$response = $this->_get($this->host . '/videos', $args);
			return $response;
		}
		// Youtube search video by keyword
		public function getVideosByKeyword($keyword, $numb) {
			$args = array(
				'q'		=> $keyword,
				'part'	=> 'id,snippet,contentDetails,fileDetails,player,statistics,status',
				'key'	=> GYAKEY,
			);
			$response = $this->__get($this->host . '/search', $args);
		}
		public function getVideoById($id) {
			$args = array(
				'id'	=> $id,
				'part'	=> 'id,snippet,contentDetails,fileDetails,player,statistics,status',
				'key'	=> GYAKEY,
			);
			$response = $this->_get($this->host . '/list', $args);
			return $response;
		}
		// Universal HTTP GET REQUEST TO RETRIVE JSON AND STRING OBJECTS
		private function _get($url, $args = array()) {
			$curl = curl_init();
			curl_setopt($curl, CURLOPT_URL, $url . (($args) ? '?' . implode("&", $args) : ''));
			curl_setopt($curl, CURLOPT_HEADER, false);
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
			curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 30);
			curl_setopt($curl, CURLOPT_USERAGENT, 'Mozilla/4.0 (Windows; U; Windows NT 5.0; En; rv:1.8.0.2) Gecko/20070306 Firefox/1.0.0.4');
			$response = curl_exec($curl);
			curl_close($curl);
			return preg_match("/^\{.+\}$/i", $response) ? json_decode($response) : $response;
		}
		// Universal HTTP POST REQUEST TO RETRIVE JSON AND STRING OBJECTS
		private function _post($url, $data) {
			if(is_array($data)) {
				$args = '';
				foreach($data as $key => $value)
					$args .= $key . "=" . $value . "&";
				$args = rtrim($args, '&');
				$data = $args;
			}

			$curl = curl_init();
			curl_setopt($curl, CURLOPT_URL, $url);
			curl_setopt($curl, CURLOPT_POST, 1);
			curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
			curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
			curl_setopt($curl, CURLOPT_USERAGENT, "Mozilla/4.0 (Windows; U; Windows NT 5.0; En; rv:1.8.0.2) Gecko/20070306 Firefox/1.0.0.4");
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
			$response = curl_exec($curl);
			curl_close($curl);
			return preg_match("/^\{.+\}$/i", $response) ? json_decode($response) : $response;
		}
	}
?>
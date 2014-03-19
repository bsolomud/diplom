<?php
	final class Youtube {
		protected $data = array();
		protected $registry = null;
		protected $host = "http://googleapis.com/youtube/v3";
		protected $client = null;
		protected $youtube = null;

		public function __construct($registry, $key = '') {
			$this->registry = $registry;
			$this->registry->get("load")->helper("json");
			$this->registry->get("load")->helper("google-api-php-client/src/Google_Client");
			$this->registry->get("load")->helper("google-api-php-client/src/contrib/Google_YouTubeService");
			$this->client = new Google_Client();
			$this->client->setDeveloperKey($key);
			$this->youtube = new Google_YoutubeService($this->client);
		}
		// Youtube get video list
		public function getVideoList($keyword = ' ', $numb = 25) {
			$response = new stdClass;
			$response->error = null;
			try {
				$vars = 'id,snippet';
				$data = array('q' => $keyword,'maxResults' => $numb);
				$searchResponse = $this->youtube->search->listSearch($vars, $data);
				$response->videos = array();
				$response->channels = array();
				$response->playlists = array();
				foreach ($searchResponse['items'] as $searchResult) {
					switch ($searchResult['id']['kind']) {
						case 'youtube#video':
							$response->videos[] = $searchResult;
							break;
						case 'youtube#channel':
							$response->channels[] = $searchResult;
							break;
						case 'youtube#playlist':
							$this->playlists[] = $searchResult;
							break;
					}
				}
			} catch (Google_ServiceException $e) {
				$response->error = htmlspecialchars($e->getMessage());
			} catch (Google_Exception $e) {
				$response->error = htmlspecialchars($e->getMessage());
			}
			return $response;
		}
	}
?>
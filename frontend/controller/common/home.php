<?php  
class ControllerCommonHome extends Controller {
	public function index() {
		// Load libraries
		$this->language->load("common/home");
		// Setup document data
		$this->document->setTitle($this->config->get('config_title'));
		$this->document->setDescription($this->config->get('config_meta_description'));

		// Loading custom videos on homepage
		$list = $this->youtube->getVideoList($this->config->get("config_home_video_keyword"));
		$this->data['results'] = array();
		if(!$list->error) {
			foreach($list->videos as $video) {
				$this->data['results'][$video['id']["videoId"]] = array(
					'name'			=> $video["snippet"]["title"],
					'description'	=> $video["snippet"]["description"],
					'publishedAt'	=> date($this->language->get('publish_format'), strtotime($video["snippet"]["publishedAt"])),
					'href'			=> $this->url->link('video/video', 'video=' . $video['id']["videoId"])
				);
				$cookie[] = $video['id']['videoId'];
				$this->data['results'][$video['id']["videoId"]]["thumbnail"] = $video['snippet']['thumbnails']['medium']['url'];
			}
			setcookie('videolist', json_encode($cookie), time() + (60*60*24));
		} else
			$this->data['text_error'] = $list->error;

		// Rendering...
		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/common/home.tpl'))
			$this->template = $this->config->get('config_template') . '/template/common/home.tpl';
		else
			$this->template = 'default/template/common/home.tpl';
		$this->children = array("common/header", "common/column_left", "common/footer");
		$this->response->setOutput($this->render());
	}
}
?>
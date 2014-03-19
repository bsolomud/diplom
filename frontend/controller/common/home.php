<?php  
class ControllerCommonHome extends Controller {
	public function index() {
		// Load libraries
		$this->language->load("common/home");
		$this->load->model("tool/image");
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
					'publishedAt'	=> date($this->config->get('published_format'), strtotime($video["snippet"]["publishedAt"])),
					'url'			=> $this->url->link('video/video', 'video=' . $video['id']["videoId"])
				);
				foreach($video["snippet"]["thumbnails"]["high"] as $thumb)
					$this->data['results'][$video['id']["videoId"]]["thumbnails"][] = $this->model_tool_image->resize($thumb['url'], $this->config->get("video_width"), $this->config->get("video_height"));
			}
			setcookie('videolist', json_encode($this->data['results']));
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
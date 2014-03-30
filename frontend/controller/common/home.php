<?php  
class ControllerCommonHome extends Controller {
	public function index() {
		// Load libraries
		$this->language->load("common/home");
		$this->load->model("video/video");
		// Setup document data
		$this->document->setTitle($this->config->get('config_title'));
		$this->document->setDescription($this->config->get('config_meta_description'));
		
		$url = '';
		if(isset($this->request->get['page'])) {
			$page = $this->request->get['page'];
			$url .= '&page=' . $page;
		} else
			$page = 1;

		$storedVideolist = $this->model_video_video->getVideolist($page, $this->config->get('config_video_limit'));
		$totalstoredVideoList = $this->model_video_video->getTotalVideoList();
		// Loading custom videos on homepage
		$list = $this->youtube->getVideoList($this->config->get("config_home_video_keyword"));
		$this->data['results'] = array();
		$total = 0;
		// Building videolist to show
		if($storedVideolist->num_rows) {
			foreach($storedVideolist->rows as $row) {
				$this->data['results'][$row["video_id"]] = array(
					'name'			=> $row["name"],
					'description'	=> $row["description"],
					'publishedAt'	=> date($this->language->get('publish_format'), strtotime($row["published_at"])),
					'href'			=> $this->url->link('video/video', 'video=' . $row["video_id"] . $url),
					'views'			=> $row['views'],
					'thumbnail'		=> $row['thumbnail']
				);
			}
			$total = $totalstoredVideoList;
		} elseif($list && !$list->error) {
			foreach($list->videos as $video) {
				$this->data['results'][$video['id']["videoId"]] = array(
					'name'			=> $video["snippet"]["title"],
					'description'	=> $video["snippet"]["description"],
					'publishedAt'	=> date($this->language->get('publish_format'), strtotime($video["snippet"]["publishedAt"])),
					'href'			=> $this->url->link('video/video', 'video=' . $video['id']["videoId"] . $url)
				);
				$this->data['results'][$video['id']["videoId"]]["thumbnail"] = $video['snippet']['thumbnails']['medium']['url'];
				$this->model_video_video->saveVideoIfNotExists($video['id']["videoId"], $video);
			}
			$total = count($this->data['results']);
		} else {
			$this->data['text_error'] = $this->language->get("error_empty_page");
			$this->data['error_request'] = $list->error;
		}
		
		$pagination = new Pagination();
		$pagination->total = $total;
		$pagination->page = $page;
		$pagination->limit = $this->config->get('config_video_limit');
		$pagination->text = $this->language->get('text_pagination');
		$pagination->url = $this->url->link('common/home', 'page={page}');
		$this->data['pagination'] = $pagination->render();

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
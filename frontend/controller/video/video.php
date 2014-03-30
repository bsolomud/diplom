<?php
	class ControllerVideoVideo extends Controller {
		public function index() {
			$this->load->language("video/video");
			$this->load->model("video/video");

			$url = '';
			if(isset($this->request->get["page"]))
				$url .= '&page=' . $this->request->get["page"];
			if(!isset($this->request->get['video'])) {
				$this->session->data['notice'] = $this->language->get("error_video");
				$this->response->redirect($this->url->link('common/home', $url));
			}
			$video = $this->model_video_video->getVideoData($this->request->get['video']);
			if(!$video->num_rows) {
				$this->session->data['warning'] = $this->language->get("error_not_found");
				$this->response->redirect($this->url->link('common/home', $url));
			}
			$start = isset($this->request->get['start']) ? $this->request->get['start'] : 0;
			$this->document->setTitle(sprintf($this->language->get('title_format'), $video->row['name'], $this->config->get('config_title')));
			$this->data['video'] = array(
				'name'			=> $video->row['name'],
				'video_id'		=> $video->row['video_id'],
				'description'	=> $video->row['description'],
				'thumbnail'		=> $video->row['thumbnail'],
				'embed'			=> sprintf($this->language->get("embed_url"), $video->row['video_id']),
				'published'		=> date($this->language->get("publish_format"), strtotime($video->row['published_at'])),
				'views'			=> $this->model_video_video->getVideoViews($video->row['id'], $video->row['views'])
			);
			$this->data["share"] = array();
			if($this->user->signedIn()) {
				// Load additional library
				$this->load->model("user/user");
				$this->data["share"] = array(
					"action"	=> $this->url->link("video/share", $url),
					"user_id"	=> $this->user->get("user_id"),
					"text"		=> $this->language->get("text_share"),
					"submit"	=> $this->language->get("button_submit")
				);
				$friends = $this->model_user_user->getUserFriends($this->user->get("user_id"));
				$this->data["share"]["friends"] = array();
				foreach($friends->rows as $friend)
					$this->data["share"]["friends"][$friend["user_id"]] = $friend["username"];
			}
			// Rendering...
			if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/video/video.tpl'))
				$this->template = $this->config->get('config_template') . '/template/video/video.tpl';
			else
				$this->template = 'default/template/video/video.tpl';
			$this->children = array("common/header", "common/column_left", "common/footer");
			$this->response->setOutput($this->render());
		}
	}
?>
<?php
	class ControllerVideoVideo extends Controller {
		public function index() {
			$this->load->language("video/video");
			$this->load->model("video/video");

			if(!isset($this->request->get['video'])) {
				$this->session->data['notice'] = $this->language->get("error_video");
				$this->response->redirect($this->url->link('common/home'));
			}
			$video = $this->model_video_video->getVideoData($this->request->get['video']);
			if(!$video->num_rows) {
				$this->session->data['warning'] = $this->language->get("error_not_found");
				$this->response->redirect($this->url->link('common/home'));
			}
			$start = isset($this->request->get['start']) ? $this->request->get['start'] : 0;

			$this->data['video'] = array(
				'name'			=> $video->row['name'],
				'video_id'		=> $video->row['video_id'],
				'description'	=> $video->row['description'],
				'thumbnail'		=> $video->row['thumbnail'],
				'embed'			=> sprintf($this->language->get("embed_url"), $video->row['video_id']),
				'published'		=> date($this->language->get("publish_format"), strtotime($video->row['published_at'])),
				'views'			=> $this->model_video_video->getVideoViews($video->row['id'], $video->row['views'])
			);
			echo '<pre>'; print_r($this->data['video']); echo '</pre>';
		}
	}
?>
<?php
	class ControllerVideoShare extends Controller {
		protected $error = array();

		public function index() {
			$this->language->load("video/video");
			$this->load->model("user/user");
			$this->load->model("video/video");
			$url = '';
			if(isset($this->request->get["page"])) {
				$url .= '&page=' . $this->request->get["page"];
				$page = $this->request->get["page"];
			} else
				$page = 1;

			if(!$this->user->signedIn()) {
				$redirect = "";
				if(isset($this->request->server["HTTP_REFERER"]) && preg_match("/^" . $this->config->get("config_url") . ".+/i", $this->request->server["HTTP_REFERER"]))
					$redirect = $this->request->server["HTTP_REFERER"];
				else
					$redirect = $this->url->link("common/home", $url);
				$this->response->redirect($redirect);
			}
			if($this->request->server["REQUEST_METHOD"] == "POST" && $this->validate()) {
				$this->model_video_video->shareVideo($this->user->get("user_id"), $this->request->post["video"], $this->request->post["start"], $this->request->post["friends"]);
				$this->session->data['success'] = sprintf($this->language->get("success_share"), $this->model_video_video->getVideoData($this->request->post["video"])->row["name"]);
				$this->response->redirect($this->url->link("video/video", "video=" . $this->request->post["video"] . "&start=" . $this->request->post["start"]));
			} elseif($this->error) {echo 'y';exit;
				$this->session->data["warning"] = $this->error["warning"];
				$this->response->redirect($this->url->link("common/home", $url));
			}

			$this->document->setTitle($this->language->get("heading_title"));

			$shared = $this->model_video_video->getSharedVideo($this->user->get("user_id"), $page, $this->config->get("config_video_limit"));
			$shared_total = $this->model_video_video->getSharedTotal($this->user->get("user_id"));
			$this->data["videolist"] = array();
			if($shared->num_rows) {
				foreach($shared->rows as $row) {
					$this->data["videolist"][$row["video_id"]] = array(
						"title"		=> $row["name"],
						"thumbnail"	=> $row["thumbnail"],
						"shared"	=> date($this->language->get("share_format"), strtotime(preg_match("/^0{4}-0{2}-0{2} 0{2}:0{2}:0{2}$/i", $row["updated_at"]) ? $row["created_at"] : $row["updated_at"])),
						"href"		=> $this->url->link("video/video", "video=" . $row["video_id"] . (($row["start"] > 0) ? '&start=' . $row["start"] : "") . $url),
						"friend"	=> $row["username"]
					);
				}
			} else
				$this->data["no_shared"] = $this->language->get("text_no_shared");

			$pagination = new Pagination();
			$pagination->total = $shared_total;
			$pagination->page = $page;
			$pagination->limit = $this->config->get('config_video_limit');
			$pagination->text = $this->language->get('text_pagination');
			$pagination->url = $this->url->link('video/share', 'page={page}');
			$this->data['pagination'] = $pagination->render();
			// Rendering...
			if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/video/share.tpl'))
				$this->template = $this->config->get('config_template') . '/template/video/share.tpl';
			else
				$this->template = 'default/template/video/share.tpl';
			$this->children = array("common/header", "common/column_left", "common/footer");
			$this->response->setOutput($this->render());
		}

		private function validate() {
			if(!isset($this->request->post["video"]) || !$this->model_video_video->videoExists($this->request->post["video"]))
				$this->error["warning"] = $this->language->get("error_video");
			return ($this->error) ? false : true;
		}
	}
?>
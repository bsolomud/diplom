<?php
	class ModelVideoVideo extends Model {
		public function getTotalVideoList() {
			$query = $this->db->query("SELECT COUNT(*) as total FROM `" . DB_PREFIX . "videolist`");
			return $query->row['total'];
		}
		public function getVideolist($page, $limit) {
			$start = $page - 1;
			$query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "videolist` LIMIT $start,$limit");
			return $query;
		}
		public function saveVideoIfNotExists($video_id, $data) {
			$query = $this->db->query("SELECT `id` FROM `" . DB_PREFIX . "videolist` WHERE video_id='" . $this->db->escape($video_id) . "'");
			if(!$query->num_rows) {
				$name = $data["snippet"]["title"];
				$description = $data["snippet"]["description"];
				$publishedAt = date("Y-m-d h:m:s", strtotime($data["snippet"]["publishedAt"]));
				$thumbnail = $data['snippet']['thumbnails']['medium']['url'];
				$this->db->query("INSERT INTO `" . DB_PREFIX . "videolist` SET `video_id`='" . $this->db->escape($video_id) . "', `name`='" . $this->db->escape($name) . "', `description`='" . $this->db->escape($description) . "', `thumbnail`='" . $this->db->escape($thumbnail) . "', `published_at`='" . $this->db->escape($publishedAt) . "', `created_at`=NOW()");
			}
		}
		public function getVideoData($video_id) {
			$query = $this->db->query("SELECT * from `" . DB_PREFIX . "videolist` WHERE `video_id`='" . $this->db->escape($video_id) . "'");
			return $query;
		}
		public function getVideoViews($id, $views) {
			$views++;
			$this->db->query("UPDATE `" . DB_PREFIX . "videolist` SET `views`=$views WHERE `id`=$id");
			return $views;
		}
	}
?>
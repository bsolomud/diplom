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
			$query = $this->db->query("SELECT * from `" . DB_PREFIX . "videolist` WHERE `video_id`='" . $this->db->escape($video_id) . "' LIMIT 1");
			return $query;
		}
		public function getVideoViews($id, $views) {
			$views++;
			$this->db->query("UPDATE `" . DB_PREFIX . "videolist` SET `views`=$views WHERE `id`=$id");
			return $views;
		}
		public function videoExists($video_id) {
			$query = $this->db->query("SELECT `id` FROM `" . DB_PREFIX . "videolist` WHERE `video_id`='" . $this->db->escape($video_id) . "' LIMIT 1");
			return $query->num_rows;
		}
		public function shareVideo($user_id, $video_id, $start = 0, $friends = array()) {
			if($friends) {
				foreach($friends as $friend_id) {
					$query = $this->db->query("SELECT s.id,s.video_id,s.friend_id,s.user_id FROM `" . DB_PREFIX . "share` s LEFT JOIN `" . DB_PREFIX . "videolist` v ON(v.id=s.video_id) WHERE v.video_id='" . $this->db->escape($video_id) . "' AND s.user_id=$friend_id AND s.friend_id=$user_id LIMIT 1");
					if($query->num_rows)
						$this->db->query("UPDATE `" . DB_PREFIX . "share` SET `status`='0', `start`=" . (int)$start . " WHERE `id`=" . $query->row["id"]);
					else {
						$video = $this->db->query("SELECT `id` FROM `" . DB_PREFIX . "videolist` WHERE `video_id`='" . $this->db->escape($video_id) . "'");
						echo "INSERT INTO `" . DB_PREFIX . "share` SET `user_id`=" . (int)$friend_id . ", `friend_id`=$user_id, `start`=" . (int)$start . ", `video_id`='" . $video->row["id"] . "', `created_at`=NOW()" .'<br />';
						$this->db->query("INSERT INTO `" . DB_PREFIX . "share` SET `user_id`=" . (int)$friend_id . ", `friend_id`=$user_id, `start`=" . (int)$start . ", `video_id`='" . $video->row["id"] . "', `created_at`=NOW()");
					}
				}
			}
		}
		public function getSharedVideo($user_id, $page, $limit) {
			$start = $page - 1;
			$query = $this->db->query("SELECT v.video_id,s.created_at,s.start,s.updated_at,s.status,v.name,u.username,v.description,v.thumbnail,s.friend_id FROM `" . DB_PREFIX . "share` s LEFT JOIN `" . DB_PREFIX . "videolist` v ON (s.video_id=v.id) LEFT JOIN `" . DB_PREFIX . "user` u ON (s.friend_id=u.user_id) WHERE s.user_id=$user_id ORDER BY s.status,s.created_at,s.updated_at DESC LIMIT $start,$limit");
			return $query;
		}
		public function getSharedTotal($user_id) {
			$query = $this->db->query("SELECT COUNT(*) as total FROM `" . DB_PREFIX . "share` WHERE `user_id`=$user_id");
			return $query->row["total"];
		}
	}
?>
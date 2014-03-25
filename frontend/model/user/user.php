<?php
	class ModelUserUser extends Model {
		public function createNewUser($data, $ip) {
			$this->db->query("INSERT INTO `" . DB_PREFIX . "user` SET `username`='" . $this->db->escape($data["username"]) . "', `password`='" . $this->db->escape(md5($data["password"])) . "', `status`=1, `ip`='$ip', `email`='" . $this->db->escape($data["email"]) . "', `user_group_id`=2, `created_at`=NOW()");
		}
		public function usernameExists($username) {
			$query = $this->db->query("SELECT `user_id` FROM `" . DB_PREFIX . "user` WHERE `username`='" . $this->db->escape($username) . "' LIMIT 1");
			return $query->num_rows;
		}
		public function emailExists($email) {
			$query = $this->db->query("SELECT `user_id` FROM `" . DB_PREFIX . "user` WHERE `email`='" . $this->db->escape($email) . "' LIMIT 1");
			return $query->num_rows;
		}
		public function updateUserFriendsList($user_id, $friends = array()) {
			if($friends) {
				foreach($friends as $friend_id) {
					$this->db->query("DELETE FROM `" . DB_PREFIX . "user_friend` WHERE `user_id`=$user_id AND `friend_id`=$friend_id");
					$this->db->query("INSERT INTO `" . DB_PREFIX . "user_friend` SET `user_id`=$user_id, `friend_id`=$friend_id");
				}
			}
		}
		public function getUsersList($current_user) {
			$query = $this->db->query("SELECT `user_id`, `username` FROM `" . DB_PREFIX . "user` WHERE `user_id` NOT IN ($current_user)");
			return $query->rows;
		}
		public function getUserData($user_id) {
			$return = array();
			$query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "user` WHERE `user_id`=$user_id LIMIT 1");
			$return = $query->row;
			$friends = $this->db->query("SELECT `friend_id` FROM `" . DB_PREFIX . "user_friend` WHERE `user_id`=$user_id");
			$return["friends"] = array();
			foreach($friends->rows as $friend)
				$return["friends"][] = $friend["friend_id"];
			return $return;
		}
	}
?>
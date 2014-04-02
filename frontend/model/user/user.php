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
			if(is_array($friends)) {
				$this->db->query("DELETE FROM `" . DB_PREFIX . "user_friend` WHERE `user_id`=$user_id AND `friend_id` IN (" . $this->db->escape(implode(",", $friends)) . ")");
				foreach($friends as $friend_id)
					$this->db->query("INSERT INTO `dp_user_friend`(`user_id`, `friend_id`) VALUES ($user_id," . (int)$this->db->escape($friend_id) . ")");
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
		public function updateUserData($user_id, $data) {
			if(isset($data["friends"])) {
				$this->updateUserFriendsList($user_id, $data["friends"]);
				unset($data["friends"]);
			}
			if($data) {
				$sql = " ";
				foreach($data as $key => $value)
					$sql .= "$key='" . $this->db->escape($value) . "' ";
				$this->db->query("UPDATE `" . DB_PREFIX . "user` SET$sqlWHERE `user_id`=$user_id");
			}
		}
		public function getUserFriends($user_id) {
			$query = $this->db->query("SELECT u.user_id,u.username FROM `" . DB_PREFIX . "user_friend` uf LEFT JOIN `" . DB_PREFIX . "user` u ON(uf.friend_id=u.user_id) WHERE uf.user_id=$user_id");
			return $query;
		}
	}
?>
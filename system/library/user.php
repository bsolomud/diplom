<?php
class User {
	protected $data = array();
	private $permission = array();

	public function __construct($registry) {
		$this->db = $registry->get('db');
		$this->request = $registry->get('request');
		$this->session = $registry->get('session');

		if (isset($this->session->data['user_id'])) {
			$user_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "user WHERE user_id = '" . (int)$this->session->data['user_id'] . "' AND status = '1'");
			$this->data["username"] = $user_query->row["username"];
			$this->data["email"] = $user_query->row["email"];
			if ($user_query->num_rows) {
				foreach($user_query->row as $key => $value)
					$this->data[$key] = $value;
				$this->db->query("UPDATE " . DB_PREFIX . "user SET ip = '" . $this->db->escape($this->request->server['REMOTE_ADDR']) . "' WHERE user_id = '" . (int)$this->session->data['user_id'] . "'");
				$user_group_query = $this->db->query("SELECT permission FROM " . DB_PREFIX . "user_group WHERE user_group_id = '" . (int)$user_query->row['user_group_id'] . "'");
				$permissions = unserialize($user_group_query->row['permission']);
				if (is_array($permissions)) {
					foreach ($permissions as $key => $value)
						$this->permission[$key] = $value;
				}
			} else
				$this->signout();
		}
	}

	public function signIn($username, $password) {
		$user_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "user WHERE username = '" . $this->db->escape($username) . "' AND `password`='" . $this->db->escape(md5($password)) . "' AND status = '1'");
		if ($user_query->num_rows) {
			$this->session->data['user_id'] = $user_query->row['user_id'];

			$this->data["user_id"] = $user_query->row['user_id'];
			$user_group_query = $this->db->query("SELECT permission FROM " . DB_PREFIX . "user_group WHERE user_group_id = '" . (int)$user_query->row['user_group_id'] . "'");
			$permissions = unserialize($user_group_query->row['permission']);
			if (is_array($permissions)) {
				foreach ($permissions as $key => $value)
					$this->permission[$key] = $value;
			}
			return true;
		} else
			return false;
	}

	public function signout() {
		unset($this->session->data['user_id']);
		$this->data = array();
		session_destroy();
	}

	public function hasPermission($key, $value) {
		return (isset($this->permission[$key]) && in_array($value, $this->permission[$key])) ? true : false;
	}

	public function signedIn() {
		return !empty($this->data);
	}

	public function get($key) {
		return array_key_exists($key, $this->data) ? $this->data[$key] : false;
	}
}
?>
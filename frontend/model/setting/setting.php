<?php 
class ModelSettingSetting extends Model {
	public function getSetting($group) {
		$data = array(); 
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "setting WHERE `group` = '" . $this->db->escape($group) . "'");
		foreach($query->rows as $row)
			$data[$row["key"]] = ($row["serialized"]) ? unserialize($row["value"]) : $row["value"];
		return $data;
	}
	public function getLanguages() {
		$query = $this->db->query("SELECT `code`, `name` FROM `" . DB_PREFIX . "language`");
		return $query;
	}
	public function updateSettig($group, $rows) {
		foreach($rows as $key => $value)
			$this->db->query("UPDATE `" . DB_PREFIX . "setting` SET `value`='$value' WHERE `group`='$group' AND `key`='$key'");

	}
}
?>
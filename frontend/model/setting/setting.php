<?php 
class ModelSettingSetting extends Model {
	public function getSetting($group) {
		$data = array(); 
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "setting WHERE `group` = '" . $this->db->escape($group) . "'");
		foreach($query->rows as $row)
			$data[$row["key"]] = ($row["serialized"]) ? unserialize($row["value"]) : $row["value"];
		return $data;
	}
}
?>
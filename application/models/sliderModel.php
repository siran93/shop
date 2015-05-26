<?php
	class SliderModel extends CI_Model{
		public $tbName = 'slider';
		public $id = 'id';
		function __construct(){
			parent::__construct();
		}
		public function insertSlider($data){
			$this->db->insert($this->tbName, $data);
		}
		public function getSlider(){
			$this->db->order_by('id', 'DESC');
			$query = $this->db->get($this->tbName);
			return $query->result_array();
		}
		public function deleteSlider($id){
			$this->db->where('id', $id);
			$this->db->delete($this->tbName);
		}
		public function getImageSlider($id){
			$result = $this->db->get_where($this->tbName, array('id' => $id));
			return $result->result_array();
		}
		public function updateSlider($id){
			$sql = "UPDATE slider
					SET `status` = CASE `status`
					WHEN 1 THEN
						0
					WHEN 0 THEN
						1
					END
					WHERE
						id = ".$id;
			$this->db->query($sql);
		}
		public function getSliderImage(){
			$this->db->order_by('id', 'DESC');
			$this->db->where('status', '1');
			$query = $this->db->get($this->tbName);
			return $query->result_array();
		}
	}
?>
<?php

class CctvModel extends CI_Model{

    public function get_recording_count() {

        return $this->db->count_all_results('tbl_recordings');// return an integer for result

    }

    public function get_recordings($limit, $offset) {
        $this->db->limit($limit, $offset);
      	$this->db->select('video, name, DATE(uploadDate) as uploadDate');
        $query = $this->db->get('tbl_recordings');
        $results = $query->result_array();
        return $results;

    }

    public function insert_recording($data){

        $this->db->insert('tbl_recordings', $data);

    }

    public function get_recording($id){

        $query = $this->db->get_where("tbl_products", array("id" => $id));
        return $query->result_array();  

    }

    public function update_product($id, $data){

        return $this->db->update("tbl_products", $data, array("id" => $id));

    }

    public function delete_product($id){
        $this->db->delete('tbl_products', array('id' => $id));
    }


    public function dnd($data){
        echo "<pre>";
        echo var_dump($data);
        echo "</pre>";
        die();
    }
}
?>
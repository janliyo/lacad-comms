<?php

//model for the signup controller
class ReportsModel extends CI_Model{

    public function get_users() {
        $query = $this->db->get('tbl_users');
        return $query->result_array();
    }

    public function dnd($data){
        echo "<pre>";
        echo var_dump($data);
        echo "</pre>";
        die();
    }
}
?>
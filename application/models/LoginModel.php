<?php

class LoginModel extends CI_Model{

    public function get_user($data){
        return $this->db->get_where("tbl_users", $data)->result_array();
    }
}
?>
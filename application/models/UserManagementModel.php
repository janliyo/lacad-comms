<?php

//model for the signup controller
class UserManagementModel extends CI_Model{

    // adds the account to the database
    public function add_user($data){
        return $this->db->insert("tbl_users", $data);
    }

    // checks if the provided email link is present in the database
    public function check_link($link){
        return $this->db->get_where("tbl_users", array("token"=>$link));
    }

    // updates the status of the account to activate it
    public function activate_account($link){
        $this->db->where("token", $link);
        return $this->db->update("tbl_users", array("isactive" => 1, "token" => "active - ".$link));
    }

    public function get_user_count() {

        return $this->db->count_all_results('tbl_users'); // return an integer for result
    }

    public function get_users() {

        $query = $this->db->get('tbl_users');
        return $query->result_array();

    }

    public function get_user($id){

        $query = $this->db->get_where("tbl_users", array("id" => $id));
        return $query->result_array();  

    }

    public function update_user($id, $data){
        return $this->db->update("tbl_users", $data, array("id" => $id));
    }

    public function deactivate_user($id){
        $this->db->where('id', $id);
        return $this->db->update('tbl_users', array('isactive' => 0));
    }

    public function dnd($data){
        echo "<pre>";
        echo var_dump($data);
        echo "</pre>";
        die();
    }
}
?>
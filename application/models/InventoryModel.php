<?php

class InventoryModel extends CI_Model{

    public function get_products($limit, $offset, $search = null) {

        if ($search != null) {
            // Search for users
            $this->db->like('prod_name', $search,'both');
        }

        // Set limit and offset
        $this->db->limit($limit, $offset);

        // Set the order
        $this->db->order_by('prod_name', 'ASC');

        // Get all users from the database
        $this->db->select('*, (prod_quantity/prod_base_stock)*100 AS availability, (prod_sell_price - prod_cost_price) AS profit');
        $query = $this->db->get('tbl_products');
        $results = $query->result_array();
        
        foreach ($results as &$result) {
            if ($result['availability'] >= 51) {
                $result['category'] = 'High stock';
            } elseif ($result['availability'] > 25) {
                $result['category'] = 'Needs attention';
            } else {
                $result['category'] = 'Low stock';
            }
        }
        return $results;
    }

    public function get_product_count($search = null) {

        // Check if search is not null
        if ($search != null) {

            // Search for users
            $this->db->like('prod_name', $search, 'both');
        }

        return $this->db->count_all_results('tbl_products'); // return an integer for result
    }

    public function get_product($id){

        $query = $this->db->get_where("tbl_products", array("id" => $id));
        return $query->result_array();  

    }

    public function insert_product($data){

        $this->db->insert('tbl_products', $data);

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
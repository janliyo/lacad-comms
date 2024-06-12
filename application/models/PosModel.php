<?php

class PosModel extends CI_Model {

    public function get_products() {
        $query = $this->db->get('tbl_products');
        return $query->result_array();
    }

    public function get_product($id) {
        $query = $this->db->get_where('tbl_products', array('id' => $id));
        return $query->row_array();
    }

    public function update_product_quantity($id, $quantity) {
        $this->db->set('prod_quantity', 'prod_quantity - ' . $quantity, FALSE);
        $this->db->where('id', $id);
        $this->db->update('tbl_products');
    }

    public function get_product_categories() {
        $query = $this->db->query('SELECT DISTINCT prod_category FROM tbl_products');
        return $query->result_array();
    }

    public function get_products_by_category($category) {
        $query = $this->db->get_where('tbl_products', array('prod_category' => $category));
        return $query->result_array();
    }

    public function get_products_by_search($search) {
        $this->db->like('prod_name', $search);
        $query = $this->db->get('tbl_products');
        return $query->result_array();
    }

    public function get_products_by_category_and_search($category, $search) {
        $this->db->like('prod_name', $search);
        $this->db->where('prod_category', $category);
        $query = $this->db->get('tbl_products');
        return $query->result_array();
    }

    public function add_to_checkout($item_id, $quantity)
    {
        // Retrieve the current inventory for the item
        $query = $this->db->get_where('inventory', array('item_id' => $item_id));
        $inventory = $query->row_array();
    
        // Check if the item is in stock
        if ($inventory['quantity'] < $quantity) {
            return false;
        }
    
        // Retrieve the item data
        $query = $this->db->get_where('items', array('item_id' => $item_id));
        $item = $query->row_array();
    
        // Calculate the total price
        $total = $item['price'] * $quantity;
    
        // Insert the checkout data into the database
        $data = array(
            'item_id' => $item_id,
            'quantity' => $quantity,
            'price' => $item['price'],
            'total' => $total,
            'date_created' => date('Y-m-d H:i:s')
        );
        $this->db->insert('checkout', $data);
    
        // Return true if the checkout data was inserted successfully
        return true;
    }

    public function get_checkout_data()
{
    // Retrieve the checkout data from the database
    $query = $this->db->get('checkout');
    return $query->result_array();
}

public function update_inventory($item_id, $quantity)
{
    // Retrieve the current inventory for the item
    $query = $this->db->get_where('inventory', array('item_id' => $item_id));
    $inventory = $query->row_array();

    // Update the inventory for the item
    $new_quantity = $inventory['quantity'] - $quantity;
    $this->db->update('inventory', array('quantity' => $new_quantity), array('item_id' => $item_id));
}

}
?>
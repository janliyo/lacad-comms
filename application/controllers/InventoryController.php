<?php

class InventoryController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->helper(array("url", "string"));
        $this->load->library(array("session", "form_validation", "email", "pagination", "upload"));
    }

    public function index()
    {
        $this->load->model("InventoryModel");
        $search = null;

        if ($this->input->get('search') != "") {
            $search = $this->input->get('search');
        }
        $config['base_url'] = base_url('InventoryController/index');
        $config['total_rows'] = $this->InventoryModel->get_product_count($search);
        $config['per_page'] = 3;
        $config['uri_segment'] = 3;
        $config['attributes'] = array('class' => 'page-link');
        $config['reuse_query_string'] = TRUE;
        $config['full_tag_open'] = '<nav aria-label="Page navigation"><ul class="pagination justify-content-center">';
        $config['full_tag_close'] = '</ul></nav>';
        $config['first_link'] = '<i class="bi bi-chevron-bar-left"></i>';
        $config['first_tag_open'] = '<li class="page-item">';
        $config['first_tag_close'] = '</li>';
        $config['prev_link'] = '<i class="bi bi-chevron-left"></i>';
        $config['prev_tag_open'] = '<li class="page-item">';
        $config['prev_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="page-item active"><a href="#" class="page-link">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li class="page-item">';
        $config['num_tag_close'] = '</a></li>';
        $config['next_link'] = '<i class="bi bi-chevron-right"></i>';
        $config['next_tag_open'] = '<li class="page-item">';
        $config['next_tag_close'] = '</li>';

        $this->pagination->initialize($config);

        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

        $this->pagination->initialize($config);

        //create array to hold pagination information
        $data = array(
            'title' => 'Products List',
            'products' => $this->InventoryModel->get_products($config['per_page'], $page, $search), //fetch all cameras present in the database
            // Create pagination links                                              
            'links' => $this->pagination->create_links()
        );

        $data["title"] = "LACAD - Inventory";
        $data["style"] = "assets/css/inventory.css";
        $data["page"] = "Inventory";

        $this->load->view("includes/header", $data);
        $this->load->view("includes/base", $data);
        $this->load->view("inventory/inventory_view");
        $this->load->view("includes/footer");
    }

    public function addProduct()
    {
        $data["title"] = "LACAD - Add Product";
        $data["style"] = "assets/css/addproduct.css";
        $data["page"] = "Add Product";

        $this->load->view("includes/header", $data);
        $this->load->view("includes/base", $data);
        $this->load->view("inventory/addProduct_view");
        $this->load->view("includes/footer");
    }

    public function insertProduct()
    {
        $this->load->model("InventoryModel");

        $config['upload_path'] = 'uploads/products/';
        $config['allowed_types'] = 'jpeg|jpg|png';
        $config['max_size'] = 10000; // 10MB
        $config['max_width'] = 10000;
        $config['max_height'] = 10000;

        $this->upload->initialize($config);

        $data = array(
            "prod_name" => $this->input->post('name'),
            "prod_quantity" => $this->input->post('quantity'),
            "prod_expiry" => $this->input->post('expiry'),
            "prod_category" => $this->input->post('category'),
            "prod_cost_price" => $this->input->post('cost_price'),
            "prod_sell_price" => $this->input->post('sell_price'),
            "prod_base_stock" => $this->input->post('base_stock')
        );

        if (!empty($_FILES['image']['name'])) {
            if ($this->upload->do_upload('image')) {
                // Get uploaded image data
                $image_data = $this->upload->data();
                $uploaded_image = $image_data["file_name"];
                $data["prod_image"] = $uploaded_image;
            } else {
                // Set error message and reload the form
                $this->session->set_flashdata('error', $this->upload->display_errors());
                redirect('InventoryController/addProduct');
            }
        }

        // Insert product data into the database
        $this->InventoryModel->insert_product($data);

        // Set success message and redirect
        $this->session->set_flashdata('success', 'Product has been added successfully.');
        redirect('InventoryController');
    }

    public function editProduct($id)
    {

        $this->load->model("InventoryModel");

        $data["product"] = $this->InventoryModel->get_product($id);
        $data["title"] = "LACAD - Edit Product";
        $data["style"] = "assets/css/editproduct.css";
        $data["page"] = "Edit Product";

        $this->load->view("includes/header", $data);
        $this->load->view("includes/base", $data);
        $this->load->view("inventory/editProduct_view", $data);
        $this->load->view("includes/footer");
    }

    public function updateProduct($id)
    {

        $this->load->model("InventoryModel");

        $config['upload_path'] = 'uploads/products/';
        $config['allowed_types'] = 'jpeg|jpg|png';
        $config['max_size'] = 10000; // 5MB
        $config['max_width'] = 10000;
        $config['max_height'] = 10000;

        $this->upload->initialize($config);

        $data = array(
            "prod_name" => $this->input->post('name'),
            "prod_quantity" => $this->input->post('quantity'),
            "prod_expiry" => $this->input->post('expiry'),
            "prod_category" => $this->input->post('category'),
            "prod_cost_price" => $this->input->post('cost_price'),
            "prod_sell_price" => $this->input->post('sell_price'),
            "prod_base_stock" => $this->input->post('base_stock')
        );

        if (!empty($_FILES['image']['name'])) {
            if ($this->upload->do_upload('image')) {

                // Get uploaded image data
                $image_data = $this->upload->data();
                $uploaded_image = $image_data["file_name"];

                $data["prod_image"] = $uploaded_image;
            } else {

                // Set error message
                $this->session->set_flashdata('error', $this->upload->display_errors());
                redirect('InventoryController');
            }
        }

        $this->InventoryModel->update_product($id, $data);

        // Set success message
        $this->session->set_flashdata('success', 'Product information updated successfully.');
        redirect('InventoryController');
    }

    public function deleteProduct($id)
    {
        $this->load->model("InventoryModel");
        $this->InventoryModel->delete_product($id);
        $this->session->set_flashdata('success', 'Product deleted successfully.');
        redirect("InventoryController");
    }


    public function dnd($data)
    {
        echo "<pre>";
        echo var_dump($data);
        echo "</pre>";
        die();
    }
}

<?php 
require_once FCPATH.'vendor/autoload.php';

class PosController extends CI_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->database();
        $this->load->helper(array("url","string"));
        $this->load->library(array("session", "form_validation","email"));
        $this->load->model('PosModel');
        
    }

    public function index()
	{ 
        $data['categories'] = $this->PosModel->get_product_categories();
        $data['products'] = $this->PosModel->get_products();

        $data["title"] = "LACAD - POS";
        $data["style"] = "assets/css/sales.css";
        $data["page"] = "POS";
        
        $this->load->view("includes/header", $data);
        $this->load->view("includes/base", $data);
		$this->load->view("pos/pos_view");
        $this->load->view("includes/footer");
	}

    public function checkout()
    {
        $data["title"] = "LACAD - Checkout";
        $data["style"] = "assets/css/checkout.css";
        $data["page"] = "Checkout";

        $this->load->view("includes/header", $data);
        $this->load->view("includes/base", $data);
        $this->load->view("pos/checkout.php");
        $this->load->view("includes/footer");
    }

    public function dnd($data){
        echo "<pre>";
        echo var_dump($data);
        echo "</pre>";
        die();
    }

    
} 

?>
<?php 

class DashboardController extends CI_Controller{
    public function __construct(){
        parent::__construct();

        $this->load->helper(array("url","string"));
        $this->load->library(array("session", "form_validation","email"));
    }

    public function index()
	{ 
        $data["title"] = "LACAD - DASHBOARD";
        $data["style"] = "assets/css/dashboard.css";
        $data["page"] = "Dashboard";
        
        $this->load->view("includes/header", $data);
        $this->load->view("includes/base", $data);
		$this->load->view("dashboard_view");
        $this->load->view("includes/footer");
	}

    
} 

?>
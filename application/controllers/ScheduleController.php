<?php 

class ScheduleController extends CI_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->database();
        $this->load->helper(array("url","string"));
        $this->load->library(array("session", "form_validation","email"));
    }

    public function index()
	{ 
        $data["title"] = "LACAD - SCHEDULE";
        $data["style"] = "assets/css/schedule.css";
        $data["page"] = "Schedule";
        
        $this->load->view("includes/header", $data);
        $this->load->view("includes/base", $data);
		$this->load->view("schedule_view");
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
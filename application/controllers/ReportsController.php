<?php 
require_once FCPATH.'vendor/autoload.php';
class ReportsController extends CI_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->database();
        $this->load->helper(array("url","string"));
        $this->load->library(array("session", "form_validation","email"));
    }

    public function index()
	{ 
        $data["title"] = "LACAD - REPORTS";
        $data["style"] = "assets/css/reports.css";
        $data["page"] = "Reports";
        
        $this->load->view("includes/header", $data);
        $this->load->view("includes/base", $data);
		$this->load->view("reports_view");
        $this->load->view("includes/footer");
	}

    public function printUsers(){
        $this->load->model("ReportsModel");
        $data["users"] = $this->ReportsModel->get_users();

        $html = $this->load->view("pdfTemplates/userReport_view", $data, TRUE);
        $mpdf = new \Mpdf\Mpdf();
        $mpdf->WriteHTML($html);
        $mpdf->Output();
    }

    public function dnd($data){
        echo "<pre>";
        echo var_dump($data);
        echo "</pre>";
        die();
    }
} 

?>
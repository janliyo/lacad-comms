<?php 

class LoginController extends CI_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->database();
        $this->load->helper(array("url","string"));
        $this->load->library(array("session", "form_validation","email"));
    }

    public function index()
	{ 
        $data["title"] = "LACAD - LOGIN";
        $data["style"] = "assets/css/login.css";
        
        $this->load->view("includes/header", $data);
		$this->load->view("login_view");
        $this->load->view("includes/footer");
	}

    public function login_user(){
        $this->load->model("LoginModel");

        $data["username"] = $this->input->post("username");
        $data["password1"] = $this->input->post("password1");
        
        //checks if user exists in the database
        $check_user = $this->LoginModel->get_user($data);
        
        //checks if the account is activated
        if(count($check_user) == 1 && $check_user[0]["isactive"] == "1"){

            //creates array to hold the account information
            $user_data["id"] =  $check_user[0]["id"];
            $user_data["name"] =  $check_user[0]["name"];
            $user_data["role"] =  $check_user[0]["role"];
            $user_data["image"] =  $check_user[0]["image"];

            //sets a session for the account
            $this->session->set_userdata($user_data);

            //when session is created, redirect to homepage
            if($this->session->userdata("id")){
                redirect("DashboardController");
            }

            //if no account is found, return to login page with error message
            else{
                $this->session->set_flashdata("error", "Account unable to login.");
                $this->index();
            }
        }

        //if the account is unactivated, return to login page with error message
        elseif(count($check_user) == 1 && $check_user[0]["isactive"] == "0"){
            $this->session->set_flashdata("warning", "Activate your account first.");
            $this->index();
        }

        //if wrong inputs, return to login page with error message
        else{
            $this->session->set_flashdata("error", "Invalid email or passowrd.");
            $this->index();
        }
    }

    public function signout() {
        $this->session->unset_userdata('id');
        redirect('LoginController');
    }

    public function dnd($data){
        echo "<pre>";
        echo var_dump($data);
        echo "</pre>";
        die();
    }
} 

?>
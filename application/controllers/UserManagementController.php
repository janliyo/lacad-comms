<?php 

class UserManagementController extends CI_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->database();
        $this->load->helper(array("url","string"));
        $this->load->library(array("session", "form_validation","email","pagination", "upload"));
    }

    public function index()
	{ 
        $this->load->model("UserManagementModel");

        $data = array(
            'title' => 'Users List',
            'users' => $this->UserManagementModel->get_users(),
            'total_users' => count($this->UserManagementModel->get_users()) // Total number of users
        );
        $data["title"] = "LACAD - USER MANAGEMENT";
        $data["style"] = "assets/css/users.css";
        $data["page"] = "User Account Management";
            
        $this->load->view("includes/header", $data);
        $this->load->view("includes/base", $data);
		$this->load->view("userManagement/userManagement_view", $data);
        $this->load->view("includes/footer");
	}

    public function register()
	{ 
        $data["title"] = "USER MANAGEMENT - ADD USER";
        $data["style"] = "assets/css/register.css";
        $data["page"] = "User Account Management";
        
        $this->load->view("includes/header", $data);
        $this->load->view("includes/base", $data);
		$this->load->view("userManagement/register_view");
        $this->load->view("includes/footer");
	}

    public function addUser()
	{ 
        $this->form_validation->set_rules("email", "Email", "trim|valid_email|is_unique[tbl_users.email]");

        if($this->form_validation->run() == FALSE){
            $this->register();
        }
        else{
            $this->load->model("UserManagementModel");

            $data["role"] = $this->input->post("role");
            $data["name"] = $this->input->post("emp_name");
            $data["username"] = $this->input->post("emp_username");
            $data["email"] = $this->input->post("email");
            $data["token"] = random_string(type: "alnum", len:20);

            //$this->dnd($data);
            $check_insert = $this->UserManagementModel->add_user($data);

            if($check_insert){
                if($this->send_email($data)){ //for successful registration, reload registration page with success messages 
                    $this->session->set_flashdata("success", "Account Registered Successfully! Check your inbox to activate your account.");
                    $this->register();  
                }
                else{ // if failed, print error message
                    $this->session->set_flashdata('error', $this->email->print_debugger());
                    $this->register();  
                }
                
            }
        }
	}

    public function send_email($data){

        //setup email configurations
        $config['useragent'] = 'CodeIgniter'; // IMPORTANT: Change this to your application name
        $config['protocol'] = 'smtp';
        $config['smtp_host'] = 'smtp.gmail.com';
        $config['smtp_user'] = 'mail.lacad.tech@gmail.com'; // IMPORTANT: Add your email address here
        $config['smtp_pass'] = 'yxyj foge cgqi fkxm'; // IMPORTANT: Add your email password here (use app password if getting error, check google for process)
        $config['smtp_port'] = 465;
        $config['smtp_crypto'] = 'ssl';
        $config['mailtype'] = 'html';
        $config['charset'] = 'utf-8';
        $config['newline'] = "\r\n";

        // Initialize email library
        $this->email->initialize($config);

        // Send email
        $this->email->from('mail.lacad.tech@gmail.com', 'LACAD');
        $this->email->to($this->input->post('email'));
        $this->email->subject('Account Activation');
        $this->email->message('Dear ' . $this->input->post('email') . ',<br><br>Thank you for registering. Please click the link below to verify your email address:<br><br><a href="' . base_url('UserManagementController/verify_email/') . $data["token"] . '">Verify Email</a><br><br>Thank you,<br>LACAD');
        
        //checks if email is sent, return boolean value to register_user() for validation
        if(!$this->email->send()){
            return FALSE;
        }
        else{
            return TRUE;
        }
    }

//verifies account activation link sent by the user through the URL
    public function verify_email($activation_link){

        //load model 
        $this->load->model("UserManagementModel");

        //check uri segment 3 for link parameter
        if(!empty($activation_link)){

            //checks whether the link provided matches the one from the database record
            $check_link = $this->UserManagementModel->check_link($activation_link);

            //if the query returns exactly one row, activate account
            if($check_link->num_rows() == 1){
                $check_active_account = $this->UserManagementModel->activate_account($activation_link);

                //when account is activated, proceed to login page
                if($check_active_account){
                    $this->session->set_flashdata("success", "Account Activated Successfully! Log in to your account now.");
                    redirect("UserManagementController/register");
                }
                //if failed, return to registration page
                else{
                    $this->session->set_flashdata("error", "Account Activation Failed! Please try again.");
                    $this->index();  
                }
            }
        //when given wrong link, give warning message and return to registration page
        else{
            $this->session->set_flashdata('warning', "Invalid link provided.");
            $this->index();
        }
        }
        //when no link is provided, return to regsitration page with warning message
        else{
            $this->session->set_flashdata('warning', "Please chack you email to get your activation link.");
            $this->index();
        }

    }

    public function update($id){

        $this->load->model("UserManagementModel");

        $data["user"] = $this->UserManagementModel->get_user($id);
        $data["title"] = "USER MANAGEMENT - EDIT USER";
        $data["style"] = "assets/css/update.css";
        $data["page"] = "User Account Management";
        
        $this->load->view("includes/header", $data);
        $this->load->view("includes/base", $data);
		$this->load->view("userManagement/update_view", $data);
        $this->load->view("includes/footer");
    }

    public function editUser($id)
    {

        $this->load->model("UserManagementModel");

        $config['upload_path'] = 'uploads/employees/';
        $config['allowed_types'] = 'jpeg|jpg|png';
        $config['max_size'] = 10000; // 5MB
        $config['max_width'] = 10000;
        $config['max_height'] = 10000;

        $this->upload->initialize($config);

        $data = array(
            "name" => $this->input->post('name'),
            "email" => $this->input->post('email'),
            "username" => $this->input->post('username'),
            "password1" => $this->input->post('password1'),
            "password2" => $this->input->post('password2'),
            "role" => $this->input->post('role')
        );

        if (!empty($_FILES['image']['name'])) {
            if ($this->upload->do_upload('image')) {

                // Get uploaded image data
                $image_data = $this->upload->data();
                $uploaded_image = $image_data["file_name"];

                $data["image"] = $uploaded_image;
            } else {

                // Set error message
                $this->session->set_flashdata('error', $this->upload->display_errors());
                redirect('UserManagementController');
            }
        }

        $this->UserManagementModel->update_user($id, $data);

        // Set success message
        $this->session->set_flashdata('success', 'Employee information updated successfully.');
        redirect('UserManagementController');
    }

    public function deactivate($id){
        $this->load->model("UserManagementModel");
        $this->UserManagementModel->deactivate_user($id);
        $this->session->set_flashdata('success', 'User Deactivated successfully.');
        redirect("UserManagementController");
    }

    public function dnd($data){
        echo "<pre>";
        echo var_dump($data);
        echo "</pre>";
        die();
    }
} 

?>
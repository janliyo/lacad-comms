<?php 

class CctvController extends CI_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->database();
        $this->load->helper(array("url","string"));
        $this->load->library(array("session", "form_validation","email", "upload", "pagination"));
    }

    public function index()
	{ 
        $this->load->model("CctvModel");

        $config['base_url'] = base_url('CctvController/index');
        $config['total_rows'] = $this->CctvModel->get_recording_count();
        $config['per_page'] = 1;
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

        $data = array(
            'title' => 'Products List',
            'recordings' => $this->CctvModel->get_recordings($config['per_page'], $page), //fetch all cameras present in the database
            // Create pagination links                                              
            'links' => $this->pagination->create_links()
        );
        $data["title"] = "LACAD - CCTV";
        $data["style"] = "assets/css/cctv.css";
        $data["page"] = "CCTV";
        
        $this->load->view("includes/header", $data);
        $this->load->view("includes/base", $data);
		$this->load->view("cctv/cctv_view");
        $this->load->view("includes/footer");
	}

    public function upload()
	{ 
        $data["title"] = "LACAD - CCTV";
        $data["style"] = "assets/css/cctv.css";
        $data["page"] = "CCTV";
        
        $this->load->view("includes/header", $data);
        $this->load->view("includes/base", $data);
		$this->load->view("cctv/uploadCCTV_view");
        $this->load->view("includes/footer");
	}

    public function upload_video() {
        ini_set('max_execution_time', 900);
        $this->load->model("CctvModel");

        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = 'mp4';
        $config['max_size'] = 102400; // 100MB

        $this->upload->initialize($config);

        if ( ! $this->upload->do_upload('userfile')) {
            $this->session->set_flashdata("error", "Recording Upload Failed!");
            $this->index();
        } else {
            $video_data = $this->upload->data();
            $file_path = $video_data['full_path'];

            $data = array(
                "video" => $video_data['file_name'],
                "name" => $this->input->post('name')
            );

            $this->CctvModel->insert_recording($data);

            // Run the YOLOv7 inference script
            $output_path = $this->run_yolo_inference($file_path);

            //$data = array('upload_data' => $data, 'output_path' => $output_path);
            $this->index();
        }
    }

    private function run_yolo_inference($file_path) {
        $python_env_path = 'yolov7-env\Scripts\python.exe'; // Update with your virtual environment's Python path
        $yolo_script_path = 'yolo_inference.py'; // Update with the correct path to your yolo_inference.py script
        $command = escapeshellcmd("$python_env_path $yolo_script_path $file_path");

        // Execute the command
        shell_exec($command);

        // Return the path to the output video
        $output_path = 'uploads\output\result'; // Adjust the path as needed
        return $output_path;
    }

    public function dnd($data){
        echo "<pre>";
        echo var_dump($data);
        echo "</pre>";
        die();
    }
} 

?>
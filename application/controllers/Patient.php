<?php
  if (!defined('BASEPATH'))exit('No direct script access allowed');
  class Patient extends CI_Controller{

    function __construct(){
      parent::__construct();
        $this->load->model('Model_user');
        $this->load->model('Model_patient');
    }

    public function List($id = null){
      $header['title'] = "HIS: Patient List";
      $header['tasks'] = $this->Model_user->get_tasks($this->session->userdata('type_id'));
      $header['permissions'] = $this->Model_user->get_permissions($this->session->userdata('type_id'));
      $data['total_patients_count'] = $this->Model_patient->get_total_patient_count();
      $data['total_admitted_patients_count'] = $this->Model_patient->get_count_admitted_patient();
      $data['total_admitted_in_er_count'] = $this->Model_patient->get_count_patient_admitted_in_er();
      $this->load->view('users/includes/header.php',$header);
      if(empty($id)){
       $data['patients'] = $this ->Model_patient->fetch_all_patient();
       $this->load->view('patient/patientlist.php', $data);
      }else{
        $data['patient'] = $this->Model_patient->get_single_patient($id);
        $this->load->view('patient/patientinfo.php', $data);
      }
    }

    public function VitalsHistory(){
      $header['title'] = "HIS: Patient Vital signs";
      $header['tasks'] = $this->Model_user->get_tasks($this->session->userdata('type_id'));
      $header['permissions'] = $this->Model_user->get_permissions($this->session->userdata('type_id'));
      $data['vitalsign_data'] = $this->Model_patient->get_vital_sign($this->uri->segment(3));
      $this->load->view('users/includes/header.php',$header);
      $this->load->view('patient/vitalshistory.php', $data);
    }

    public function recordvitalsign(){
      $data = array(
                    'heart_rate'=>$this->input->post('heartrate'),
                    'resp_rate'=>$this->input->post('respiratoryrate'),
                    'blood_pres'=>$this->input->post('bloodpressure'),
                    'body_temp'=>$this->input->post('temperature'),
                    'patient_id'=>$this->uri->segment(3),
                    'user_id'=>$this->session->userdata('user_id')
                   );
      $sql = $this->Model_patient->recordvitalsign($data);
      redirect(base_url().'Patient/VitalsHistory/'.$this->uri->segment(3));
    }

    public function AdmittingHistory(){
      $header['title'] = "HIS: Patient Admitting History";
      $header['tasks'] = $this->Model_user->get_tasks($this->session->userdata('type_id'));
      $header['permissions'] = $this->Model_user->get_permissions($this->session->userdata('type_id'));
      $data['admitting_data'] = $this->Model_patient->get_admitting_data($this->uri->segment(3));
      $this->load->view('users/includes/header.php',$header);
      $this->load->view('patient/admittinghistory.php', $data);
    }

    public function LaboratoryHistory(){
      $header['title'] = "HIS: Patient Laboratory History";
      $header['tasks'] = $this->Model_user->get_tasks($this->session->userdata('type_id'));
      $header['permissions'] = $this->Model_user->get_permissions($this->session->userdata('type_id'));
      $data['laboratory_data'] = $this->Model_patient->get_laboratory_data($this->uri->segment(3));
      $this->load->view('users/includes/header.php',$header);
      $this->load->view('patient/laboratoryhistory.php', $data);
    }

    public function RadiologyHistory(){
      $header['title'] = "HIS: Patient Radiology History";
      $header['tasks'] = $this->Model_user->get_tasks($this->session->userdata('type_id'));
      $header['permissions'] = $this->Model_user->get_permissions($this->session->userdata('type_id'));
      $data['radiology_data'] = $this->Model_patient->get_radiology_data($this->uri->segment(3));
      $this->load->view('users/includes/header.php',$header);
      $this->load->view('patient/radiologyhistory.php', $data);
    }

    public function PharmacyHistory(){
      $header['title'] = "HIS: Patient Pharmacy History";
      $header['tasks'] = $this->Model_user->get_tasks($this->session->userdata('type_id'));
      $header['permissions'] = $this->Model_user->get_permissions($this->session->userdata('type_id'));
      $data['pharmacy_data'] = $this->Model_patient->get_pharmacy_data($this->uri->segment(3));
      $this->load->view('users/includes/header.php',$header);
      $this->load->view('patient/pharmacyhistory.php', $data);
    }

  }
?>

<?php
/**
 * Created by PhpStorm.
 * User: subhegde
 * Date: 14/9/15
 * Time: 5:43 PM
 */

class Users extends CI_Controller {
    public function __construct(){
        parent::__construct();
        if($this->getCustomer()==null){
            redirect('login','refresh');
        }
        $this->load->model("user_model");
    }

    public function dashboard(){
        //print_r($this->getCustomer());
        $data = $this->getCustomer();
        $data['pageTitle'] = "Dashboard";
        loadViewFiles(true,false,'customer/dashboard',$data);
    }

    public function getCustomer(){
        if($this->session->userdata('customerData')){
            return $this->session->userdata('customerData');
        } else {
            return null;
        }
    }

    public function logout(){
        $this->session->unset_userdata('customerData');
        redirect('login','refresh');
    }

    /**
     * Function to add new users to the system
     */
    public function create(){
        try{
            $data = $this->getCustomer();
            $data['pageTitle'] = "Create New User";
            $this->load->helper('form');
            loadViewFiles(true,true,'users/edit',$data);
            //throw new Exception("mm");
        } catch(Exception $e){
            loadViewFiles(true,false,'error',$data);
            log_message("error",$e->getMessage());
        }
    }

    /**
     * Function to save user details
     */
    public function save(){
        try{
            $data = array();
            print_r($this->input->post());
        } catch(Exception $e){
            loadViewFiles(true,false,'error',$data);
            log_message("error",$e->getMessage());
        }
    }

    /**
     * Validate email address
     */
    public function validateUserEmail(){
        try{
            $data = array();
            $this->load->helper(array('form', 'url'));
            $response = array();
            $email = $this->input->post("email");
            $userId = $this->input->post('id');
            //throw new Exception("test");
            if(filter_var($email, FILTER_VALIDATE_EMAIL) && !$this->user_model->isEmailAlreadyExists($email, $userId)){
                $response['status'] = 1;
            } else {
                $response['status'] = 0;
            }
        }catch (Exception $e){
            $response['status']= 500;
        }
        echo json_encode($response);
    }
}
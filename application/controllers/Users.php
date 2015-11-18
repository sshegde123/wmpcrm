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

    /**
     * User grid view
     */
    public function index(){
        $data['userSession'] = $this->getCustomer();
        $data['all'] = $this->user_model->getUsersList();
        $data['pageTitle'] = "All Users";
        //print_r($data['all']);
        loadViewFiles(true,false,'users/list',$data);
    }
    public function dashboard(){
        //print_r($this->getCustomer());
        $data['userSession'] = $this->getCustomer();
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
            if($this->input->get('id')){
                $data = $this->user_model->getUserData($this->input->get('id'));
            }
            $data['userSession'] = $this->getCustomer();
            $data['pageTitle'] = "Create New User";
            $this->load->helper('form');
            loadViewFiles(true,true,'users/edit',$data);
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
            $postData = $this->input->post();
            $this->load->library('form_validation');
            $this->form_validation->set_rules('first_name','first_name', 'trim|required');
            $this->form_validation->set_rules('last_name','last_name','trim|required');
            $this->form_validation->set_rules('email','email','trim|required|valid_email');
            $redirectUrl = 'users/create';

            if(!$postData['phone'] && !$postData['mobile']){
                $this->form_validation->set_rules('phone','phone','trim|required|regex_match[/^[0-9]+$/]');
                $this->form_validation->set_rules('mobile','mobile','trim|required|regex_match[/^[0-9]+$/]');
            }
            if($this->form_validation->run() && !$this->user_model->isEmailAlreadyExists($postData['email'],$postData['id'])){
                $userId = $this->user_model->saveUser($postData);
                if($userId){
                    $this->session->set_flashdata('successMsg', 'User Account created successfully.');
                    $redirectUrl = $redirectUrl."?id=".$userId;
                    redirect($redirectUrl,'refresh');
                    return true;
                }
            }
        } catch(Exception $e){
            loadViewFiles(true,false,'error',$data);
            log_message("error",$e->getMessage());
        }
        if($postData['id']){
            $redirectUrl = $redirectUrl.'?id='.$postData['id'];
        }
        $this->session->set_flashdata('errorMsg', 'Error while saving user details. Please try again.');
        redirect($redirectUrl,'refresh');
        return;
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
            if(filter_var($email, FILTER_VALIDATE_EMAIL)){
                $response['status'] = 0;
            }
            if(!$this->user_model->isEmailAlreadyExists($email, $userId)){
                $response['status'] = 1;
            } else {
                $response['status'] = 2;
            }
        }catch (Exception $e){
            $response['status']= 500;
        }
        echo json_encode($response);
    }
}
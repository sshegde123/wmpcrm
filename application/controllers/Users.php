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
            print_r($this->input->post());
        } catch(Exception $e){
            loadViewFiles(true,false,'error',$data);
            log_message("error",$e->getMessage());
        }
    }
}
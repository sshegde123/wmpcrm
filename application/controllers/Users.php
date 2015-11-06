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
            loadViewFiles(true,false,'users/edit',$data);
        } catch(Exception $e){
            loadViewFiles(true,false,'error',$data);
            log_message("error",$e->getMessage());
        }
    }
}
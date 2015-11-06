<?php
/**
 * Created by PhpStorm.
 * User: subhegde
 * Date: 15/9/15
 * Time: 10:59 AM
 */




class Login_model extends  CI_Model {

    public function __construct(){
        $this->load->database();
    }

    /*
     * Function to authenticate customer login
     * @params String $userName, String $password
     * @return boolean
     */
    public function authenticateCustomer($userName, $password){
        try{
            $users = $this->db->select('*')->get_where('users', array('email'=>$userName, 'password' => md5($password)));
            //echo "<pre>";print_r();exit;
            if($users->result_array()){
                $this->setCustomerSession($users->result_array()[0]);
                return true;
            }
        } catch(Exception $e){

        }
        return false;
    }


    public function setCustomerSession($usersData){
        $this->session->set_userdata('customerData',$usersData);
    }
} 
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
            $customer = $this->db->get_where('customers', array('email'=>$userName, 'password' => md5($password)));
            if($customer->num_rows){
                $this->setCustomerSession($customer->result_array()[0]);
                return true;
            }
        } catch(Exception $e){

        }
        return false;
    }


    public function setCustomerSession($customerData){
        $this->session->set_userdata('customerData',$customerData);
    }
} 
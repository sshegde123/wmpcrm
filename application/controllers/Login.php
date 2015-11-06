<?php
/**
 * Created by PhpStorm.
 * User: subhegde
 * Date: 14/9/15
 * Time: 12:26 PM
 */

//namespace admin;


class Login extends CI_Controller {

    public function __construct(){
        parent::__construct();
        //$this->load->model('form_model');
        $this->load->model('login_model');
        //$this->load->library('session');
    }
    public function index(){

        $this->load->helper('form');
        $data['pageTitle'] = "Login";
        $this->load->helper('common');
        $data['loginMsg'] = "";
        if(!$this->input->post()){
            $this->loginViewFiles($data);
        } else {
            $this->load->helper(array('form', 'url'));
            $this->load->library('form_validation');

            $this->form_validation->set_rules("userName", "Username",'trim|required');
            $this->form_validation->set_rules("password","Password",'trim|required');
            if(!$this->form_validation->run()){
                $this->loginViewFiles($data);
            } else {
                if($this->login_model->authenticateCustomer($this->input->post('userName'),$this->input->post('password'))){
                    redirect('customer/dashboard','refresh');
                } else {
                    $data['loginMsg'] = "Invalid Login details";
                    $this->loginViewFiles($data);
                }

            }
        }

    }


    public function loginViewFiles($data){
        loadViewFiles(true,true,'authentication/login',$data);
    }

    public function signUp(){
        $data['pageTitle'] = "Sign Up";
        loadViewFiles(true,false,'authentication/signup',$data);
    }

}
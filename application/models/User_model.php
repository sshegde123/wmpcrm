<?php

/**
 * Created by Subrahmanya Hegde.
 * User: Subrahmanya Hegde
 * Date: 13/11/15
 * Time: 12:09 PM
 */
class User_model extends CI_Model
{
    public  function __construct()
    {
        $this->load->database();
    }

    /**
     * Function to validate email. return status, 1-Already exists, 0-not found, 500-any error
     * @param $email
     * @param null $userId
     * @return int
     */
    public function isEmailAlreadyExists($email,$userId = null){
        try{
            if($userId){
                $users = $this->db->select('email')->get_where("users", array("email"=>$email, "id <>" => $userId));
                //throw new Exception("Test");
                if($users->result_array()){
                    return 1;
                } else {
                    return 0;
                }
            }
        } catch(Exception $e){
            log_message("error",$e->getMessage());
            return 500;
        }
    }

}
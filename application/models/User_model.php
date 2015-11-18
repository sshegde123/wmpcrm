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
                if($users->result_array()){
                    return 1;
                } else {
                    return 0;
                }
            } else {
                $users = $this->db->select('email')->get_where("users", array("email"=>$email));
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

    /**
     * @param $userData array of customer data to be saved
     * @return int. customer id;
     */
    public function saveUser($userData){
        try{

            $userFields = $this->db->list_fields('users');
            $userDetailsFields = $this->db->list_fields('user_details');
            $user = array();
            $userDetails = array();
            foreach($userFields as $field){
                if(isset($userData[$field]) && $field !="id" )
                    $user[$field] = $userData[$field];
            }
            foreach($userDetailsFields as $field){
                if(isset($userData[$field]) && $field !="id")
                    $userDetails[$field] = $userData[$field];
            }

            $userDetails['user_role_id'] = null;
            if(isset($userData['roles']) && $userData['roles'])
                $userDetails['user_role_id'] = serialize($userData['roles']);

            $this->db->trans_start();
            //unset($user['id']);
            if(isset($userData['id']) and $userData['id']){
                $userId = $userData['id'];
                $this->db->where('id',$userId)->update('users',$user);
                $userDetails['user_id'] = $userId;
                $this->db->where('user_id',$userId)->update('user_details',$userDetails);
            } else {
                $user['status'] = 0;
                $user['password'] = md5($user['password']);
                $user['created_at'] = date("Y-m-d h:i:s");
                $this->db->insert('users',$user);
                $userDetails['user_id'] = $this->db->insert_id();
                $this->db->insert('user_details',$userDetails);
            }
            $this->db->trans_complete();
            return $userDetails['user_id'];
        } catch(Exception $e){
            $this->db->trans_rollback();
            log_message('error',$e->getMessage());
        }
        return 0;
    }

    /**
     * Function to get user details of given id
     * @param $userId
     * @return array|null
     */

    public function getUserData($userId){
        try{
            $userDetails = array();
            $this->db->select('*')->from('users')
                ->join('user_details','user_details.user_id = users.id','inner')
                ->where('users.id',$userId);
            $userDetails = $this->db->get()->result_array()[0];
            return $userDetails;

            return $userDetails;
        }catch (Exception $e){
            log_message("error",$e->getMessage());
            return null;
        }
    }

    public function getUsersList(){
        try{
            $users = array();
            $this->db->select('*')->from('users')->join('user_details','user_details.user_id = users.id','inner');
            return  $this->db->get()->result_array();
        } catch(Exception $e){
            log_message('error',$e->getMessage());
        }
    }
}
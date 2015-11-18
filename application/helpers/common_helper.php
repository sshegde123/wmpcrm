<?php
/**
 * Created by PhpStorm.
 * User: subhegde
 * Date: 14/9/15
 * Time: 1:22 PM
 */

function getSkinUrl($filePath = null){
    if($filePath){
        return base_url().'skin/'.$filePath;
    } else {
        return base_url().'skin/';
    }
}

function isLoggedIn(){
    $ci = get_instance();
    if($ci->session->userdata('customerData')){
        return true;
    }
    return false;
}

function loadViewFiles($enableLeft,$enableRight,$contentViewName,$data){
    $ci = get_instance();
    $ci->load->view('templates/head', $data);
    $ci->load->view('templates/header', $data);
    if($enableLeft)
        $ci->load->view('templates/left', $data);

    $ci->load->view($contentViewName, $data);
    if($enableRight)
        $ci->load->view('templates/right', $data);

    $ci->load->view('templates/footer', $data);
}

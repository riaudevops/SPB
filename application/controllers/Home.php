<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
    public function index()
    {
        $data['title'] = "Homepage";
        $data['index'] = 1;
        $this->load->view('templates/header',$data);
        $this->load->view('templates/sidebar',$data);
        $this->load->view('templates/topbar');

        if($this->session->userdata('username') !== null){
            if ($this->session->userdata('hak_akses') == 1) {
                $this->load->view('home/dashboard');
            }else{
                $this->load->view('home/user_dashboard');
            }
        }else{
            $this->load->view('home/index');
        }
        $this->load->view('templates/footer');
    }
}
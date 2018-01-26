<?php

/*
 * @Author:    Kiril Kirkov
 *  Gitgub:    https://github.com/kirilkirkov
 */
if (!defined('BASEPATH')) { 
    exit('No direct script access allowed');
}

class Customers extends ADMIN_Controller
{

    public function index()
    {
    
        $this->login_check();  
                     
        $data = array();
        $head = array();
        $head['title'] = 'Administration - Customers';
        $head['description'] = '!';
        $head['keywords'] = '';
        $data['customers'] = $this->AdminModel->customer_get(['type' => 'customer']);         

        $this->load->view('_parts/header', $head);
        $this->load->view('advanced_settings/customers', $data);
        $this->load->view('_parts/footer');
        $this->saveHistory('Go to Customers');
    }
    

}

<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Registration extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('email');
        
        if ($this->session->userdata('user_type')) {
            redirect('dashboard');
		}
    }


    public function index() {
        $head = array();
        $data = array();
        $head['brand'] = $this->Publicmodel->getShopBrands();
        $head['categories'] = $this->Publicmodel->getShopCategory_mother(['sub_for' => 0, 'category_name !=' => '']);
        $head['sub_categories'] = $this->Publicmodel->getShopCategory_child();

        $arrSeo = $this->Publicmodel->getSeo('page_contacts');
        $head['title'] = 'Registration';
        $head['description'] = @$arrSeo['description'];
        $head['keywords'] = str_replace(" ", ",", $head['title']);
        $this->render('signup', $head, $data);
        
        //redirect('registration');
    }
    
    
    
    public function insert () {
        $msg_err = '';
        if (isset($_POST['name']) && isset($_POST['email']) && isset($_POST['username']) && isset($_POST['password'])) {   // if mandetory data exist
            $txtEmail    = 	strtolower($_POST['email']);
            $txtName     = 	ucwords($_POST['name']);
            $txtPhone    = 	$_POST['phone'];
            $txtUsername = 	strtolower($_POST['username']);
            $txtPassword = 	$_POST['password'];

            $isValidEmail = false;
            $isValidPhone = false;
            $isValidUsername = false;

            // $txtEmail formate validation & uniq check
            if (filter_var($txtEmail, FILTER_VALIDATE_EMAIL)) {
                if ($this->Publicmodel->get_user(['email' => $txtEmail])) {
                    $msg_err = $msg_err.'Email already exist.</br>';
                } else {
                    $isValidEmail = true;
                }
            } else {
                $msg_err = $msg_err.'Incorrect email formate.</br>';
            }

            // $txtPhone numeric check
            if (is_numeric($txtPhone) && strlen($txtPhone)) {
                if ($this->Publicmodel->get_user(['phone' => $txtPhone])) {
                    $msg_err = $msg_err.'Phone number already exist.</br>';
                } else {
                    $isValidPhone = true;
                }
            } else {
                $msg_err = $msg_err.'Incorrect phone number.</br>';
            }

            // $txtUsername uniq check
            if ($this->Publicmodel->get_user(['username' => $txtUsername])) {
                $msg_err = $msg_err.'Username already exist.</br>';
            } else {
                $isValidUsername = true;
            }

            if ($isValidEmail && $isValidPhone && $isValidUsername) {
                // inserting into user table
                $user_id = $this->Publicmodel->insert_user([
                    'name'	    =>  $txtName,
                    'email'	    =>  $txtEmail,
                    'phone'	    =>  $txtPhone,
                    'username'	=>  $txtUsername,
                    'password'	=>  sha1($txtPassword. SALT),
                    'token'		=>  sha1($txtPassword. SALT.time()),
                    'type'	    =>  'customer',
                    'status'	=>  1,
                    'refferer'	=>  1,
                ]);
                
                // update seller id
                if ($this->session->userdata('user_id')) {
        			$reffer = $this->session->userdata('user_id');
        		} else {
        		    $reffer = $user_id;
        		}
                $update_refferer = $this->Publicmodel->update_user(['user_id' => $user_id], ['refferer' => $reffer]);

                // insert shipping_address
                $shipping_address = $this->Publicmodel->insert_shipping_address(['user_id' => $user_id]);
                // insert billing_address
                $billing_address = $this->Publicmodel->insert_billing_address(['user_id' => $user_id]);
                // insert rewards_address
                $rewards_address = $this->Publicmodel->insert_rewards_address(['user_id' => $user_id]);

                if ($user_id) {
                    $msg_err = 'Registration successful';
                } else {
                    $msg_err = $msg_err.'Registration fail.</br>';
                }
            }
        } else {
            $msg_err = $msg_err.'All mandetory fields are not filled up.</br>';
        }

        $this->session->set_flashdata('resultSend', $msg_err);
        redirect('registration');
    }


}

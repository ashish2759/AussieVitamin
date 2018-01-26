<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('email');
        
        if (!$this->session->userdata('user_type')) {
            redirect('login');
		}
    }


    public function index() {
        $head = array();
        $data = array();
        $head['brand'] = $this->Publicmodel->getShopBrands();
        $head['categories'] = $this->Publicmodel->getShopCategory_mother(['sub_for' => 0, 'category_name !=' => '']);
        $head['sub_categories'] = $this->Publicmodel->getShopCategory_child();

        $arrSeo = $this->Publicmodel->getSeo('page_contacts');
        $head['title'] = 'Order';
        $head['description'] = @$arrSeo['description'];
        $head['keywords'] = str_replace(" ", ",", $head['title']);
        
        $arr = array();
        for($i=0; $i< get_cookie('total'); $i++){
            $arr[] = get_cookie('product_id'.$i);
        }
        
        if(!empty($arr)){
            $data['products'] = $this->Publicmodel->get_join_product_translation($arr); 
        }
        
        $data['order_data'] = $this->Publicmodel->get_ordered_det($this->session->userdata('user_id')); 
        //print_r($data['order_data']);die();
        $data['imageall'] = $this->Publicmodel->get_All_products();
        $this->render('order', $head, $data);
    }
    

    public function mypage() {
        $head = array();
        $data = array();
        $head['brand'] = $this->Publicmodel->getShopBrands();
        $head['categories'] = $this->Publicmodel->getShopCategory_mother(['sub_for' => 0, 'category_name !=' => '']);
        $head['sub_categories'] = $this->Publicmodel->getShopCategory_child();

        $arrSeo = $this->Publicmodel->getSeo('page_contacts');
        $head['title'] = 'My Page';
        $head['description'] = @$arrSeo['description'];
        $head['keywords'] = str_replace(" ", ",", $head['title']);
        $this->render('mypage', $head, $data);
    }
    
    
    public function accountsettings() {
        $head = array();
        $data = array();
        $head['brand'] = $this->Publicmodel->getShopBrands();
        $head['categories'] = $this->Publicmodel->getShopCategory_mother(['sub_for' => 0, 'category_name !=' => '']);
        $head['sub_categories'] = $this->Publicmodel->getShopCategory_child();

        $data['user'] = $this->Publicmodel->get_user(['user_id' => $this->session->userdata('user_id')]);
        $arrSeo = $this->Publicmodel->getSeo('page_contacts');
        $head['title'] = 'Account Settings';
        $head['description'] = @$arrSeo['description'];
        $head['keywords'] = str_replace(" ", ",", $head['title']);
        $this->render('accountsettings', $head, $data);
    }
    
    
    function update() {
        $user_id = $this->session->userdata('user_id');
        $msg_err = '';

        $txtEmail    = 	strtolower($_POST['email']);
        $txtName     = 	ucwords($_POST['name']);
        $txtPhone    = 	$_POST['phone'];
        $txtPassword = 	$_POST['password'];
        $txtConfirmPassword = 	$_POST['confirm_password'];

        if(isset($_POST['name']) && isset($_POST['email']) && isset($_POST['phone'])){   // if mandetory data exist
            $isValidEmail = false;
            $isValidPassword = false;
            $isValidPhone = false;

            $data = $this->Publicmodel->get_user(['user_id' => $user_id]);
            if (filter_var($txtEmail, FILTER_VALIDATE_EMAIL)) {
                if ($data[0]['email']!=$txtEmail) {
                    if ($this->Publicmodel->get_user(['email' => $txtEmail])) {
                        $msg_err = $msg_err.'Email is already taken. ';
                    } else {
                        $update_email = $this->Publicmodel->update_user(['user_id' => $user_id], ['email' => $txtEmail]);
                        if (!$update_email) {
                            $msg_err = $msg_err.'Email updation failed. ';
                        } else {
                            $isValidEmail = true;
                        }
                    }
                } else {
                    $isValidEmail = true;
                }
            } else {
                $msg_err = $msg_err.'Incorrect email formate. ';
            }


            if (is_numeric($txtPhone)==true && strlen($txtPhone)==10) {
                $user_update = $this->Publicmodel->update_user(['user_id' => $user_id],[
                    'name' => $txtName,
                    'phone' => $txtPhone
    			]);
                $isValidPhone = true;
            } else {
                $msg_err = $msg_err.'Password mismatched. ';
            }


            if ($txtPassword && $txtConfirmPassword) {
                if ($txtPassword == $txtConfirmPassword) {
                    $update_pwd = $this->Publicmodel->update_user(['user_id' => $user_id], [
                        'password' => sha1($txtPassword. SALT),
                        'token' => sha1($txtPassword.$user_id. SALT)
                    ]);

                    if ($update_pwd) {
                        $isValidPassword = true;
                    }
                } else {
                    $msg_err = $msg_err.'Password mismatched. ';
                }
            } else {
                $isValidPassword = true;
            }


			if ($isValidEmail && $isValidPassword && $isValidPhone) {
				$msg_err = $msg_err.'Settings is updated. ';
			} else {
				$msg_err = $msg_err.'Settings updation failed';
			}
        } else {
            $msg_err = $msg_err.'Required fields are empty.</br>';
        }

        $this->session->set_flashdata('resultSend', $msg_err);
        redirect('dashboard/settings');
    }
    
    
    public function addressbook() {
        $head = array();
        $data = array();
        $head['brand'] = $this->Publicmodel->getShopBrands();
        $head['categories'] = $this->Publicmodel->getShopCategory_mother(['sub_for' => 0, 'category_name !=' => '']);
        $head['sub_categories'] = $this->Publicmodel->getShopCategory_child();

        $arrSeo = $this->Publicmodel->getSeo('page_contacts');
        $head['title'] = 'Address Book';
        $head['description'] = @$arrSeo['description'];
        $head['keywords'] = str_replace(" ", ",", $head['title']);
        
        $data['shipping'] = $this->Publicmodel->get_shipping_address(['user_id' => $this->session->userdata('user_id')]);
        $data['billing'] = $this->Publicmodel->get_billing_address(['user_id' => $this->session->userdata('user_id')]);
        $data['rewards'] = $this->Publicmodel->get_rewards_address(['user_id' => $this->session->userdata('user_id')]);
        $this->render('addressbook', $head, $data);
    }
    
    
    function update_shipping_address() {
        $user_id = $this->session->userdata('user_id');
        $msg_err = '';

        $name    = 	ucwords($_POST['name']);
        $phone     = 	$_POST['phone'];
        $address1    = 	ucwords($_POST['address1']);
        $address2 = 	ucwords($_POST['address2']);
        $city = 	ucwords($_POST['city']);
        $state = 	ucwords($_POST['state']);
        $country = 	ucwords($_POST['country']);
        $zip = 	$_POST['zip'];

        $isValidPhone = false;
        $isValidZip = false;

        if($phone) {
            if (is_numeric($phone)==true && strlen($phone)==10) {
            	$isValidPhone = true;
            } else {
            	$msg_err = $msg_err.'Incorrect phone number. ';
            }            
        } else {
            $isValidPhone = true;
        }
        
        if($zip) {
            if (is_numeric($zip)==true) {
                $isValidZip = true;
            } else {
                $msg_err = $msg_err.'Incorrect zip. ';
            }
        } else {
            $isValidZip = true;
        }

		if ($isValidZip && $isValidPhone) {
            $update = $this->Publicmodel->update_shipping_address(['user_id' => $user_id],[
                'shipping_name' => $name,
                'shipping_phone' => $phone,
                'shipping_address1' => $address1,
                'shipping_address2' => $address2,
                'shipping_city' => $city,
                'shipping_state' => $state,
                'shipping_country' => $country,
                'shipping_zip' => $zip
            ]);

            if ($update) {
                $msg_err = $msg_err.'Shipping address is updated. ';
            } else {
    			$msg_err = $msg_err.'Shipping address failed';
    		}
		}

        $this->session->set_flashdata('resultSend', $msg_err);
        redirect('dashboard/addressbook');
    }
    
    
    
    function update_billing_address() {
        $user_id = $this->session->userdata('user_id');
        $msg_err = '';

        $name    = 	ucwords($_POST['name']);
        $phone     = 	$_POST['phone'];
        $address1    = 	ucwords($_POST['address1']);
        $address2 = 	ucwords($_POST['address2']);
        $city = 	ucwords($_POST['city']);
        $state = 	ucwords($_POST['state']);
        $country = 	ucwords($_POST['country']);
        $zip = 	$_POST['zip'];

        $isValidPhone = false;
        $isValidZip = false;

        if($phone) {
            if (is_numeric($phone)==true && strlen($phone)==10) {
            	$isValidPhone = true;
            } else {
            	$msg_err = $msg_err.'Incorrect phone number. ';
            }            
        } else {
            $isValidPhone = true;
        }
        
        if($zip) {
            if (is_numeric($zip)==true) {
                $isValidZip = true;
            } else {
                $msg_err = $msg_err.'Incorrect zip. ';
            }
        } else {
            $isValidZip = true;
        }

		if ($isValidZip && $isValidPhone) {
            $update = $this->Publicmodel->update_billing_address(['user_id' => $user_id],[
                'billing_name' => $name,
                'billing_phone' => $phone,
                'billing_address1' => $address1,
                'billing_address2' => $address2,
                'billing_city' => $city,
                'billing_state' => $state,
                'billing_country' => $country,
                'billing_zip' => $zip
            ]);

            if ($update) {
                $msg_err = $msg_err.'Billing address is updated. ';
            } else {
    			$msg_err = $msg_err.'Billing address failed';
    		}
		}

        $this->session->set_flashdata('resultSend', $msg_err);
        redirect('dashboard/addressbook');
    }    
    
    
    function update_rewards_address() {
        $user_id = $this->session->userdata('user_id');
        $msg_err = '';

        $name    = 	ucwords($_POST['name']);
        $phone     = 	$_POST['phone'];
        $address1    = 	ucwords($_POST['address1']);
        $address2 = 	ucwords($_POST['address2']);
        $city = 	ucwords($_POST['city']);
        $state = 	ucwords($_POST['state']);
        $country = 	ucwords($_POST['country']);
        $zip = 	$_POST['zip'];

        $isValidPhone = false;
        $isValidZip = false;

        if($phone) {
            if (is_numeric($phone)==true && strlen($phone)==10) {
            	$isValidPhone = true;
            } else {
            	$msg_err = $msg_err.'Incorrect phone number. ';
            }            
        } else {
            $isValidPhone = true;
        }
        
        if($zip) {
            if (is_numeric($zip)==true) {
                $isValidZip = true;
            } else {
                $msg_err = $msg_err.'Incorrect zip. ';
            }
        } else {
            $isValidZip = true;
        }

		if ($isValidZip && $isValidPhone) {
            $update = $this->Publicmodel->update_rewards_address(['user_id' => $user_id],[
                'rewards_name' => $name,
                'rewards_phone' => $phone,
                'rewards_address1' => $address1,
                'rewards_address2' => $address2,
                'rewards_city' => $city,
                'rewards_state' => $state,
                'rewards_country' => $country,
                'rewards_zip' => $zip
            ]);

            if ($update) {
                $msg_err = $msg_err.'Rewards address is updated. ';
            } else {
    			$msg_err = $msg_err.'Rewards address failed';
    		}
		}

        $this->session->set_flashdata('resultSend', $msg_err);
        redirect('dashboard/addressbook');
    }       
    
    
    
    public function reviews() {
        $head = array();
        $data = array();
        $head['brand'] = $this->Publicmodel->getShopBrands();
        $head['categories'] = $this->Publicmodel->getShopCategory_mother(['sub_for' => 0, 'category_name !=' => '']);
        $head['sub_categories'] = $this->Publicmodel->getShopCategory_child();

        $arrSeo = $this->Publicmodel->getSeo('page_contacts');
        $head['title'] = 'Reviews';
        $head['description'] = @$arrSeo['description'];
        $head['keywords'] = str_replace(" ", ",", $head['title']);
        $this->render('reviews', $head, $data);
    }    
    
    
    public function messages() {
        $head = array();
        $data = array();
        $head['brand'] = $this->Publicmodel->getShopBrands();
        $head['categories'] = $this->Publicmodel->getShopCategory_mother(['sub_for' => 0, 'category_name !=' => '']);
        $head['sub_categories'] = $this->Publicmodel->getShopCategory_child();

        $arrSeo = $this->Publicmodel->getSeo('page_contacts');
        $head['title'] = 'Messages';
        $head['description'] = @$arrSeo['description'];
        $head['keywords'] = str_replace(" ", ",", $head['title']);
        $this->render('messages', $head, $data);
    }    
   

    public function termsandcondition() {
        $head = array();
        $data = array();
        $head['brand'] = $this->Publicmodel->getShopBrands();
        $head['categories'] = $this->Publicmodel->getShopCategory_mother(['sub_for' => 0, 'category_name !=' => '']);
        $head['sub_categories'] = $this->Publicmodel->getShopCategory_child();

        $arrSeo = $this->Publicmodel->getSeo('page_contacts');
        $head['title'] = 'Terms and Condition';
        $head['description'] = @$arrSeo['description'];
        $head['keywords'] = str_replace(" ", ",", $head['title']);
        $this->render('termsandcondition', $head, $data);
    }
    
    
    public function faq() {
        $head = array();
        $data = array();
        $head['brand'] = $this->Publicmodel->getShopBrands();
        $head['categories'] = $this->Publicmodel->getShopCategory_mother(['sub_for' => 0, 'category_name !=' => '']);
        $head['sub_categories'] = $this->Publicmodel->getShopCategory_child();

        $arrSeo = $this->Publicmodel->getSeo('page_contacts');
        $head['title'] = 'F.A.Q.';
        $head['description'] = @$arrSeo['description'];
        $head['keywords'] = str_replace(" ", ",", $head['title']);
        $this->render('faq', $head, $data);
    }
    
    public function overview() {
        $head = array();
        $data = array();
        $head['brand'] = $this->Publicmodel->getShopBrands();
        $head['categories'] = $this->Publicmodel->getShopCategory_mother(['sub_for' => 0, 'category_name !=' => '']);
        $head['sub_categories'] = $this->Publicmodel->getShopCategory_child();

        $arrSeo = $this->Publicmodel->getSeo('page_contacts');
        $head['title'] = 'Overview';
        $head['description'] = @$arrSeo['description'];
        $head['keywords'] = str_replace(" ", ",", $head['title']);
        $this->render('overview', $head, $data);
    }
    
    public function notification() {
        $head = array();
        $data = array();
        $head['brand'] = $this->Publicmodel->getShopBrands();
        $head['categories'] = $this->Publicmodel->getShopCategory_mother(['sub_for' => 0, 'category_name !=' => '']);
        $head['sub_categories'] = $this->Publicmodel->getShopCategory_child();

        $arrSeo = $this->Publicmodel->getSeo('page_contacts');
        $head['title'] = 'Notification';
        $head['description'] = @$arrSeo['description'];
        $head['keywords'] = str_replace(" ", ",", $head['title']);
        $this->render('notification', $head, $data);
    }
    
    public function emailpreference() {
        $head = array();
        $data = array();
        $head['brand'] = $this->Publicmodel->getShopBrands();
        $head['categories'] = $this->Publicmodel->getShopCategory_mother(['sub_for' => 0, 'category_name !=' => '']);
        $head['sub_categories'] = $this->Publicmodel->getShopCategory_child();

        $arrSeo = $this->Publicmodel->getSeo('page_contacts');
        $head['title'] = 'Email Preference';
        $head['description'] = @$arrSeo['description'];
        $head['keywords'] = str_replace(" ", ",", $head['title']);
        $this->render('emailpreference', $head, $data);
    }
    
    public function quickshop() {
        $head = array();
        $data = array();
        $head['brand'] = $this->Publicmodel->getShopBrands();
        $head['categories'] = $this->Publicmodel->getShopCategory_mother(['sub_for' => 0, 'category_name !=' => '']);
        $head['sub_categories'] = $this->Publicmodel->getShopCategory_child();
        $arrSeo = $this->Publicmodel->getSeo('page_contacts');
        $head['title'] = 'Quick Shop';
        $head['description'] = @$arrSeo['description'];
        $head['keywords'] = str_replace(" ", ",", $head['title']);
        $this->render('quickshop', $head, $data);
    }
    
    public function wishlist() {
        $head = array();
        $data = array();
        $head['brand'] = $this->Publicmodel->getShopBrands();
        $head['categories'] = $this->Publicmodel->getShopCategory_mother(['sub_for' => 0, 'category_name !=' => '']);
        $head['sub_categories'] = $this->Publicmodel->getShopCategory_child();

        $arrSeo = $this->Publicmodel->getSeo('page_contacts');
        $head['title'] = 'Wish List';
        $head['description'] = @$arrSeo['description'];
        $head['keywords'] = str_replace(" ", ",", $head['title']);
        $this->render('wishlist', $head, $data);
    }

    

}

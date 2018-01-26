<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Registration extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('email');
        
        if ($this->session->userdata('user_type')) {
 $this->guest_to_cart_afterlogin();
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

		
		$to = $txtEmail;
		$subject = "Welcome to Aussie Vitamin Store";
		$message = "Welcome to Aussie Vitamin Store";
		// Always set content-type when sending HTML email
		$headers = "MIME-Version: 1.0" . "\r\n";
		$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
		
		// More headers
		$headers .= 'From: <webmaster@example.com>' . "\r\n";
		$headers .= 'Cc: myboss@example.com' . "\r\n";
		
		mail($to,$subject,$message,$headers);
		
		
		$to = "suman@weborbit.in";
		$subject = "New Customer Registered";
		
		$message = "
		<html>
			<head>
				<title>Aussie Vitamin Store Email Template</title>
			</head>
			<body>
				<h4>Here is the customer details</h4>
				<table>
					<tr>
						<th>Name</th>
						<th>Email ID</th>
						<th>Phone Number</th>
					</tr>
					<tr>
						<td'".$txtName."'</td>
						<td>'".$txtEmail."'</td>
						<td>'".$txtPhone."'</td>
					</tr>
				</table>
			</body>
		</html>
		";
		
		// Always set content-type when sending HTML email
		$headers = "MIME-Version: 1.0" . "\r\n";
		$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
		
		// More headers
		$headers .= 'From: <webmaster@example.com>' . "\r\n";
		$headers .= 'Cc: myboss@example.com' . "\r\n";
		
		mail($to,$subject,$message,$headers);
                    
					

	$this->session->set_userdata(
			[
				'user_id' => $user_id, 
				'user_type' => 'customer', 
				'username' => $txtUsername, 
				'name' => $txtName, 
				'email' => $txtEmail, 
				'phone' => $txtPhone
			]
	);
	$msg_err = 'Login successful';
	$this->session->set_flashdata('resultSend', $msg_err);
	
	if($this->input->post('checkout') == 'checkout'){
		redirect('checkout');
	}else{
		if($this->session->userdata('wishlist_product_id')) {
			redirect('wishlist');
		} else {
$this->guest_to_cart_afterlogin();
		   redirect('dashboard');
		}
	}

/**/
					
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

    public function guest_to_cart_afterlogin($Params	= array())
    {
		$add_to_cart_id = $this->session->userdata('add_to_cart_id');
		$add_to_cart_qty = $this->session->userdata('add_to_cart_qty');
		if(!empty($add_to_cart_id) && !empty($add_to_cart_qty))
		{
			$this->session->set_userdata(['add_to_cart_id' => 0, 'add_to_cart_qty' => 0]);
			redirect('editCart/set?ip='.$add_to_cart_id.'&qty='.$add_to_cart_qty);
		}
		else
		{
			$this->session->set_userdata(['add_to_cart_id' => 0, 'add_to_cart_qty' => 0]);
			return true;
		}
	}


}

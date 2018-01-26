<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('email');
        
        
         //Load user model
        $this->load->model('user');
        
        // Load facebook library and pass associative array which contains appId and secret key
        //$this->load->library('facebook');

        // Get user's login information
        //$this->user = $this->facebook->getUser();
    }


    public function index() {
        
        if ($this->session->userdata('user_type')) {
$this->guest_to_cart_afterlogin();
            if($this->session->userdata('wishlist_product_id')) {
                redirect('wishlist');
            } else {
                redirect('dashboard');
            }
		} else {
		    $head = array();
            $data = array();
            $head['brand'] = $this->Publicmodel->getShopBrands();
            $head['categories'] = $this->Publicmodel->getShopCategory_mother(['sub_for' => 0, 'category_name !=' => '']);
            $head['sub_categories'] = $this->Publicmodel->getShopCategory_child();
    
            $arrSeo = $this->Publicmodel->getSeo('page_contacts');
            $head['title'] = 'Login';
            $head['description'] = @$arrSeo['description'];
            $head['keywords'] = str_replace(" ", ",", $head['title']);
            $this->render('login', $head, $data);  
    		}
		
       
        
        //redirect('registration');
    }
    
    
    public function fblogin(){
        
        $this->load->view('../libraries/facebook-php-sdk/src/Facebook/autoload.php');
        
                $fb = new Facebook\Facebook([
                  'app_id' => '1931176813811357',
                  'app_secret' => 'cddd70f7ac7fcb46b4f56c475616d8c9',
                  'default_graph_version' => 'v2.10',
                ]);
                
            
            // //Create the Facebook service
            // $fb = new Facebook\Facebook ([
            // 'app_id' => '-----------------',
            // 'app_secret' => '--------------------',
            // 'default_graph_version' => 'v2.4'
            // ]);
        
           $helper = $fb->getRedirectLoginHelper();
        
           $permissions = ['email','user_location','user_birthday','publish_actions']; 
        // For more permissions like user location etc you need to send your application for review
        
           $loginUrl = $helper->getLoginUrl('http://aussievitaminstore.com/login/fbcallback', $permissions);
        
           header("location: ".$loginUrl);
        
        
        
        
        // $userData = array();

        // // Check if user is logged in
        // if($this->facebook->is_authenticated()){
        //     // Get user facebook profile details
        //     $userProfile = $this->facebook->request('get', '/me?fields=id,first_name,last_name,email,gender,locale,picture');

        //     // Preparing data for database insertion
        //     $userData['oauth_provider'] = 'facebook';
        //     $userData['oauth_uid'] = $userProfile['id'];
        //     $userData['first_name'] = $userProfile['first_name'];
        //     $userData['last_name'] = $userProfile['last_name'];
        //     $userData['email'] = $userProfile['email'];
        //     $userData['gender'] = $userProfile['gender'];
        //     $userData['locale'] = $userProfile['locale'];
        //     $userData['profile_url'] = 'https://www.facebook.com/'.$userProfile['id'];
        //     $userData['picture_url'] = $userProfile['picture']['data']['url'];

        //     // Insert or update user data
        //     $userID = $this->user->checkUser($userData);

        //     // Check user data insert or update status
        //     if(!empty($userID)){
        //         $data['userData'] = $userData;
        //         $this->session->set_userdata('userData',$userData);
        //     }else{
        //       $data['userData'] = array();
        //     }

        //     // Get logout URL
        //     $data['logoutUrl'] = $this->facebook->logout_url();
        // }else{
        //     $fbuser = '';

        //     // Get login URL
        //     $data['authUrl'] =  $this->facebook->login_url();
        // }

        // // Load login & profile view
        // $this->load->view('user_authentication/index',$data);
    }
    
    public function fbcallback() {



        $this->load->view('../libraries/facebook-php-sdk/src/Facebook/autoload.php');

        $fb = new Facebook\Facebook([
            'app_id' => '1931176813811357',
            'app_secret' => 'cddd70f7ac7fcb46b4f56c475616d8c9',
            'default_graph_version' => 'v2.10',
        ]);

        $helper = $fb->getRedirectLoginHelper();

        //$res = $fb->get('/me', '{access-token}');
        //print_r($res);die();
        //$session = $helper->getSession();

        try {
            $fbClient = $fb->getClient();
            $accessToken = $helper->getAccessToken($fbClient);
        } catch (Facebook\Exceptions\FacebookResponseException $e) {
            // When Graph returns an error  
            echo 'Graph returned an error: ' . $e->getMessage();
            exit;
        } catch (Facebook\Exceptions\FacebookSDKException $e) {
            // When validation fails or other local issues  
            echo 'Facebook SDK returned an error: ' . $e->getMessage();
            exit;
        }



        try {
            // Get the Facebook\GraphNodes\GraphUser object for the current user.
            // If you provided a 'default_access_token', the '{access-token}' is optional.
            $response = $fb->get('/me?fields=id,name,email,first_name,last_name,birthday,location,gender', $accessToken);
            // print_r($response);
        } catch (Facebook\Exceptions\FacebookResponseException $e) {
            // When Graph returns an error
            echo 'ERROR: Graph ' . $e->getMessage();
            exit;
        } catch (Facebook\Exceptions\FacebookSDKException $e) {
            // When validation fails or other local issues
            echo 'ERROR: validation fails ' . $e->getMessage();
            exit;
        }

        // User Information Retrival begins................................................
        $me = $response->getGraphUser();

        $location = $me->getProperty('location');
        $profileid = $me->getProperty('id');
        /* echo "Full Name: " . $me->getProperty('name') . "<br>";
          echo "First Name: " . $me->getProperty('first_name') . "<br>";
          echo "Last Name: " . $me->getProperty('last_name') . "<br>";
          echo "Gender: " . $me->getProperty('gender') . "<br>";
          echo "Email: " . $me->getProperty('email') . "<br>";
          echo "location: " . $location['name'] . "<br>";
          echo "Birthday: " . $me->getProperty('birthday')->format('d/m/Y') . "<br>";
          echo "Facebook ID: <a href='https://www.facebook.com/" . $me->getProperty('id') . "' target='_blank'>" . $me->getProperty('id') . "</a>" . "<br>";

          echo "</br><img src='//graph.facebook.com/$profileid/picture?type=large'> ";
          echo "</br></br>Access Token : </br>" . $accessToken; */


        //Insert facebook user data if not present or login user data data if exist
        $user_data = $this->Publicmodel->get_user(['email' => $me->getProperty('email')]);
        
        if (count($user_data) > 0) {

            $user_id = $this->Publicmodel->update_user(['user_id' => $user_data[0]['user_id']], [
                'facebook_id' => $me->getProperty('id'),
                'fb_img' => '//graph.facebook.com/' . $profileid . '/picture?type=large',
                'email_verfication_status' => 1
            ]);

            $this->session->set_userdata(['user_id' => $user_data[0]['user_id'], 'user_type' => $user_data[0]['type'], 'username' => $user_data[0]['username'], 'name' => $user_data[0]['name'], 'email' => $user_data[0]['email'], 'phone' => $user_data[0]['phone']]);
            $msg_err = 'Login successful';
            $this->session->set_flashdata('resultSend', $msg_err);

$this->guest_to_cart_afterlogin();

            redirect('dashboard');
        } else {
            
            $fb_id = $me->getProperty('id');
            $name = $me->getProperty('name');
            $username = str_replace(' ', '', $name);
            $user_name = mb_substr(strtolower($username), 0 , 3) . '_' . rand();
            $password = $fb_id. mb_substr(strtolower($username), 0, 2);
            
            $user_id = $this->Publicmodel->insert_user([
                'name' => $name,
                'email' => $me->getProperty('email'),
                'facebook_id' => $me->getProperty('id'),
                'fb_img' => '//graph.facebook.com/' . $profileid . '/picture?type=large',
                'username' => $user_name,
                'password' => sha1($password . SALT),
                'token' => sha1($password . SALT . time()),
                'email_verfication_status' => 1,
                'type' => 'customer',
                'status' => 1,
                'refferer' => 1,
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

            $user_data = $this->Publicmodel->get_user(['user_id' => $user_id]);

            $this->session->set_userdata(['user_id' => $user_data[0]['user_id'], 'user_type' => $user_data[0]['type'], 'username' => $user_data[0]['username'], 'name' => $user_data[0]['name'], 'email' => $user_data[0]['email'], 'phone' => $user_data[0]['phone']]);

            $config = Array(
                'protocol' => 'smtp',
                'smtp_host' => 'vps29011.inmotionhosting.com',
                'smtp_port' => 465,
                'smtp_user' => 'system@weborbitsolutions.com',
                'smtp_pass' => 'WsRocks123',
                'mailtype' => 'html',
                'charset' => 'iso-8859-1'
            );

            $this->load->library('email', $config);
            $this->email->set_newline("\r\n");
            $this->email->from("system@weborbitsolutions.com", "Aussie Vitamin Store");
            $this->email->to($me->getProperty('email'));
            $this->email->set_mailtype("html");
            $this->email->subject('Account Creation');
            $txt = 'Hello '. $name .',<br><br>your Aussie Vitamin account has been created. <br><br>Please Note your account credentials carefully.<br><br>Username : '. $user_name .' and password : '. $password .'.<br><br>Thank you.';
            $this->email->message($txt);
            // Set to, from, message, etc.
            $this->email->send();
$this->guest_to_cart_afterlogin();
            redirect('dashboard');
        }
    }
    


    function validation() {
        $msg_err = '';

        $txtUsername = strtolower($_POST['username']);
        $txtPassword = $_POST['password'];

        if (isset($_POST['username']) && isset($_POST['password'])) {
            $password = sha1($txtPassword . SALT);

            $user_data = $this->Publicmodel->get_user(['username' => $txtUsername, 'password' => $password]);
            
           if ($user_data) {
                if ($user_data[0]['status'] == 1) {
                    $this->session->set_userdata(['user_id' => $user_data[0]['user_id'], 'user_type' => $user_data[0]['type'], 'username' => $user_data[0]['username'], 'name' => $user_data[0]['name'], 'email' => $user_data[0]['email'], 'phone' => $user_data[0]['phone']]);
                    $msg_err = 'Login successful';
                    $this->session->set_flashdata('resultSend', $msg_err);
             
			       
$this->guest_to_cart_afterlogin();

					
                    if($this->input->post('checkout') == 'checkout'){
                        redirect('checkout');
                    }else{
                        if($this->session->userdata('wishlist_product_id')) {
                            redirect('wishlist');
                        } else {
                           redirect('dashboard');
                        }
                    }
                    
                } else {
                    $msg_err = 'Inactive account';
                }
            } else {
                $msg_err = 'Invalid Credentials';
            }
        } else {
            $msg_err = 'All mandetory fields are not filled up. ';
        }
        
        $this->session->set_flashdata('resultSend', $msg_err);
        redirect('login');
    }


    function logout() {
        //delete_cookie('user_id');
        $this->session->sess_destroy();
        $this->load->helper('cookie');
        redirect('/');
    }
    
    public function recover_credentials() {
        
       
		    $head = array();
            $data = array();
            $head['brand'] = $this->Publicmodel->getShopBrands();
            $head['categories'] = $this->Publicmodel->getShopCategory_mother(['sub_for' => 0, 'category_name !=' => '']);
            $head['sub_categories'] = $this->Publicmodel->getShopCategory_child();
    
            $arrSeo = $this->Publicmodel->getSeo('page_contacts');
            $head['title'] = 'Login';
            $head['description'] = @$arrSeo['description'];
            $head['keywords'] = str_replace(" ", ",", $head['title']);
            $this->render('forgot_password', $head, $data);  
		
       
        
        //redirect('registration');
    }
    function action_recover_credentials() {
        $msg_err = '';

        $txtEmailMobile = strtolower($_POST['EmailMobile']);
        $email_or_mobile= $_POST['email_or_mobile'];

        if (!empty($_POST['EmailMobile']) && !empty($_POST['email_or_mobile'])) {

           if($email_or_mobile == 'Email')$user_data = $this->Publicmodel->get_user(['email' => $txtEmailMobile]);
           if($email_or_mobile == 'Mobile')$user_data = $this->Publicmodel->get_user(['phone' => $txtEmailMobile]);
			
			#pr($user_data);
            
           if ($email_or_mobile) {
                if ($user_data[0]['status'] == 1) {
                    
					$RandPassword = rand(10000,99999);
					prf($RandPassword,'','RandPassword');
					#pr($RandPassword);
                	$update_refferer = $this->Publicmodel->update_user(
					
							['user_id' => $user_data[0]['user_id']], 
							[ 'password'	=>  sha1($RandPassword. SALT), 'token'		=>  sha1($RandPassword. SALT.time())]
						
						);
					

			$Params	= array();
			$Params['to'] = $to = $user_data[0]['email'];
			$Params['subject'] = $subject = 'Aussie Vitamin Store: Account recovery Credentials: Confidential';
            $Params['txt'] = $txt = 'Hello ' . $user_data[0]['name'] . ',<br><br>Your Username is ' . $user_data[0]['username']. ' .<br><br> Your new password is ' . $RandPassword. ' . <br><br> <br><br>Thank you.';
			$this->send_mail($Params);


                    $msg_err = 'Check your email to reset the password.';
                    $this->session->set_flashdata('resultSend', $msg_err);
                   
                    
                    redirect('login');
                    
                } else {
                    $msg_err = 'Inactive account';
                }
            } else {
                $msg_err = 'Invalid Credentials';
            }
        } else {
            $msg_err = 'All mandetory fields are not filled up. ';
        }
        
        $this->session->set_flashdata('resultSend', $msg_err);
        redirect('login');
    }


    public function send_mail($Params	= array())
    {
    
		prf($Params,'Params','email_send');
		if(empty($Params['to']))return false;
		
		
    	$config = Array(
                'protocol' => 'smtp',
                'smtp_host' => 'vps29011.inmotionhosting.com',
                'smtp_port' => 465,
                'smtp_user' => 'system@weborbitsolutions.com',
                'smtp_pass' => 'WsRocks123',
                'mailtype' => 'html',
                'charset' => 'iso-8859-1'
            );
            
          
            $this->load->library('email', $config);
            $this->email->set_newline("\r\n");
            $this->email->from("admin@aussievitaminstore.com", "Aussie Vitamin Store");
            $this->email->to($Params['to']);
            $this->email->set_mailtype("html");
            $this->email->subject($Params['subject']); 

            
            $this->email->message($Params['txt']);
            // Set to, from, message, etc.
            $this->email->send();
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

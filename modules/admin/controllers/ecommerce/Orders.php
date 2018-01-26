<?php

/*
 * @Author:    Kiril Kirkov
 *  Gitgub:    https://github.com/kirilkirkov
 */
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Orders extends ADMIN_Controller
{


	

    private $num_rows = 10;

    public function index($page = 0)
    {
        $this->login_check();
        $data = array();
        $head = array();
        $head['title'] = 'Administration - Orders';
        $head['description'] = '!';
        $head['keywords'] = '';

        $order_by = null;
        if (isset($_GET['order_by'])) {
            $order_by = $_GET['order_by'];
        }
        $rowscount = $this->AdminModel->ordersCount();
        $data['orders'] = $this->AdminModel->orders($this->num_rows, $page, $order_by);
        $data['links_pagination'] = pagination('admin/orders', $rowscount, $this->num_rows, 3);
        if (isset($_POST['paypal_sandbox'])) {
            $this->AdminModel->setValueStore('paypal_sandbox', $_POST['paypal_sandbox']);
            if ($_POST['paypal_sandbox'] == 1) {
                $msg = 'Paypal sandbox mode activated';
            } else {
                $msg = 'Paypal sandbox mode disabled';
            }
            $this->session->set_flashdata('paypal_sandbox', $msg);
            $this->saveHistory($msg);
            redirect('admin/orders?settings');
        }
        if (isset($_POST['paypal_email'])) {
            $this->AdminModel->setValueStore('paypal_email', $_POST['paypal_email']);
            $this->session->set_flashdata('paypal_email', 'Public quantity visibility changed');
            $this->saveHistory('Change paypal business email to: ' . $_POST['paypal_email']);
            redirect('admin/orders?settings');
        }
        if (isset($_POST['paypal_currency'])) {
            $this->AdminModel->setValueStore('paypal_currency', $_POST['paypal_currency']);
            $this->session->set_flashdata('paypal_currency', 'Public quantity visibility changed');
            $this->saveHistory('Change paypal currency to: ' . $_POST['paypal_currency']);
            redirect('admin/orders?settings');
        }
        if (isset($_POST['cashondelivery_visibility'])) {
            $this->AdminModel->setValueStore('cashondelivery_visibility', $_POST['cashondelivery_visibility']);
            $this->session->set_flashdata('cashondelivery_visibility', 'Cash On Delivery Visibility Changed');
            $this->saveHistory('Change Cash On Delivery Visibility - ' . $_POST['cashondelivery_visibility']);
            redirect('admin/orders?settings');
        }
        if (isset($_POST['iban'])) {
            $this->AdminModel->setBankAccountSettings($_POST);
            $this->session->set_flashdata('bank_account', 'Bank account settings saved');
            $this->saveHistory('Bank account settings saved for : ' . $_POST['name']);
            redirect('admin/orders?settings');
        }
        $data['paypal_sandbox'] = $this->AdminModel->getValueStore('paypal_sandbox');
        $data['paypal_email'] = $this->AdminModel->getValueStore('paypal_email');
        $data['paypal_currency'] = $this->AdminModel->getValueStore('paypal_currency');
        $data['cashondelivery_visibility'] = $this->AdminModel->getValueStore('cashondelivery_visibility');
        $data['bank_account'] = $this->AdminModel->getBankAccountSettings();
        $this->load->view('_parts/header', $head);
        $this->load->view('ecommerce/orders', $data);
        $this->load->view('_parts/footer');
        if ($page == 0) {
            $this->saveHistory('Go to orders page');
        }
    }

    public function changeOrdersOrderStatus()
    {
    
    	
    
        $this->login_check();
        $order_id = $_POST['the_id'];
        
        $result = $this->AdminModel->changeOrderStatus($_POST['the_id'], $_POST['to_status']);
        if ($result == true) {
        
                
            echo 1;
            
            $config = Array(
                'protocol' => 'smtp',
                'smtp_host' => 'vps29011.inmotionhosting.com',
                'smtp_port' => 465,
                'smtp_user' => 'system@weborbitsolutions.com',
                'smtp_pass' => 'WsRocks123',
                'mailtype' => 'html',
                'charset' => 'iso-8859-1'
            );
            
           $res_client = $this->AdminModel->get_order_client(['orders.id' => $order_id]);
           //print_r($res_client); die();

            $this->load->library('email', $config);
            $this->email->set_newline("\r\n");
            $this->email->from("admin@ussievitaminstore.com", "Aussie Vitamin Store");
            $this->email->to($res_client[0]['email']);
            $this->email->set_mailtype("html");
            $this->email->subject('Order Status with ID #' . $res_client[0]['order_id']);

            if ($res_client[0]['processed'] == '0') {
                $processed = 'Closed';
            } elseif ($res_client[0]['processed'] == '1') {
                $processed = 'Ordered';
            } elseif ($res_client[0]['processed'] == '2') {
                $processed = 'Shipped';
            } elseif ($res_client[0]['processed'] == '3') {
                $processed = 'Processed';
            } elseif ($res_client[0]['processed'] == '4') {
                $processed = 'Delivered';
            } elseif ($res_client[0]['processed'] == '5') {
                $processed = 'Refunded';
            }

            $txt = 'Hello ' . $res_client[0]['first_name '] . ',<br><br>your Aussie Vitamin Store order with id #' . $res_client[0]['order_id'] . ' has been ' . $processed . '. <br><br>Thank you.';
            $this->email->message($txt);
            // Set to, from, message, etc.
            $this->email->send();
            
            
        } else {
            echo 0;
        }
        $this->saveHistory('Change order status on product Id ' . $_POST['the_id'] . ' to status ' . $_POST['to_status']);
    }
    
    public function change_status_mail()
    {
    
    	//$this->load->library('email');
    	
        $this->login_check();
        $order_id = $this->input->post('order_id');
        $order_status = $this->input->post('order_status');
        $status_details = $this->input->post('status_details');
        
        $result = $this->AdminModel->changeOrderStatus($order_id , $order_status, $status_details);
        //print_r($result); die();
        
        if ($result) {
           //print_r($result); die();
           
            $config = Array(
                'protocol' => 'smtp',
                'smtp_host' => 'vps29011.inmotionhosting.com',
                'smtp_port' => 465,
                'smtp_user' => 'system@weborbitsolutions.com',
                'smtp_pass' => 'WsRocks123',
                'mailtype' => 'html',
                'charset' => 'iso-8859-1'
            );
            
           $res_client = $this->AdminModel->get_order_client(['orders.id' => $order_id]);
           //print_r($res_client[0]['email']); die();

            $this->load->library('email', $config);
            $this->email->set_newline("\r\n");
            $this->email->from("admin@aussievitaminstore.com", "Aussie Vitamin Store");
            $this->email->to($res_client[0]['email']);
            $this->email->set_mailtype("html");
            $this->email->subject('Order Status Update with ID #' . $res_client[0]['order_id']); 

            if ($res_client[0]['processed'] == '0') {
                $processed = 'Closed';
            } elseif ($res_client[0]['processed'] == '1') {
                $processed = 'Ordered';
            } elseif ($res_client[0]['processed'] == '2') {
                $processed = 'Shipped';
            } elseif ($res_client[0]['processed'] == '3') {
                $processed = 'Processed';
            } elseif ($res_client[0]['processed'] == '4') {
                $processed = 'Delivered';
            } elseif ($res_client[0]['processed'] == '5') {
                $processed = 'Refunded';
            }

            $txt = 'Hello ' . $res_client[0]['first_name'] . ',<br><br>your Aussie Vitamin Store order with id #' . $res_client[0]['order_id'] . ' has been ' . $processed . '. <br><br>'. $status_details .'<br><br>Thank you.';
            $this->email->message($txt);
            // Set to, from, message, etc.
            $this->email->send();
            
            
        } 
        $this->saveHistory('Change order status on product Id ' . $_POST['the_id'] . ' to status ' . $_POST['to_status']);
        redirect('admin/orders');
    }
	
	
	

    public function EditTrackingNumber()
    {
    
    	//$this->load->library('email');
    	
        $this->login_check();
        $order_id = $this->input->post('order_id');
        $TrackingNumber = $this->input->post('TrackingNumber');
        
        $result = $this->AdminModel->EditTrackingNumber($order_id ,  $TrackingNumber);
        //print_r($result); die();
        
        if ($result) {
           //print_r($result); die();
           
           // $config = Array(
//                'protocol' => 'smtp',
//                'smtp_host' => 'vps29011.inmotionhosting.com',
//                'smtp_port' => 465,
//                'smtp_user' => 'system@weborbitsolutions.com',
//                'smtp_pass' => 'WsRocks123',
//                'mailtype' => 'html',
//                'charset' => 'iso-8859-1'
//            );
//            
//           $res_client = $this->AdminModel->get_order_client(['orders.id' => $order_id]);
//           //print_r($res_client[0]['email']); die();
//
//            $this->load->library('email', $config);
//            $this->email->set_newline("\r\n");
//            $this->email->from("admin@aussievitaminstore.com", "Aussie Vitamin Store");
//            $this->email->to($res_client[0]['email']);
//            $this->email->set_mailtype("html");
//            $this->email->subject('Order Status Update with ID #' . $res_client[0]['order_id']); 
//
//            if ($res_client[0]['processed'] == '0') {
//                $processed = 'Closed';
//            } elseif ($res_client[0]['processed'] == '1') {
//                $processed = 'Ordered';
//            } elseif ($res_client[0]['processed'] == '2') {
//                $processed = 'Shipped';
//            } elseif ($res_client[0]['processed'] == '3') {
//                $processed = 'Processed';
//            } elseif ($res_client[0]['processed'] == '4') {
//                $processed = 'Delivered';
//            } elseif ($res_client[0]['processed'] == '5') {
//                $processed = 'Refunded';
//            }
//
//            $txt = 'Hello ' . $res_client[0]['first_name'] . ',<br><br>your Aussie Vitamin Store order with id #' . $res_client[0]['order_id'] . ' has been ' . $processed . '. <br><br>'. $status_details .'<br><br>Thank you.';
//            $this->email->message($txt);
//            // Set to, from, message, etc.
//            $this->email->send();
            
            
        } 
        $this->saveHistory('Change order Tracking Number');
        redirect('admin/orders');
    }
	
	
	
	
}

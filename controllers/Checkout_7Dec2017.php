<?php

defined('BASEPATH') OR exit('No direct script access allowed');


use PayPal\Api\ItemList;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\PaymentExecution;


class Checkout extends MY_Controller
{
    public $_api_context;
    private $orderId;

    public function __construct()
    {
        parent::__construct();
        
        $this->load->view('../libraries/PayPal-PHP-SDK/first'); // require paypal files

         $this->load->model('paypal_model', 'paypal');
        // paypal credentials
        $this->config->load('paypal');

        $this->_api_context = new \PayPal\Rest\ApiContext(
                new \PayPal\Auth\OAuthTokenCredential(
                $this->config->item('client_id'), $this->config->item('secret')
                )
        );
        
        
        
        
        $this->load->helper(array('currency_convertor'));
    }

    public function index()
    {
        $data = array();
        $head = array();
        $head['brand'] = $this->Publicmodel->getShopBrands();
        $head['categories'] = $this->Publicmodel->getShopCategory_mother(['sub_for' => 0, 'category_name !=' => '']);
        $head['sub_categories'] = $this->Publicmodel->getShopCategory_child();
        $arrSeo = $this->Publicmodel->getSeo('page_checkout');
        $head['title'] = @$arrSeo['title'];
        $head['description'] = @$arrSeo['description'];
        $head['keywords'] = str_replace(" ", ",", $head['title']);

        if (isset($_POST['payment_type'])) {
            $errors = $this->userInfoValidate($_POST);
            if (!empty($errors)) {
                $this->session->set_flashdata('submit_error', $errors);
            } else {
            	
            	if ($_POST['payment_type'] == 'PayPal') {
            		//echo $this->input->post('item_price');
            		$this->session->set_userdata([
            		  'first_name' => $_POST['first_name'],
            		  'last_name' => $_POST['last_name'],
            		  'email' => $_POST['email'],
            		  'phone' => $_POST['phone'],
            		  'address' => $_POST['address'],
            		  'city' => $_POST['city'],
            		  'post_code' => $_POST['post_code'],
            		  'notes' => $_POST['notes']
            		]);
            		
            		$totals = 0;
            		
			if($this->input->post('item_price')){
			 // $totals = get_cookie('coupon_total');
			    $totals  = $this->input->post('item_price');
			    
			   // echo 'xvx'.$totals;
			   // exit;
			}else{
			
			 for($i=0; $i<get_cookie('total'); $i++){
                          $res1= $this->Publicmodel->get_product_translation(['id' => get_cookie('product_id'.$i)]);
                          $total = $res1[0]['price'] * get_cookie('qty'.$i);
                          $totals += $total;
                      		}
			}
                    // redirect('paypal/create_payment_with_paypal');
                    // setup PayPal api context
                    $this->_api_context->setConfig($this->config->item('settings'));


// ### Payer
// A resource representing a Payer that funds a payment
// For direct credit card payments, set payment method
// to 'credit_card' and add an array of funding instruments.

                    $payer['payment_method'] = 'paypal';

// ### Itemized information
// (Optional) Lets you specify item wise
// information
                    $item1["name"] = $this->input->post('item_name');
                    $item1["sku"] = $this->input->post('item_number');  // Similar to `item_number` in Classic API
                    $item1["description"] = $this->input->post('item_description');
                    $item1["currency"] = "USD";
                    $item1["quantity"] = 1;
                    $item1["price"] = $totals;

                    $itemList = new ItemList();
                    $itemList->setItems(array($item1));

// ### Additional payment details
// Use this optional field to set additional
// payment information such as tax, shipping
// charges etc.
                    $details['tax'] = 0;
                    $details['subtotal'] = $totals;
// ### Amount
// Lets you specify a payment amount.
// You can also specify additional details
// such as shipping, tax.
                    $amount['currency'] = "USD";
                    $amount['total'] = $details['tax'] + $details['subtotal'];
                    $amount['details'] = $details;
// ### Transaction
// A transaction defines the contract of a
// payment - what is the payment for and who
// is fulfilling it.
                    $transaction['description'] = 'Payment description';
                    $transaction['amount'] = $amount;
                    $transaction['invoice_number'] = uniqid();
                    $transaction['item_list'] = $itemList;

                    // ### Redirect urls
// Set the urls that the buyer must be redirected to after
// payment approval/ cancellation.
                    $baseUrl = base_url();
                    $redirectUrls = new RedirectUrls();
                    $redirectUrls->setReturnUrl($baseUrl . "checkout/getPaymentStatus")
                            ->setCancelUrl($baseUrl . "checkout/getPaymentStatus");

// ### Payment
// A Payment Resource; create one using
// the above types and intent set to sale 'sale'
                    $payment = new Payment();
                    $payment->setIntent("sale")
                            ->setPayer($payer)
                            ->setRedirectUrls($redirectUrls)
                            ->setTransactions(array($transaction));

                    try {
                        $payment->create($this->_api_context);
                    } catch (Exception $ex) {
                        // NOTE: PLEASE DO NOT USE RESULTPRINTER CLASS IN YOUR ORIGINAL CODE. FOR SAMPLE ONLY
                        ResultPrinter::printError("Created Payment Using PayPal. Please visit the URL to Approve.", "Payment", null, $ex);
                        exit(1);
                    }
                    foreach ($payment->getLinks() as $link) {
                        if ($link->getRel() == 'approval_url') {
                            $redirect_url = $link->getHref();
                            break;
                        }
                    }

                    if (isset($redirect_url)) {
                        /** redirect to paypal **/
                        redirect($redirect_url);
                    }

                    $this->session->set_flashdata('success_msg', 'Unknown error occurred');
                    redirect('checkout/index');
                } else {
            
            
                $_POST['referrer'] = $this->session->userdata('referrer');
                $_POST['clean_referrer'] = cleanReferral($_POST['referrer']);
                $orderId = $this->Publicmodel->setOrder($_POST);
                if ($orderId != false) {
                    $this->orderId = $orderId;
                    $this->setActivationLink();
                    $this->goToDestination();
                } else {
                    log_message('error', 'Cant save order!! ' . implode('::', $_POST));
                    $this->session->set_flashdata('order_error', true);
                    redirect(LANG_URL . '/checkout/order-error');
                }
               }
            }
        }
        $data['bank_account'] = $this->AdminModel->getBankAccountSettings();
        $data['cashondelivery_visibility'] = $this->AdminModel->getValueStore('cashondelivery_visibility');
        $data['paypal_email'] = $this->AdminModel->getValueStore('paypal_email');
        $data['bestSellers'] = $this->Publicmodel->getbestSellers();
        
        
        $arr = array();
        for($i=0; $i< get_cookie('total'); $i++){
            $arr[] = get_cookie('product_id'.$i);
        }
        
        if(!empty($arr)){
            $data['products'] = $this->Publicmodel->get_join_product_translation($arr); 
        }
        
        $data['imageall'] = $this->Publicmodel->get_All_products();
        $this->render('checkout', $head, $data);
    }
    
    public function getPaymentStatus() {
        $head['brand'] = $this->Publicmodel->getShopBrands();
        $head['categories'] = $this->Publicmodel->getShopCategory_mother(['sub_for' => 0, 'category_name !=' => '']);
        $head['sub_categories'] = $this->Publicmodel->getShopCategory_child();
        // paypal credentials

        /** Get the payment ID before session clear * */
        $payment_id = $this->input->get("paymentId");
        $PayerID = $this->input->get("PayerID");
        $token = $this->input->get("token");
        /** clear the session payment ID * */
        if (empty($PayerID) || empty($token)) {
            $this->session->set_flashdata('success_msg', 'Payment failed');
            redirect('checkout/index');
        }

        $payment = Payment::get($payment_id, $this->_api_context);


        /** PaymentExecution object includes information necessary * */
        /** to execute a PayPal account payment. * */
        /** The payer_id is added to the request query parameters * */
        /** when the user is redirected from paypal back to your site * */
        $execution = new PaymentExecution();
        $execution->setPayerId($this->input->get('PayerID'));

        /*         * Execute the payment * */
        $result = $payment->execute($execution, $this->_api_context);



        //  DEBUG RESULT, remove it later **/
        if ($result->getState() == 'approved') {
            $trans = $result->getTransactions();

            // item info
            $Subtotal = $trans[0]->getAmount()->getTotal();
            $Tax = '0';

            $payer = $result->getPayer();
            // payer info //
            $PaymentMethod = $payer->getPaymentMethod();
            $PayerStatus = $payer->getStatus();
            $PayerMail = $payer->getPayerInfo()->getEmail();

            $relatedResources = $trans[0]->getRelatedResources();
            $sale = $relatedResources[0]->getSale();
            // sale info //
            $saleId = $sale->getId();
            $CreateTime = $sale->getCreateTime();
            $UpdateTime = $sale->getUpdateTime();
            $State = $sale->getState();
            $Total = $sale->getAmount()->getTotal();
            /** it's all right * */
            /** Here Write your database logic like that insert record or value in database if you want * */
            $this->paypal->create($Total, $Subtotal, $Tax, $PaymentMethod, $PayerStatus, $PayerMail, $saleId, $CreateTime, $UpdateTime, $State);


            $_POST['referrer'] = $this->session->userdata('referrer');
            $_POST['clean_referrer'] = cleanReferral($_POST['referrer']);
            $orderId = $this->Publicmodel->setOrderpaypal();
            @set_cookie('checkout', $orderId, 2678400);
            if ($orderId != false) {
                $this->orderId = $orderId;
                $this->setActivationLink();
            } else {
            
                log_message('error', 'Cant save order!! ' . implode('::', $_POST));
                $this->session->set_flashdata('order_error', true);
                redirect(LANG_URL . '/checkout/order-error', $head);
            }


            $this->session->set_flashdata('success_msg', 'Payment success');
            redirect('checkout/paypal_success');
        }
        $this->session->set_flashdata('success_msg', 'Payment failed');
        redirect('checkout/paypal_cancel');
    }

    
    

    private function setActivationLink()
    {
        if ($this->config->item('send_confirm_link') === true) {
            $link = md5($this->orderId . time());
            $result = $this->Publicmodel->setActivationLink($link, $this->orderId);
            if ($result == true) {
                $url = parse_url(base_url());
                $msg = lang('please_confirm') . base_url('confirm/' . $link);
                $this->sendmail->sendTo($_POST['email'], $_POST['first_name'] . ' ' . $_POST['last_name'], lang('confirm_order_subj') . $url['host'], $msg);
            }
        }
    }

    private function goToDestination()
    {
        if ($_POST['payment_type'] == 'cashOnDelivery' || $_POST['payment_type'] == 'Bank') {
            $this->shoppingcart->clearShoppingCart();
            $this->session->set_flashdata('success_order', true);
        }
        if ($_POST['payment_type'] == 'Bank') {
            $_SESSION['order_id'] = $this->orderId;
            $_SESSION['final_amount'] = $_POST['final_amount'] . $_POST['amount_currency'];
            redirect(LANG_URL . '/checkout/successbank');
        }
        if ($_POST['payment_type'] == 'cashOnDelivery') {
            redirect(LANG_URL . '/checkout/successcash');
        }
        if ($_POST['payment_type'] == 'PayPal') {
            @set_cookie('paypal', $this->orderId, 2678400);
            $_SESSION['discountAmount'] = $_POST['discountAmount'];
            redirect(LANG_URL . '/checkout/paypalpayment');
        }
    }

    private function userInfoValidate($post)
    {
        $errors = array();
        if (mb_strlen(trim($post['first_name'])) == 0) {
            $errors[] = lang('first_name_empty');
        }
        if (mb_strlen(trim($post['last_name'])) == 0) {
            $errors[] = lang('last_name_empty');
        }
        if (!filter_var($post['email'], FILTER_VALIDATE_EMAIL)) {
            $errors[] = lang('invalid_email');
        }
        $post['phone'] = preg_replace("/[^0-9]/", '', $post['phone']);
        if (mb_strlen(trim($post['phone'])) == 0) {
            $errors[] = lang('invalid_phone');
        }
        if (mb_strlen(trim($post['address'])) == 0) {
            $errors[] = lang('address_empty');
        }
        if (mb_strlen(trim($post['city'])) == 0) {
            $errors[] = lang('invalid_city');
        }

        if (mb_strlen(trim($post['post_code'])) == 0) {
            $errors[] = lang('post_code_empty');
        }
        return $errors;
    }

    public function orderError()
    {
        if ($this->session->flashdata('order_error')) {
            $data = array();
            $head = array();
            $arrSeo = $this->Publicmodel->getSeo('page_checkout');
            $head['title'] = @$arrSeo['title'];
            $head['description'] = @$arrSeo['description'];
            $head['keywords'] = str_replace(" ", ",", $head['title']);
            $this->render('checkout_parts/order_error', $head, $data);
        } else {
            redirect(LANG_URL . '/checkout');
        }
    }

    public function paypalPayment()
    {
        $data = array();
        $head = array();
        $head['brand'] = $this->Publicmodel->getShopBrands();
        $head['categories'] = $this->Publicmodel->getShopCategory_mother(['sub_for' => 0, 'category_name !=' => '']);
        $head['sub_categories'] = $this->Publicmodel->getShopCategory_child();
        $arrSeo = $this->Publicmodel->getSeo('page_checkout');
        $head['title'] = @$arrSeo['title'];
        $head['description'] = @$arrSeo['description'];
        $head['keywords'] = str_replace(" ", ",", $head['title']);
        $data['paypal_sandbox'] = $this->AdminModel->getValueStore('paypal_sandbox');
        $data['paypal_email'] = $this->AdminModel->getValueStore('paypal_email');
        $data['paypal_currency'] = $this->AdminModel->getValueStore('paypal_currency');
        $this->render('checkout_parts/paypal_payment', $head, $data);
    }

    public function successPaymentCashOnD()
    {
        if ($this->session->flashdata('success_order')) {
            $data = array();
            $head = array();
            $head['brand'] = $this->Publicmodel->getShopBrands();
        $head['categories'] = $this->Publicmodel->getShopCategory_mother(['sub_for' => 0, 'category_name !=' => '']);
        $head['sub_categories'] = $this->Publicmodel->getShopCategory_child();
            $arrSeo = $this->Publicmodel->getSeo('page_checkout');
            $head['title'] = @$arrSeo['title'];
            $head['description'] = @$arrSeo['description'];
            $head['keywords'] = str_replace(" ", ",", $head['title']);
            $this->render('checkout_parts/payment_success_cash', $head, $data);
        } else {
            redirect(LANG_URL . '/checkout');
        }
    }

    public function successPaymentBank()
    {
        if ($this->session->flashdata('success_order')) {
            $data = array();
            $head = array();
            $head['brand'] = $this->Publicmodel->getShopBrands();
        $head['categories'] = $this->Publicmodel->getShopCategory_mother(['sub_for' => 0, 'category_name !=' => '']);
        $head['sub_categories'] = $this->Publicmodel->getShopCategory_child();
            $arrSeo = $this->Publicmodel->getSeo('page_checkout');
            $head['title'] = @$arrSeo['title'];
            $head['description'] = @$arrSeo['description'];
            $head['keywords'] = str_replace(" ", ",", $head['title']);
            $data['bank_account'] = $this->AdminModel->getBankAccountSettings();
            $this->render('checkout_parts/payment_success_bank', $head, $data);
        } else {
            redirect(LANG_URL . '/checkout');
        }
    }

    public function paypal_cancel()
    {
        if (get_cookie('paypal') == null) {
            redirect(base_url());
        }
        @delete_cookie('paypal');
        $orderId = get_cookie('paypal');
        $this->Publicmodel->changePaypalOrderStatus($orderId, 'canceled');
        $data = array();
        $head = array();
        $head['brand'] = $this->Publicmodel->getShopBrands();
        $head['categories'] = $this->Publicmodel->getShopCategory_mother(['sub_for' => 0, 'category_name !=' => '']);
        $head['sub_categories'] = $this->Publicmodel->getShopCategory_child();
        $head['title'] = '';
        $head['description'] = '';
        $head['keywords'] = '';
        $this->render('checkout_parts/paypal_cancel', $head, $data);
    }

    public function paypal_success()
    {
    
    	//print_r($_POST);
    	//exit;
        if (get_cookie('paypal') == null) {
            redirect(base_url());
        }
        @delete_cookie('paypal');
        $this->shoppingcart->clearShoppingCart();
        $orderId = get_cookie('paypal');
        $this->Publicmodel->changePaypalOrderStatus($orderId, 'payed');
        $data = array();
        $head = array();
        $head['brand'] = $this->Publicmodel->getShopBrands();
        $head['categories'] = $this->Publicmodel->getShopCategory_mother(['sub_for' => 0, 'category_name !=' => '']);
        $head['sub_categories'] = $this->Publicmodel->getShopCategory_child();
        $head['title'] = '';
        $head['description'] = '';
        $head['keywords'] = '';
        $this->render('checkout_parts/paypal_success', $head, $data);
    }

}

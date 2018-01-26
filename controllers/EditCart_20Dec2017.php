<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class EditCart extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('publicmodel');
        $this->load->library('email');
        
    }
    
    function index(){
        $head = array();
        $data = array();
        
        $head['brand'] = $this->Publicmodel->getShopBrands();
        $head['categories'] = $this->Publicmodel->getShopCategory_mother(['sub_for' => 0, 'category_name !=' => '']);
        $head['sub_categories'] = $this->Publicmodel->getShopCategory_child();

        $head['title'] = 'View Cart';
        $head['description'] = @$arrSeo['description'];
        $head['keywords'] = str_replace(" ", ",", $head['title']);
        $arr = array();
        for($i=0; $i< get_cookie('total'); $i++){
            $arr[] = get_cookie('product_id'.$i);
        }
        
        if(!empty($arr)){
            $data['products'] = $this->Publicmodel->get_join_product_translation($arr); 
        }
        
        $data['imageall'] = $this->Publicmodel->get_All_products();
        $this->render('view_cart', $head, $data);
    }
    
    function set(){
         $check_product_id = $this->Publicmodel->getSingleTranslation(['id' => $this->input->get('ip'), 'type' => 'product']);
        if($check_product_id){
            if(get_cookie('total')){
              $counter = get_cookie('total') + 1;
              $in = $counter - 1;
              //print_r($in);
              //exit;
            }else{
              $counter = 1;
              $in = 0;
            }
        	if(!$this->session->userdata('user_type')) {

                redirect('login');

            }
            for($i=$in; $i< $counter; $i++){
                if(get_cookie('product_id'.$i) !== $this->input->get('ip')){                             
               
                $cart_insert_id = $this->Publicmodel->insert_cart([
                        'user_id' => $this->session->userdata('user_id'),
                        'product_id' => $this->input->get('ip'),
                        'mail_status' => '0',
                        'added_date' => date('Y-m-d'),
                        'added_time' => date('h:i:s'),
                        'last_update_date' => date('Y-m-d'),
                        'last_update_time' => date('h:i:s')
                        
                    ]);
                
                    set_cookie('i'.$i, $i, '360');
                    set_cookie('product_id'.$i, $this->input->get('ip'), '360');
                    set_cookie('qty'.$i, $this->input->get('qty'), '360');
                    if(!get_cookie('total') > 0){
                        $set = set_cookie('count_cart', 0, '360');
                        $get = get_cookie('count_cart') + 1;
                    }else{
                        $get = get_cookie('total') + 1;
                    }
                    
                    
                    
                    //print_r($get);
                    //exit;
                    if($get){
                        // if(get_cookie('total')){
                        //     for($i=0; $i < get_cookie('total'); $i++){
                        //         $k = get_cookie('i'); 
                        //         set_cookie('i', $k, '360');
                        //         $get_productID = get_cookie('product_id'. $i);
                        //         set_cookie('product_id'.$i, $get_productID, '360');
                        //     }
                        // }
                        
                        set_cookie('total', $get, '360');
                        redirect('editCart');
                    }
                }else{
                    print_r('Product already in cart.');
                    exit;
                }
            }
        }
    }
    
    function remove_cookie($data){
        
        for($i=0; $i< get_cookie('total'); $i++){
            if($i == $data){
                delete_cookie("product_id".$i);
                delete_cookie("i".$i);
                delete_cookie("qty".$i);
            }
        }
        
        $remove = get_cookie('total') - 1;
        if($remove > 0){
         $good= set_cookie('countertotal', $remove, '360');
        }else{
         $good= delete_cookie("total");
        }
        
        if($remove){
            redirect('editCart');
        }else{
            redirect('editCart');
        }
    }
    
    function updateCart(){
        for($i=0; $i< get_cookie('total'); $i++){
            if(get_cookie('i'.$i) == 'i'.$i){
              set_cookie('i'.$i, $i, '360');
            }
            
            if(get_cookie('product_id'.$i)){
              set_cookie('product_id'.$i, get_cookie('product_id'.$i), '360');
            }
            
            if(get_cookie('qty'.$i)){
              set_cookie('qty'.$i, $this->input->post('qty'.$i), '360');
            }
        }
        
        redirect('editCart');
    }
    
    function codeCheck(){
        if(!get_cookie('coupon_total')){
            $res= $this->Publicmodel->get_check_code(['code' => $this->input->post('coupon'), 'status' => 1]);
            $all = 0;
            $total =0;
            if($res){
                $currentDate = date('Y-m-d h:i:s');
                $timeStamp= strtotime($currentDate);
                
                if($timeStamp >= $res[0]['valid_from_date'] && $res[0]['valid_to_date'] >= $timeStamp){
                    if($res[0]['type'] == 'percent'){
                      for($i=0; $i<get_cookie('total'); $i++){
                          $res1= $this->Publicmodel->get_product_translation(['id' => get_cookie('product_id'.$i)]);
                          $total = $res1[0]['price'] * get_cookie('qty'.$i);
                          $all += $total;
                      }
                      
                      $coupon = ($all - (($all * $res[0]['amount']) / 100));
                      $coupon_amount = (($all * $res[0]['amount']) / 100);
                      set_cookie('coupon_total', $coupon, '360');
                      set_cookie('coupon', $coupon_amount, '360');
                      set_cookie('discount_code', $this->input->post('coupon'), '360');
                      $this->session->set_flashdata('codesucc', 'Coupon Code Applied Successfully');
                      redirect('editCart');
                      
                    } else {
                       for($i=0; $i<get_cookie('total'); $i++){
                          $res1= $this->Publicmodel->get_product_translation(['id' => get_cookie('product_id'.$i)]);
                          $total = $res1[0]['price'] * get_cookie('qty'.$i);
                          $all += $total;
                      }
                      $coupon = $all - $res[0]['amount'];
                      $coupon_amount = $res[0]['amount'];
                      set_cookie('coupon_total', $coupon, '360');
                      set_cookie('coupon', $coupon_amount, '360');
                      set_cookie('discount_code', $this->input->post('coupon'), '360');
                      $this->session->set_flashdata('codesucc', 'Coupon Code Applied Successfully');
                      redirect('editCart');
                    }
                }else{
                    $this->session->set_flashdata('coderror', 'Expired Discount Code!');
                     redirect('editCart');
                }
            }else{
                $this->session->set_flashdata('coderror', 'Invalid Discount Code!');
                redirect('editCart');
            }
        }else{
            $this->session->set_flashdata('coderror', 'Coupon Code Already Applied');
            redirect('editCart');
        }
    }
    
    function abandone_cart(){
    
        $get_abandoned_users = $this->Publicmodel->get_cart_users(['cart_abandone.mail_status'=> 0]);
        
        
        
        for($i=0; $i<count($get_abandoned_users); $i++){
               
            $get_abandoned_cart = $this->Publicmodel->get_cart_details(['user.user_id'=> $get_abandoned_users[$i]['user_id'], 'cart_abandone.mail_status'=> 0]);
            //print_r($get_abandoned_cart);die();
            
            $all = count($get_abandoned_users);
                       
            $config = Array(
                'protocol' => 'smtp',
                'smtp_host' => 'vps29011.inmotionhosting.com',
                'smtp_port' => 465,
                'smtp_user' => 'system@weborbitsolutions.com',
                'smtp_pass' => 'WsRocks123',
                'mailtype' => 'html',
                'charset' => 'iso-8859-1'
            );
            //echo "<pre>";
            //for($k=0; $k<count($get_abandoned_cart); $k++){ $get_abandoned_cart[$k]['product_title'] .'<br>'. }
            //echo "</pre>";

            $this->load->library('email', $config);
            $this->email->set_newline("\r\n");
            $this->email->from("system@weborbitsolutions.com", "Aussie Vitamin Store");           
            $this->email->to($get_abandoned_cart[$i]['email']);
            $this->email->set_mailtype("html");
            $this->email->subject('Aussie Vitamin Store Cart Status');
            
            
            $content = 'Hello '. $get_abandoned_cart[$i]['customer_name'] .',<br><br>you have added below listed products in your cart. Kindly do the needful.<br><br>';
            
                        
                $content .= '<table style="width:100%" border="0">';

		$content .= '<tr>';
		$content .= '<th style="text-align:left">Product Name</th>';
		$content .= '</tr>';
		
		$k = 1;
		foreach ($get_abandoned_cart as $items):
		        $content .= '<tr>';
		        $content .= '<td >'. $k .'.&nbsp;<a href="'. LANG_URL . '/' . $items['url'] .'">'. $items['product_title'].'</a>,</td>';
		        $content .= '</tr>';
		$k++; 
		endforeach;
			
		$content .= '</table>';
		$content .= '<br><br>Thank you.';
            
                       
            $headers  = 'MIME-Version: 1.0' . "\n";
	    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\n";
            
            
            $this->email->message($content, $headers);
             //Set to, from, message, etc.
            $this->email->send();
            
            for($j=0; $j<count($get_abandoned_cart); $j++){
            $update_mail_status = $this->Publicmodel->update_cron_mail_status(['product_id'=> $get_abandoned_cart[$j]['product_id']], ['mail_status'=> 1]); 
            }
            
           
            
            
            
                       
            
        }
        
        
        //print_r(count($get_abandoned));die();   
        
        //$get_abandoned = $this->Publicmodel->get_cart_users(['cart_abandone.mail_status'=> 0]);      
        
        //redirect('editCart');
    }
}
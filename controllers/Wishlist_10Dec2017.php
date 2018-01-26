<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Wishlist extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();

    }


    public function index() {
        if(isset($_GET['ip'])){
            $product_id = base64_decode($_GET['ip']);
            $this->session->set_userdata(['wishlist_product_id' => $product_id]);
            
            if(!$this->session->userdata('user_type')) {
                redirect('login');
            }
        }
        
        
        if($this->session->userdata('wishlist_product_id')) {
            $data = $this->Publicmodel->get_wishlist_product(['wishlist_products.user_id' => $this->session->userdata('user_id'), 'wishlist_products.product_id' => $this->session->userdata('wishlist_product_id')]); 
            if(!$data) {
                $wishlist_id = $this->Publicmodel->insert_wishlist_products([
                    'product_id'  =>  $this->session->userdata('wishlist_product_id'),
                    'user_id'	  =>  $this->session->userdata('user_id')
                ]);
            }
            
            // unset session wishlist product
            $this->session->unset_userdata('wishlist_product_id');
        }
        
        
        $head = array();
        $data = array();
        $head['brand'] = $this->Publicmodel->getShopBrands();
        $head['categories'] = $this->Publicmodel->getShopCategory_mother(['sub_for' => 0]);
        $head['sub_categories'] = $this->Publicmodel->getShopCategory_child();
        $data['products'] = $this->Publicmodel->get_wishlist_product(['wishlist_products.user_id' => $this->session->userdata('user_id')]); 
        $arrSeo = $this->Publicmodel->getSeo('page_contacts');
        $head['title'] = 'Wishlist - Aussievitaminstore';
        $head['description'] = @$arrSeo['description'];
        $head['keywords'] = str_replace(" ", ",", $head['title']);
        $this->render('wishlist', $head, $data);
    }
    
    
    public function delete($id) {
        $delete = $this->Publicmodel->delete_wishlist_product(['wishlist_id' => $id]);
        
        if($delete) {
            $msg_err = 'Product is deleted from wishlist';
        } else {
            $msg_err = 'Deletion failed';
        }
        $this->session->set_flashdata('resultSend', $msg_err);
        redirect('wishlist');
    }
    
    
    


}

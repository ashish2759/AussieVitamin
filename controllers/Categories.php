<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Categories extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('publicmodel');
        
    }
    
    function index($id){
        $head = array();
        $data = array();
        $head['brand'] = $this->Publicmodel->getShopBrands();
        $head['category'] = $this->Publicmodel->getShopCategory();
        $head['categories'] = $this->Publicmodel->getShopCategory_mother(['sub_for' => 0, 'category_name !=' => '']);
        $head['sub_categories'] = $this->Publicmodel->getShopCategory_child();

        $head['title'] = 'Category';
        $head['description'] = @$arrSeo['description'];
        $head['keywords'] = str_replace(" ", ",", $head['title']);
        $data['category_details'] = $this->Publicmodel->get_product_det_category(['products.shop_categorie' => $id]);
        
        $arr = array();
        for($i=0; $i< get_cookie('total'); $i++){
            $arr[] = get_cookie('product_id'.$i);
        }
        
        $data['prod_ids'] = $arr;
        $this->render('category', $head, $data);
    }

   function view($id){
        $head = array();
        $data = array();
        $head['brand'] = $this->Publicmodel->getShopBrands();
        $head['category'] = $this->Publicmodel->getShopCategory();
        $head['categories'] = $this->Publicmodel->getShopCategory_mother(['sub_for' => 0, 'category_name !=' => '']);
        $head['sub_categories'] = $this->Publicmodel->getShopCategory_child();

        $head['title'] = $id.' - Aussievitaminstore';
        $head['description'] = @$arrSeo['description'];
        $head['keywords'] = str_replace(" ", ",", $head['title']);
        
        $data['categpry_name'] = $this->Publicmodel->getShopCategory_mother(['category_slug' => $id]);
        $data['mother_categpry_name'] = $this->Publicmodel->getShopCategory_mother(['id' => $data['categpry_name'][0]['sub_for']]);
        $data['category_details'] = $this->Publicmodel->get_product_det_category(['products.shop_categorie' => $data['categpry_name'][0]['id']]);
        
        $arr = array();
        for($i=0; $i< get_cookie('total'); $i++){
            $arr[] = get_cookie('product_id'.$i);
        }
        
        $data['prod_ids'] = $arr;
        $this->render('category', $head, $data);
    }
    
    function get_product($id){
        $this->output->set_content_type('application jason');
        $res = $this->Publicmodel->get_product_det_category(['products.shop_categorie' => $id]);
        if ($res) {
            $this->output->set_output(json_encode(['result' => 1, 'val' => $res, 'all' => count($res)]));
            return FALSE;
        } else {
            $this->output->set_output(json_encode(['result' => 2]));
            return FALSE;
        }
    }
    
    
    
}
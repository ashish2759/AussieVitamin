<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Brands extends MY_Controller
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
        $head['categories'] = $this->Publicmodel->getShopCategory_mother(['sub_for' => 0, 'category_name !=' => '']);
        $head['sub_categories'] = $this->Publicmodel->getShopCategory_child();
        $head['title'] = 'Brand';
        $head['description'] = @$arrSeo['description'];
        $head['keywords'] = str_replace(" ", ",", $head['title']);
        $data['translation'] = $this->Publicmodel->get_product_details(['translations.manufacturer_id' => $id]);
        
        $arr = array();
        for($i=0; $i< get_cookie('total'); $i++){
            $arr[] = get_cookie('product_id'.$i);
        }
        
        $data['prod_ids'] = $arr;
        $this->render('brand', $head, $data);
    }

    function view($id) {
        $head = array();
        $data = array();
        $head['brand'] = $this->Publicmodel->getShopBrands();
        $head['categories'] = $this->Publicmodel->getShopCategory_mother(['sub_for' => 0, 'category_name !=' => '']);
        $head['sub_categories'] = $this->Publicmodel->getShopCategory_child();
        $head['title'] = $id.' - Aussievitaminstore';
        $head['description'] = @$arrSeo['description'];
        $head['keywords'] = str_replace(" ", ",", $head['title']);

        $data['brand_name'] = $this->Publicmodel->getShoponeBrand(['manufacturer_slug' => $id]);
        $data['translation'] = $this->Publicmodel->get_translations_manufacterer(['manufacturer.manufacturer_slug' => $id]);
        $arr = array();
        for ($i = 0; $i < get_cookie('total'); $i++) {
            $arr[] = get_cookie('product_id' . $i);
        }

        $data['prod_ids'] = $arr;
        $this->render('brand', $head, $data);
    }
    
}
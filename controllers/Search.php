<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Search extends MY_Controller
{
 
    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('pagination'));
        $this->load->Model('publicmodel');
    }

    public function index()
    {
        $data = array();
        $head = array();
        $head['brand'] = $this->Publicmodel->getShopBrands();
        $head['categories'] = $this->Publicmodel->getShopCategory_mother(['sub_for' => 0, 'category_name !=' => '']);
        $head['sub_categories'] = $this->Publicmodel->getShopCategory_child();
        $arrSeo = $this->Publicmodel->getSeo('page_home');
        $head['title'] = @$arrSeo['title'];
        $head['description'] = @$arrSeo['description'];
        $head['keywords'] = str_replace(" ", ",", $head['title']);
        
        $all_categories = $this->Publicmodel->getShopCategories();

        /*
         * Tree Builder for categories menu
         */

        function buildTree(array $elements, $parentId = 0)
        {
            $branch = array();
            foreach ($elements as $element) {
                if ($element['sub_for'] == $parentId) {
                    $children = buildTree($elements, $element['id']);
                    if ($children) {
                        $element['children'] = $children;
                    }
                    $branch[] = $element;
                }
            }
            return $branch;
        }

        $data['home_categories'] = $tree = buildTree($all_categories);
        $data['all_categories'] = $all_categories;
        $data['countQuantities'] = $this->Publicmodel->getCountQuantities();
        $data['bestSellers'] = $this->Publicmodel->getbestSellers();
        $data['sliderProducts'] = $this->Publicmodel->getSliderProducts();
        //$data['products'] = $this->Publicmodel->getProducts($this->num_rows, $page, $_GET);
        $rowscount = $this->Publicmodel->productsCount($_GET);
        $data['shippingOrder'] = $this->AdminModel->getValueStore('shippingOrder');
        $data['showOutOfStock'] = $this->AdminModel->getValueStore('outOfStock');
        $data['showBrands'] = $this->AdminModel->getValueStore('showBrands');
        $data['brands'] = $this->AdminModel->getBrands();
        //$data['links_pagination'] = pagination('home', $rowscount, $this->num_rows);
        $data['trending'] = $this->Publicmodel->getSliderProducts();
        
        $arr = array();
       for($i=0; $i< get_cookie('total'); $i++){
           $arr[] = get_cookie('product_id'.$i);
       }
       
       $data['prod_ids'] = $arr;
       
        $key_word = $this->input->get('search_in_title');
        $data['product_details'] = $this->Publicmodel->get_product_det_product($key_word);
        //print_r($data['product_details']);die();
        
        $this->render('searched_product', $head, $data);
    }

    /*
     * Called to add/remove quantity from cart
     * If is ajax request send POST'S to class ShoppingCart
     */

    public function manageShoppingCart()
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        }
        $this->shoppingcart->manageShoppingCart();
    }

    /*
     * Called to remove product from cart
     * If is ajax request and send $_GET variable to the class
     */

    public function removeFromCart()
    {
        $backTo = $_GET['back-to'];
        $this->shoppingcart->removeFromCart();
        $this->session->set_flashdata('deleted', lang('deleted_product_from_cart'));
        redirect(LANG_URL . '/' . $backTo);
    }

    public function clearShoppingCart()
    {
        $this->shoppingcart->clearShoppingCart();
    }

    public function viewProduct($id)
    {
        $data = array();
        $head = array();
        $head['categories'] = $this->Publicmodel->getShopCategory_mother(['sub_for' => 0, 'category_name !=' => '']);
        $head['sub_categories'] = $this->Publicmodel->getShopCategory_child();
        $head['brand'] = $this->Publicmodel->getShopBrands();
        $data['product'] = $this->Publicmodel->getOneProduct($id);
        $data['trans'] =$this->Publicmodel->getAllproducts(['for_id' => $id]);
        $data['sameCagegoryProducts'] = $this->Publicmodel->sameCagegoryProducts($data['product']['shop_categorie'], $id);
        if ($data['product'] === null) {
            show_404();
        }
        $vars['publicDateAdded'] = $this->AdminModel->getValueStore('publicDateAdded');
        $this->load->vars($vars);
        $head['title'] = $data['product']['title'];
        $description = url_title(character_limiter(strip_tags($data['product']['description']), 130));
        $description = str_replace("-", " ", $description) . '..';
        $head['description'] = $description;
        $head['keywords'] = str_replace(" ", ",", $data['product']['title']);
        $data['avg_star'] = $this->Publicmodel->getOnlyreview(['product_id' => $id]);
        $data['av_star'] = $this->Publicmodel->getAVGstars($id);
        
        $arr = array();
        for($i=0; $i< get_cookie('total'); $i++){
            $arr[] = get_cookie('product_id'.$i);
        }
        
        $data['prod_ids'] = $arr;
        //print_r($data['prod_ids']);
        //exit;
        $this->render('view_product', $head, $data);
    }

    public function confirmLink($md5)
    {
        if (preg_match('/^[a-f0-9]{32}$/', $md5)) {
            $result = $this->Publicmodel->confirmOrder($md5);
            if ($result === true) {
                $data = array();
                $head = array();
                $head['title'] = '';
                $head['description'] = '';
                $head['keywords'] = '';
                $this->render('confirmed', $head, $data);
            } else {
                show_404();
            }
        } else {
            show_404();
        }
    }

    public function discountCodeChecker()
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        }
        $result = $this->Publicmodel->getValidDiscountCode($_POST['enteredCode']); 
        if ($result == null) {
            echo 0;
        } else {
            echo json_encode($result);
        }
    }
    
    
    public function review(){
        $this->output->set_content_type('application jason');
        $this->form_validation->set_rules('title', 'Review Title', 'required');
         if ($this->form_validation->run() == FALSE) {
            $this->output->set_output(json_encode(['result' => 0, 'error' => $this->form_validation->error_array()]));
            return FALSE;
        }
        $res = $this->Publicmodel->insertReview([
            'product_id' => $this->input->post('product_id'),
            'review_title' => $this->input->post('title'), 
            'stars' => $this->input->post('rating'),
            'review' => $this->input->post('review'),
            'username' => $this->session->userdata('username'),
            'userid' => $this->session->userdata('user_id'),
            'rv_time' => date('Y-m-d h:i:s'),
        ]);
        
        if($res){
            $this->output->set_output(json_encode(['result' => 1]));
            return FALSE;
        }else{
            $this->output->set_output(json_encode(['result' => 2]));
            return FALSE;
        }
    }
}

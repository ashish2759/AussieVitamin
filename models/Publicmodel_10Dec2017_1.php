<?php

class Publicmodel extends CI_Model
{

    private $showOutOfStock;
    private $showInSliderProducts;

    public function __construct()
    {
        $this->load->Model('AdminModel');
        $this->showOutOfStock = $this->AdminModel->getValueStore('outOfStock');
        $this->showInSliderProducts = $this->AdminModel->getValueStore('showInSlider');
    }

    public function productsCount($big_get)
    {
        $this->db->join('translations', 'translations.for_id = products.id', 'left');
        $this->db->where('translations.abbr', MY_LANGUAGE_ABBR);
        $this->db->where('translations.type', 'product');
        if (!empty($big_get) && isset($big_get['category'])) {
            $this->getFilter($big_get);
        }
        $this->db->where('visibility', 1);
        if ($this->showOutOfStock == 0) {
            $this->db->where('quantity >', 0);
        }
        if ($this->showInSliderProducts == 0) {
            $this->db->where('in_slider', 0);
        }
        return $this->db->count_all_results('products');
    }

    public function getPosts($limit, $page, $search = null, $month = null)
    {
        if ($search !== null) {
            $search = $this->db->escape_like_str($search);
            $this->db->where("(translations.title LIKE '%$search%' OR translations.description LIKE '%$search%')");
        }
        if ($month !== null) {
            $from = intval($month['from']);
            $to = intval($month['to']);
            $this->db->where("time BETWEEN $from AND $to");
        }
        $this->db->join('translations', 'translations.for_id = blog_posts.id', 'left');
        $this->db->where('translations.type', 'blog');
        $this->db->where('translations.abbr', MY_LANGUAGE_ABBR);
        $query = $this->db->select('blog_posts.id, translations.title, translations.description, blog_posts.url, blog_posts.time, blog_posts.image')->get('blog_posts', $limit, $page);
        return $query->result_array();
    }

    public function getProducts($limit = null, $start = null, $big_get)
    {
        if ($limit !== null && $start !== null) {
            $this->db->limit($limit, $start);
        }
        if (!empty($big_get) && isset($big_get['category'])) {
            $this->getFilter($big_get);
        }
        $this->db->select('products.id,products.image, products.quantity, translations.title, translations.price, translations.old_price, products.url');
        $this->db->join('translations', 'translations.for_id = products.id', 'left');
        $this->db->where('translations.abbr', MY_LANGUAGE_ABBR);
        $this->db->where('translations.type', 'product');
        $this->db->where('visibility', 1);
        if ($this->showOutOfStock == 0) {
            $this->db->where('quantity >', 0);
        }
        if ($this->showInSliderProducts == 0) {
            $this->db->where('in_slider', 0);
        }
        $this->db->order_by('position', 'asc');
        $query = $this->db->get('products');
        return $query->result_array();
    }

    public function getOneLanguage($myLang)
    {
        $this->db->select('*');
        $this->db->where('abbr', $myLang);
        $result = $this->db->get('languages');
        return $result->row_array();
    }

    private function getFilter($big_get)
    {

        if ($big_get['category'] != '') {
            (int) $big_get['category'];
            $findInIds = array();
            $findInIds[] = $big_get['category'];
            $query = $this->db->query('SELECT id FROM shop_categories WHERE sub_for = ' . $big_get['category']);
            foreach ($query->result() as $row) {
                $findInIds[] = $row->id;
            }
            $this->db->where_in('products.shop_categorie', $findInIds);
        }
        if ($big_get['in_stock'] != '') {
            if ($big_get['in_stock'] == 1)
                $sign = '>';
            else
                $sign = '=';
            $this->db->where('products.quantity ' . $sign, '0');
        }
        if ($big_get['search_in_title'] != '') {
            $this->db->like('translations.title', $big_get['search_in_title']);
        }
        if ($big_get['search_in_body'] != '') {
            $this->db->like('translations.description', $big_get['search_in_body']);
        }
        
        if ($big_get['order_price'] != '') {
            $this->db->order_by('CAST(price AS DECIMAL(10.2)) ' . $big_get['order_price']);
        }
        
        if ($big_get['order_procurement'] != '') {
            $this->db->order_by('products.procurement', $big_get['order_procurement']);
        }
        
        if ($big_get['order_new'] != '') {
            $this->db->order_by('products.id', $big_get['order_new']);
        } else {
            $this->db->order_by('products.id', 'DESC');
        }
        if ($big_get['quantity_more'] != '') {
            $this->db->where('products.quantity > ', $big_get['quantity_more']);
        }
        if ($big_get['quantity_more'] != '') {
            $this->db->where('products.quantity > ', $big_get['quantity_more']);
        }
        if ($big_get['brand_id'] != '') {
            $this->db->where('products.brand_id = ', $big_get['brand_id']);
        }
        if ($big_get['added_after'] != '') {
            $time = strtotime($big_get['added_after']);
            $this->db->where('products.time > ', $time);
        }
        if ($big_get['added_before'] != '') {
            $time = strtotime($big_get['added_before']);
            $this->db->where('products.time < ', $time);
        }
        if ($big_get['price_from'] != '') {
            $this->db->where('translations.price >= ', $big_get['price_from']);
        }
        if ($big_get['price_to'] != '') {
            $this->db->where('translations.price <= ', $big_get['price_to']);
        }
    }

    public function getShopCategories()
    {
        $this->db->select('shop_categories.sub_for, shop_categories.id, translations.name');
        $this->db->where('abbr', MY_LANGUAGE_ABBR);
        $this->db->where('type', 'shop_categorie');
        $this->db->order_by('position', 'asc');
        $this->db->join('shop_categories', 'shop_categories.id = translations.for_id', 'INNER');
        $query = $this->db->get('translations');
        $arr = array();
        if ($query !== false) {
            foreach ($query->result_array() as $row) {
                $arr[] = $row;
            }
        }
        return $arr;
    }

    public function getSeo($page)
    {
        $this->db->where('type', $page);
        $this->db->where('abbr', MY_LANGUAGE_ABBR);
        $query = $this->db->get('translations');
        $arr = array();
        if ($query !== false) {
            foreach ($query->result_array() as $row) {
                $arr['title'] = $row['title'];
                $arr['description'] = $row['description'];
            }
        }
        return $arr;
    }

    public function getOneProduct($id)
    {
        $this->db->where('products.id', $id);

        $this->db->select('products.*, translations.title,translations.description, translations.price, translations.old_price, products.url, trans2.name as categorie_name');

        $this->db->join('translations', 'translations.for_id = products.id', 'left');
        $this->db->where('translations.abbr', MY_LANGUAGE_ABBR);
        $this->db->where('translations.type', 'product');

        $this->db->join('translations as trans2', 'trans2.for_id = products.shop_categorie', 'inner');
        $this->db->where('trans2.abbr', MY_LANGUAGE_ABBR);
        $this->db->where('trans2.type', 'shop_categorie');

        $this->db->where('visibility', 1);
        $query = $this->db->get('products');
        return $query->row_array();
    }

    public function getCountQuantities()
    {
        $query = $this->db->query('SELECT SUM(IF(quantity<=0,1,0)) as out_of_stock, SUM(IF(quantity>0,1,0)) as in_stock FROM products WHERE visibility = 1');
        return $query->row_array();
    }

    public function setToCart($post)
    {
        if (!is_numeric($post['article_id'])) {
            return false;
        }
        $query = $this->db->insert('shopping_cart', array(
            'session_id' => session_id(),
            'article_id' => $post['article_id'],
            'time' => time()
        ));
        return $query;
    }

    public function getShopItems($array_items)
    {
        $this->db->select('products.id, products.image, products.url, translations.price, translations.title');
        $this->db->from('products');
        if (count($array_items) > 1) {
            $i = 1;
            $where = '';
            foreach ($array_items as $id) {
                $i == 1 ? $open = '(' : $open = '';
                $i == count($array_items) ? $or = '' : $or = ' OR ';
                $where .= $open . 'products.id = ' . $id . $or;
                $i++;
            }
            $where .= ')';
            $this->db->where($where);
        } else {
            $this->db->where('products.id =', current($array_items));
        }
        $this->db->join('translations', 'translations.for_id = products.id', 'inner');
        $this->db->where('translations.abbr', MY_LANGUAGE_ABBR);
        $this->db->where('translations.type', 'product');
        $query = $this->db->get();
        return $query->result_array();
    }

    /*
     * Users for notification by email
     */

    public function getNotifyUsers()
    {
        $result = $this->db->query('SELECT email FROM users WHERE notify = 1');
        $arr = array();
        foreach ($result->result_array() as $email) {
            $arr[] = $email['email'];
        }
        return $arr;
    }

    public function setOrder($post)
    {
        $q = $this->db->query('SELECT MAX(order_id) as order_id FROM orders');
        $rr = $q->row_array();
        if ($rr['order_id'] == 0) {
            $rr['order_id'] = 1233;
        }
        $post['order_id'] = $rr['order_id'] + 1;

        $i = 0;
        $post['products'] = array();
        foreach ($post['id'] as $product) {
            $post['products'][$product] = $post['quantity'][$i];
            $i++;
        }
        unset($post['id'], $post['quantity']);
        $post['date'] = time();
        $post['products'] = serialize($post['products']);
        $result = $this->db->insert('orders', array(
            'client_user_id' => $this->session->userdata('user_id'),
            'order_id' => $post['order_id'],
            'products' => $post['products'],
            'date' => $post['date'],
            'referrer' => $post['referrer'],
            'clean_referrer' => $post['clean_referrer'],
            'payment_type' => $post['payment_type'],
            'paypal_status' => @$post['paypal_status'],
            'discount_code' => @$post['discountCode']
        ));
        $lastId = $this->db->insert_id();
        $result_2 = $this->db->insert('orders_clients', array(
            'for_id' => $lastId,
            'first_name' => $post['first_name'],
            'last_name' => $post['last_name'],
            'email' => $post['email'],
            'phone' => $post['phone'],
            'address' => $post['address'],
            'city' => $post['city'],
            'post_code' => $post['post_code'],
            'notes' => $post['notes']
        ));
        
        for($i=0; $i<get_cookie('total'); $i++){
            if(get_cookie('product_id'. $i)){
                $this->db->where('id', get_cookie('product_id'. $i));
                $get_price = $this->db->get('translations');
                
                foreach ($get_price->result_array() as $email) {
                        $price = $email['price'];
                }
                
                $this->db->insert('order_products', array(
                    'order_id' => $lastId,
                    'prod_id' => get_cookie('product_id'. $i),
                    'order_quantity' => get_cookie('qty'. $i),
                    'order_price' => $price
                ));
            }
        }
        
        if(get_cookie('coupon_total')){
            $this->db->where('id', $lastId);
            $res = $this->db->update('orders', array(
                'total_amount' => get_cookie('coupon_total'),
                'discount_code' => get_cookie('discount_code')
            ));
            if($res){
                delete_cookie('coupon_total');
                delete_cookie('discount_code');
            }
        }
        
        if ($result == true && $result_2 == true) {
            delete_cookie("total");
            delete_cookie('countertotal');
            for($i=0; $i<get_cookie('total'); $i++){
                if(get_cookie('product_id'. $i)){
                   delete_cookie('i'.$i);
                   delete_cookie('product_id'.$i);
                   delete_cookie('qty'.$i);
                }else{
                    continue;
                }
            }
            
            return $post['order_id'];
        }
        return false;
    }

    public function setOrderpaypal()
    {
    	 $result = $this->db->insert('orders', array(
            'client_user_id' => $this->session->userdata('user_id'),
            'order_id' => 'OD'.rand(0, 99999999),
            'date' => time(),
            'referrer' => 'Paypal',
            'clean_referrer' => 'Paypal',
            'payment_type' => 'PayPal',
            'paypal_status' => 'PayPal'
        ));
        $lastId = $this->db->insert_id();
        $result_2 = $this->db->insert('orders_clients', array(
            'for_id' => $lastId,
            'first_name' => $this->session->userdata('first_name'),
            'last_name' => $this->session->userdata('last_name'),
            'email' => $this->session->userdata('email'),
            'phone' => $this->session->userdata('phone'),
            'address' => $this->session->userdata('address'),
            'city' => $this->session->userdata('city'),
            'post_code' => $this->session->userdata('post_code'),
            'notes' => $this->session->userdata('notes')
        ));
        
        for($i=0; $i<get_cookie('total'); $i++){
            if(get_cookie('product_id'. $i)){
                $this->db->where('id', get_cookie('product_id'. $i));
                $get_price = $this->db->get('translations');
                
                foreach ($get_price->result_array() as $email) {
                        $price = $email['price'];
                }
                
                $this->db->insert('order_products', array(
                    'order_id' => $lastId,
                    'prod_id' => get_cookie('product_id'. $i),
                    'order_quantity' => get_cookie('qty'. $i),
                    'order_price' => $price
                ));
            }
        }
        
        if(get_cookie('coupon_total')){
            $this->db->where('id', $lastId);
            $res = $this->db->update('orders', array(
                'total_amount' => get_cookie('coupon_total'),
                'discount_code' => get_cookie('discount_code')
            ));
            if($res){
                delete_cookie('coupon_total');
                delete_cookie('discount_code');
            }
        }
        
        if ($result == true && $result_2 == true) {
            delete_cookie("total");
            delete_cookie('countertotal');
            for($i=0; $i<get_cookie('total'); $i++){
                if(get_cookie('product_id'. $i)){
                   delete_cookie('i'.$i);
                   delete_cookie('product_id'.$i);
                   delete_cookie('qty'.$i);
                }else{
                    continue;
                }
            }
            
            return $lastId;
        }
        return false;
    }

    public function setActivationLink($link, $orderId)
    {
        $result = $this->db->insert('confirm_links', array('link' => $link, 'for_order' => $orderId));
        return $result;
    }

    public function getSliderProducts()
    {
        $this->db->select('products.id, products.quantity, products.image, products.url, translations.price, translations.title, translations.basic_description, translations.old_price');
        $this->db->join('translations', 'translations.for_id = products.id', 'left');
        $this->db->where('translations.abbr', MY_LANGUAGE_ABBR);
        $this->db->where('translations.type', 'product');
        $this->db->where('visibility', 1);
        $this->db->where('in_slider', 1);
        if ($this->showOutOfStock == 0) {
            $this->db->where('quantity >', 0);
        }
        $query = $this->db->get('products');
        return $query->result_array();
    }

    public function getbestSellers($categorie = 0, $noId = 0)
    {
        $this->db->select('products.id, products.quantity, products.image, products.url, translations.price, translations.title, translations.old_price');
        $this->db->join('translations', 'translations.for_id = products.id', 'left');
        if ($noId > 0) {
            $this->db->where('products.id !=', $noId);
        }
        $this->db->where('translations.abbr', MY_LANGUAGE_ABBR);
        if ($categorie != 0) {
            $this->db->where('products.shop_categorie !=', $categorie);
        }
        $this->db->where('translations.type', 'product');
        $this->db->where('visibility', 1);
        if ($this->showOutOfStock == 0) {
            $this->db->where('quantity >', 0);
        }
        $this->db->order_by('products.procurement', 'desc');
        $this->db->limit(5);
        $query = $this->db->get('products');
        return $query->result_array();
    }

    public function sameCagegoryProducts($categorie, $noId)
    {
        $this->db->select('products.id, products.quantity, products.image, products.url, translations.price, translations.title, translations.old_price');
        $this->db->join('translations', 'translations.for_id = products.id', 'left');
        $this->db->where('products.id !=', $noId);
        $this->db->where('products.shop_categorie =', $categorie);
        $this->db->where('translations.abbr', MY_LANGUAGE_ABBR);
        $this->db->where('translations.type', 'product');
        $this->db->where('visibility', 1);
        if ($this->showOutOfStock == 0) {
            $this->db->where('quantity >', 0);
        }
        $this->db->order_by('products.id', 'desc');
        $this->db->limit(5);
        $query = $this->db->get('products');
        return $query->result_array();
    }

    public function getOnePost($id)
    {
        $this->db->select('translations.title, translations.description, blog_posts.image, blog_posts.time');
        $this->db->where('blog_posts.id', $id);
        $this->db->join('translations', 'translations.for_id = blog_posts.id', 'left');
        $this->db->where('translations.abbr', MY_LANGUAGE_ABBR);
        $query = $this->db->get('blog_posts');
        return $query->row_array();
    }

    public function getArchives()
    {
        $result = $this->db->query("SELECT DATE_FORMAT(FROM_UNIXTIME(time), '%M %Y') as month, MAX(time) as maxtime, MIN(time) as mintime FROM blog_posts GROUP BY DATE_FORMAT(FROM_UNIXTIME(time), '%M %Y')");
        if ($result->num_rows() > 0) {
            return $result->result_array();
        }
        return false;
    }

    public function getFooterCategories()
    {
        $this->db->select('shop_categories.id, translations.name');
        $this->db->where('abbr', MY_LANGUAGE_ABBR);
        $this->db->where('shop_categories.sub_for =', 0);
        $this->db->where('type', 'shop_categorie');
        $this->db->join('shop_categories', 'shop_categories.id = translations.for_id', 'INNER');
        $this->db->limit(10);
        $query = $this->db->get('translations');
        $arr = array();
        if ($query !== false) {
            foreach ($query->result_array() as $row) {
                $arr[$row['id']] = $row['name'];
            }
        }
        return $arr;
    }

    public function setSubscribe($array)
    {
        $num = $this->db->where('email', $arr['email'])->count_all_results('subscribed');
        if ($num == 0) {
            $this->db->insert('subscribed', $array);
        }
    }

    public function getDynPagesLangs($dynPages)
    {
        if (!empty($dynPages)) {
            $this->db->join('translations', 'translations.for_id = active_pages.id', 'left');
            $this->db->where_in('active_pages.name', $dynPages);
            $this->db->where('translations.abbr', MY_LANGUAGE_ABBR);
            $this->db->where('translations.type', 'page');
            $result = $this->db->select('translations.name as lname, active_pages.name as pname')->get('active_pages');
            $ar = array();
            $i = 0;
            foreach ($result->result_array() as $arr) {
                $ar[$i]['lname'] = $arr['lname'];
                $ar[$i]['pname'] = $arr['pname'];
                $i++;
            }
            return $ar;
        } else
            return $dynPages;
    }

    public function getOnePage($page)
    {
        $this->db->join('translations', 'translations.for_id = active_pages.id', 'left');
        $this->db->where('translations.abbr', MY_LANGUAGE_ABBR);
        $this->db->where('translations.type', 'page');
        $this->db->where('active_pages.name', $page);
        $result = $this->db->select('translations.description as content, translations.name')->get('active_pages');
        return $result->row_array();
    }

    public function changePaypalOrderStatus($order_id, $status)
    {
        $processed = 0;
        if ($status == 'canceled') {
            $processed = 2;
        }
        $this->db->where('order_id', $order_id);
        $this->db->update('orders', array(
            'paypal_status' => $status,
            'processed' => $processed
        ));
    }

    public function getCookieLaw()
    {
        $this->db->join('cookie_law_translations', 'cookie_law_translations.for_id = cookie_law.id', 'inner');
        $this->db->where('cookie_law_translations.abbr', MY_LANGUAGE_ABBR);
        $this->db->where('cookie_law.visibility', '1');
        $query = $this->db->select('link, theme, message, button_text, learn_more')->get('cookie_law');
        if ($query->num_rows() > 0) {
            return $query->row_array();
        } else {
            return false;
        }
    }

    public function confirmOrder($md5)
    {
        $this->db->limit(1);
        $this->db->where('link', $md5);
        $result = $this->db->get('confirm_links');
        $row = $result->row_array();
        if (!empty($row)) {
            $orderId = $row['for_order'];
            $this->db->limit(1);
            $this->db->where('order_id', $orderId);
            $result = $this->db->update('orders', array('confirmed' => '1'));
            return $result;
        }
        return false;
    }

    public function getValidDiscountCode($code)
    {
        $time = time();
        $this->db->select('type, amount');
        $this->db->where('code', $code);
        $this->db->where($time . ' BETWEEN valid_from_date AND valid_to_date');
        $query = $this->db->get('discount_codes');
        return $query->row_array();
    }
    
    

    /*  for login page, function validation  */
     public function get_user($data) {
        $q = $this->db->get_where('user', $data);
        return $q->result_array();
    }


    /*  for member page, function insert  */
     public function insert_user($data) {
        $this->db->insert('user', $data);
        return $this->db->insert_id();
    }

    
    public function update_user($wdata, $udata) {
        $this->db->where($wdata);
        $this->db->update('user', $udata);
        return $this->db->affected_rows();
    }
    
    
     public function insert_cart_temp($data) {
        $this->db->insert('cart_temp', $data);
        return $this->db->insert_id();
    }

    
    public function getAllproducts($data){
        $this->db->order_by('product_added_date', 'DESC');
        $result = $this->db->get_where('translations', $data);
        return $result->result_array();
    }
    
    public function getShopBrands()
    {
        $result = $this->db->get('manufacturer');
        return $result->result_array();
    }
    
    public function getShoponeBrand($data)
    {
        $result = $this->db->get_where('manufacturer', $data);
        return $result->result_array();
    }
    
    
    public function get_shipping_address($data)
    {
        $result = $this->db->get_where('shipping_address', $data);
        return $result->result_array();
    }
    
    public function get_billing_address($data)
    {
        $result = $this->db->get_where('billing_address', $data);
        return $result->result_array();
    }
    
    public function get_rewards_address($data)
    {
        $result = $this->db->get_where('rewards_address', $data);
        return $result->result_array();
    }
    
    public function insertReview($data){
        $this->db->insert('reviews', $data);
        return $this->db->insert_id();
    }
    
    public function getOnlyreview($data){
        $this->db->order_by('rv_time', 'DESC');
        $result = $this->db->get_where('reviews', $data);
        return $result->result_array();
    }
    
    function getAVGstars($data) {
        $q = $this->db->query("SELECT AVG(stars) as stars, review FROM reviews WHERE `product_id`=$data");
        return $q->result_array();
    }
    
    public function getShopCategory(){
        
        $result = $this->db->get('shop_categories');
        return $result->result_array();
    }

    
    public function getSingleTranslation($data){
        $result = $this->db->get_where('translations', $data);
        return $result->result_array(); 
    }
    
    public function get_product_details($data){ 
        $this->db->select('translations.id as tr_id, products.url as url, translations.price as price, translations.manufacturer_id as translations_manufacturer_id, translations.old_price as old_price, translations.title as translations_title, translations.price as price, translations.manufacturer as translations_manufacturer, products.image, products.id as pr_id, products.quantity'); 
        $this->db->join('manufacturer', 'translations.manufacturer_id = manufacturer.manufacturer_id');
        $this->db->join('products', 'translations.for_id = products.id');
        $query = $this->db->get_where('translations', $data);
        return $query->result_array();
    }
    
    public function get_product_det_category($data){
        $this->db->select('shop_categories.category_name as category_name, translations.id as tr_id, products.url as url, translations.price as price, translations.manufacturer_id as translations_manufacturer_id, translations.old_price as old_price, translations.title as translations_title, translations.price as price, translations.manufacturer as translations_manufacturer, products.image, products.id as pr_id, products.quantity'); 
        $this->db->join('shop_categories', 'shop_categories.id = products.shop_categorie');
        $this->db->join('translations', 'translations.for_id = products.id');
        $query = $this->db->get_where('products', $data);
        return $query->result_array();
    }
    

    
    public function update_shipping_address($wdata, $udata) {
        $this->db->where($wdata);
        $this->db->update('shipping_address', $udata);
        return $this->db->affected_rows();
    }
    
    public function update_billing_address($wdata, $udata) {
        $this->db->where($wdata);
        $this->db->update('billing_address', $udata);
        return $this->db->affected_rows();
    }
    
    public function update_rewards_address($wdata, $udata) {
        $this->db->where($wdata);
        $this->db->update('rewards_address', $udata);
        return $this->db->affected_rows();
    }
    
    public function insert_shipping_address($data) {
        $this->db->insert('shipping_address', $data);
        return $this->db->insert_id();
    }    
    
    public function insert_billing_address($data) {
        $this->db->insert('billing_address', $data);
        return $this->db->insert_id();
    }    
    
    public function insert_rewards_address($data) {
        $this->db->insert('rewards_address', $data);
        return $this->db->insert_id();
    }
    
    public function getShopCategory_mother($data){
        $result = $this->db->get_where('shop_categories', $data);
        return $result->result_array();
    }
    
    public function getShopCategory_child(){
        
        $this->db->where('sub_for !=', 0);
        $result = $this->db->get_where('shop_categories');
        return $result->result_array();
    }
    
    
    public function insert_wishlist_products($data) {
        $this->db->insert('wishlist_products', $data);
        return $this->db->insert_id();
    }
    
    
    function get_join_product_translation($arr){
        $this->db->where_in('id', $arr);
        $result = $this->db->get('translations');
        return $result->result_array();
    }
    
    function get_All_products(){
        $result = $this->db->get('products');
        return $result->result_array();
    }
    
    function get_wishlist_product($data){
        $this->db->join('translations', 'translations.id = wishlist_products.product_id');
        $this->db->join('products', 'products.id = translations.for_id');
        $result = $this->db->select('wishlist_products.wishlist_id, wishlist_products.product_id, translations.title, 
		translations.price, translations.old_price, products.image,products.quantity')->get_where('wishlist_products', $data);
        return $result->result_array();
    }
    
    function delete_wishlist_product($data){
        $this->db->delete('wishlist_products', $data);
        return $this->db->affected_rows();
    }
    
    function get_check_code($data){
        $result = $this->db->get_where('discount_codes', $data);
        return $result->result_array();
    }
    
    function get_product_translation($data){
         $result = $this->db->get_where('translations', $data);
         return $result->result_array();
    }
    
    public function get_product_det_product($keyword){
        $this->db->select('translations.id as tr_id, products.url as url, translations.price as price, translations.manufacturer_id as translations_manufacturer_id, translations.old_price as old_price, translations.title as translations_title, translations.price as price, translations.manufacturer as translations_manufacturer, products.image, products.id as pr_id, products.quantity'); 
        $this->db->join('shop_categories', 'shop_categories.id = products.shop_categorie');
        $this->db->join('translations', 'translations.for_id = products.id');
        $this->db->like("translations.title", $keyword);
        $this->db->or_like("translations.manufacturer", $keyword);
        $query = $this->db->get('products');
        return $query->result_array();
    }
    
    public function get_ordered_det($id){
        $this->db->select('*');
        
        $this->db->join('translations', 'translations.id = order_products.prod_id');
        $this->db->join('orders', 'orders.id = order_products.order_id');
        $this->db->join('products', 'products.id = translations.for_id');
        
        $this->db->where('orders.client_user_id', $id);
        $query = $this->db->get('order_products');
        return $query->result_array();
    }

     function get_translations_manufacterer($data) {
        $this->db->select('translations.id as tr_id, products.url as url, translations.price as price, translations.manufacturer_id as translations_manufacturer_id, 
     translations.old_price as old_price, translations.title as translations_title, translations.price as price, translations.manufacturer as translations_manufacturer, products.image, 
     products.id as pr_id, products.quantity');
        $this->db->join('manufacturer', 'translations.manufacturer_id = manufacturer.manufacturer_id');
        $this->db->join('products', 'translations.for_id = products.id');
        $query = $this->db->get_where('translations', $data);
        return $query->result_array();
    }
    
    /*  for cart insert  */
     public function insert_cart($data) {
        $this->db->insert('cart_abandone', $data);
        return $this->db->insert_id();
    }
    
    public function get_cart_users($data) {
        $this->db->select('cart_abandone.user_id');
	$this->db->group_by('cart_abandone.user_id');
	$this->db->join('user', 'user.user_id = cart_abandone.user_id'); 
	$query = $this->db->get_where('cart_abandone', $data);
        return $query->result_array();
    }
    
    public function get_cart_details($data) {       
	$this->db->select('user.email as email, user.name as customer_name, translations.id as product_id, translations.title as product_title,  products.url as url, translations.title as product_title, translations.manufacturer as brand');
	$this->db->join('translations', 'translations.id= cart_abandone.product_id');
	$this->db->join('products', 'products.id= translations.for_id');
	$this->db->join('user', 'user.user_id = cart_abandone.user_id'); 
	$query = $this->db->get_where('cart_abandone', $data);
        return $query->result_array();
    }
    
     public function update_cron_mail_status($wdata, $udata) {
        $this->db->where($wdata);
        $this->db->update('cart_abandone', $udata);
        return $this->db->affected_rows();
    }
    
    
    
}

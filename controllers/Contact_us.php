<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Contact_us extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('publicmodel');

    }

    function index(){
        $head = array();
        $data = array();
        $head['brand'] = $this->Publicmodel->getShopBrands();
        $head['categories'] = $this->Publicmodel->getShopCategory_mother(['sub_for' => 0, 'category_name !=' => '']);
        $head['sub_categories'] = $this->Publicmodel->getShopCategory_child();
        $head['title'] = 'Brand';
        $head['description'] = @$arrSeo['description'];
        $head['keywords'] = str_replace(" ", ",", $head['title']);

        $this->render('contact_us', $head, $data);
    }

    function enquire() {
        $this->output->set_content_type('application jason');

        //form_validation
        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('phone_number', 'Phone Number', 'required|numeric');
        $this->form_validation->set_rules('subject', 'Subject', 'required');
        $this->form_validation->set_rules('message', 'Message', 'required');

        //Validation run
        if ($this->form_validation->run() == FALSE) {
            $this->output->set_output(json_encode(['result' => 0, 'error' => $this->form_validation->error_array()]));
            return FALSE;
        }

        $name = ucwords($this->input->post('name'));
        $email = $this->input->post('email');
        $phone_number = $this->input->post('phone_number');
        $order_no = ucwords($this->input->post('order_no'));
        $subject = $this->input->post('subject');
        $message = $this->input->post('message');

        $txt = 'Dear Admin,' . '<br/><br/> You have received an enquirey request for Aussie vitamin Store' . ' from <b>' . $name . '</b> .<br/>The enquirey details are mentioned below. <br/><br/> Message : ' . $message . '. <br/> Name : <b>' . $name . '</b> <br/> Email : <b>' . $email . '</b> <br/> Phone : <b>' . $phone_number . '</b> <br/> Subject : <b>' . $subject . '</b> <br/> Order Number : <b>' . $order_no . '</b>';

        $config = Array(
            'protocol' => 'smtp',
            'smtp_host' => 'vps29011.inmotionhosting.com',
            'smtp_port' => 465,
            'smtp_user' => 'system@durgapujaparikrama.com',
            'smtp_pass' => 'WsRocks123',
            'mailtype'  => 'html',
            'charset'   => 'iso-8859-1'
        );

        $this->load->library('email', $config);
        $this->email->set_newline("\r\n");

        $this->email->from($email, $name);
        $this->email->to('ashish2759@gmail.com');
        $this->email->set_mailtype("html");

        $this->email->subject('Enquiry Aussievitaminstore');
        $this->email->message($txt);

        // Set to, from, message, etc.
        $result = $this->email->send();

        $this->output->set_output(json_encode(['result' => 1]));
        return FALSE;
    }

}
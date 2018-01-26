<?php

/*
 * @Author:    Kiril Kirkov
 *  Gitgub:    https://github.com/kirilkirkov
 */
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Manufacture extends ADMIN_Controller
{

    private $num_rows = 20;

    public function index($page = 0)
    {
        $this->login_check();
        $data = array();
        $head = array();
        $head['title'] = 'Administration - Home Manufacturer';
        $head['description'] = '!';
        $head['keywords'] = '';
        $data['manufacturers'] = $this->AdminModel->getmanufacturer();
       
        /*$data['languages'] = $this->AdminModel->getLanguages();
        $rowscount = $this->AdminModel->categoriesCount();
        $data['links_pagination'] = pagination('admin/shopcategories', $rowscount, $this->num_rows, 3);*/
        if (isset($_GET['delete'])) {
            $this->saveHistory('Delete a shop categorie');
            $res = $this->AdminModel->deleteManufacturer(['manufacturer_id' => $_GET['delete']]);
            if ($res) {
                $this->saveHistory('Home Manufacturer id - ' . $_GET['delete']);
                $this->session->set_flashdata('result_delete', 'Manufacturer is deleted!');
            } else {
                $this->session->set_flashdata('result_delete', 'Problem with Manufacturer delete!');
            }
            redirect('admin/manufacture');
        }
        if (isset($_POST['submit'])) {
            $result = $this->AdminModel->setManufacturer([
                'manufacturer_name' => $_POST['man_name'],
                'manufacturer_description' => $_POST['desc'],
                'manufacturer_slug' => $_POST['slug'],
                'manufacturer_date' => date('Y-m-d h:i:s')
            ]);
            if ($result) {
                $this->session->set_flashdata('result_add', 'Manufacturer is added!');
                $this->saveHistory('Added Manufacturer');
            } else {
                $this->session->set_flashdata('result_add', 'Problem with Manufacturer add!');
            }
            redirect('admin/manufacture');
        }
        if (isset($_POST['editSubId'])) {
            $result = $this->AdminModel->editShopCategorieSub($_POST);
            if ($result === true) {
                $this->session->set_flashdata('result_add', 'Subcategory changed!');
                $this->saveHistory('Change subcategory for category id - ' . $_POST['editSubId']);
            } else {
                $this->session->set_flashdata('result_add', 'Problem with Shop category change!');
            }
            redirect('admin/manufacture');
        }
        
        
        
        $this->load->view('_parts/header', $head);
        $this->load->view('ecommerce/manufacture', $data);
        $this->load->view('_parts/footer');
        $this->saveHistory('Go to manufacturer');
    }
   



}

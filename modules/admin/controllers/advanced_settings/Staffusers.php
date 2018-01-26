<?php
 
/*
 * @Author:    Kiril Kirkov
 *  Gitgub:    https://github.com/kirilkirkov
 */
if (!defined('BASEPATH')) { 
    exit('No direct script access allowed');
}

class Staffusers extends ADMIN_Controller
{

    public function index()
    {
        $this->login_check();
        if (isset($_GET['delete'])) {
            $result = $this->AdminModel->deleteStaffUser($_GET['delete']);
            if ($result == true) {
                $this->saveHistory('Delete user id - ' . $_GET['delete']);
                $this->session->set_flashdata('result_delete', 'User is deleted!');
            } else {
                $this->session->set_flashdata('result_delete', 'Problem with user delete!');
            }
            redirect('admin/staffUsers');
        }
        if (isset($_GET['edit']) && !isset($_POST['username'])) {
            $_POST = $this->AdminModel->getStaffUsers($_GET['edit']);
        }
        $data = array();
        $head = array();
        $head['title'] = 'Administration - Staff Users';
        $head['description'] = '!';
        $head['keywords'] = '';
        $data['staff_users'] = $this->AdminModel->staff_get(['type' => 'staff']); 
        $this->form_validation->set_rules('username', 'User', 'trim|required');
        if (isset($_POST['edit']) && $_POST['edit'] == 0) {
            $this->form_validation->set_rules('password', 'Password', 'trim|required');
        }
        if ($this->form_validation->run($this)) {
            $result = $this->AdminModel->setAdminUser($_POST);
            if ($result === true) {
                $this->session->set_flashdata('result_add', 'User is added!');
                $this->saveHistory('Create staff user - ' . $_POST['username']);
            } else {
                $this->session->set_flashdata('result_add', 'Problem with staff user add!');
                $this->saveHistory('Cant add staffuser');
            }
            redirect('admin/staffUsers');
        }

        $this->load->view('_parts/header', $head);
        $this->load->view('advanced_settings/staffUsers', $data);
        $this->load->view('_parts/footer');
        $this->saveHistory('Go to Staff Users');
    }
    
    function add_staff_members() {
        $this->output->set_content_type('application jason');

        //form_validation
        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');
        $this->form_validation->set_rules('con_password', 'Confirm Password', 'required|matches[password]');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('phone', 'Phone', 'required|numeric');

        //Validation run
        if ($this->form_validation->run() == FALSE) {
            $this->output->set_output(json_encode(['result' => 0, 'error' => $this->form_validation->error_array()]));
            return FALSE;
        }

        $name = ucwords($this->input->post('name'));
        $username = $this->input->post('username');
        $email = $this->input->post('email');
        $password = $this->input->post('password');
        $con_password= $this->input->post('con_password');
        $phone = $this->input->post('phone');
        $added_by= $this->input->post('added_by');
        
        $data_field = array(
            'name' => $name,
            'username' => $username ,
            'email' => $email,
            'password' => md5($password),
            'phone' => $phone,
            'notify' => 1,
            'last_login' => 0,
            'type' => 'staff',
            'added_by' => $added_by
        );

        $insert_id = $this->AdminModel->insert_staff($data_field);
        
        if ($insert_id) {
            $this->output->set_output(json_encode(['result' => 1]));
            return FALSE;
        } else {
            $this->output->set_output(json_encode(['result' => 2]));
            return FALSE;
        }

    }

}

<?php
namespace App\Controllers;

use App\Models\M_admin;

class Admin_auth extends BaseController
{
    protected $session;

    public function __construct()
    {
        $this->session = \Config\Services::session();
    }

    public function login()
    {
        $error = session()->getFlashdata('error');
        return view('login', ['error' => $error]);
    }

    public function dologin()
    {
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        $adminModel = new M_admin();
        $admin = $adminModel->adminlogin($username);
        if ($admin) {
            if (password_verify($password, $admin->admin_password)) {
                $this->session->set([
                    "logged_in"   => true,
                    "id"          => $admin->admin_id,
                    "admin_name"  => $admin->admin_name ?? '',
                ]);
                return redirect()->to('/dashboard');
            } else {
                return redirect()->to('/')->with('error', 'Incorrect password. Please try again.');
            }
        } else {
            return redirect()->to('/')->with('error', 'Username or mobile number not found.');
        }
    }
public function logout()
{
    $session = session();
    $session->destroy();
    return redirect()->to(base_url('/'))
                     ->with('message', 'You have been logged out successfully.');
}
public function group_edit_requests()
  {
    $m_group_edit_request = new \App\Models\M_request();
      if (!session()->get('logged_in')) {
          return redirect()->to('/');
      }
    $admindata['admin_name'] = $this->session->get('admin_name');
    $reqdata['groupeditrequests']=$m_group_edit_request->get_edit_requests();
      echo view('includes/header',$admindata);
      echo view('includes/sidebar');
      echo view('group_edit_requests',$reqdata);
      echo view('includes/footer');
   }
  public function permission_granted($Id,$groupId)
    {
    $m_request = new \App\Models\M_request();
    $m_group = new \App\Models\M_group();
    $response = [];
    $result=$m_request->update_request($Id,$groupId);
  
    if ($result){
        $m_group->permission_granted($groupId);
        $response['success'] = true;
        $response['message']= "permission granted for group edit.";
        $response['reload']  = 1;
    }
    return $this->response
          ->setHeader('Content-Type', 'application/json')
          ->setBody(json_encode($response));
    }
}
?>

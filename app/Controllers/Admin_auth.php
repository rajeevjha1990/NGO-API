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

}
?>

<?php
namespace App\Controllers;

class Dashboard extends BaseController
{
    protected $session;

    public function __construct()
    {
        $this->session = \Config\Services::session();
    }
public function index()
{
    if (!session()->get('logged_in')) {
        return redirect()->to('/');
    }

    $data['admin_name'] = $this->session->get('admin_name');
    echo view('includes/header', $data);
    echo view('includes/sidebar');
    echo view('dashboard', $data);
    echo view('includes/footer');
}

public function historyData()
{
    $model = new \App\Models\M_stock();
    $data['history'] = $model->get_all_medicines_monthly_history();
    return $this->response->setJSON($data);
}

}
?>

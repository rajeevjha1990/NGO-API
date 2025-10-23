<?php
namespace App\Controllers\Api;

use App\Controllers\BaseAuthController;

class Common extends BaseAuthController
{
    protected $session;
    protected $validation;
    protected $request;

    public function __construct()
    {
        $this->session    = \Config\Services::session();
        $this->validation = \Config\Services::validation();
        $this->request    = \Config\Services::request();
    }
    public function qualifications()
      {
        $m_qualification = new \App\Models\M_qualification();
        $response['qualifications']=$m_qualification->get_qualification();
        return json_encode($response);
      }
    }
?>

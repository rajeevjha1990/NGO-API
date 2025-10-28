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
    public function getPrograms()
      {
        $m_program = new \App\Models\M_program();
        $response['programs']=$m_program->get_programs();
        return json_encode($response);
      }
  // public function new_group()
  //     {
  //         $groupData=array(
  //           ''=>$this->request->getVar('');
  //           ''=>$this->request->getVar('');
  //           ''=>$this->request->getVar('');
  //           ''=>$this->request->getVar('');
  //           ''=>$this->request->getVar('');
  //           ''=>$this->request->getVar('');
  //           ''=>$this->request->getVar('');
  //           ''=>$this->request->getVar('');
  //         );
  //     }
    }
?>

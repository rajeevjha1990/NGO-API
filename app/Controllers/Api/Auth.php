<?php
namespace App\Controllers\Api;

use App\Controllers\BaseAuthController;

class Auth extends BaseAuthController
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

    // ------------------------------------------
    // Register
    // ------------------------------------------
    public function volunteer_register()
    {
        $this->validation->setRules([
            'volunteer_name' => 'required',
            'volntr_mobile'     => 'required|numeric|min_length[10]|is_unique[volunteer.volntr_mobile]',
            'password'      => 'required|min_length[6]'
        ]);

        if (!$this->validation->withRequest($this->request)->run()) {
            return $this->response->setStatusCode(400)->setJSON([
                'status' => false,
                'err' => $this->validation->getErrors()
            ]);
        }

        $volunteerModel = new \App\Models\M_volunteer();

        $insertData = [
            'volunteer_name' => $this->request->getVar('volunteer_name'),
            'volntr_mobile'     => $this->request->getVar('volntr_mobile'),
            'volntr_password'      => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
        ];
        $insert = $volunteerModel->insert($insertData);
        if ($insert) {
            return $this->response->setJSON([
                'status' => true,
                'msg'    => 'Registration successful.'
            ]);
        } else {
            return $this->response->setStatusCode(500)->setJSON([
                'status' => false,
                'msg'    => 'Failed to register user.'
            ]);
        }
    }

    // ------------------------------------------
    // Login
    // ------------------------------------------
public function login()
{
    $this->validation->setRules([
        'mobile' => [
            'label' => 'Mobile Number',
            'rules' => 'required|regex_match[/^[0-9]{10}$/]',
            'errors' => [
                'required' => 'Mobile number is required.',
                'regex_match' => 'Please enter a valid 10-digit mobile number.'
            ]
        ],
        'password' => [
            'label' => 'Password',
            'rules' => 'required',
            'errors' => ['required' => 'Password is required.']
        ]
    ]);
    if (!$this->validation->withRequest($this->request)->run()) {
        return $this->response->setStatusCode(451)->setJSON([
            'status' => false,
            'errors' => $this->validation->getErrors()
        ]);
    }

    $mobile = $this->request->getVar('mobile');
    $password = $this->request->getVar('password');
    $m_volunteer = new \App\Models\M_volunteer();
    $volunteer = $m_volunteer->where('volntr_mobile', $mobile)->first();
    if (!$volunteer) {
        return $this->response->setStatusCode(404)->setJSON([
            'status' => false,
            'msg' => 'Mobile number not registered.'
        ]);
    }
    if (password_verify($password, $volunteer['volntr_password'])) {
       $auth = json_encode(["id" => $volunteer['volntr_id']]);
            $authkey = $this->encrypter->encrypt($auth);
            $response = [
                "authkey" => bin2hex($authkey),
                "volntrid" => $volunteer['volntr_id'],
                "message" => "You are sucessfuly logedin",
            ];
            return json_encode($response);
    }

}
  public function get_volunteer()
    {
      $resp_data["volunteer"] = $this->volunteerData;
      return json_encode($resp_data);
    }
    public function logout()
    {
        $this->session->destroy();
        return $this->response->setJSON([
            'status' => true,
            'msg' => 'Logout successful.'
        ]);
    }

    public function reset_password()
    {
        $this->validation->setRules([
            'volntr_mobile'       => 'required|numeric|min_length[10]',
            'new_password'    => 'required|min_length[6]',
            'confirm_password' => 'required|matches[new_password]'
        ]);

        if (!$this->validation->withRequest($this->request)->run()) {
            return $this->response->setStatusCode(400)->setJSON([
                'status' => false,
                'errors' => $this->validation->getErrors()
            ]);
        }

        $mobile = $this->request->getVar('volntr_mobile');
        $newPassword = $this->request->getVar('new_password');

        $volunteerModel = new \App\Models\M_volunteer();
        $volunteer = $volunteerModel->where('volntr_mobile', $mobile)->first();

        if (!$volunteer) {
            return $this->response->setStatusCode(404)->setJSON([
                'status' => false,
                'msg' => 'Mobile number not found.'
            ]);
        }

        $volunteerModel->update($volunteer['id'], [
            'password' => password_hash($newPassword, PASSWORD_DEFAULT),
            'last_password_changed_at' => date('Y-m-d H:i:s')
        ]);

        return $this->response->setJSON([
            'status' => true,
            'msg' => 'Password reset successful.'
        ]);
    }
  public function update_profile()
    {
      $profiledata=array(
          'volntr_name'=>$this->request->getVar('volunteer_name'),
          'volntr_mobile'=>$this->request->getVar('volntr_mobile'),
          'volntr_email'=>$this->request->getVar('volntr_email'),
          'volntr_ep_temp'=>$this->request->getVar('volntr_ep_temp'),
          'volntr_qualification'=>$this->request->getVar('volntr_qualification'),
          'volntr_join_date'=>$this->request->getVar('volntr_join_date'),
          'volntr_address'=>$this->request->getVar('volntr_address'),
      );
      $volunteerModel = new \App\Models\M_volunteer();
      $vlntrId=$this->volunteerData->volntr_id;
      $result=$volunteerModel->update_profile($profiledata,$vlntrId);
      if ($result) {
          return $this->response->setJSON([
              'status' => true,
              'msg'    => 'Your profile updated successful.'
          ]);
      } else {
          return $this->response->setStatusCode(500)->setJSON([
              'status' => false,
              'msg'    => 'Failed to register user.'
          ]);
      }
    }
}
?>

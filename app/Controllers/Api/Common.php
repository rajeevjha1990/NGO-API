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
public function epGropus()
  {
    $m_group = new \App\Models\M_group();
    $vlntrId=$this->volunteerData->volntr_id;
    $response['groups']=$m_group->get_groups($vlntrId);
    return json_encode($response);
  }
public function new_group()
{
    $groupData = [
        'group_volunteer'     =>$this->volunteerData->volntr_id,
        'group_program'     => $this->request->getVar('program_id'),
        'group_name'     => $this->request->getVar('group_name'),
        'group_epno'        => $this->request->getVar('ep_no'),
        'group_senior_epno' => $this->request->getVar('senior_ep_no'),
        'group_noof_member' => $this->request->getVar('no_of_members'),
    ];

    $groupmembers = $this->request->getVar('members');
    if (is_string($groupmembers)) {
        $groupmembers = json_decode($groupmembers, true);
    }

    $m_group = new \App\Models\M_group();
    $insert = $m_group->insertGroup($groupData);
    $group_id = $m_group->insertID();

    if ($insert && $group_id && !empty($groupmembers)) {
        $m_group_member = new \App\Models\M_group_member();
        $mobiles = array_column($groupmembers, 'mobile');

        $existingMobiles = $m_group_member->checkduplicateMobile($mobiles);
        if (!empty($existingMobiles)) {
            $existingMobileList = array_column($existingMobiles, 'mobile');
            return $this->response->setStatusCode(409)->setJSON([
                'status' => false,
                'msg' => 'Duplicate mobile numbers found: ' . implode(', ', $existingMobileList)
            ]);
        }
        $batchData = [];
        foreach ($groupmembers as $member) {
            $batchData[] = [
                'groupid' => $group_id,
                'epno'    => $this->request->getVar('ep_no'),
                'name'    => $member['name'],
                'mobile'  => $member['mobile']
            ];
        }
        $result = $m_group_member->insertBatch($batchData);
    }

    if (!empty($result)) {
        return $this->response->setJSON([
            'status' => true,
            'msg'    => 'New Group Created Successfully with members.'
        ]);
    } else {
        return $this->response->setStatusCode(500)->setJSON([
            'status' => false,
            'msg'    => 'Failed to create new group.'
        ]);
    }
}
public function getMembers()
  {
    $groupid=$this->request->getVar('groupId');
    $m_group_member= new \App\Models\M_group_member();
    $response['groupmembers']=$m_group_member->get_group_members($groupid);
    return json_encode($response);
  }
public function update_role()
  {
    $memberId=$this->request->getVar('memberId');
    $role=$this->request->getVar('role');
    $m_group_member= new \App\Models\M_group_member();
    $result=$m_group_member->update_role($memberId,$role);
    if($result){
      return $this->response->setJSON([
          'status' => true,
          'msg'    => 'Member role update.'
      ]);
    }
  }
public function request_edit_group()
  {
    $requestdata=array(
      'request_id'=>$this->volunteerData->volntr_id,
      'group_id'=>$this->request->getVar('groupId'),
      'reason'=>$this->request->getVar('reason')
    );
  
    $m_request= new \App\Models\M_request();
    $result =$m_request->request_insert($requestdata);
    if($result){
      return $this->response->setJSON([
          'status' => true,
          'msg' => 'Your request to edit the group has been successfully submitted.'
      ]);
    }
  }
}
?>

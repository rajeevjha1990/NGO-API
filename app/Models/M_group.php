<?php

namespace App\Models;

use CodeIgniter\Model;

class M_group extends Model
{
    protected $table = 'group';

    protected $allowedFields = [
        'group_id',
        'group_name',
        'group_volunteer',
        'group_program',
        'group_noof_member',
        'group_epno',
        'group_senior_epno',
        'group_start_date',
        'group_status',
        'group_created',
    ];
  public function get_groups($vlntrId)
    {
      //$this->where('group_status',1);
      $this->where('group_volunteer',$vlntrId);
      return $this->get()->getResult();
    }
  public function get_groupdata($groupId)
    {
      $this->select('group_id as group_id,group_name as group_name,
      group_volunteer as group_volunteer,group_program as program_id,group_noof_member as group_noof_member,
      group_epno as ep_no,group_senior_epno as senior_ep_no');
      $this->where('group_id',$groupId);
      return $this->get()->getRow();
    }
  public function insertGroup($groupData)
    {
      return  $this->insert($groupData);
    }
public function permission_granted($groupId)
  {
    $this->where('group_id',$groupId);
    $this->set('group_status',2);
    $resp= $this->update();
    return $resp?true:false;
  }
public function update_group($groupId, $groupData)
  {
    $this->where('group_id',$groupId);
    $this->set($groupData);
    $this->set('group_status',1);
    $resp= $this->update();
    return $resp?true:false;
  }
}
?>

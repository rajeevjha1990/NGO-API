<?php

namespace App\Models;

use CodeIgniter\Model;

class M_group_member extends Model
{
    protected $table = 'group_member';

    protected $allowedFields = [
        'id',
        'groupid',
        'name',
        'mobile',
        'epno',
        'role',
        'staus',
        'created',
    ];

  public function insertGroup($groupData)
    {
      return  $this->insert($groupData);
    }
public function checkduplicateMobile($mobiles)
  {
    $this->select('mobile');
    $this->whereIn('mobile', $mobiles);
    return $this->get()->getResult();
  }
  public function get_group_members($groupId)
    {
      $this->where('status',1);
      $this->where('groupid',$groupId);
      return $this->get()->getResult();
    }
  public function update_role($memberId,$role)
  {
    $this->where('id',$memberId);
    $this->set('role',$role);
    return $this->update();
  }
}
?>

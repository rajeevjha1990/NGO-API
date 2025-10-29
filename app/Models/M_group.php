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
        'group_status',
        'group_created',
    ];
  public function get_groups($vlntrId)
    {
      $this->where('group_status',1);
      $this->where('group_volunteer',$vlntrId);
      return $this->get()->getResult();
    }
  public function insertGroup($groupData)
    {
      return  $this->insert($groupData);
    }

}
?>

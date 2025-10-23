<?php

namespace App\Models;

use CodeIgniter\Model;

class M_volunteer extends Model
{
    protected $table = 'volunteer';

    protected $allowedFields = [
        'volntr_id',
        'volntr_ep_temp',
        'volntr_name',
        'volntr_qualification',
        'volntr_mobile',
        'volntr_email',
        'volntr_address',
        'volntr_password',
        'volntr_join_date',
        'volntr_status',
        'volntr_created',
    ];

public function getPassword($mobile)
  {
    $this->where('volntr_mobile', $mobile);
    return $this->get()->getRow();
  }
  public function get_volunteer($volunteerId)
    {
      $this->where('volntr_id',$volunteerId);
      return $this->get()->getRow();
    }
  public function volunteer_exits($mobile, $volunteerId=null)
      {
        $this->where('volntr_mobile', $mobile);
        if (!empty($volunteerId)) {
            $this->where('volntr_id !=', $volunteerId);
        }
        $query = $this->get(1);
        return $query->getRow();
      }
public function insert_volunteer($data)
  {
  return  $this->insert($data);
  }
public function update_profile($profiledata,$vlntrId)
  {
    $this->set($profiledata);
    $this->where('volntr_id',$vlntrId);
    return $this->update();
  }
}
?>

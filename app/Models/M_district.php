<?php

namespace App\Models;

use CodeIgniter\Model;

class M_district extends Model
{
    protected $table = 'district';
    protected $allowedFields = [
        'district_id',
        'district_name',
        'district_state',
        'district_status',
        'district_created',
    ];

  public function state_districts($stateId)
    {
      $this->where('district_state',$stateId);
      $this->where('district_status',1);
      return $this->get()->getResult();
    }
}
?>

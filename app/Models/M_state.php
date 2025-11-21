<?php

namespace App\Models;

use CodeIgniter\Model;

class M_state extends Model
{
    protected $table = 'state';

    protected $allowedFields = [
        'state_id',
        'state_name',
        'state_status',
        'state_created',
    ];

  public function allStates()
    {
      $this->where('state_status',1);
      return $this->get()->getResult();
    }
}
?>

<?php

namespace App\Models;

use CodeIgniter\Model;

class M_request extends Model
{
    protected $table = 'group_edit_request';

    protected $allowedFields = [
        'id',
        'request_id',
        'group_id',
        'reason',
        'staus',
        'created',
    ];

  public function request_insert($groupData)
    {
      return  $this->insert($groupData);
    }
}
?>

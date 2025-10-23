<?php

namespace App\Models;

use CodeIgniter\Model;

class M_qualification extends Model
{
    protected $table = 'qualification';

    protected $allowedFields = [
        'qualification_id',
        'qualification_short',
        'qualification_title',
        'qualification_desc',
        'qualification_status',
        'qualification_created',
        ];

public function get_qualification()
  {
    $this->where('qualification_status',1);
    return $this->get()->getResult();
  }
}
?>

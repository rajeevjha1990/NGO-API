<?php

namespace App\Models;

use CodeIgniter\Model;

class M_program extends Model
{
    protected $table = 'programs';

    protected $allowedFields = [
        'program_id',
        'program_name',
        'program_description',
        'program_charge',
        'program_status',
        'program_creaed',
    ];

  public function get_programs()
    {
      $this->where('program_status',1);
      return $this->get()->getResult();
    }

}
?>

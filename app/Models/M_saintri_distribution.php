<?php

namespace App\Models;

use CodeIgniter\Model;

class M_saintri_distribution extends Model
{
    protected $table = 'saintri_distribution';

    protected $allowedFields = [
        'id',
        'member_name',
        'age',
        'guardian',
        'village',
        'post',
        'police_station',
        'district',
        'state',
        'pincode',
        'aadhar',
        'mobile',
        'membership_amount',
        'volunteer_id',
        'issue_date',
        'status',
        'created',
    ];

  public function saintri_insert($saintriData)
    {
      return  $this->insert($saintriData);
    }
  public function distributed_saintries($volntrId)
    {
      $this->where('volunteer_id',$volntrId);
      $this->where('status',1);
      return $this->get()->getResult();
    }
}
?>

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
        'status',
        'created',
    ];

  public function request_insert($groupData)
    {
      return  $this->insert($groupData);
    }
    public function get_edit_requests()
      {
        $this->select('vl.volntr_name,vl.volntr_ep_temp,
        g.group_name,group_edit_request.reason,group_edit_request.id,group_edit_request.group_id');
        $this->join('volunteer vl','vl.volntr_id=group_edit_request.request_id');
        $this->join('group g','g.group_id=group_edit_request.group_id');
        $this->where('status',1);
        return $this->get()->getResult();
      }
  public function get_all_edit_request()
    {
      $this->where('status',1);
      return $this->get()->getResult();
    }
public function update_request($Id,$groupId)
  {
    $this->where('id',$Id);
    $this->where('group_id',$groupId);
    $this->set('status',0);
    $resp= $this->update();
    return $resp?true:false;
  }
}
?>

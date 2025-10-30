<?php

namespace App\Models;

use CodeIgniter\Model;

class M_admin extends Model
{
    protected $table = 'admin';

    protected $allowedFields = [
        'admin_id',
        'admin_name',
        'admin_mobile',
        'admin_email',
        'admin_password',
        'admin_status',
        'admin_created',
    ];
    public function adminlogin($adminname)
    {
        return $this->where('admin_email', $adminname)
                    ->orWhere('admin_mobile', $adminname)
                    ->get()->getRow();
    }
public function new_password_set($adminid,$admin_pwd)
    {
      $this->set('admin_password',$admin_pwd);
      $this->where('admin_id',$adminid);
      if($this->update()){
        return true;
      }else {
        return false;
      }
    }
  public function getAdminData($adminid)
    {
      $this->where('admin_id',$adminid);
      $this->select('admin_password');
      return  $this->get()->getRow();
    }
}
?>

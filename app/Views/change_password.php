<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Change Password</title>
</head>
<body>
<div class="container mt-5">
  <div class="content">
<div class="card">
  <div class="card-body login-card-body">
    <p class="login-box-msg"></p>
    <form action="<?php echo base_url(); ?>medicine/change_password" method="post">
      <div class="input-group mb-3">
        <input type="password" name="current_password" class="form-control" placeholder="Current Password">
      </div>
      <div class="input-group mb-3">
        <input type="password" name="new_password" class="form-control" placeholder="New Password">
      </div>
      <div class="input-group mb-3">
        <input type="password" name="confirm_password" class="form-control" placeholder="Confirm New Password">
      </div>
      <div class="row">
        <div class="offset-10 col-4">
          <button type="submit" class="btn btn-primary btn-block">Change Password</button>
        </div>
      </div>
    </form>
  </div>
</div>
</div>
</div>

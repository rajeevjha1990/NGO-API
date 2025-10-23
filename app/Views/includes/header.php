<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Medicine Management</title>
    <link rel="stylesheet" href="<?php echo base_url(); ?>/assets/css/dataTables.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>/assets/css/style.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>/assets/css/bootstrap.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>/assets/css/select2.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>/assets/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>/assets/css/all.min.css">

    <style>
        .header {
            background: #222;
            color: #fff;
            padding: 10px 20px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .header h1 {
            margin: 0;
            font-size: 22px;
        }
        .user-section {
            display: flex;
            align-items: center;
            gap: 15px;
        }
        .user-section span {
            font-weight: bold;
        }
        .logout-btn {
            background: #dc3545;
            color: #fff;
            border: none;
            padding: 5px 12px;
            border-radius: 5px;
            cursor: pointer;
        }
        .logout-btn:hover {
            background: #c82333;
        }
        .notification-bell {
    position: relative;
    display: inline-block;
    margin: 0 10px;
    cursor: pointer;
}
.notification-count {
    position: absolute;
    top: -8px;
    right: -10px;
    background: red;
    color: white;
    border-radius: 50%;
    padding: 2px 6px;
    font-size: 12px;
    font-weight: bold;
}

    </style>
</head>

<body>
    <header class="header">
    <h1>Medicine Management</h1>
    <div class="user-section">
        <a href="index.php?action=notifications" class="notification-bell" style="color:#fff; position:relative; font-size:20px;">
            <i class="fas fa-bell"></i>
            <?php if (!empty($notifCount) && $notifCount > 0) { ?>
                <span class="notification-count" id="notifCount"><?php echo $notifCount; ?></span>
            <?php } else { ?>
                <span class="notification-count" id="notifCount" style="display:none;">0</span>
            <?php } ?>
        </a>
        <span><?php echo $admin_name ?? 'Guest'; ?></span>
        <a href="<?php echo base_url() ?>/auth/logout" class="logout-btn">
            Logout
            <i class="float-right fas sign-out-alt"></i>
          </a>
    </div>
</header>
<div class="main-container">
<script>
document.querySelector('.logout-btn').addEventListener('click', function(e){
    e.preventDefault(); // prevent immediate logout
    const logoutUrl = this.href;

    Swal.fire({
        title: 'Are you sure you want to logout?',
        text: "You will be logged out from the system.",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, Logout',
        cancelButtonText: 'Cancel'
    }).then((result) => {
        if (result.isConfirmed) {
            // redirect to logout
            window.location.href = logoutUrl;
        }
    });
});
</script>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Medicine List</title>
    <style>
        .new-btn {
            display: inline-block;
            padding: 8px 14px;
            margin-bottom: 15px;
            background: #007bff;
            color: #fff;
            font-weight: bold;
            border-radius: 5px;
            text-decoration: none;
        }
        .new-btn:hover {
            background: #0056b3;
        }

        .action-btn {
            padding: 5px 10px;
            margin-right: 5px;
            border: none;
            border-radius: 4px;
            color: #fff;
            cursor: pointer;
        }

        .edit-btn {
            background: #28a745;
        }

        .edit-btn:hover {
            background: #218838;
        }

        .delete_data {
            background: #dc3545;
        }

        .delete_data:hover {
            background: #c82333;
        }
    </style>
</head>
<body>
<div class="content">
    <h2>Medicine List</h2>
    <div style="text-align:right;">
        <a href="<?php echo base_url();?>/medicine/medicine_form" class="new-btn">+ New Medicine</a>
    </div>
    <table id="myTable" class="display" style="width:100%">
        <thead>
            <tr>
                <th>Name</th>
                <th>Price</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($medicines as $value) { ?>
            <tr>
                <td><?php echo $value->name; ?></td>
                <td><?php echo $value->price; ?></td>
                <td>
                    <a href="<?php echo base_url();?>/medicine/get_stock_history/<?php echo $value->id; ?>" class="action-btn edit-btn">View</a>
                    <a href="<?php echo base_url();?>/medicine/medicine_edit_form/<?php echo $value->id; ?>" class="action-btn edit-btn">Edit</a>
                    <a href="<?php echo base_url();?>/medicine/remove_medicine/<?php echo $value->id; ?>" class="action-btn delete_data" >Delete</a>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</div>

</body>
</html>

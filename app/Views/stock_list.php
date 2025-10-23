<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Stock List</title>
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
            .btn-purchase {
        background: #28a745; /* Green for purchase */
    }
    .btn-purchase:hover {
        background: #218838;
    }

    .btn-sale {
        background: #dc3545; /* Red for sale */
    }
    .btn-sale:hover {
        background: #c82333;
    }


        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table th, table td {
            border: 1px solid #ddd;
            padding: 8px;
        }
        table th {
            background: #f4f4f4;
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
    <h2>Stock List</h2>
    <div style="text-align:right;">
    <a href="<?php echo base_url();?>/medicine/medicine_sale" class="new-btn btn-sale">- Sale Medicine</a>
    <a href="<?php echo base_url();?>/medicine/purchase_form" class="new-btn btn-purchase">+ New Purchase</a>
</div>
    <table id="myTable" class="display" style="width:100%">
        <thead>
            <tr>
                <th>Medicine Name</th>
                <th>Current Stock</th>
                <th>View History</th>
            </tr>
        </thead>
        <tbody>
        <?php if (!empty($stocks)) {
            foreach ($stocks as $stock) { ?>
                <tr>
                    <td><?php echo $stock->name; ?></td>
                    <td><?php echo $stock->currentStock; ?></td>
                    <td>
                      <a href="<?php echo base_url(); ?>/medicine/get_stock_history/<?php echo $stock->medicine_id;?>">
                      view
                    </a>
                    </td>
                </tr>
            <?php }
        } else { ?>
            <tr>
                <td colspan="2" style="text-align:center;">No stock available</td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</div>
</body>
</html>

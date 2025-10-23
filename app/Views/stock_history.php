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

        /* Medicine name style — medical term style */
        .medicine-name {
            display: inline-block;
            font-weight: bold;
            font-size: 18px;
            padding: 6px 12px;
            border-radius: 8px;
            background: linear-gradient(90deg, #e0f7fa, #b2ebf2);
            color: #00796b;
            box-shadow: 0 2px 5px rgba(0,0,0,0.2);
        }
    </style>
</head>
<body>

<div class="content">
    <h2>
      <div class="medicine-name"><?php echo $medicine->name; ?></div>
       stock details.
    </h2>
    <div style="text-align:right;">
      <a href="<?php echo base_url(); ?>/medicine/medicine_stock" class="btn btn-info">
        Stock List
      </a>
    </div>

  <table id="myTable" class="display" style="width:100%">
    <thead>
        <tr>
            <th>Date</th>
            <th>Total Purchase</th>
            <th>Total Sale</th>
            <th>Net Balance</th>
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($history)) {
            foreach ($history as $row) { ?>
                <tr>
                    <td><?= date("d-m-Y", strtotime($row->date)) ?></td>
                    <td><?= esc($row->total_purchase) ?></td>
                    <td><?= esc($row->total_sale) ?></td>
                    <td><?= esc($row->net_balance) ?></td>
                </tr>
        <?php } } else { ?>
            <tr><td colspan="4" style="text-align:center;">No history available</td></tr>
        <?php } ?>
    </tbody>
</table>

</div>
</body>
</html>

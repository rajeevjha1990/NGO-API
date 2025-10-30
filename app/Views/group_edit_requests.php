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
    <h2>Group Edit Requests</h2>
    <table id="myTable" class="display" style="width:100%">
        <thead>
            <tr>
                <th>Volunteer</th>
                <th>Groups</th>
                <th>Reason</th>
                <th>Permission</th>
            </tr>
        </thead>
        <tbody>
        <?php
            foreach ($groupeditrequests as $request) { ?>
                <tr>
                    <td><?php echo $request->volntr_name.$request->volntr_ep_temp; ?></td>
                    <td><?php echo $request->group_name; ?></td>
                    <td><?php echo $request->reason; ?></td>
                    <td>
                      <a class="btn btn-success approve_request" href="<?php echo base_url(); ?>/adminauth/permission_granted/<?php echo $request->id;?>/<?php echo $request->group_id; ?>">
                       Permission
                    </a>
                    </td>
                </tr>
                <?php } ?>
        </tbody>
    </table>
</div>
</body>
</html>

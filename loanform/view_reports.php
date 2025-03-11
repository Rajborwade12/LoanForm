<?php
include('db.php');

$result = $conn->query("SELECT * FROM loan_reports");
?>

<!DOCTYPE html>
<html lang="mr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Loan Reports</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #ffefd5;
        }

        .header {
            background-color: #2c3e50;
            color: white;
            padding: 15px;
            text-align: center;
            font-size: 24px;
            font-weight: bold;
            position: relative;
        }

        .header .buttons {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
        }

        .header .buttons a {
            text-decoration: none;
            color: white;
            background-color: #e74c3c;
            padding: 8px 15px;
            margin-left: 10px;
            border-radius: 5px;
            font-size: 14px;
        }

        .header .buttons a.dashboard {
            background-color: #3498db;
        }

        .container {
            width: 90%;
            max-width: 800px;
            margin: 30px auto;
            background: white;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        h2 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: white;
        }

        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background: #3498db;
            color: white;
            text-transform: uppercase;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        a.print-btn {
            text-decoration: none;
            color: white;
            background-color: #2ecc71;
            padding: 5px 10px;
            border-radius: 5px;
            font-size: 14px;
            transition: 0.3s;
        }

        a.print-btn:hover {
            background-color: #27ae60;
        }

        .footer {
            text-align: center;
            padding: 15px;
            background: #2c3e50;
            color: white;
            position: absolute;
            bottom: 0;
            width: 100%;
        }
    </style>
</head>
<body>

<div class="header">
    Shri Chhatrapati Rajarshi Shahu Urban Coop Bank Ltd Beed
    <div class="buttons">
        <a href="dashboard.php" class="dashboard">Dashboard</a>
        <a href="logout.php">Logout</a>
    </div>
</div>

<div class="container">
    <h2>Loan Reports</h2>
    <table>
        <tr>
            <th>Applicant Name</th>
            <th>Action</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()) { ?>
            <tr>
                <td><?php echo htmlspecialchars($row['applicant_name']); ?></td>
                <td><a href="print_view.php?id=<?php echo $row['id']; ?>" target="_blank" class="print-btn">Print View</a></td>
            </tr>
        <?php } ?>
    </table>
</div>

<div class="footer">
    &copy; <?php echo date("Y"); ?> SCRSUCB | All Rights Reserved 2025
</div>

</body>
</html>

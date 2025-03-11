<?php
include('db.php');

$result = $conn->query("SELECT * FROM loan_reports");

echo "<h2>Loan Reports</h2><table border='1'><tr><th>Applicant</th><th>Action</th></tr>";
while ($row = $result->fetch_assoc()) {
    echo "<tr><td>" . htmlspecialchars($row['applicant_name']) . "</td>";
    echo "<td><a href='print_view.php?id=" . $row['id'] . "' target='_blank'>Print View</a></td></tr>";
}
echo "</table>";
?>

<?php
include('db.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // File Upload Handling
    $uploadDir = "uploads/";
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    $mortgagePhotoPath = "";
    $businessOwnerPhotoPath = "";

    if (!empty($_FILES['mortgage_photo']['name'])) {
        $mortgagePhotoPath = $uploadDir . basename($_FILES['mortgage_photo']['name']);
        move_uploaded_file($_FILES['mortgage_photo']['tmp_name'], $mortgagePhotoPath);
    }

    if (!empty($_FILES['business_owner_photo']['name'])) {
        $businessOwnerPhotoPath = $uploadDir . basename($_FILES['business_owner_photo']['name']);
        move_uploaded_file($_FILES['business_owner_photo']['tmp_name'], $businessOwnerPhotoPath);
    }

    // Prepare SQL Statement
    $stmt = $conn->prepare("INSERT INTO loan_reports 
        (visit_date, applicant_name, firm_name, business_address, home_address, age, mobile, 
        bank_loans, total_outstanding, overdue, mortgage_property, owner_of_property, 
        gross_yearly_income, net_income, job_gross_payment, total_deduction, net_payment, 
        home_godown_rent, commercial_vehicle_income, income_from_farming, reason_of_loan, 
        loan_duration, own_capital, other_deduction, other_income, investment, business_place, 
        business_experience, bank_account, cibil_score, mortgage_photo, business_owner_photo) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

    $stmt->bind_param("sssssisddssdddddsssidsddddsissss",
        $_POST['visit_date'], $_POST['applicant_name'], $_POST['firm_name'],
        $_POST['business_address'], $_POST['home_address'], $_POST['age'], $_POST['mobile'],
        $_POST['bank_loans'], $_POST['total_outstanding'], $_POST['overdue'],
        $_POST['mortgage_property'], $_POST['owner_of_property'],
        $_POST['gross_yearly_income'], $_POST['net_income'], $_POST['job_gross_payment'],
        $_POST['total_deduction'], $_POST['net_payment'], $_POST['home_godown_rent'],
        $_POST['commercial_vehicle_income'], $_POST['income_from_farming'], $_POST['reason_of_loan'],
        $_POST['loan_duration'], $_POST['own_capital'], $_POST['other_deduction'],
        $_POST['other_income'], $_POST['investment'], $_POST['business_place'],
        $_POST['business_experience'], $_POST['bank_account'], $_POST['cibil_score'],
        $mortgagePhotoPath, $businessOwnerPhotoPath
    );

    if ($stmt->execute()) {
        echo "<div class='alert alert-success'>Form submitted successfully!</div>";
    } else {
        echo "<div class='alert alert-danger'>Error: " . $stmt->error . "</div>";
    }

    $stmt->close();
    $conn->close();
}
?>





<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Loan Visit Form</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-5">
    <h2 class="mb-4">Loan Visit Form</h2>
    <form action="submit.php" method="POST" enctype="multipart/form-data" class="card p-4">

        <!-- Date of Visit -->
        <label>Date of Visit:</label>
        <input type="date" name="visit_date" class="form-control" required>

        <!-- Applicant Name -->
        <label>Applicant Name:</label>
        <input type="text" name="applicant_name" class="form-control" required>

        <!-- Firm Name -->
        <label>Firm Name:</label>
        <input type="text" name="firm_name" class="form-control" required>

        <!-- Business Address -->
        <label>Business Address:</label>
        <textarea name="business_address" class="form-control" required></textarea>

        <!-- Home Address -->
        <label>Home Address:</label>
        <textarea name="home_address" class="form-control" required></textarea>

        <!-- Age & Mobile Number (Same Line) -->
        <div class="row">
            <div class="col-md-6">
                <label>Age:</label>
                <input type="number" name="age" class="form-control" required>
            </div>
            <div class="col-md-6">
                <label>Mobile Number:</label>
                <input type="text" name="mobile" class="form-control" required>
            </div>
        </div>

        <!-- Other Bank Loan, Total Outstanding, Overdue (Same Line) -->
        <div class="row">
            <div class="col-md-4">
                <label>Other Bank Loan (₹):</label>
                <input type="number" name="bank_loans" class="form-control">
            </div>
            <div class="col-md-4">
                <label>Total Outstanding (₹):</label>
                <input type="number" name="total_outstanding" class="form-control">
            </div>
            <div class="col-md-4">
                <label>Overdue (₹):</label>
                <input type="number" name="overdue" class="form-control">
            </div>
        </div>

        <!-- Mortgage Property & Owner of Property -->
        <label>Mortgage Property:</label>
        <select name="mortgage_property" class="form-control">
            <option value="Home">Home</option>
            <option value="NA Plot">NA Plot</option>
            <option value="Farm">Farm</option>
        </select>

        <label>Owner of Property:</label>
        <select name="owner_of_property" class="form-control">
            <option value="Borrower">Borrower</option>
            <option value="Guarantor">Guarantor</option>
        </select>

        <!-- Gross Yearly Income & Net Income (Same Line) -->
        <div class="row">
            <div class="col-md-6">
                <label>Gross Yearly Income (₹):</label>
                <input type="number" name="gross_yearly_income" class="form-control">
            </div>
            <div class="col-md-6">
                <label>Net Income (₹):</label>
                <input type="number" name="net_income" class="form-control">
            </div>
        </div>

        <!-- Job Holder Gross Payment, Total Deduction, Net Payment (Same Line) -->
        <div class="row">
            <div class="col-md-4">
                <label>Job Holder Gross Payment (₹):</label>
                <input type="number" name="job_gross_payment" class="form-control">
            </div>
            <div class="col-md-4">
                <label>Total Deduction (₹):</label>
                <input type="number" name="total_deduction" class="form-control">
            </div>
            <div class="col-md-4">
                <label>Net Payment (₹):</label>
                <input type="number" name="net_payment" class="form-control">
            </div>
        </div>

        <!-- Other Income Sources -->
        <label>Other Income Sources:</label>
        <div class="row">
            <div class="col-md-4">
                <input type="number" name="home_godown_rent" class="form-control" placeholder="Home/Godown Rent (₹)">
            </div>
            <div class="col-md-4">
                <input type="number" name="commercial_vehicle_income" class="form-control" placeholder="Commercial Vehicle Income (₹)">
            </div>
            <div class="col-md-4">
                <input type="number" name="income_from_farming" class="form-control" placeholder="Income from Farming (₹)">
            </div>
        </div>

        <!-- Reason of Loan -->
        <label>Reason of Loan:</label>
        <textarea name="reason_of_loan" class="form-control" required></textarea>

        <!-- Loan Duration -->
        <label>Loan Duration (Years):</label>
        <input type="number" name="loan_duration" class="form-control">

        <!-- Own Capital -->
        <label>Own Capital (₹):</label>
        <input type="number" name="own_capital" class="form-control">

        <!-- Other Deduction -->
        <label>Other Deduction (₹):</label>
        <input type="number" name="other_deduction" class="form-control">

        <!-- Other Income -->
        <label>Other Income (₹):</label>
        <input type="number" name="other_income" class="form-control">

        <!-- Investment -->
        <label>Investment (₹):</label>
        <input type="number" name="investment" class="form-control">

        <!-- Business Place -->
        <label>Business Place:</label>
        <select name="business_place" class="form-control">
            <option value="Self">Self</option>
            <option value="On Rent">On Rent</option>
        </select>

        <!-- Business Experience -->
        <label>Business Experience (Years):</label>
        <input type="number" name="business_experience" class="form-control">

        <!-- Bank Account -->
        <label>Bank Account:</label>
        <input type="text" name="bank_account" class="form-control">

        <!-- CIBIL Score -->
        <label>CIBIL Score:</label>
        <input type="number" name="cibil_score" class="form-control">

        <!-- Mortgage Photo & Business Owner Photo -->
        <label>Mortgage Photo:</label>
        <input type="file" name="mortgage_photo" class="form-control">

        <label>Business Owner Photo:</label>
        <input type="file" name="business_owner_photo" class="form-control">

       Submit Button  <button type="submit" class="btn btn-primary mt-3">Submit</button>

<form action="submit.php" method="POST" enctype="multipart/form-data" class="card p-4">


    </form>
</div>

</body>
</html>

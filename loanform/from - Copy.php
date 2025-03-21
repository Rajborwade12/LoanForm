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
        (branch, visitor_name, visit_date, applicant_name, firm_name, business_address, home_address, age, mobile, bank_loans, total_dues, overdue, collateral, collateral_owner, annual_gross_income, annual_net_income, job_gross_salary, house_rent, vehicle_income, farming_income, loan_purpose, loan_duration, own_capital, bank_account, cibil_score, mortgage_details, owner_of_business, income_source, business_place, mortgage_photo, business_owner_photo) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

    $stmt->bind_param("ssssssssssssssssssssssssssss",
        $_POST['branch'], $_POST['visitor_name'], $_POST['visit_date'], $_POST['applicant_name'],
        $_POST['firm_name'], $_POST['business_address'], $_POST['home_address'], $_POST['age'],
        $_POST['mobile'], $_POST['bank_loans'], $_POST['total_dues'], $_POST['overdue'],
        $_POST['collateral'], $_POST['collateral_owner'], $_POST['annual_gross_income'],
        $_POST['annual_net_income'], $_POST['job_gross_salary'], $_POST['house_rent'],
        $_POST['vehicle_income'], $_POST['farming_income'], $_POST['loan_purpose'],
        $_POST['loan_duration'], $_POST['own_capital'], $_POST['bank_account'], $_POST['cibil_score'],
        $_POST['mortgage_details'], $_POST['owner_of_business'], $_POST['income_source'], $_POST['business_place'],
        $mortgagePhotoPath, $businessOwnerPhotoPath
    );

    if ($stmt->execute()) {
        echo "Form submitted successfully!";
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

<form method="POST" enctype="multipart/form-data">
    Branch: <input type="text" name="branch" required><br>
    Visitor Name: <input type="text" name="visitor_name" required><br>
    Visit Date: <input type="date" name="visit_date" required><br>
    Applicant Name: <input type="text" name="applicant_name" required><br>
    Firm Name: <input type="text" name="firm_name" required><br>
    Business Address: <textarea name="business_address"></textarea><br>
    Home Address: <textarea name="home_address"></textarea><br>
    Age: <input type="number" name="age" required><br>
    Mobile: <input type="text" name="mobile" required><br>
    Bank Loans (₹): <input type="number" name="bank_loans"><br>
    Total Dues (₹): <input type="number" name="total_dues"><br>
    Overdue (₹): <input type="number" name="overdue"><br>
    Collateral: <input type="text" name="collateral"><br>
    Collateral Owner: <input type="text" name="collateral_owner"><br>
    Annual Gross Income (₹): <input type="number" name="annual_gross_income"><br>
    Annual Net Income (₹): <input type="number" name="annual_net_income"><br>
    Job Gross Salary (₹): <input type="number" name="job_gross_salary"><br>
    House Rent (₹): <input type="number" name="house_rent"><br>
    Vehicle Income (₹): <input type="number" name="vehicle_income"><br>
    Farming Income (₹): <input type="number" name="farming_income"><br>
    Loan Purpose: <input type="text" name="loan_purpose"><br>
    Loan Duration (years): <input type="number" name="loan_duration"><br>
    Own Capital (₹): <input type="number" name="own_capital"><br>
    Bank Account: <input type="text" name="bank_account"><br>
    CIBIL Score: <input type="number" name="cibil_score"><br>

    <!-- New Dropdown Fields -->
    Mortgage Details: 
    <select name="mortgage_details">
        <option value="Home">Home</option>
        <option value="NA Plot">NA Plot</option>
        <option value="Farm">Farm</option>
    </select><br>

    Owner of Business:
    <select name="owner_of_business">
        <option value="Borrower">Borrower</option>
        <option value="Guarantor">Guarantor</option>
    </select><br>

    Income Source:
    <select name="income_source">
        <option value="Home/Godown Rent">Home/Godown Rent</option>
        <option value="Business Vehicle Income">Business Vehicle Income</option>
        <option value="Income from Farming">Income from Farming</option>
    </select><br>

    Business Place:
    <select name="business_place">
        <option value="Self">Self</option>
        <option value="On Rent">On Rent</option>
    </select><br>

    <!-- File Upload Fields -->
    Mortgage Photo: <input type="file" name="mortgage_photo"><br>
    Business Owner Photo with Shop: <input type="file" name="business_owner_photo"><br>

    <button type="submit">Submit</button>
</form>

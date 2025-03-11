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

    // Sanitize Inputs & Ensure All Fields Exist
    $fields = [
        'visit_date', 'applicant_name', 'firm_name', 'business_address', 'home_address',
        'age', 'mobile', 'bank_loans', 'total_outstanding', 'overdue',
        'mortgage_property', 'owner_of_property', 'gross_yearly_income', 'net_income',
        'job_gross_payment', 'total_deduction', 'net_payment', 'home_godown_rent',
        'commercial_vehicle_income', 'income_from_farming', 'reason_of_loan', 'loan_duration',
        'own_capital', 'other_deduction', 'other_income', 'investment', 'business_place',
        'business_experience', 'bank_account', 'cibil_score'
    ];

    // Default Values for Missing Fields
    $data = [];
    foreach ($fields as $field) {
        $data[] = isset($_POST[$field]) ? $_POST[$field] : "";
    }

    // Append File Paths
    $data[] = $mortgagePhotoPath;
    $data[] = $businessOwnerPhotoPath;

    // Prepare SQL Statement
    $stmt = $conn->prepare("INSERT INTO loan_reports 
        (visit_date, applicant_name, firm_name, business_address, home_address, age, mobile, 
        bank_loans, total_outstanding, overdue, mortgage_property, owner_of_property, 
        gross_yearly_income, net_income, job_gross_payment, total_deduction, net_payment, 
        home_godown_rent, commercial_vehicle_income, income_from_farming, reason_of_loan, 
        loan_duration, own_capital, other_deduction, other_income, investment, business_place, 
        business_experience, bank_account, cibil_score, mortgage_photo, business_owner_photo) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

    // Bind Parameters
    $stmt->bind_param("sssssisddssdddddsssidsddddsissss",
        ...$data
    );

    if ($stmt->execute()) {
        // Show a JavaScript alert and redirect to dashboard.php
        echo "<script>
            alert('✅ Form submitted successfully!');
            window.location.href = 'dashboard.php';
        </script>";
    } else {
        echo "<script>
            alert('❌ Error: " . $stmt->error . "');
        </script>";
    }

    $stmt->close();
    $conn->close();
}
?>

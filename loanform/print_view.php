<?php
include('db.php');

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("Invalid request.");
}

$id = intval($_GET['id']); // Ensure ID is an integer
$stmt = $conn->prepare("SELECT * FROM loan_reports WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$data = $result->fetch_assoc();

if (!$data) {
    die("Record not found.");
}
?>

<!DOCTYPE html>
<html lang="mr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Print Form</title>
    <style>
        body { font-family: Arial, sans-serif; padding: 20px; }
        .container { width: 80%; margin: auto; border: 1px solid #ccc; padding: 20px; }
        h2 { text-align: center; }
        .field { margin-bottom: 10px; font-size: 18px; }
        .label { font-weight: bold; }
        .dotted-line { border-bottom: 1px dotted #000; width: 60%; display: inline-block; }
        .print-btn { display: block; text-align: center; margin-top: 20px; }
        img { max-width: 100%; height: auto; margin-top: 10px; }
    </style>
</head>
<body>

<div class="container">
    <h2>Loan Application Details</h2>




    
    <div class="field"><span class="label">📅 भेटीची तारीख:</span> <span class="dotted-line"><?php echo htmlspecialchars($data['visit_date']); ?></span></div>
    <div class="field"><span class="label">👤 अर्जदाराचे नाव:</span> <span class="dotted-line"><?php echo htmlspecialchars($data['applicant_name']); ?></span></div>
    <div class="field"><span class="label">🏢 फर्मचे नाव:</span> <span class="dotted-line"><?php echo htmlspecialchars($data['firm_name']); ?></span></div>
    <div class="field"><span class="label">📍 व्यवसायाचा पत्ता:</span> <span class="dotted-line"><?php echo htmlspecialchars($data['business_address']); ?></span></div>
    <div class="field"><span class="label">🏡 घरचा पत्ता:</span> <span class="dotted-line"><?php echo htmlspecialchars($data['home_address']); ?></span></div>
    <div class="field"><span class="label">🎂 वय:</span> <span class="dotted-line"><?php echo htmlspecialchars($data['age']); ?> वर्ष</span></div>
    <div class="field"><span class="label">📞 मोबाईल क्रमांक:</span> <span class="dotted-line"><?php echo htmlspecialchars($data['mobile']); ?></span></div>

    <h3>आर्थिक माहिती</h3>
    <div class="field"><span class="label">🏦 इतर बँकेतील कर्ज:</span> <span class="dotted-line">₹<?php echo htmlspecialchars($data['bank_loans']); ?></span></div>
    <div class="field"><span class="label">📊 एकूण येणे बाकी:</span> <span class="dotted-line">₹<?php echo htmlspecialchars($data['total_outstanding']); ?></span></div>
    <div class="field"><span class="label">⏳ पैकी थकबाकी:</span> <span class="dotted-line">₹<?php echo htmlspecialchars($data['overdue']); ?></span></div>

    <h3>तारण मालमत्ता</h3>
   <div class="field"><span class="label">🏠 मालमत्ता प्रकार:</span> <span class="dotted-line"><?php echo htmlspecialchars($data['mortgage_property']); ?></span></div>
    <div class="field"><span class="label">📝 मालमत्ता कोणाच्या नावावर:</span> <span class="dotted-line"><?php echo htmlspecialchars($data['owner_of_property']); ?></span></div>

    <h3>उत्पन्न आणि खर्च</h3>
 <div class="field"><span class="label">💰 व्यवसायाचे वार्षिक उत्पन्न:</span> <span class="dotted-line">₹<?php echo htmlspecialchars($data['gross_yearly_income']); ?></span></div>
    <div class="field"><span class="label">💰 नेट उत्पन्न:</span> <span class="dotted-line">₹<?php echo htmlspecialchars($data['net_income']); ?></span></div>
  <div class="field"><span class="label">💼 नोकरीधारक उत्पन्न:</span> <span class="dotted-line">₹<?php echo htmlspecialchars($data['job_gross_payment']); ?></span></div>
    <div class="field"><span class="label">📉 एकूण कपात:</span> <span class="dotted-line">₹<?php echo htmlspecialchars($data['total_deduction']); ?></span></div>
    <div class="field"><span class="label">💵 निव्वळ वेतन:</span> <span class="dotted-line">₹<?php echo htmlspecialchars($data['net_payment']); ?></span></div>
  <div class="field"><span class="label">🏠 घर/गोदाम भाडे उत्पन्न:</span> <span class="dotted-line">₹<?php echo htmlspecialchars($data['home_godown_rent']); ?></span></div>
  <div class="field"><span class="label">🚛 व्यावसायिक वाहन उत्पन्न:</span> <span class="dotted-line">₹<?php echo htmlspecialchars($data['commercial_vehicle_income']); ?></span></div>
 <div class="field"><span class="label">🌾 शेती उत्पन्न:</span> <span class="dotted-line">₹<?php echo htmlspecialchars($data['income_from_farming']); ?></span></div>

    <h3>कर्जाची माहिती</h3>
    <div class="field"><span class="label">❓ कर्जाचा हेतू:</span> <span class="dotted-line"><?php echo htmlspecialchars($data['reason_of_loan']); ?></span></div>
    <div class="field"><span class="label">⏳ कर्जाची मुदत:</span> <span class="dotted-line"><?php echo htmlspecialchars($data['loan_duration']); ?></span></div>
    <div class="field"><span class="label">💵 स्वतःचे भांडवल:</span> <span class="dotted-line">₹<?php echo htmlspecialchars($data['own_capital']); ?></span></div>

<div class="field"><span class="label">📉 इतर कपात:</span> <span class="dotted-line">₹<?php echo htmlspecialchars($data['other_deduction']); ?></span></div>
<div class="field"><span class="label">💰 इतर उत्पन्न:</span> <span class="dotted-line">₹<?php echo htmlspecialchars($data['other_income']); ?></span></div>
<div class="field"><span class="label">📈 गुंतवणूक:</span> <span class="dotted-line">₹<?php echo htmlspecialchars($data['investment']); ?></span></div>
    <h3>इतर माहिती</h3>
    <div class="field"><span class="label">🏠 व्यवसायाचे ठिकाण:</span> <span class="dotted-line"><?php echo htmlspecialchars($data['business_place']); ?></span></div>
    <div class="field"><span class="label">⌛ व्यवसायाचा अनुभव:</span> <span class="dotted-line"><?php echo htmlspecialchars($data['business_experience']); ?> वर्षे</span></div>
    <div class="field"><span class="label">🏦 बँकेचे नाव:</span> <span class="dotted-line"><?php echo htmlspecialchars($data['bank_account']); ?></span></div>
    <div class="field"><span class="label">💳 CIBIL स्कोर:</span> <span class="dotted-line"><?php echo htmlspecialchars($data['cibil_score']); ?></span></div>

   <h3>फोटो</h3>
    <div class="field">
        <span class="label">🏠 तारण मालमत्तेचा फोटो:</span><br>
        <?php
        $mortgage_photo = isset($data['mortgage_photo']) ? $data['mortgage_photo'] : '';
        if (!empty($mortgage_photo) && file_exists($mortgage_photo)) {
            echo '<img src="' . htmlspecialchars($mortgage_photo) . '" alt="तारण मालमत्तेचा फोटो">';
        } else {
            echo '<img src="default-mortgage.jpg" alt="तारण मालमत्तेचा फोटो">';
        }
        ?>
    </div>

<div class="field">
    <span class="label">👤 व्यवसाय मालकाचा फोटो:</span><br>
    <?php
    // Fetch the image path from database correctly
    $business_owner_photo = isset($data['business_owner_photo']) ? trim($data['business_owner_photo']) : '';

    // Check if the file path is valid and exists
    if (!empty($business_owner_photo) && file_exists($business_owner_photo)) {
        echo '<img src="' . htmlspecialchars($business_owner_photo) . '" alt="व्यवसाय मालकाचा फोटो">';
    } else {
        echo '<img src="default-owner.jpg" alt="व्यवसाय मालकाचा फोटो">';
    }
    ?>
</div>


    <button class="print-btn" onclick="window.print()">Print</button>
</div>

</body>
</html>

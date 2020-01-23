<?php
include 'config.php';

$post_action = isset($_POST['export-csv']) && ! empty($_POST['export-csv']) ? $_POST['export-csv'] : null;
if ( !is_null($post_action) ) {
    $start_date = !empty($_POST['start_date']) ? $_POST['start_date'] : null;
    $end_date = !empty($_POST['end']) ? $_POST['end'] : null;
}
// var_dump($start_date);

$dsn = 'mysql:host=' . HOST . ';dbname=' . DB;
$pdo = new PDO($dsn, USER, PASS);

$result = $pdo->prepare("SELECT * FROM users WHERE date_submitted BETWEEN '" . $start_date  . "' and '" . $end_date  . "'");
$result->execute();
$query = $result->fetchAll(PDO::FETCH_ASSOC);

$delimiter = ",";
$filename = "user_" . date('Y-m-d') . ".csv";

$f = fopen('php://memory', 'w');

$fields = array('ID', 'Name', 'Email', 'Phone No', 'Receipt Numbers', 'Receipt Images', 'Date Submitted');
fputcsv($f, $fields, $delimiter);

foreach ($query as $key => $row) {
    $receipt_images = explode(',', $row['receipt_images']);
    $final_receipt_images = '';

    foreach ($receipt_images as $name) {
        $final_receipt_images .= $name . ', ';
    }
    $final_receipt_images = rtrim($final_receipt_images, ', ');

    $lineData = array($row['id'], $row['first_name'] . '  ' . $row['last_name'], $row['email'], $row['phone_no'], $row['receipt_numbers'], $final_receipt_images, $row['date_submitted']);
    fputcsv($f, $lineData, $delimiter);
}

fseek($f, 0);

header('Content-Type: text/csv');
header('Content-Disposition: attachment; filename="' . $filename . '";');

fpassthru($f);

exit;
?>
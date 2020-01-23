<?php
require('./config.php');
$post_action = isset($_POST['action']) && ! empty($_POST['action']) ? $_POST['action'] : null;

if ($post_action) {
  $valid = array();
  $receipt_array = array();
  $receipt_pic_array = array();

  $first_name = !empty($_POST['first_name']) ? $_POST['first_name'] : null;
  $last_name = !empty($_POST['last_name']) ? $_POST['last_name'] : null;
  $phone_no = !empty($_POST['phone_no']) ? $_POST['phone_no'] : null;
  $email = !empty($_POST['email']) ? trim($_POST['email']) : null;

  $date_submitted = date('Y-m-d');

  if (!empty($_POST['receipt_no_1'])) {
    foreach (array_keys($_POST) as $field) {
      if (strpos($field, 'receipt_no' ) !== false) {
        array_push($receipt_array, $_POST[$field]);
      }
    }
  }

  if (!empty($_FILES['receipt_pic_1'])) {
    foreach (array_keys($_FILES) as $field) {
      array_push($receipt_pic_array, $_FILES[$field]['name']);
    }
  }

  if (!receipt_validate($receipt_array)) {
    $new_receipt_pics = upload_receipt($receipt_pic_array);

    if (count($receipt_pic_array) > 0) {
      add_data($first_name, $last_name, $phone_no, $email, $receipt_array, $new_receipt_pics, $date_submitted);
    }
    
  }
}

function receipt_validate($receipt_array) {
  $is_error = false;
  for ($i = 1; $i <= count($receipt_array); $i++) {
    $_POST['receipt_error_' . $i] = $is_error;
  }

  $dsn = 'mysql:host=' . HOST . ';dbname=' . DB;
  $pdo = new PDO($dsn, USER, PASS);

  $receipt_numbers = $pdo->prepare("SELECT receipt_numbers FROM users");
  $receipt_numbers->execute();
  $query_receipt_numbers = $receipt_numbers->fetchAll(PDO::FETCH_ASSOC);

  foreach ($query_receipt_numbers as $key => $row) {
    $receipt_numbers = explode(',', $row['receipt_numbers']);

    foreach ($receipt_numbers as $number) {
      if (in_array($number, $receipt_array)) {
        $is_error = true;

        $key = array_search($number, $receipt_array) + 1;
        $_POST['receipt_error_' . $key] = $is_error;
      }
    }
  }

  $_POST['receipt_count'] = count($receipt_array);
  return $is_error;
}


function randomString() { 
    $characters = '0123456789abcdefghijklmnopqrstuvwxyz'; 
    $randomString = ''; 
  
    for ($i = 0; $i < 6; $i++) { 
        $index = rand(0, strlen($characters) - 1); 
        $randomString .= $characters[$index]; 
    } 
  
    return $randomString; 
}  

function upload_receipt($receipt_pic_array) {
  $folder = "/luminous630/uploads/"; 
  $new_receipt_array = array();

  for ($i = 1; $i <= count($receipt_pic_array); $i++) {
    $tmp_path = $_FILES['receipt_pic_' . $i]['tmp_name'];
    $file_name = randomString() . '_' . basename($_FILES['receipt_pic_' . $i]['name']);

    var_dump($file_name);

    $path = $_SERVER['DOCUMENT_ROOT'] . $folder . $file_name;
    if (move_uploaded_file($tmp_path, $path)) {
      array_push($new_receipt_array, $file_name);
    }
    else {
      echo "upload file failed";
    }
  }

  return $new_receipt_array;
}

function add_data($first_name, $last_name, $phone_no, $email, $receipt_array, $receipt_pic_array, $date_submitted) {
  $receipt_no = count($receipt_array);

  if ($receipt_no === 0)
    $receipt_numbers = '';
  else if ($receipt_no === 1)
    $receipt_numbers = $receipt_array[0];
  else
    $receipt_numbers = implode(",", $receipt_array);

  $receipt_pic = count($receipt_pic_array);

  if ($receipt_pic === 0)
    $receipt_images = '';
  else if ($receipt_pic === 1)
    $receipt_images = $receipt_pic_array[0];
  else
    $receipt_images = implode(",", $receipt_pic_array);

  $data = array( 
    'first_name' => $first_name,
    'last_name' => $last_name,
    'phone_no' => $phone_no,
    'email' => $email,
    'receipt_numbers' => $receipt_numbers,
    'receipt_images' => $receipt_images,
    'date_submitted' => $date_submitted
  );

  $dsn = 'mysql:host=' . HOST . ';dbname=' . DB;
  $pdo = new PDO($dsn, USER, PASS);

  $result = $pdo->prepare("INSERT INTO users (first_name, last_name, phone_no, email, receipt_numbers, receipt_images, date_submitted) 
  value (:first_name, :last_name, :phone_no, :email, :receipt_numbers, :receipt_images, :date_submitted)");

  $result->execute($data);

  if ($result) {
    header('Location: ./thank-you.php');
  }
}
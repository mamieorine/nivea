<?php
include 'config.php';

$password = '!9jqooj@iw2';
if ($_GET["pw"] !== $password) {
    return header('Location: ./');
}

$dsn = 'mysql:host=' . HOST . ';dbname=' . DB;
$pdo = new PDO($dsn, USER, PASS);
$stmt = $pdo->prepare('SELECT * from users ORDER BY id ASC');
$stmt->execute();
$query = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=2.0, user-scalable=yes">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.css"></link>
  <link rel="stylesheet" href="./style.css">
  <title>Nivea</title>
</head>
<body class="data-page">
    <header>
        <div class="container">
        <div class="row">
            <div class="col">
            <a href="/luminous630/"><img src="./images/logo.png" alt="nivea" class="logo"></a>
            </div>
        </div>
        </div>
    </header>

    <main class="data">
    <div class="container">
        <!-- choose date and export -->
        <div class="export">
        <form method="post" action="export-data.php" id="csv-form" enctype="multipart/form-data" class="d-flex align-items-center">
            <label for="start-date">Start date: </label> <input type="date" name="start_date" id="start-date" class="form-control"> 
            <label for="end-date"> End date: </label> <input type="date" name="end" id="end-date" class="form-control">
            <input type="submit" name="export-csv" value="Export Data" class="btn btn-primary" />
        </form>
        </div>

        <!-- Bootstrab table -->
        <h1 class="font-28 text-center mb-3">ตารางข้อมูลทั้งหมด</h1>
        <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Date</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Phone Number</th>
                    <th scope="col">Receipt Numbers</th>
                    <th scope="col">Receipt Images</th>
                </tr>
            </thead>
            <tbody>
                    <?php 
                    foreach ($query as $key => $row) {
                        $receipt_numbers = explode(',', $row['receipt_numbers']);
                        $final_receipt_numbers = '';
                        foreach ($receipt_numbers as $name) {
                            $final_receipt_numbers .= $name . ', ';
                        }
                        $final_receipt_numbers = rtrim($final_receipt_numbers, ', ');

                        $receipt_images = explode(',', $row['receipt_images']);
                        $final_receipt_images = '';
                        foreach ($receipt_images as $name) {
                            $final_receipt_images .= '<a href="uploads/' . $name . '" target="_blank">' . $name . '</a><br>';
                        }

                        echo '<tr>';
                        echo '<td>' . $row['id'] . '</td>';
                        echo '<td>' . $row['date_submitted'] . '</td>';
                        echo '<td>' . $row['first_name'] . '  ' . $row['last_name'] . '</td>';
                        echo '<td>' . $row['email'] . '</td>';
                        echo '<td>' . $row['phone_no'] . '</td>';
                        echo '<td>' . $final_receipt_numbers . '</td>';
                        echo '<td>' . $final_receipt_images . '</td>';
                        echo '</tr>';
                    }
                    ?>
                </tbody>
            </table>
        </div>

    </div>
    </main>

  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  <script src="./script.js"></script>
</body>
</html>

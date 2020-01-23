<?php 
require('./action.php');
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
<body>
  <header>
    <div class="container">
      <div class="row">
        <div class="col">
          <a href="/luminous630/"><img src="./images/logo.png" alt="nivea" class="logo"></a>
        </div>
      </div>
    </div>
  </header>

  <main>
    <div class="container banner">
      <img src="./images/banner_desktop_new.jpg" alt="nivea promotion" class="desktop">
      <img src="./images/banner_mobile_new.jpg" alt="nivea promotion" class="mobile">
    </div>

    <div class="container">
      <div class="detail">
        <h1 class="font-28 mb-1"><strong>ช้อป นีเวีย ลูมินัส 630 แจกจริงของรางวัลทุกอาทิตย์</strong></h1>
        <p class="font-18 mb-2">โบกมือลาฝ้าแดด พร้อมลุ้นรางวัลทุกอาทิตย์ เมื่อช้อปกลุ่มผลิตภัณฑ์ นีเวีย ลูมินัส 630 ใดก็ได้ 1 ชิ้น
        ไม่ว่าจะเป็น นีเวีย ลูมินัส 630 สปอตเคลียร์ ทรีตเมนต์ หรือ นีเวีย ลูมินัส 630 สปอตเคลียร์ ซันโพรเทค หรือ
        นีเวีย ลูมินัส 630 สปอตเคลียร์ ทรีตเมนต์และซันโพรเทค แพ็คคู่ ที่ร้านวัตสัน แล้วถ่ายรูปใบเสร็จรับเงิน
        เพื่อร่วมกิจกรรมลุ้นรับของรางวัลประจำสัปดาห์ โดย 1 ใบเสร็จ ต่อ 1 สิทธิ์ในการลุ้นรับของรางวัล</p>

        <h3 class="font-20 primary-color">ตั้งแต่วันที่ 23 ม.ค. 63 – 30 เม.ย. 63</h3>

        <form method="post" action="index.php?#row-receipt" id="nivea-form" enctype="multipart/form-data">
          <input type="text" name="first_name" placeholder="ชื่อจริง" class="form-control" value="<?php if (isset($_POST['first_name'])) echo $_POST['first_name']; ?>" required />
          <input type="text" name="last_name" placeholder="นามสกุล" class="form-control" value="<?php if (isset($_POST['last_name'])) echo $_POST['last_name']; ?>" required />
          <input type="text" name="phone_no" placeholder="เบอร์โทรศัพท์" class="form-control" value="<?php if (isset($_POST['phone_no'])) echo $_POST['phone_no']; ?>" required />
          <input type="email" name="email" placeholder="อีเมล์" class="form-control" value="<?php if (isset($_POST['email'])) echo $_POST['email']; ?>" required />
          <div class="example-receipt">
            <h2 class="font-20 mt-3">อัพโหลดใบเสร็จเพื่อร่วมกิจกรรม โดยกรอกหมายเลขใบเสร็จรับเงินแล้วกดอัพโหลดรูปใบเสร็จเพื่อร่วมกิจกรรม<h2>
            <h2 class="font-20"><strong>ตัวอย่างใบเสร็จที่ถูกต้อง</strong><h2>
            <img src="./images/receipt_ipad.jpg" class="receipt-ipad">
            <img src="./images/receipt_mobile.jpg" class="receipt-mobile">
          </div>
          <div id="row-receipt"></div>
          <div class="row-receipt">
            <?php 
              if ($_POST['receipt_error_1']) {
                echo '<span class="error"><strong>This receipt number already been used</strong></span>';
              } 
            ?>
            <input type="text" name="receipt_no_1" placeholder="กรอกหมายเลขใบเสร็จรับเงิน" pattern="[A-Za-z0-9#]+" title="Letters and numbers only" class="form-control receipt" required />
            <label for="receipt_pic_1">Upload</label> <span class="file_name">No file choosen</span>
            <input type="file" name="receipt_pic_1" id="receipt_pic_1" accept="image/*" class="form-control file" required />

            <span class="close hide">X</span>
          </div>
          <?php
              if ($_POST['receipt_count']) {
                for ($i = 2; $i <= $_POST['receipt_count']; $i++) {
                  echo '<div class="row-receipt">';
                  if (($_POST['receipt_error_' . $i])) { 
                    echo '<span class="error"><strong>This receipt number already been used</strong></span>';
                  }
                  echo '<input type="text" name="receipt_no_' . $i . '" placeholder="กรอกหมายเลขใบเสร็จรับเงิน" class="form-control receipt" required />';
                  echo '<label for="receipt_pic_' . $i . '">Upload</label><span class="file_name">No file choosen</span>';
                  echo '<input type="file" name="receipt_pic_' . $i . '" id="receipt_pic_' . $i . '" accept="image/*" class="form-control file" required />';
                  echo '<span class="close hide">X</span></div>';
                }
              }
          ?>
          <a id="add-more">Add More <span>+</span></a>
          <div class="conditions">
            <a class="conditions-toggle" data-toggle="collapse" href="#conditions" role="button" aria-expanded="false" aria-controls="conditions">
            เงื่อนไขการร่วมกิจกรรม <i class="fas fa-chevron-down"></i>
            </a>
            <div class="collapse" id="conditions">
              <div class="card card-body">
                <ol>
                  <li>ลูกค้าที่ซื้อสินค้า กลุ่มผลิตภัณฑ์ นีเวีย ลูมินัส 630 ใดก็ได้ 1 ชิ้นขึ้นไปที่ร้านวัตสัน (ทุกสาขา) ต่อ 1
                    ใบเสร็จ สามารถร่วมรายการได้โดย ส่งภาพใบเสร็จรับเงินที่ซื้อผลิตภัณฑ์ นีเวีย ลูมินัส 630 มาทาง
                    LINE OFFICIAL ACOUNT @NIVEAThailand โดยคลิกแอดไลน์
                    แล้วไปที่เมนูลงทะเบียนเพื่อร่วมกิจกรรม ส่งภาพใบเสร็จ
                    พร้อมกรอกรายละเอียดในฟอร์มที่กำหนดให้ครบถ้วน โดย 1 ใบเสร็จ ถือเป็น 1 สิทธิ์ในการลุ้นรางวัล
                    เมื่อครบระยะเวลาร่วมรายการที่กำหนดในการจับรางวัลแต่ละครั้ง บริษัทฯ
                    จะดึงข้อมูลออกจากฐานข้อมูลคอมพิวเตอร์ นำมาจัดพิมพ์หมายเลขโทรศัพท์
                    และเลขที่ใบเสร็จรับเงินของผู้ร่วมรายการ ตัดเป็นชิ้นส่วน
                    นำมาจับรางวัลหาผู้โชคดีตามวันและเวลาที่กำหนดต่อไป</li>
                    <li>ระยะเวลาในการร่วมกิจกรรม ตั้งแต่วันที่ 23 มกราคม 2563 เวลา 00.00 น. ถึงวันที่ 30 เมษายน 2563 เวลา 23.59 น.</li>
                    <li>กำหนดจับรางวัล 7 ครั้ง โดยทำการจับรางวัลแต่ละครั้ง ณ บริษัท ลัคกี้วันกรุ๊ป จำกัด เลขที่ 3/16
                    ถนนสนามบินน้ำ ตำบลท่าทราย อำเภอเมือง นนทบุรี 11000
                    <ol>
                        <li>
                          <strong>ครั้งที่ 1)</strong> เริ่มรายการตั้งแต่วันที่ 23 มกราคม 2563 เวลา 00.00 น. ถึงวันที่ 31 มกราคม  2563 เวลา 23.59 น. กำหนดจับรางวัล วันที่ 2 กุมภาพันธ์ 2563 เวลา 14.00 น.  และประกาศผลผ่านทาง Facebook/NIVEAThailand  และ Line official Home @NIVEA Thailand  ในวันที่ 4 กุมภาพันธ์ 2563 เวลา 10.00 น. รายละเอียดของรางวัลได้แก่ 
                          <br><strong>รางวัลที่ 1</strong>
                          <ol>
                            <li>เครื่องเป่าผม ยี่ห้อ Dyson รุ่น Dyson Supersonic™ hair dryer (Fuchsia)  มูลค่า 14,500 บาท จำนวน  1 รางวัล </li>
                            <li>เครื่องนวดหน้า FOREO รุ่น Luna™ Go For Normal Skin  มูลค่า 3780 บาท  จำนวน 1 รางวัล</li>
                          </ol>

                          <strong>รางวัลที่ 2</strong>
                          <ol>
                            <li>ผลิตภัณฑ์ นีเวีย  ลูมินัส 630 สปอตเคลียร์ ทรีทเมนต์ ขนาด 30 มล. มูลค่า 950 บาท จำนวน 20 รางวัล</li>
                          </ol>
                        </li>
                        <li>
                          <strong>ครั้งที่ 2)</strong> เริ่มรายการตั้งแต่วันที่ 1 กุมภาพันธ์ 2563 เวลา 00.00 น. ถึงวันที่ 15 กุมภาพันธ์  2563 เวลา 23.59 น. กำหนดจับรางวัล วันที่ 17 กุมภาพันธ์ 2563 เวลา 14.00 น. และประกาศผลผ่านทาง Facebook/NIVEAThailand  และ Line official Home @NIVEAThailand  ในวันที่ 19 กุมภาพันธ์ 2563 เวลา 10.00น. รายละเอียดของรางวัล ได้แก่
                          <br><strong>รางวัลที่ 1</strong>
                          <ol>
                            <li>เครื่องนวดหน้า FOREO รุ่น Luna™ Go For Normal Skin  มูลค่า 3780 บาท จำนวน 1 รางวัล</li>
                            <li>เครื่องทำกาแฟ ยี่ห้อ Nespresso รุ่น Pixie Electric สีบรอนซ์เงิน (รุ่นปรับปรุง) มูลค่า 6500 บาท จำนวน 1 รางวัล</li>
                          </ol>

                          <strong>รางวัลที่ 2</strong>
                          <ol>
                            <li>ผลิตภัณฑ์ นีเวีย  ลูมินัส 630 สปอตเคลียร์ ทรีทเมนต์ ขนาด 30 มล. มูลค่า 950 บาท จำนวน 20 รางวัล</li>
                          </ol>
                        </li>
                        <li>
                          <strong>ครั้งที่ 3)</strong>เริ่มรายการตั้งแต่วันที่ 16 กุมภาพันธ์ 2563 เวลา 00.00 น. ถึงวันที่ 1 มีนาคม 2563 เวลา 23.59 น. กำหนดจับรางวัล วันที่ 3 มีนาคม 2563 เวลา 14.00 น.  และประกาศผลผ่านทาง Facebook/NIVEAThailand  และ Line official Home @NIVEAThailand ในวันที่ 5 มีนาคม 2563 เวลา 10.00 น. 
                          <br><strong>รางวัลที่ 1</strong>
                          <ol>
                            <li>เครื่องเป่าผม ยี่ห้อ Dyson รุ่น Dyson Supersonic™ hair dryer (Fuchsia)  มูลค่า 14,500 บาท จำนวน  1 รางวัล </li>
                            <li>เครื่องนวดหน้า FOREO รุ่น Luna™ Go For Normal Skin  มูลค่า 3,780 บาท  จำนวน 1 รางวัล</li>
                          </ol>

                          <strong>รางวัลที่ 2</strong>
                          <ol>
                            <li>ผลิตภัณฑ์ นีเวีย  ลูมินัส 630 สปอตเคลียร์ ทรีทเมนต์ ขนาด 30 มล. มูลค่า 950 บาท จำนวน 20 รางวัล</li>
                          </ol>
                        </li>
                        <li>
                          <strong>ครั้งที่ 4)</strong> เริ่มรายการตั้งแต่วันที่ 2 มีนาคม 2563 เวลา 00.00 น. ถึงวันที่ 16 มีนาคม  2563 เวลา 23.59 น. กำหนดจับรางวัล วันที่ 18  มีนาคม 2563 เวลา 14.00 น.  และประกาศผลผ่านทาง Facebook/NIVEAThailand  และ Line official Home @NIVEA Thailand ในวันที่ 20 มีนาคม 2563 เวลา 10.00 น. 
                          <br><strong>รางวัลที่ 1</strong>
                          <ol>
                            <li>เครื่องนวดหน้า FOREO รุ่น Luna™ Go For Normal Skin  มูลค่า 3,780 บาท จำนวน 1 รางวัล</li>
                            <li>เครื่องทำกาแฟ ยี่ห้อ Nespresso รุ่น Pixie Electric สีบรอนซ์เงิน (รุ่นปรับปรุง) มูลค่า 6,500 บาท จำนวน 1 รางวัล</li>
                          </ol>
                          <strong>รางวัลที่ 2</strong>
                          <ol>
                            <li>ผลิตภัณฑ์ นีเวีย  ลูมินัส 630 สปอตเคลียร์ ทรีทเมนต์ ขนาด 30 มล. มูลค่า 950 บาท จำนวน 20 รางวัล</li>
                          </ol>
                        </li>
                        <li>
                          <strong>ครั้งที่ 5)</strong> เริ่มรายการตั้งแต่วันที่ 17 มีนาคม 2563 เวลา 00.00 น. ถึงวันที่ 31 มีนาคม 2563 เวลา 23.59 น. กำหนดจับรางวัล วันที่ 2 เมษายน 2563 เวลา 14.00 น. และประกาศผลผ่านทาง Facebook/NIVEAThailand และ Line official Home @NIVEA Thailand ในวันที่ 4 เมษายน 2563 เวลา 10.00 น. 
                          <br><strong>รางวัลที่ 1</strong>
                          <ol>
                            <li>เครื่องเป่าผม ยี่ห้อ Dyson รุ่น Dyson Supersonic™ hair dryer (Fuchsia)  มูลค่า 14,500 บาท จำนวน  1รางวัล </li>
                            <li>เครื่องนวดหน้า FOREO รุ่น Luna™ Go For Normal Skin  มูลค่า 3780 บาท  จำนวน 1 รางวัล</li>
                          </ol>
                          <strong>รางวัลที่ 2</strong>
                          <ol>
                            <li>ผลิตภัณฑ์ นีเวีย  ลูมินัส 630 สปอตเคลียร์ ทรีทเมนต์ ขนาด 30 มล. มูลค่า 950 บาท จำนวน 20 รางวัล</li>
                          </ol>
                        </li>
                        <li>
                          <strong>ครั้งที่ 6)</strong> เริ่มรายการตั้งแต่วันที่ 1 เมษายน 2563 เวลา 00.00 น. ถึงวันที่ 15 เมษายน 2563 เวลา 23.59 น. กำหนดจับรางวัล วันที่ 17 เมษายน 2563 เวลา 14.00 น.  และประกาศผลผ่านทาง Facebook/NIVEAThailand และ Line official NIVEA Home @Thailand ในวันที่ 19 เมษายน 2563 เวลา 10.00 น.
                          <br><strong>รางวัลที่ 1</strong>
                          <ol>
                            <li>เครื่องนวดหน้า FOREO รุ่น Luna™ Go For Normal Skin  มูลค่า 3,780 บาท จำนวน 1 รางวัล</li>
                            <li>เครื่องทำกาแฟ ยี่ห้อ Nespresso รุ่น Pixie Electric สีบรอนซ์เงิน (รุ่นปรับปรุง) มูลค่า 6,500 บาท  จำนวน 1 รางวัล</li>
                          </ol>
                          <strong>รางวัลที่ 2</strong>
                          <ol>
                            <li>ผลิตภัณฑ์ นีเวีย  ลูมินัส 630 สปอตเคลียร์ ทรีทเมนต์ ขนาด 30 มล. มูลค่า 950 บาท จำนวน 20 รางวัล</li>
                          </ol>
                        </li>
                        <li>
                          <strong>ครั้งที่ 7)</strong> เริ่มรายการตั้งแต่วันที่ 16 เมษายน 2563 เวลา 00.00 น. ถึงวันที่ 30 เมษายน  2563 เวลา 23.59 น. กำหนดจับรางวัล วันที่ 2 พฤษภาคม 2563 เวลา 14.00 น.  และประกาศผลผ่านทาง Facebook/NIVEAThailand และ Line official Home @NIVEAThailand ในวันที่ 4 พฤษภาคม 2563 เวลา 10.00 น.
                          <br><strong>รางวัลที่ 1</strong>
                          <ol>
                            <li>เครื่องนวดหน้า FOREO รุ่น Luna™ Go For Normal Skin  มูลค่า 3,780 บาท จำนวน 1 รางวัล</li>
                            <li>เครื่องทำกาแฟ ยี่ห้อ Nespresso รุ่น Pixie Electric สีบรอนซ์เงิน (รุ่นปรับปรุง) มูลค่า 6,500 บาท จำนวน 1 รางวัล</li>
                          </ol>
                          <strong>รางวัลที่ 2</strong>
                          <ol>
                            <li>ผลิตภัณฑ์ นีเวีย  ลูมินัส 630 สปอตเคลียร์ ทรีทเมนต์ ขนาด 30 มล. มูลค่า 950 บาท จำนวน 20 รางวัล</li>
                          </ol>
                        </li>
                    </ol>
                  </li>
                  <li>เมื่อครบระยะเวลาร่วมรายการที่กำหนดจับรางวัลแต่ละครั้ง บริษัทฯจะทำการดึงข้อมูลของผู้ร่วมรายการทุกท่านที่ปฏิบัติตามเงื่อนไขของบริษัทฯ
                    ออกจากฐานข้อมูลคอมพิวเตอร์ นำมาจัดพิมพ์เบอร์โทรศัพท์ และเลขที่ใบเสร็จรับเงินของผู้ร่วมรายการ
                    ตัดเป็นชิ้นส่วนใส่ในภาชนะ โดยคลุกเคล้าชิ้นส่วนทั้งหมดให้ทั่วกัน แล้วเชิญแขกผู้มีเกียรติจับชิ้นส่วนต่อหน้าคณะกรรมการตัดสินของบริษัทฯ และสักขีพยานหาผู้โชคดีเพื่อให้ได้รางวัลตามที่กำหนดไว้ ท่านที่มาร่วมงานทราบโดยทั่วกัน ทั้งนี้ บริษัทฯ
                    จะนำชิ้นส่วนที่เหลือจากการจับรางวัลในแต่ละครั้ง มาจับรางวัลในครั้งต่อไปอีก
                  </li>
                  <li>ผู้ร่วมรายการสามารถเข้าร่วมรายการได้โดยไม่จำกัดจำนวนสิทธิ์ แต่จะได้รับรางวัลที่มีมูลค่าสูงสุดเพียงรางวัลเดียวต่อการจับรางวัลในแต่ละครั้งเท่านั้น และเมื่อผู้ร่วมรายการได้รับรางวัลในการจับรางวัลครั้งใดแล้ว ผู้ร่วมรายการรายดังกล่าวจะไม่ถูกตัดสิทธิในการรับรางวัลในครั้งต่อๆไปตลอดระยะเวลากิจกรรมที่เหลืออยู่</li>
                  <li>หากปรากฏว่าได้ผู้ร่วมรายการได้รับรางวัลหลายรางวัลในการจับชิ้นส่วนในแต่ละครั้ง ผู้ร่วมรายการมีสิทธิ์ได้รับของรางวัลที่มีมูลค่าสูงสุดเพียงรางวัลเดียวเท่านั้น บริษัทฯจะยกเลิกรายชื่อที่ซ้ำซ้อนนั้น แล้วทำการจับชิ้นส่วนใหม่เพื่อให้ได้ผู้โชคดีคนใหม่ทดแทนต่อไป</li>
                  <li>ผู้โชคดีไม่สามารถแลก เปลี่ยน ทอนเป็นเงินสดหรือของรางวัลอื่นได้และไม่สามารถโอนสิทธิ์ให้กับบุคคลอื่นได้</li>
                  <li>ผู้ที่ได้รับรางวัลที่มีมูลค่าเกิน 1,000 บาท ต้องชำระภาษีหัก ณ ที่จ่าย 5% ตามมูลค่าของรางวัลและค่าใช้จ่ายอื่นใด อันนอกเหนือจากรางวัลดังกล่าว</li>
                  <li>ผู้โชคดีจะต้องเก็บใบเสร็จไว้เป็นหลักฐานในการรับรางวัล และต้องนําบัตรประจําตัวประชาชนพร้อมสำเนา 1 ชุด มาแสดง เพื่อเป็นหลักฐานในการขอรับรางวัล</li>
                  <li>เมื่อครบระยะเวลาร่วมรายการที่กำหนดจับรางวัลแต่ละครั้ง บริษัทฯจะทำการดึงข้อมูลของผู้ร่วมรายการทุกท่านที่ปฏิบัติตามเงื่อนไขของบริษัทฯ ออกจากฐานข้อมูลคอมพิวเตอร์ นำมาจัดพิมพ์เบอร์โทรศัพท์ และเลขที่ใบเสร็จรับเงินของผู้ร่วมรายการ  ตัดเป็นชิ้นส่วนใส่ในภาชนะ โดยคลุกเคล้าชิ้นส่วนทั้งหมดให้ทั่วกัน แล้วเชิญแขกผู้มีเกียรติจับชิ้นส่วนต่อหน้าคณะกรรมการตัดสินของบริษัทฯ และสักขีพยานหาผู้โชคดีเพื่อให้ได้รางวัลตามที่กำหนดไว้ พร้อมทั้งประกาศรายชื่อผู้โชคดีทันทีเพื่อให้ทุกๆ  ท่านที่มาร่วมงานทราบโดยทั่วกัน ทั้งนี้ บริษัทฯ จะนำชิ้นส่วนที่เหลือจากการจับรางวัลในแต่ละครั้ง มาจับรางวัลในครั้งต่อไปอีก</li>
                  <li>ผู้ร่วมรายการสามารถเข้าร่วมรายการได้โดยไม่จำกัดจำนวนสิทธิ์ แต่จะได้รับรางวัลที่มีมูลค่าสูงสุดเพียงรางวัลเดียวต่อการจับรางวัลในแต่ละครั้งเท่านั้น และเมื่อผู้ร่วมรายการได้รับรางวัลในการจับรางวัลครั้งใดแล้ว ผู้ร่วมรายการรายดังกล่าวจะไม่ถูกตัดสิทธิในการรับรางวัลในครั้งต่อๆ ไปตลอดระยะเวลากิจกรรมที่เหลืออยู่</li>
                  <li>หากปรากฏว่าได้ผู้ร่วมรายการได้รับรางวัลหลายรางวัลในการจับชิ้นส่วนในแต่ละครั้ง ผู้ร่วมรายการมีสิทธิ์ได้รับของรางวัลที่มีมูลค่าสูงสุดเพียงรางวัลเดียวเท่านั้น บริษัทฯจะยกเลิกรายชื่อที่ซ้ำซ้อนนั้น แล้วทำการจับชิ้นส่วนใหม่เพื่อให้ได้ผู้โชคดีคนใหม่ทดแทนต่อไป </li>
                  <li>ผู้โชคดีไม่สามารถแลก เปลี่ยน ทอนเป็นเงินสดหรือของรางวัลอื่นได้ และไม่สามารถโอนสิทธิ์ให้กับบุคคลอื่นได้</li>
                  <li>ผู้ที่ได้รับรางวัลที่มีมูลค่าเกิน 1,000 บาท ต้องชำระภาษีหัก ณ ที่จ่าย 5% ตามมูลค่าของรางวัล และค่าใช้จ่ายอื่นใด อันนอกเหนือจากรางวัลดังกล่าว</li>
                  <li>ผู้โชคดีจะต้องเก็บใบเสร็จไว้เป็นหลักฐานในการรับรางวัล และต้องนําบัตรประจําตัวประชาชน พร้อมสำเนา 1 ชุด มาแสดง เพื่อเป็นหลักฐานในการขอรับรางวัล</li>
                  <li>ผู้โชคดีจะได้รับการติดต่อจากบริษัทฯ ภายใน 30 วันนับจากวันที่ประกาศผลรางวัลแต่ละครั้ง หากผู้โชคดีไม่ได้รับการติดต่อหรือไม่ได้รับรางวัลภายในระยะเวลาที่กำหนด กรุณาติดต่อบริษัท NeuMerlin Company Limited ที่อยู่ 55 ซอยประดิพัทธ์ 17 ถนนประดิพัทธ์ เเขวงพญาไท เขตพญาไท กรุงเทพฯ 10400 โทร 02-6183155 ในวันและเวลาทำการ ภายใน 30 วันนับจากวันที่ประกาศผลรางวัลแต่ละครั้ง หากพ้นกำหนดเวลา จะถือว่าผู้โชคดีสละสิทธิ์ บริษัทฯ จะทำการติดต่อผู้โชคดีสำรองถัดไป สำหรับรางวัลที่ 2 บริษัทฯ จะทำการจัดส่งให้กับผู้โชคดีทางไปรษณีย์ ภายใน 30 วัน หลังจากประกาศผลและสามารถติดต่อกับผู้โชคดีได้</li>
                  <li>บริษัทฯ ขอสงวนสิทธิ์ในการเปลี่ยนแปลงรายละเอียดเกี่ยวกับของรางวัลเป็นของอย่างอื่นมีมูลค่าเทียบเท่าของรางวัลเดิมโดยไม่ต้องแจ้งให้ทราบล่วงหน้า </li>
                  <li>บริษัทฯ มิได้มีส่วนเกี่ยวข้องในการจัดจำหน่ายของรางวัลที่ระบุในกิจกรรมนี้ บริษัทฯ จะไม่รับประกันและไม่รับผิดชอบต่อคุณภาพของรางวัลดังกล่าว หากมีปัญหาเกี่ยวกับของรางวัล ผู้โชคดีจะต้องติดต่อที่บริษัทที่ผลิตหรือจำหน่ายโดยตรง </li>
                  <li>บริษัทฯ ขอสงวนสิทธิ์ในการบันทึกภาพผู้ได้รับรางวัลเพื่อการประชาสัมพันธ์ของบริษัท ไบเออร์สด๊อรฟ (ประเทศไทย) จำกัด โดยผู้ได้รับรางวัลยินยอมให้ภาพของผู้ได้รับรางวัลเป็นกรรมสิทธิ์ของทางบริษัท และบริษัทฯ สามารถนำไปใช้เผยแพร่ในการประชาสัมพันธ์ได้</li>
                  <li>คำตัดสินของคณะกรรมการถือเป็นอันสิ้นสุด</li>
                  <li>พนักงานและครอบครัวพนักงานของ บริษัท ไบเออร์สด๊อรฟ (ประเทศไทย) จำกัด และ บริษัทอื่นใดที่เกี่ยวข้องกับการจัดกิจกรรมนี้ ไม่มีสิทธิเข้าร่วมกิจกรรมได้</li>
                </ol>
              </div>
            </div>
          </div>

          <div class="group d-flex justify-content-start">
            <input type="checkbox" name="agree" required /> <label for="agree"><strong>ข้าพเจ้าได้อ่านรับทราบและยอมรับเงื่อนไขและรายละเอียดต่างๆ แล้ว</strong></label>
          </div>
          <div class="group d-flex justify-content-start">
            <input type="checkbox" name="news" required /> <label for="news"><strong>ยินยอมรับข่าวสารผลิตภัณฑ์ กิจกรรมทางการตลาด โปรโมชั่น จากนีเวีย และสามารถยกเลิกกการสมัครรับข่าวสารนี้ได้ตลอดเวลาที่ต้องการ อ่านเพิ่มเติมนโยบายความเป็นส่วนตัว <a href="https://www.nivea.co.th/about-us/privacy-policy" target="_blank">คลิกที่นี่</a></strong></label>
          </div>

          <input type="submit" name="action" value="Submit" class="btn btn-primary" />
        </form>
      </div>
    </div>
  </main>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  <script src="./script.js"></script>
</body>
</html>

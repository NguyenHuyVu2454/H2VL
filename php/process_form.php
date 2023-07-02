<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../PHPMailer-master/PHPMailer-master/src/Exception.php';
require '../PHPMailer-master/PHPMailer-master/src/PHPMailer.php';
require '../PHPMailer-master/PHPMailer-master/src/SMTP.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Lấy dữ liệu từ form
  $fullName = $_POST["fullName"];
  $username = $_POST["username"];
  $email = $_POST["email"];
  $phoneNumber = $_POST["phoneNumber"];
  $password = $_POST["password"];
  $gender = isset($_POST['gender']) ? $_POST['gender'] : '';

  // Địa chỉ email để nhận thông tin đăng ký
  $to = $email;

  // Tiêu đề email
  $subject = "H2VL membership registration";

  // Nội dung email
  $message = '<!DOCTYPE html>
<html lang="en">
<head>
    <title>Thông tin đăng ký thành viên H2VL</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        h1{
            color: blue;
            text-transform: uppercase;
            text-align: center;
        }
        h2{
            color: red;
            text-align: center;
        }
        .form{
            display: flex;
            justify-content: space-around;
        }
        .img img{
            width: 200px;
        }
        .text h3{
            color: dodgerblue;
        }
        .text ul{
            list-style: none;
            line-height: 25px;
            font-weight: 500;
        }
    </style>
</head>
<body>
    <h1>
        Cảm ơn bạn đã đăng ký thành viên H2VL!
    </h1>
    <h2>Thông tin đăng ký của bạn:</h2>
    <p><strong>Họ và tên:</strong> ' . $fullName . '</p>
    <p><strong>Tên tài khoản:</strong> ' . $username . '</p>
    <p><strong>Email:</strong> ' . $email . '</p>
    <p><strong>Số điện thoại:</strong> ' . $phoneNumber . '</p>
    <p><strong>Giới tính:</strong> ' . $gender . '</p>
    <div class="form">
        <div class="img">
            <img src="img/logoH.png" alt="">
        </div>
        <div class="text">
            <h3>
                Đội ngũ nhân viên
            </h3>
            <ul>
                <li><i class="fa-solid fa-user"></i> Nguyễn Huy Vũ</li>
                <li><i class="fa-solid fa-user"></i> Trần Nhật Hoàng</li>
                <li><i class="fa-solid fa-user"></i> Hoàng Tấn Lộc</li>
                <li><i class="fa-solid fa-user"></i> Phạm Quốc Việt</li>
            </ul>
        </div>
    </div>
</body>
</html>';

  // Cấu hình PHPMailer
  $mail = new PHPMailer(true);
  $mail->isSMTP();
  $mail->Host = 'smtp.gmail.com';  // Thay thế bằng địa chỉ SMTP của bạn
  $mail->SMTPAuth = true;
  $mail->Username = 'nhhuyvu123123@gmail.com';  // Thay thế bằng địa chỉ email của bạn
  $mail->Password = 'atuwnnkqrnylzlsl';  // Thay thế bằng mật khẩu email của bạn
  $mail->SMTPSecure = 'tls';
  $mail->Port = 587;

  $mail->setFrom('nhhuyvu123123@gmail.com', 'Nguyen Huy Vu');  // Thay thế bằng địa chỉ email và tên của bạn
  $mail->addAddress($to);  // Thêm địa chỉ email người nhận

  // Đường dẫn đến hình ảnh của bạn
  $attachmentPath = '../img/logoH.png';

  // Kiểm tra xem tập tin tồn tại trước khi đính kèm
  if (file_exists($attachmentPath)) {
    $mail->addAttachment($attachmentPath);
  }

  // Thiết lập nội dung email
  $mail->isHTML(true);
  $mail->Subject = $subject;
  $mail->Body = $message;

  // Gửi email
  try {
    $mail->send();
    echo '<script>alert("Email đã được gửi thành công.");</script>';
  } catch (Exception $e) {
    echo '<script>alert("Có lỗi xảy ra khi gửi email: ' . $mail->ErrorInfo . '");</script>';
  }
}

?>

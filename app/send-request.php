<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    include_once 'database.php';
    require '../vendor/autoload.php';

    if (
        !isset($_POST['send_request']) &&
        !isset($_POST['email']) &&
        isset($_SESSION['id'])
    ) {
        $message = 'Unable to send request.';
    } else {
        $email = trim(filter_var($_POST['email'], FILTER_SANITIZE_EMAIL));
        $random_characters = str_shuffle('abcdefghihjklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890');
        $token = substr($random_characters, 57);
        $hashed_token = password_hash($token, PASSWORD_DEFAULT);
        $access_key = bin2hex(random_bytes(32));
        $url = 'http://localhost/barangay-agusi/change-password.php?access_key=' . $access_key;
        $mail = new PHPMailer(true);

        try {
            $select_users = $connect->prepare('SELECT * FROM users WHERE email = :email');
            $select_users->bindParam(':email', $email);
            $select_users->execute();

            $select_settings = $connect->prepare('SELECT * FROM settings');
            $select_settings->execute();
            $setting = $select_settings->fetch();

            if (empty($email)) {
                $message = 'Email is required.';
            } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $message = 'Invalid email format.';
            } else if ($select_users->rowCount() < 1) {
                $message = 'Email does not exist.';
            } else {
                try {
                    $insert_resets = $connect->prepare('INSERT INTO resets
                        VALUES (:email, :token, :access_key, NOW() + INTERVAL 5 MINUTE, NOW(), NOW())
                        ON DUPLICATE KEY UPDATE
                            token = :token,
                            access_key = :access_key,
                            expiration = NOW() + INTERVAL 5 MINUTE,
                            date_updated = NOW()');
                    $insert_resets->bindParam(':email', $email);
                    $insert_resets->bindParam(':token', $hashed_token);
                    $insert_resets->bindParam(':access_key', $access_key);
                    $insert_resets->execute();

                    try {
                        $mail->isSMTP();
                        $mail->Host = 'smtp.gmail.com';
                        $mail->SMTPAuth = true;
                        $mail->Username = $setting['contact_email'];
                        $mail->Password = '';
                        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
                        $mail->Port = 465;

                        $mail->setFrom($setting['contact_email']);
                        $mail->addAddress($email);

                        $mail->isHTML(true);
                        $mail->Subject = 'Password Reset';
                        $mail->Body = 'We received your request to reset your password. This is the link for you to reset your password: <b><a href="' . $url . '">Change Password Link</a></b>. This is the Token: <b>' . $token . '</b>. The Token expires in 5 minutes.';

                        if (!$mail->send()) {
                            $message = 'There was an error sending the email.';
                        } else {
                            $message = 'Email has been successfully sent. Check your mail.';
                        }
                    } catch (Exception $e) {
                        $message = $e->getMessage();
                    }
                } catch (PDOException $e) {
                    $message = $e->getMessage();
                }
            }
        } catch (PDOException $e) {
            $message = $e->getMessage();
        }
    }
?>

<script>
    alert(`<?= $message; ?>`)
    location.href = '../forgot-password.php'
</script>
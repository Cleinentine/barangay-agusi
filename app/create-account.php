<?php
    include_once 'database.php';

    if (
        !isset($_POST['create_account']) &&
        !isset($_POST['registration_key']) &&
        !isset($_POST['email']) &&
        !isset($_POST['mobile_number']) &&
        !isset($_POST['password']) &&
        !isset($_POST['confirm_password']) &&
        isset($_SESSION['id'])
    ) {
        $message = 'Unable to create account.';
    } else {
        $registration_key = trim(filter_var($_POST['registration_key'], FILTER_SANITIZE_SPECIAL_CHARS));
        $email = trim(filter_var($_POST['email'], FILTER_SANITIZE_EMAIL));
        $mobile_number = trim(filter_var($_POST['mobile_number'], FILTER_SANITIZE_NUMBER_INT));
        $password = trim(filter_var($_POST['password'], FILTER_SANITIZE_SPECIAL_CHARS));
        $confirm_password = trim(filter_var($_POST['confirm_password'], FILTER_SANITIZE_SPECIAL_CHARS));
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $error = 0;

        try {
            $select_emails = $connect->prepare('SELECT * FROM users WHERE email = :email');
            $select_emails->bindParam(':email', $email);
            $select_emails->execute();

            $select_mobile_number = $connect->prepare('SELECT * FROM users WHERE mobile_number = :mobile_number');
            $select_mobile_number->bindParam(':mobile_number', $mobile_number);
            $select_mobile_number->execute();

            $select_residents = $connect->prepare('SELECT * FROM residents WHERE registration_key = :registration_key');
            $select_residents->bindParam(':registration_key', $registration_key);
            $select_residents->execute();

            if (empty($registration_key) || empty($email) || empty($mobile_number) || empty($password) || empty($confirm_password) || $select_residents->rowCount() < 1) {
                $error = 1;
                $message = 'All fields are required.';
            } else {
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $error = 1;
                    $message = 'Invalid email format.';
                } else if ($select_emails->rowCount() > 0) {
                    $error = 1;
                    $message = 'Email is already in use.';
                }

                if (!is_numeric($mobile_number)) {
                    $error = 1;
                    $message = 'Mobile number should be numeric.';
                } else if (strlen($mobile_number) > 11) {
                    $error = 1;
                    $message = 'Mobile number should have a maximum of 11 digits only.';
                } else if ($select_mobile_number->rowCount() > 0) {
                    $error = 1;
                    $message = 'Mobile number is already in use.';
                }

                if ($password != $confirm_password) {
                    $error = 1;
                    $message = 'Both password fields do not match.';
                }

                if ($error < 1) {
                    try {
                        $insert_users = $connect->prepare('INSERT INTO users VALUES ("", :email, :mobile_number, :password, 1, NOW(), NOW())');
                        $insert_users->bindParam(':email', $email);
                        $insert_users->bindParam(':mobile_number', $mobile_number);
                        $insert_users->bindParam(':password', $hashed_password);
                        $insert_users->execute();

                        $_SESSION['id'] = $connect->lastInsertId();

                        $update_residents = $connect->prepare('UPDATE residents
                            SET user_id = :user_id,
                                registration_key = null,
                                date_updated = NOW()
                            WHERE registration_key = :registration_key');
                        $update_residents->bindParam(':registration_key', $registration_key);
                        $update_residents->bindParam(':user_id', $_SESSION['id']);
                        $update_residents->execute();

                        $message = 'Account has been created successfully.';
                    } catch (PDOException $e) {
                        $message = $e->getMessage();
                    }
                }
            }
        } catch (PDOException $e) {
            $message = $e->getMessage();
        }
    }
?>

<script>
    alert(`<?= $message; ?>`)

    <?php
        if ($error > 0) {
            ?> history.back() <?php
        } else {
            ?> location.href = '../profile.php' <?php
        }
    ?>
</script>
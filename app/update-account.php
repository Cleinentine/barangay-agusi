<?php
    include_once 'database.php';

    if (
        !isset($_POST['update_account']) &&
        !isset($_POST['email']) &&
        !isset($_POST['mobile_number']) &&
        !isset($_SESSION['id'])
    ) {
        $message = 'Unable to update your account.';
    } else {
        $email = trim(filter_var($_POST['email'], FILTER_SANITIZE_EMAIL));
        $mobile_number = trim(filter_var($_POST['mobile_number'], FILTER_SANITIZE_SPECIAL_CHARS));

        try {
            $select_emails = $connect->prepare('SELECT email FROM users WHERE email = :email');
            $select_emails->bindParam(':email', $email);
            $select_emails->execute();
            $user_email = $select_emails->fetch();

            $select_mobile_numbers = $connect->prepare('SELECT mobile_number FROM users WHERE mobile_number = :mobile_number');
            $select_mobile_numbers->bindParam(':mobile_number', $mobile_number);
            $select_mobile_numbers->execute();
            $user_mobile_number = $select_mobile_numbers->fetch();

            if (empty($email)) {
                $message = 'Email is required.';
            } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $message = 'Invalid email format.';
            } else if ($email !== $user_email['email']) {
                if ($select_emails->rowCount() > 0) {
                    $message = 'Email is already in use.';
                }
            } else if ($select_mobile_numbers->rowCount() > 0 && $mobile_number !== $user_mobile_number['mobile_number']) {
                if ($select_mobile_numbers->rowCount() > 0) {
                    $message = 'Mobile number is already in use.';
                }
            } else {
                try {
                    $update_users = $connect->prepare('UPDATE users
                        SET email = :email,
                            mobile_number = :mobile_number,
                            date_updated = NOW()
                        WHERE id = :id');
                    $update_users->bindParam(':id', $id);
                    $update_users->bindParam(':email', $email);
                    $update_users->bindParam(':mobile_number', $mobile_number);
                    $update_users->execute();

                    $message = 'Account has been successfully updated.';
                } catch (PDOException $update_users_message) {
                    $message = 'update_users: ' . $update_users_message->getMessage();
                }
            }
        } catch (PDOException $select_users_message) {
            $message = 'select_users: ' . $select_users_message->getMessage();
        }
    }
?>

<script>
    alert(`<?= $message; ?>`)
    history.back()
</script>
<?php
    include_once 'database.php';

    if (
        !isset($_POST['change_account_password']) &&
        !isset($_POST['new_password']) &&
        !isset($_POST['confirm_new_password']) &&
        !isset($_SESSION['id'])
    ) {
        $message = 'Unable to change your account password.';
    } else {
        $new_password = trim(filter_var($_POST['new_password'], FILTER_SANITIZE_SPECIAL_CHARS));
        $confirm_new_password = trim(filter_var($_POST['confirm_new_password'], FILTER_SANITIZE_SPECIAL_CHARS));
        $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

        if (empty($new_password)) {
            $message = 'Enter your new password.';
        } else if ($new_password != $confirm_new_password) {
            $message = 'Both password fields do not match.';
        } else {
            try {
                $update_users = $connect->prepare('UPDATE users
                    SET password = :password,
                        date_updated = NOW()
                    WHERE id = :id');
                $update_users->bindParam(':id', $id);
                $update_users->bindParam(':password', $hashed_password);
                $update_users->execute();

                $message = 'Password has been successfully changed.';
            } catch (PDOException $update_users) {
                $message = 'update_users: ' . $update_users->getMessage();
            }
        }
    }
?>

<script>
    alert(`<?= $message; ?>`)
    history.back()
</script>
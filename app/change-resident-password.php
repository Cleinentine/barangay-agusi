<?php
    include_once 'database.php';

    $redirect = false;

    if (
        !isset($_POST['change_resident_password']) &&
        !isset($_POST['access_key']) &&
        !isset($_POST['token']) &&
        !isset($_POST['new_password']) &&
        !isset($_POST['confirm_new_password'])
    ) {
        $message = 'Unable to change password.';
    } else {
        $access_key = trim(filter_var($_POST['access_key'], FILTER_SANITIZE_SPECIAL_CHARS));
        $token = trim(filter_var($_POST['token'], FILTER_SANITIZE_SPECIAL_CHARS));
        $new_password = trim(filter_var($_POST['new_password'], FILTER_SANITIZE_SPECIAL_CHARS));
        $confirm_new_password = trim(filter_var($_POST['confirm_new_password'], FILTER_SANITIZE_SPECIAL_CHARS));
        $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
        $delete = false;

        try {
            $select_resets = $connect->prepare('SELECT * FROM resets WHERE access_key = :access_key');
            $select_resets->bindParam(':access_key', $access_key);
            $select_resets->execute();
            $reset = $select_resets->fetch();

            if (empty($access_key) || empty($token) || empty($new_password) || empty($new_password)) {
                $message = 'All fields are required.';
            } else {
                if (!password_verify($token, $reset['token'])) {
                    $message = 'Invalid token.';
                } else if (date('Y-m-d h:i:s') >= $reset['expiration']) {
                    $delete = true;
                    $message = 'Token has expired.';
                } else if ($new_password != $confirm_new_password) {
                    $message = 'Both password fields do not match.';
                } else {
                    try {
                        $update_users = $connect->prepare('UPDATE users SET password = :password, date_updated = NOW() WHERE email = :email');
                        $update_users->bindParam(':email', $reset['email']);
                        $update_users->bindParam(':password', $hashed_password);
                        $update_users->execute();

                        $delete = true;
                        $redirect = true;
                        $message = 'Password has been changed.';
                    } catch (PDOException $e) {
                        $message = $e->getMessage();
                    }
                }
            }
        } catch (PDOException $e) {
            $message = $e->getMessage();
        }

        if ($delete) {
            try {
                $delete_resets = $connect->prepare('DELETE FROM resets WHERE access_key = :access_key');
                $delete_resets->bindParam(':access_key', $access_key);
                $delete_resets->execute();
            } catch (PDOException $e) {
                $message = $e->getMessage();
            }
        }
    }
?>

<script>
    alert(`<?= $message; ?>`)

    <?php
        if ($redirect) {
            ?> location.href = '../sign-in.php'; <?php
        } else {
            ?> history.back() <?php
        }
    ?>
</script>
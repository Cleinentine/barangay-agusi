<?php
    include_once 'database.php';

    $error = 0;

    if (
        !isset($_POST['login']) ||
        !isset($_POST['email']) ||
        !isset($_POST['password']) ||
        isset($_SESSION['id'])
    ) {
        $error = 1;
        $message = 'Unable to login.';
    } else {
        $email = trim(filter_var($_POST['email'], FILTER_SANITIZE_EMAIL));
        $password = trim(filter_var($_POST['password'], FILTER_SANITIZE_SPECIAL_CHARS));

        try {
            $select_users = $connect->prepare('SELECT * FROM users WHERE email = :email');
            $select_users->bindParam(':email', $email);
            $select_users->execute();
            $user = $select_users->fetch();

            if (empty($email) || empty($password)) {
                $error = 1;
                $message = 'Enter your email and password.';
            } else if ($select_users->rowCount() < 1 || !password_verify($password, $user['password'])) {
                $error = 1;
                $message = 'Invalid email or password.';
            } else {
                $_SESSION['id'] = $user['id'];

                $message = 'Logging in.';
            }
        } catch (PDOException $select_users_message) {
            $error = 1;
            $message = 'select_users: ' . $select_users_message->getMessage();
        }
    }
?>

<script>
    alert(`<?= $message; ?>`)

    <?php
        if ($error > 0) {
            ?> location.href = '../sign-in.php' <?php
        } else {
            if ($user['access_level'] == 2) {
                ?> location.href = '../admin.php' <?php
            } else {
                ?> location.href = '../profile.php' <?php
            }
        }
    ?>
</script>
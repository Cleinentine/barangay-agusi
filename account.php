<?php require_once 'app/database.php'; ?>

<!DOCTYPE html>

<html lang="en">
    <head>
        <?php include_once 'layouts/head.html'; ?>

        <link href="css/admin.css" rel="stylesheet">
        <link href="css/sidebar.css" rel="stylesheet">

        <script src="https://cdn.jsdelivr.net/npm/chart.js@3.9.1/dist/chart.min.js" integrity="sha256-+8RZJua0aEWg+QVVKg4LEzEEm/8RFez5Tb4JBNiV5xA=" crossorigin="anonymous"></script>
    </head>

    <body>
        <?php
            if (!isset($_SESSION['id'])) {
                header('Location: ./sign-in.php');
            } else {
                if ($user['access_level'] == 1) {
                    header('Location: ./');
                } else {
                    include_once 'layouts/sidebar.php';

                    ?>

                    <main class="admin-container">
                        <h1>Account</h1>

                        <hr>

                        <article>
                            <section class="admin-box">
                                <?php
                                    include_once 'includes/account-form.php';
                                    include_once 'includes/change-password-form.php';
                                ?>
                            </section>
                        </article>
                    </main>

                    <?php
                }
            }
        ?>

        <script>
            document.getElementById('account_link').style.backgroundColor = '#0d2d4f'
        </script>
    </body>
</html>
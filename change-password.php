<?php require_once 'app/database.php'; ?>

<!DOCTYPE html>

<html lang="en">
    <head>
        <?php include_once 'layouts/head.html'; ?>

        <link href="css/guest.css" rel="stylesheet">
    </head>

    <body>
        <?php
            $access_key = trim($_GET['access_key']);

            include_once 'layouts/header.php';

            if (isset($_SESSION['id']) || !isset($_GET['access_key']) || !ctype_xdigit($_GET['access_key'])) {
                header('Location: ./');
            } else {
                ?>

                <article class="bg-components header-gap" style="background-image: url('img/bgs/guest.jpg');">
                    <section class="main-padding main-wrapper">
                        <div class="guest">
                            <h2><i class="fa-solid fa-right-to-bracket"></i> CHANGE PASSWORD</h2>
                            <h3>Change your password? Let's get it changed this time!</h3>

                            <form action="app/change-resident-password.php" class="massive-top-gap" method="POST">
                                <input name="access_key" type="hidden" value="<?= $access_key; ?>">

                                <div>
                                    <label>Token <span class="required">(Required)</span>:</label>

                                    <div class="icon-container">
                                        <input name="token" type="text">

                                        <span><i class="fa-solid fa-gem"></i></span>
                                    </div>
                                </div>

                                <div class="top-gap">
                                    <label>New Password <span class="required">(Required)</span>:</label>

                                    <div class="icon-container">
                                        <input name="new_password" type="password">

                                        <span><i class="fa-solid fa-key"></i></span>
                                    </div>
                                </div>

                                <div class="top-gap">
                                    <label>Confirm New Password <span class="required">(Required)</span>:</label>

                                    <div class="icon-container">
                                        <input name="confirm_new_password" type="password">

                                        <span><i class="fa-solid fa-rotate-right"></i></span>
                                    </div>
                                </div>

                                <div class="text-center small-top-gap">
                                    <button name="change_resident_password" type="submit"><i class="fa-solid fa-pen-to-square"></i> Change Password</button>
                                </div>
                            </form>
                        </div>
                    </section>
                </article>

                <?php
            }

            include_once 'layouts/contact.php';
            include_once 'layouts/footer.html';
        ?>
    </body>
</html>
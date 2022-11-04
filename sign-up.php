<?php require_once 'app/database.php'; ?>

<!DOCTYPE html>

<html lang="en">
    <head>
        <?php include_once 'layouts/head.html'; ?>

        <link href="css/guest.css" rel="stylesheet">
    </head>

    <body>
        <?php
            include_once 'layouts/header.php';

            if (isset($_SESSION['id'])) {
                header('Location: ./profile.php');
            } else {
                ?>

                <article class="bg-components header-gap" style="background-image: url('img/bgs/guest.jpg');">
                    <section class="main-padding main-wrapper">
                        <div class="guest">
                            <h2><i class="fa-solid fa-right-to-bracket"></i> SIGN UP</h2>
                            <h3>New resident? Let's get you signed-up!</h3>

                            <form action="app/register.php" class="massive-top-gap" method="POST">
                                <div>
                                    <label>Email Address <span class="required">(Required)</span>:</label>

                                    <div class="icon-container">
                                        <input name="email" placeholder="e.g. johnsmith@gmail.com" type="email">

                                        <span><i class="fa-solid fa-at"></i></span>
                                    </div>
                                </div>

                                <div class="top-gap">
                                    <label>Mobile Number:</label>

                                    <div class="icon-container">
                                        <input name="mobile_number" placeholder="e.g. 09123456789" type="number">

                                        <span><i class="fa-solid fa-mobile-screen-button"></i></span>
                                    </div>
                                </div>

                                <div class="top-gap">
                                    <label>Password <span class="required">(Required)</span>:</label>

                                    <div class="icon-container">
                                        <input name="password" type="password">

                                        <span><i class="fa-solid fa-key"></i></span>
                                    </div>
                                </div>

                                <div class="top-gap">
                                    <label>Confirm Password <span class="required">(Required)</span>:</label>

                                    <div class="icon-container">
                                        <input name="confirm_password" type="password">

                                        <span><i class="fa-solid fa-rotate-right"></i></span>
                                    </div>
                                </div>

                                <div class="text-center small-top-gap">
                                    <button name="register" type="submit"><i class="fa-solid fa-user-plus"></i> Sign Up</button>
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
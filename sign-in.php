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
                            <h2><i class="fa-solid fa-right-to-bracket"></i> SIGN IN</h2>
                            <h3>Welcome back. Let's get you signed-in!</h3>

                            <form action="app/login.php" class="massive-top-gap" method="POST">
                                <div>
                                    <label>Email Address:</label>

                                    <div class="icon-container">
                                        <input name="email" placeholder="e.g. johnsmith@gmail.com" type="email">

                                        <span><i class="fa-solid fa-at"></i></span>
                                    </div>
                                </div>

                                <div class="top-gap">
                                    <label>Password:</label>

                                    <div class="icon-container">
                                        <input name="password" type="password">

                                        <span><i class="fa-solid fa-lock"></i></span>
                                    </div>
                                </div>

                                <div class="smaller-top-gap text-right">
                                    <p><a href="./forgot-password.php">Forgot Password?</a></p>
                                </div>

                                <div class="text-center small-top-gap">
                                    <button name="login" type="submit"><i class="fa-solid fa-right-to-bracket"></i> Sign In</button>
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
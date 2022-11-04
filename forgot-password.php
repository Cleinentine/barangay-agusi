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
                header('Location: ./');
            } else {
                ?>

                <article class="bg-components header-gap" style="background-image: url('img/bgs/guest.jpg');">
                    <section class="main-padding main-wrapper">
                        <div class="guest">
                            <h2><i class="fa-solid fa-right-to-bracket"></i> FORGOT PASSWORD</h2>
                            <h3>Don't remember your password? Let's reset your password then!</h3>

                            <form action="app/send-request.php" class="massive-top-gap" method="POST">
                                <div>
                                    <label>Email Address <span class="required">(Required)</span>:</label>

                                    <div class="icon-container">
                                        <input name="email" placeholder="e.g. johnsmith@gmail.com" type="email">

                                        <span><i class="fa-solid fa-at"></i></span>
                                    </div>
                                </div>

                                <div class="text-center small-top-gap">
                                    <button name="send_request" type="submit"><i class="fa-solid fa-paper-plane"></i> Send Request</button>
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
<?php require_once 'app/database.php'; ?>

<!DOCTYPE html>

<html lang="en">
    <head>
        <?php include_once 'layouts/head.html'; ?>

        <link href="css/home.css" rel="stylesheet">
    </head>

    <body>
        <?php
            include_once 'layouts/header.php';

            ?>

            <article class="bg-components hero">
                <div class="bg-overlay">
                    <section class="introduction main-padding">
                        <h2>WELCOME TO</h2>
                        <h1>BARANGAY AGUSI</h1>
                        <h3>Official Portal Website</h3>

                        <a class="btn-link" href="./#Vision_Mission"><i class="fa-solid fa-caret-down"></i> Learn More</a>
                    </section>

                    <section class="municipality">
                        <h2>MUNICIPALITY OF CAMALANIUGAN</h2>
                    </section>

                    <section class="date-time">
                        <h2><?= strtoupper(date('M d, Y h:i A')); ?></h2>
                    </section>

                    <section class="scroll-down">
                        <h2>Scroll <i class="fa-solid fa-caret-down"></i> Down</h2>
                    </section>
                </div>
            </article>

            <?php

            try {
                $select_settings = $connect->prepare('SELECT * FROM settings WHERE id = 1');
                $select_settings->execute();
                $setting = $select_settings->fetch();

                if ($select_settings->rowCount() > 0) {
                    ?>

                    <article class="grid grid-cols-2 grid-gap main-padding main-wrapper text-center vision-mission" id="Vision_Mission">
                        <section>
                            <h2><i class="fa-solid fa-eye"></i></h2>
                            <h3>Vision</h3>

                            <p><?= $setting['vision']; ?></p>
                        </section>

                        <section>
                            <h2><i class="fa-solid fa-scroll"></i></h2>
                            <h3>Mission</h3>

                            <p><?= $setting['mission']; ?></p>
                        </section>
                    </article>

                    <?php
                }
            } catch (PDOException $select_settings_message) {
                ?> <p class="app-message fail text-center"><i class="fa-solid fa-circle-xmark"></i> <b>select_settings</b>: <?= $select_settings_message->getMessage(); ?>.</p> <?php
            }

            include_once 'layouts/contact.php';
            include_once 'layouts/footer.html';
        ?>
    </body>
</html>
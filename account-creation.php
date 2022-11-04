<?php require_once 'app/database.php'; ?>

<!DOCTYPE html>

<html lang="en">
    <head>
        <?php include_once 'layouts/head.html'; ?>
    </head>

    <body>
        <?php
            if (isset($_SESSION['id'])) {
                header('Location: ./');
            } else {
                try {
                    $select_residents = $connect->prepare('SELECT * FROM residents WHERE user_id = :user_id');
                    $select_residents->bindParam(':user_id', $id);
                    $select_residents->execute();

                    if ($select_residents->rowCount() > 0) {
                        header('Location: profile.php');
                    } else {
                        $registration_key = trim(filter_var($_GET['registration_key']));

                        try {
                            $select_residents = $connect->prepare('SELECT * FROM residents WHERE registration_key = :registration_key');
                            $select_residents->bindParam(':registration_key', $registration_key);
                            $select_residents->execute();

                            if (!isset($_GET['registration_key']) || isset($_SESSION['user_id']) || $select_residents->rowCount() < 1) {
                                header('Location: ./');
                            } else {
                                include_once 'layouts/header.php';

                                ?>

                                <article class="main-padding main-wrapper">
                                    <form action="app/create-account.php" method="POST">
                                        <input name="registration_key" type="hidden" value="<?= $registration_key; ?>">

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
                                            <button name="create_account" type="submit"><i class="fa-solid fa-user-plus"></i> Create Account</button>
                                        </div>
                                    </form>
                                </article>

                                <?php

                                include_once 'layouts/contact.php';
                                include_once 'layouts/footer.html';
                            }
                        } catch (PDOException $e) {
                            echo $e->getMessage();   
                        }
                    }
                } catch (PDOException $e) {
                    echo $e->getMessage();
                }
            }
        ?>
    </body>
</html>
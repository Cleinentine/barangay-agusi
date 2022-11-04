<?php require_once 'app/database.php'; ?>

<!DOCTYPE html>

<html lang="en">
    <head>
        <?php include_once 'layouts/head.html'; ?>
    </head>

    <body>
        <?php
            if (!isset($_SESSION['id'])) {
                header('Location: ./sign-up.php');
            } else {
                try {
                    $select_residents = $connect->prepare('SELECT * FROM residents WHERE user_id = :user_id');
                    $select_residents->bindParam(':user_id', $id);
                    $select_residents->execute();

                    if ($select_residents->rowCount() > 0) {
                        header('Location: profile.php');
                    } else {
                        include_once 'layouts/header.php';

                        ?>

                        <article class="main-padding main-wrapper">
                            <form action="app/add-profile.php" class="top-gap" method="POST">
                                <div class="grid grid-cols-3 grid-gap">
                                    <div class="col">
                                        <label>Last Name <span class="required">(Required)</span>:</label>

                                        <div class="icon-container">
                                            <input name="last_name" placeholder="e.g. Smith" type="text">

                                            <span><i class="fa-solid fa-user-tag"></i></span>
                                        </div>
                                    </div>

                                    <div class="col">
                                        <label>First Name <span class="required">(Required)</span>:</label>

                                        <div class="icon-container">
                                            <input name="first_name" placeholder="e.g. John" type="text">

                                            <span><i class="fa-solid fa-user-tag"></i></span>
                                        </div>
                                    </div>

                                    <div class="col">
                                        <label>Maiden Name:</label>

                                        <div class="icon-container">
                                            <input name="maiden_name" placeholder="e.g. Doe" type="text">

                                            <span><i class="fa-solid fa-user-tag"></i></span>
                                        </div>
                                    </div>

                                    <div class="col">
                                        <label>Middle Name:</label>

                                        <div class="icon-container">
                                            <input name="middle_name" placeholder="e.g. J." type="text">

                                            <span><i class="fa-solid fa-user-tag"></i></span>
                                        </div>
                                    </div>

                                    <div class="col">
                                        <label>Sex:</label>

                                        <div class="icon-container">
                                            <select name="sex">
                                                <option value="Male">Male</option>
                                                <option value="Female">Female</option>
                                            </select>

                                            <span><i class="fa-solid fa-venus-mars"></i></span>
                                        </div>
                                    </div>

                                    <div class="col">
                                        <label>Civil Status:</label>

                                        <div class="icon-container">
                                            <select name="civil_status">
                                                <option value="Single">Single</option>
                                                <option value="Married">Married</option>
                                                <option value="Separated">Separated</option>
                                                <option value="Divorced">Divorced</option>
                                                <option value="Widowed">Widowed</option>
                                            </select>

                                            <span><i class="fa-solid fa-ring"></i></span>
                                        </div>
                                    </div>

                                    <div class="col">
                                        <label>Birth Date:</label>

                                        <div class="icon-container">
                                            <input name="birth_date" type="date">

                                            <span><i class="fa-solid fa-cake-candles"></i></span>
                                        </div>
                                    </div>

                                    <div class="col">
                                        <label>Place of Birth:</label>

                                        <div class="icon-container">
                                            <input name="place_of_birth" placeholder="e.g. Hogwarts" type="text">

                                            <span><i class="fa-solid fa-map-location-dot"></i></span>
                                        </div>
                                    </div>

                                    <div class="col">
                                        <label>Educational Attainment:</label>

                                        <div class="icon-container">
                                            <input name="educational_attainment" placeholder="e.g. College Graduate" type="text">

                                            <span><i class="fa-solid fa-user-graduate"></i></span>
                                        </div>
                                    </div>

                                    <div class="col">
                                        <label>Family Planning:</label>

                                        <div class="icon-container">
                                            <input name="family_planning" type="text">

                                            <span><i class="fa-solid fa-people-roof"></i></span>
                                        </div>
                                    </div>

                                    <div class="col">
                                        <label>Occupation:</label>

                                        <div class="icon-container">
                                            <input name="occupation" placeholder="e.g. Doctor" type="text">

                                            <span><i class="fa-solid fa-user-doctor"></i></span>
                                        </div>
                                    </div>

                                    <div class="col">
                                        <label>House/Lot Number:</label>

                                        <div class="icon-container">
                                            <input name="house_or_lot_number" placeholder="e.g. Barangay Agusi" type="text">

                                            <span><i class="fa-solid fa-house-user"></i></span>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="grid grid-cols-2 grid-gap top-gap">
                                    <div class="col">
                                        <label>Street Address:</label>

                                        <div class="icon-container">
                                            <input name="street_address" placeholder="e.g. 110 Street" type="text">

                                            <span><i class="fa-solid fa-street-view"></i></span>
                                        </div>
                                    </div>

                                    <div class="col">
                                        <label>District <span class="required">(Required)</span>:</label>

                                        <div class="icon-container">
                                            <input name="district" placeholder="e.g. 1" type="number">

                                            <span><i class="fa-solid fa-arrow-up-1-9"></i></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="text-center small-top-gap">
                                    <button name="add_profile" type="submit"><i class="fa-solid fa-user-plus"></i> Add Profile</button>
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
        ?>
    </body>
</html>
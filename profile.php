<?php require_once 'app/database.php'; ?>

<!DOCTYPE html>

<html lang="en">
    <head>
        <?php include_once 'layouts/head.html'; ?>

        <style>
            .forms-and-certificates {
                list-style-type: none;
                padding-left: 0;
            }

            .forms-and-certificates li a {
                color: #000;
                font-weight: 600;
                text-decoration: none;
            }

            .forms-and-certificates li a:hover {
                text-decoration: underline;
            }
        </style>
    </head>

    <body>
        <?php
            if (!isset($_SESSION['id'])) {
                header('Location: ./sign-in.php');
            } else {
                try {
                    $select_residents = $connect->prepare('SELECT * FROM residents WHERE user_id = :user_id');
                    $select_residents->bindParam(':user_id', $id);
                    $select_residents->execute();
                    $resident = $select_residents->fetch();

                    if ($select_residents->rowCount() < 1) {
                        header('Location: ./profile-creation.php');
                    } else {
                        include_once 'layouts/header.php';

                        ?>

                        <article class="main-padding main-wrapper">
                            <section>
                                <h2>List of Downloadable Forms and Certificates</h2>

                                <ul class="forms-and-certificates grid grid-cols-4 grid-gap top-gap">
                                    <?php
                                        $documents_directory = 'documents/';
                                        $documents = glob($documents_directory . '*.docx');

                                        foreach ($documents as $document) {
                                            ?> <li class="col"><a href="<?= $document; ?>" download="<?= basename($document, '.docx'); ?>"><?= basename($document, '.docx'); ?></a></li> <?php
                                        }
                                    ?>
                                </ul>
                            </section>

                            <section class="massive-top-gap">
                                <?php
                                    include_once 'includes/account-form.php';
                                    include_once 'includes/change-password-form.php';
                                ?>
                            </section>

                            <section class="massive-top-gap">
                                <h2>My Profile</h2>

                                <form action="app/update-profile.php" class="top-gap" method="POST">
                                    <div class="grid grid-cols-3 grid-gap">
                                        <div class="col">
                                            <label>Last Name <span class="required">(Required)</span>:</label>

                                            <div class="icon-container">
                                                <input name="last_name" placeholder="e.g. Smith" type="text" value="<?= $resident['last_name']; ?>">

                                                <span><i class="fa-solid fa-user-tag"></i></span>
                                            </div>
                                        </div>

                                        <div class="col">
                                            <label>First Name <span class="required">(Required)</span>:</label>

                                            <div class="icon-container">
                                                <input name="first_name" placeholder="e.g. John" type="text" value="<?= $resident['first_name']; ?>">

                                                <span><i class="fa-solid fa-user-tag"></i></span>
                                            </div>
                                        </div>

                                        <div class="col">
                                            <label>Maiden Name:</label>

                                            <div class="icon-container">
                                                <input name="maiden_name" placeholder="e.g. Doe" type="text" value="<?= $resident['maiden_name']; ?>">

                                                <span><i class="fa-solid fa-user-tag"></i></span>
                                            </div>
                                        </div>

                                        <div class="col">
                                            <label>Middle Name:</label>

                                            <div class="icon-container">
                                                <input name="middle_name" placeholder="e.g. J." type="text" value="<?= $resident['middle_name']; ?>">

                                                <span><i class="fa-solid fa-user-tag"></i></span>
                                            </div>
                                        </div>

                                        <div class="col">
                                            <label>Sex:</label>

                                            <div class="icon-container">
                                                <select name="sex">
                                                    <option <?php if ($resident['sex'] == 'Male') { echo 'selected'; } ?> value="Male">Male</option>
                                                    <option <?php if ($resident['sex'] == 'Female') { echo 'selected'; } ?> value="Female">Female</option>
                                                </select>

                                                <span><i class="fa-solid fa-venus-mars"></i></span>
                                            </div>
                                        </div>

                                        <div class="col">
                                            <label>Civil Status:</label>

                                            <div class="icon-container">
                                                <select name="civil_status">
                                                    <option <?php if ($resident['civil_status'] == 'Single') { echo 'selected'; } ?> value="Single">Single</option>
                                                    <option <?php if ($resident['civil_status'] == 'Married') { echo 'selected'; } ?> value="Married">Married</option>
                                                    <option <?php if ($resident['civil_status'] == 'Separated') { echo 'selected'; } ?> value="Separated">Separated</option>
                                                    <option <?php if ($resident['civil_status'] == 'Divorced') { echo 'selected'; } ?> value="Divorced">Divorced</option>
                                                    <option <?php if ($resident['civil_status'] == 'Widowed') { echo 'selected'; } ?> value="Widowed">Widowed</option>
                                                </select>

                                                <span><i class="fa-solid fa-ring"></i></span>
                                            </div>
                                        </div>

                                        <div class="col">
                                            <label>Birth Date:</label>

                                            <div class="icon-container">
                                                <input name="birth_date" type="date" value="<?= $resident['birth_date']; ?>">

                                                <span><i class="fa-solid fa-cake-candles"></i></span>
                                            </div>
                                        </div>

                                        <div class="col">
                                            <label>Place of Birth:</label>

                                            <div class="icon-container">
                                                <input name="place_of_birth" placeholder="e.g. Hogwarts" type="text" value="<?= $resident['place_of_birth']; ?>">

                                                <span><i class="fa-solid fa-map-location-dot"></i></span>
                                            </div>
                                        </div>

                                        <div class="col">
                                            <label>Educational Attainment:</label>

                                            <div class="icon-container">
                                                <input name="educational_attainment" placeholder="e.g. College Graduate" type="text" value="<?= $resident['educational_attainment']; ?>">

                                                <span><i class="fa-solid fa-user-graduate"></i></span>
                                            </div>
                                        </div>

                                        <div class="col">
                                            <label>Family Planning:</label>

                                            <div class="icon-container">
                                                <input name="family_planning" type="text" value="<?= $resident['family_planning']; ?>">

                                                <span><i class="fa-solid fa-people-roof"></i></span>
                                            </div>
                                        </div>

                                        <div class="col">
                                            <label>Occupation:</label>

                                            <div class="icon-container">
                                                <input name="occupation" placeholder="e.g. Doctor" type="text" value="<?= $resident['occupation']; ?>">

                                                <span><i class="fa-solid fa-user-doctor"></i></span>
                                            </div>
                                        </div>

                                        <div class="col">
                                            <label>House/Lot Number:</label>

                                            <div class="icon-container">
                                                <input name="house_or_lot_number" placeholder="e.g. Barangay Agusi" type="text" value="<?= $resident['house_or_lot_number']; ?>">

                                                <span><i class="fa-solid fa-house-user"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="grid grid-cols-2 grid-gap top-gap">
                                        <div class="col">
                                            <label>Street Address:</label>

                                            <div class="icon-container">
                                                <input name="street_address" placeholder="e.g. 110 Street" type="text" value="<?= $resident['street_address']; ?>">

                                                <span><i class="fa-solid fa-street-view"></i></span>
                                            </div>
                                        </div>

                                        <div class="col">
                                            <label>District <span class="required">(Required)</span>:</label>

                                            <div class="icon-container">
                                                <input name="district" placeholder="e.g. 1" type="number" value="<?= $resident['district']; ?>">

                                                <span><i class="fa-solid fa-arrow-up-1-9"></i></span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="text-center small-top-gap">
                                        <button name="update_profile" type="submit"><i class="fa-solid fa-user-pen"></i> Update Profile</button>
                                    </div>
                                </form>
                            </section>
                        </article>

                        <?php

                        include_once 'layouts/contact.php';
                        include_once 'layouts/footer.html';
                    }
                } catch (PDOException $select_residents_message) {
                    ?>

                    <section class="app-message fail text-center">
                        <h2 class="large-icon"><i class="fa-solid fa-circle-xmark"></i></h2>
                        <h3 class="black-weight">SELECT_RESIDENTS</h3>

                        <p class="small-top-gap"><?= $select_residents_message->getMessage(); ?>.</p>
                    </section>

                    <?php
                }
            }
        ?>
    </body>
</html>
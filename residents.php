<?php require_once 'app/database.php'; ?>

<!DOCTYPE html>

<html lang="en">
    <head>
        <?php include_once 'layouts/head.html'; ?>

        <link href="css/admin.css" rel="stylesheet">
        <link href="css/sidebar.css" rel="stylesheet">
    </head>

    <body>
        <?php
            if (!isset($_SESSION['id'])) {
                header('Location: ./sign-in.php');
            } else {
                if ($user['access_level'] == 1) {
                    header('Location: ./profile.php');
                } else {
                    include_once 'layouts/sidebar.php';
                }
            }
        ?>

        <main class="admin-container">
            <h1>Residents</h1>

            <hr>

            <article>
                <section class="admin-box">
                    <h2 class="text-center">Add a List of Residents</h2>

                    <p class="text-center"><a href="downloadables/format.csv" download="Resident List Upload Format">Download CSV Format</a></p>

                    <form action="app/upload-residents-list.php" class="top-gap" enctype="multipart/form-data" method="POST">
                        <div>
                            <label>CSV File <span class="required">(Required)</span>:</label>

                            <div class="icon-container">
                                <input accept=".csv" name="csv" type="file">

                                <span><i class="fa-solid fa-file-csv"></i></span>
                            </div>
                        </div>

                        <div class="text-center small-top-gap">
                            <button name="upload_residents_list" type="submit"><i class="fa-solid fa-upload"></i> Upload Residents List</button>
                        </div>
                    </form>
                </section>

                <section class="admin-box top-gap">
                    <h2 class="text-center">Add a Resident</h2>

                    <form action="app/add-resident.php" class="top-gap" method="POST">
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
                            <button name="add_resident" type="submit"><i class="fa-solid fa-user-plus"></i> Add Resident</button>
                        </div>
                    </form>
                </section>

                <?php
                    try {
                        $select_residents = $connect->prepare('SELECT * FROM residents ORDER BY last_name ASC');
                        $select_residents->execute();
                        $residents = $select_residents->fetchAll();

                        if ($select_residents->rowCount() > 0) {
                            ?>

                            <section class="admin-box top-gap">
                                <h2 class="text-center">List of Residents</h2>

                                <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>" class="small-top-gap" method="GET">
                                    <div class="icon-container">
                                        <input name="resident_keywords" placeholder="e.g. John Smith" type="search">

                                        <span><i class="fa-solid fa-magnifying-glass"></i></span>
                                    </div>
                                </form>

                                <div class="table-responsive top-gap">
                                    <table>
                                        <thead>
                                            <tr>
                                                <th>L. Name</th>
                                                <th>F. Name</th>
                                                <th>M. Name</th>
                                                <th>M. I.</th>
                                                <th>Sex</th>
                                                <th>Civil</th>
                                                <th>Birthdate</th>
                                                <th>Birth Place</th>
                                                <th>Education</th>
                                                <th>Family Planning</th>
                                                <th>Occupation</th>
                                                <th>House/Lot No.</th>
                                                <th>Street Address</th>
                                                <th>District</th>
                                                <th>Registration Link</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <?php
                                                if (!isset($_GET['resident_keywords'])) {
                                                    foreach ($residents as $resident) {
                                                        ?>

                                                        <tr>
                                                            <td><?= $resident['last_name']; ?></td>
                                                            <td><?= $resident['first_name']; ?></td>
                                                            <td><?= $resident['maiden_name']; ?></td>
                                                            <td><?= $resident['middle_name']; ?></td>
                                                            <td><?= $resident['sex']; ?></td>
                                                            <td><?= $resident['civil_status']; ?></td>
                                                            <td><?= $resident['birth_date']; ?></td>
                                                            <td><?= $resident['place_of_birth']; ?></td>
                                                            <td><?= $resident['educational_attainment']; ?></td>
                                                            <td><?= $resident['family_planning']; ?></td>
                                                            <td><?= $resident['occupation']; ?></td>
                                                            <td><?= $resident['house_or_lot_number']; ?></td>
                                                            <td><?= $resident['street_address']; ?></td>
                                                            <td><?= $resident['district']; ?></td>
                                                            <td><a href="http://localhost/barangay-agusi/account-creation.php?registration_key=<?= $resident['registration_key']; ?>">Registration Link</a></td>
                                                        </tr>

                                                        <?php
                                                    }
                                                } else {
                                                    $resident_keywords = trim(filter_var($_GET['resident_keywords']));
                                                    $sql = '%' . $resident_keywords . '%';

                                                    try {
                                                        $search_residents = $connect->prepare('SELECT * FROM residents
                                                            WHERE last_name OR first_name OR maiden_name OR middle_name LIKE :resident_keywords
                                                            ORDER BY last_name ASC');
                                                        $search_residents->bindParam(':resident_keywords', $sql);
                                                        $search_residents->execute();
                                                        $residents = $search_residents->fetchAll();

                                                        if ($search_residents->rowCount() < 1) {
                                                            ?> <p class="text-center">Resident not found!</p> <?php
                                                        } else {
                                                            foreach ($residents as $resident) {
                                                                ?>
        
                                                                <tr>
                                                                    <td><?= $resident['last_name']; ?></td>
                                                                    <td><?= $resident['first_name']; ?></td>
                                                                    <td><?= $resident['maiden_name']; ?></td>
                                                                    <td><?= $resident['middle_name']; ?></td>
                                                                    <td><?= $resident['sex']; ?></td>
                                                                    <td><?= $resident['civil_status']; ?></td>
                                                                    <td><?= $resident['birth_date']; ?></td>
                                                                    <td><?= $resident['place_of_birth']; ?></td>
                                                                    <td><?= $resident['educational_attainment']; ?></td>
                                                                    <td><?= $resident['family_planning']; ?></td>
                                                                    <td><?= $resident['occupation']; ?></td>
                                                                    <td><?= $resident['house_or_lot_number']; ?></td>
                                                                    <td><?= $resident['street_address']; ?></td>
                                                                    <td><?= $resident['district']; ?></td>
                                                                    <td><a href="http://localhost/barangay-agusi/account-creation.php?registration_key=<?= $resident['registration_key']; ?>">Registration Link</a></td>
                                                                </tr>
        
                                                                <?php
                                                            }
                                                        }
                                                    } catch (PDOException $e) {
                                                        echo $e->getMessage();
                                                    }
                                                }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </section>

                            <?php
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
                ?>
            </article>
        </main>

        <script>
            document.getElementById('residents_link').style.backgroundColor = '#0d2d4f'
        </script>
    </body>
</html>
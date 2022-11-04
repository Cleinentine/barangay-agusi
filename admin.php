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
                        <h1>Dashboard</h1>

                        <hr>

                        <?php
                            try {
                                $count_district_members = $connect->prepare('SELECT district,
                                    COUNT(*) AS total_residents
                                    FROM residents
                                    GROUP BY district');
                                $count_district_members->execute();
                                $district_members = $count_district_members->fetchAll();

                                $count_incomplete_datas = $connect->prepare('SELECT
                                    COUNT(*) AS total_incompletes
                                    FROM residents
                                    WHERE first_name = ""
                                        OR last_name = ""
                                        OR maiden_name = ""
                                        OR middle_name = ""
                                        OR sex = ""
                                        OR civil_status = ""
                                        OR birth_date = ""
                                        OR place_of_birth = ""
                                        OR educational_attainment = ""
                                        OR family_planning = ""
                                        OR occupation = ""
                                        OR house_or_lot_number = ""
                                        OR street_address = ""');
                                $count_incomplete_datas->execute();
                                $incomplete_data = $count_incomplete_datas->fetch();

                                $count_users = $connect->prepare('SELECT
                                    COUNT(CASE WHEN user_id IS NULL THEN 0 ELSE NULL END) AS total_no_users,
                                    COUNT(CASE WHEN user_id IS NOT NULL THEN 0 ELSE NULL END) AS total_users
                                    FROM residents');
                                $count_users->execute();
                                $count_user = $count_users->fetch();

                                ?>

                                <article class="grid grid-cols-4 grid-gap">
                                    <?php
                                        foreach ($district_members as $district_member) {
                                            ?>

                                            <section class="admin-box col text-center">
                                                <h3>DISTRICT NO. <?= $district_member['district']; ?></h3>
                                                <h4><?= number_format($district_member['total_residents']); ?></h4>
                                                <h5>TOTAL RESIDENTS</h5>
                                            </section>

                                            <?php
                                        }
                                    ?>
                                </article>

                                <article class="grid grid-cols-3 grid-gap text-center top-gap">
                                    <section class="admin-box col">
                                        <h3>INCOMPLETE DATA</h3>
                                        <h4><?= number_format($incomplete_data['total_incompletes']); ?></h4>
                                        <h5>OF RESIDENTS</h5>
                                    </section>

                                    <section class="admin-box col">
                                        <h3>RESIDENTS W/ ACC.</h3>
                                        <h4><?= number_format($count_user['total_users']); ?></h4>
                                    </section>

                                    <section class="admin-box col">
                                        <h3>RESIDENTS W/O ACC.</h3>
                                        <h4><?= number_format($count_user['total_no_users']); ?></h4>
                                    </section>
                                </article>

                                <?php
                            } catch (PDOException $count_district_members_message) {
                                ?>

                                <article class="app-message fail text-center">
                                    <section>
                                        <h2 class="large-icon"><i class="fa-solid fa-circle-xmark"></i></h2>
                                        <h3 class="black-weight">COUNT_DISTRICT_MEMBERS</h3>

                                        <p class="small-top-gap"><?= $count_district_members_message->getMessage(); ?>.</p>
                                    </section>
                                </article>

                                <?php
                            }

                            try {
                                $residents_sex_data = $connect->prepare('SELECT district,
                                    COUNT(CASE WHEN sex = "Male" THEN 0 ELSE NULL END) AS total_male,
                                    COUNT(CASE WHEN sex = "Female" THEN 0 ELSE NULL END) AS total_female,
                                    COUNT(CASE WHEN sex = "" THEN 0 ELSE NULL END)AS total_undefined
                                    FROM residents
                                    GROUP BY district');
                                $residents_sex_data->execute();
                                $residents_sex_datas = $residents_sex_data->fetchAll();

                                if ($residents_sex_data->rowCount() > 0) {
                                    ?>
                                    
                                    <article class="admin-box top-gap">
                                        <h2>Residents Data via Sex</h2>

                                        <canvas class="top-gap" id="myChart"></canvas>

                                        <script>
                                            const ctx = document.getElementById('myChart').getContext('2d');
                                            const myChart = new Chart(ctx, {
                                                type: 'bar',

                                                data: {
                                                    labels: [
                                                        <?php
                                                            $district_array = [];

                                                            foreach ($residents_sex_datas as $resident_sex_data) {
                                                                $district_array[] = '"District No. ' . $resident_sex_data['district'] . '"';
                                                            }

                                                            echo implode(', ', $district_array);
                                                        ?>
                                                    ],

                                                    datasets: [
                                                        {
                                                            label: 'Total Male Residents per District',

                                                            data: [
                                                                <?php
                                                                    $male_data_array = [];

                                                                    foreach ($residents_sex_datas as $resident_sex_data) {
                                                                        $male_data_array[] = $resident_sex_data['total_male'];
                                                                    }

                                                                    echo implode(', ', $male_data_array);
                                                                ?>
                                                            ],

                                                            backgroundColor: 'rgba(59, 130, 246, 0.5)',
                                                            borderColor: 'rgb(59, 130, 246)',
                                                            borderWidth: 1
                                                        },

                                                        {
                                                            label: 'Total Female Residents per District',

                                                            data: [
                                                                <?php
                                                                    $female_data_array = [];

                                                                    foreach ($residents_sex_datas as $resident_sex_data) {
                                                                        $female_data_array[] = $resident_sex_data['total_female'];
                                                                    }

                                                                    echo implode(', ', $female_data_array);
                                                                ?>
                                                            ],

                                                            backgroundColor: 'rgba(244, 63, 94, 0.5)',
                                                            borderColor: 'rgb(244, 63, 94)',
                                                            borderWidth: 1
                                                        },

                                                        {
                                                            label: 'Total Undefined Sex Residents per District',

                                                            data: [
                                                                <?php
                                                                    $undefined_data_array = [];

                                                                    foreach ($residents_sex_datas as $resident_sex_data) {
                                                                        $undefined_data_array[] = $resident_sex_data['total_undefined'];
                                                                    }

                                                                    echo implode(', ', $undefined_data_array);
                                                                ?>
                                                            ],

                                                            backgroundColor: 'rgba(100, 116, 134, 0.5)',
                                                            borderColor: 'rgb(100, 116, 139)',
                                                            borderWidth: 1
                                                        }
                                                    ]
                                                },
                                                
                                                options: {
                                                    scales: {
                                                        y: {
                                                            beginAtZero: true
                                                        }
                                                    }
                                                }
                                            });
                                        </script>
                                    </article>

                                    <?php
                                }
                            } catch (PDOException $residents_sex_data_message) {
                                ?>

                                <article class="app-message fail text-center">
                                    <section>
                                        <h2 class="large-icon"><i class="fa-solid fa-circle-xmark"></i></h2>
                                        <h3 class="black-weight">RESIDENTS_SEX_DATA</h3>

                                        <p class="small-top-gap"><?= $residents_sex_data_message->getMessage(); ?>.</p>
                                    </section>
                                </article>

                                <?php
                            }
                        ?>
                    </main>

                    <?php
                }
            }
        ?>

        <script>
            document.getElementById('dashboard_link').style.backgroundColor = '#0d2d4f'
        </script>
    </body>
</html>
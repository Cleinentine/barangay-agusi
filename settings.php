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
                    try {
                        $select_settings = $connect->prepare('SELECT * FROM settings');
                        $select_settings->execute();
                        $setting = $select_settings->fetch();

                        include_once 'layouts/sidebar.php';

                        ?>

                        <main class="admin-container">
                            <h1>Settings</h1>

                            <hr>

                            <article>
                                <section class="admin-box">
                                    <form action="app/update-settings.php" method="POST">
                                        <div>
                                            <label>Vision:</label>

                                            <textarea name="vision" placeholder="e.g. Lorem ipsum..." rows="15"><?= $setting['vision']; ?></textarea>
                                        </div>

                                        <div class="top-gap">
                                            <label>Mission:</label>

                                            <textarea name="mission" placeholder="e.g. Lorem ipsum..." rows="15"><?= $setting['mission']; ?></textarea>
                                        </div>

                                        <div class="top-gap">
                                            <label>Contact Email:</label>

                                            <div class="icon-container">
                                                <input name="contact_email" placeholder="e.g. johnsmith@gmail.com" type="email" value="<?= $setting['contact_email']; ?>">

                                                <span><i class="fa-solid fa-at"></i></span>
                                            </div>
                                        </div>

                                        <div class="top-gap">
                                            <label>Contact Number:</label>

                                            <div class="icon-container">
                                                <input name="contact_number" placeholder="e.g. 09123456789" type="number" value="<?= $setting['contact_number']; ?>">

                                                <span><i class="fa-solid fa-mobile-screen-button"></i></span>
                                            </div>
                                        </div>

                                        <div class="top-gap">
                                            <label>Contact Address:</label>

                                            <div class="icon-container">
                                                <input name="contact_address" placeholder="e.g. Hogwarts" type="text" value="<?= $setting['contact_address']; ?>">

                                                <span><i class="fa-solid fa-map-location-dot"></i></span>
                                            </div>
                                        </div>

                                        <div class="text-center small-top-gap">
                                            <button name="update_settings" type="submit"><i class="fa-solid fa-pen-to-square"></i> Update Settings</button>
                                        </div>
                                    </form>
                                </section>
                            </article>
                        </main>

                        <?php
                    } catch (PDOException $e) {
                        echo $e->getMessage();
                    }
                }
            }
        ?>

        <script>
            document.getElementById('settings_link').style.backgroundColor = '#0d2d4f'
        </script>
    </body>
</html>
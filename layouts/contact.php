<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    require 'vendor/autoload.php';
?>

<article class="contact">
    <div class="grid grid-cols-2 grid-gap main-padding main-wrapper">
        <section class="col">
            <h2>CONTACT US</h2>
            <h3>IF YOU HAVE ANY QUESTIONS OR INQUIRIES PLEASE FILL UP THE FORM BELOW.</h3>

            <?php
                try {
                    $select_settings = $connect->prepare('SELECT * FROM settings WHERE id = 1');
                    $select_settings->execute();
                    $setting = $select_settings->fetch();

                    if ($select_settings->rowCount() > 0) {
                        ?>

                        <div class="massive-top-gap">
                            <h4><i class="fa-solid fa-envelope"></i> CONTACT EMAIL</h4>
                            <h5><a href="mailto: <?= $setting['contact_email'] ?>"><?= $setting['contact_email']; ?></a></h5>
                        </div>

                        <div class="top-gap">
                            <h4><i class="fa-solid fa-mobile-retro"></i> CONTACT NUMBER</h4>
                            <h5><a href="tel: <?= $setting['contact_number'] ?>"><?= $setting['contact_number']; ?></a></h5>
                        </div>

                        <div class="top-gap">
                            <h4><i class="fa-solid fa-map-location-dot"></i> CONTACT ADDRESS</h4>
                            <h5><?= $setting['contact_address']; ?></h5>
                        </div>

                        <?php
                    }
                } catch (PDOException $select_settings_message) {
                    ?> <p class="app-message fail massive-top-gap"><i class="fa-solid fa-circle-xmark"></i> <b>select_settings</b>: <?= $select_settings_message->getMessage(); ?>.</p> <?php
                }
            ?>

            <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>#Contact_Messenger" class="massive-top-gap" id="Contact" method="POST">
                <div>
                    <label>Email <span class="required">(Required)</span>:</label>

                    <div class="icon-container">
                        <input name="email" placeholder="e.g. johnsmith@gmail.com" type="email">

                        <span><i class="fa-solid fa-at"></i></span>
                    </div>
                </div>

                <div class="top-gap">
                    <label>Subject:</label>

                    <div class="icon-container">
                        <input name="subject" placeholder="e.g. Create an Account" type="text">

                        <span><i class="fa-solid fa-folder-open"></i></span>
                    </div>
                </div>

                <div class="top-gap">
                    <label>Message <span class="required">(Required)</span>:</label>

                    <textarea name="message" placeholder="e.g. Lorem ipsum..." rows="15"></textarea>
                </div>

                <div class="text-center small-top-gap">
                    <button name="send_message" type="submit"><i class="fa-solid fa-paper-plane"></i> Send Email</button>
                </div>
            </form>

            <div class="top-gap" id="Contact_Messenger">
                <?php
                    if (
                        isset($_POST['send_message']) &&
                        isset($_POST['email']) &&
                        isset($_POST['subject']) &&
                        isset($_POST['message'])
                    ) {
                        $email = trim(filter_var($_POST['email'], FILTER_SANITIZE_EMAIL));
                        $subject = trim(filter_var($_POST['subject'], FILTER_SANITIZE_SPECIAL_CHARS));
                        $message = trim(filter_var($_POST['message'], FILTER_SANITIZE_SPECIAL_CHARS));
                        $mail = new PHPMailer(true);

                        try {
                            $select_settings = $connect->prepare('SELECT * FROM settings');
                            $select_settings->execute();
                            $setting = $select_settings->fetch();

                            if (empty($email) || empty($message)) {
                                ?> <p class="app-message fail"><i class="fa-solid fa-circle-xmark"></i> Please fill up the fields that are marked as required.</p> <?php
                            } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                                ?> <p class="app-message fail"><i class="fa-solid fa-circle-xmark"></i> Invalid email format.</p> <?php
                            } else {
                                try {
                                    $mail->isSMTP();
                                    $mail->Host = 'smtp.gmail.com';
                                    $mail->SMTPAuth = true;
                                    $mail->Username = $setting['contact_email'];
                                    $mail->Password = '';
                                    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
                                    $mail->Port = 465;
    
                                    $mail->setFrom($email);
                                    $mail->addAddress($setting['contact_email']);
    
                                    $mail->isHTML(true);
                                    $mail->Subject = $subject;
                                    $mail->Body = $message;
    
                                    if ($mail->send()) {
                                        ?> <p class="app-message success"><i class="fa-solid fa-circle-check"></i> Email has been sent.</p> <?php
                                    } else {
                                        ?> <p class="app-message fail"><i class="fa-solid fa-circle-xmark"></i> Failed to send the email.</p> <?php
                                    }
                                } catch (Exception $e) {
                                    ?> <p class="app-message fail"><i class="fa-solid fa-circle-xmark"></i> There was an error sending an email.</p> <?php
                                }
                            }
                        } catch (PDOException $e) {

                        }
                    }
                ?>
            </div>
        </section>

        <section class="col">
            <iframe src="https://www.bing.com/maps/embed?h=1000&w=1000&cp=18.263002104041306~121.70465982042151&lvl=14.825998843504617&typ=d&sty=h&src=SHELL&FORM=MBEDV8" scrolling="no"></iframe>

            <h6>Embedded Bing Map</h6>
        </section>
    </div>
</article>
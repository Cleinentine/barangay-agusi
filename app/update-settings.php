<?php
    include_once 'database.php';

    if (
        !isset($_POST['update_settings']) &&
        !isset($_POST['vision']) &&
        !isset($_POST['mission']) &&
        !isset($_POST['contact_email']) &&
        !isset($_POST['contact_number']) &&
        !isset($_POST['contact_address']) &&
        !isset($_SESSION['id']) &&
        $id['access_level'] == 1
    ) {
        $message = 'Unable to update settings.';
    } else {
        $vision = trim(filter_var($_POST['vision'], FILTER_SANITIZE_SPECIAL_CHARS));
        $mission = trim(filter_var($_POST['mission'], FILTER_SANITIZE_SPECIAL_CHARS));
        $contact_email = trim(filter_var($_POST['contact_email'], FILTER_SANITIZE_EMAIL));
        $contact_number = trim(filter_var($_POST['contact_number'], FILTER_SANITIZE_NUMBER_INT));
        $contact_address = trim(filter_var($_POST['contact_address'], FILTER_SANITIZE_SPECIAL_CHARS));

        if (empty($vision) || empty($mission) || empty($contact_email) || empty($contact_number) || empty($contact_address)) {
            $message = 'All fields are required.';
        } else {
            if (!filter_var($contact_email, FILTER_VALIDATE_EMAIL)) {
                $message = 'Invalid email format.';
            } else if (!is_numeric($contact_number)) {
                $message = 'Contact number should be numeric.';
            } else {
                try {
                    $update_settings = $connect->prepare('UPDATE settings
                        SET vision = :vision,
                            mission = :mission,
                            contact_email = :contact_email,
                            contact_number = :contact_number,
                            contact_address = :contact_address,
                            date_updated = NOW()');
                    $update_settings->bindParam(':vision', $vision);
                    $update_settings->bindParam(':mission', $mission);
                    $update_settings->bindParam(':contact_email', $contact_email);
                    $update_settings->bindParam(':contact_number', $contact_number);
                    $update_settings->bindParam(':contact_address', $contact_address);
                    $update_settings->execute();

                    $message = 'Settings has been updated.';
                } catch (PDOException $e) {
                    $message = $e->getMessage();
                }
            }
        }
    }
?>

<script>
    alert(`<?= $message; ?>`)
    history.back()
</script>
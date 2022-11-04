<?php
    include_once 'database.php';

    if (
        !isset($_POST['add_profile']) &&
        !isset($_POST['last_name']) &&
        !isset($_POST['first_name']) &&
        !isset($_POST['maiden_name']) &&
        !isset($_POST['middle_name']) &&
        !isset($_POST['sex']) &&
        !isset($_POST['civil_status']) &&
        !isset($_POST['birth_date']) &&
        !isset($_POST['place_of_birth']) &&
        !isset($_POST['educational_attainment']) &&
        !isset($_POST['family_planning']) &&
        !isset($_POST['occupation']) &&
        !isset($_POST['house_or_lot_number']) &&
        !isset($_POST['street_address']) &&
        !isset($_POST['district']) &&
        !isset($_SESSION['id']) &&
        $user['access_level'] == 2
    ) {
        $message = 'Unable to add a resident.';
    } else {
        $last_name = trim(filter_var($_POST['last_name'], FILTER_SANITIZE_SPECIAL_CHARS));
        $first_name = trim(filter_var($_POST['first_name'], FILTER_SANITIZE_SPECIAL_CHARS));
        $maiden_name = trim(filter_var($_POST['maiden_name'], FILTER_SANITIZE_SPECIAL_CHARS));
        $middle_name = trim(filter_var($_POST['middle_name'], FILTER_SANITIZE_SPECIAL_CHARS));
        $sex = trim(filter_var($_POST['sex'], FILTER_SANITIZE_SPECIAL_CHARS));
        $civil_status = trim(filter_var($_POST['civil_status'], FILTER_SANITIZE_SPECIAL_CHARS));
        $birth_date = trim(preg_replace("([^0-9/])", "", $_POST['birth_date']));
        $place_of_birth = trim(filter_var($_POST['place_of_birth'], FILTER_SANITIZE_SPECIAL_CHARS));
        $educational_attainment = trim(filter_var($_POST['educational_attainment'], FILTER_SANITIZE_SPECIAL_CHARS));
        $family_planning = trim(filter_var($_POST['family_planning'], FILTER_SANITIZE_SPECIAL_CHARS));
        $occupation = trim(filter_var($_POST['occupation'], FILTER_SANITIZE_SPECIAL_CHARS));
        $house_or_lot_number = trim(filter_var($_POST['house_or_lot_number'], FILTER_SANITIZE_SPECIAL_CHARS));
        $street_address = trim(filter_var($_POST['street_address'], FILTER_SANITIZE_SPECIAL_CHARS));
        $district = trim(filter_var($_POST['district'], FILTER_SANITIZE_NUMBER_INT));

        $sex_array = ['Male', 'Female'];
        $civil_status_array = ['Single', 'Married', 'Separated', 'Divorced', 'Widowed'];

        if (empty($last_name) || empty($first_name) || empty($district)) {
            $message = 'Fill up the fields that are marked as required.';
        } else if (!in_array($sex, $sex_array)) {
            $message = 'Invalid sex value.';
        } else if (!in_array($civil_status, $civil_status_array)) {
            $message = 'Invalid civil status value.';
        } else if (!filter_var($district, FILTER_VALIDATE_INT)) {
            $message = 'District should be numeric.';
        } else {
            if (empty($birth_date)) {
                $birth_date = null;
            }

            try {
                $insert_residents = $connect->prepare('INSERT INTO residents VALUES (
                    "",
                    :user_id,
                    null,
                    :last_name,
                    :first_name,
                    :maiden_name,
                    :middle_name,
                    :sex,
                    :civil_status,
                    :birth_date,
                    :place_of_birth,
                    :educational_attainment,
                    :family_planning,
                    :occupation,
                    :house_or_lot_number,
                    :street_address,
                    :district,
                    NOW(),
                    NOW()
                )');

                $insert_residents->bindParam(':user_id', $id);
                $insert_residents->bindParam(':last_name', $last_name);
                $insert_residents->bindParam(':first_name', $first_name);
                $insert_residents->bindParam(':maiden_name', $maiden_name);
                $insert_residents->bindParam(':middle_name', $middle_name);
                $insert_residents->bindParam(':sex', $sex);
                $insert_residents->bindParam(':civil_status', $civil_status);
                $insert_residents->bindParam(':birth_date', $birth_date);
                $insert_residents->bindParam(':place_of_birth', $place_of_birth);
                $insert_residents->bindParam(':educational_attainment', $educational_attainment);
                $insert_residents->bindParam(':family_planning', $family_planning);
                $insert_residents->bindParam(':occupation', $occupation);
                $insert_residents->bindParam(':house_or_lot_number', $house_or_lot_number);
                $insert_residents->bindParam(':street_address', $street_address);
                $insert_residents->bindParam(':district', $district);
                $insert_residents->execute();

                $message = 'Resident has been successfully added.';
            } catch (PDOException $insert_residents_message) {
                $message = 'insert_residents: ' . $insert_residents_message->getMessage();
            }
        }
    }
?>

<script>
    alert(`<?= $message; ?>`)
    history.back()
</script>
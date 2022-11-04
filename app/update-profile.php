<?php
    include_once 'database.php';

    if (
        !isset($_POST['update_profile']) &&
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
        !isset($_SESSION['id'])
    ) {
        $message = 'Unable to update your account.';
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
                $update_residents = $connect->prepare('UPDATE residents
                    SET last_name = :last_name,
                        first_name = :first_name,
                        maiden_name = :maiden_name,
                        middle_name = :middle_name,
                        sex = :sex,
                        civil_status = :civil_status,
                        birth_date = :birth_date,
                        place_of_birth = :place_of_birth,
                        educational_attainment = :educational_attainment,
                        family_planning = :family_planning,
                        occupation = :occupation,
                        house_or_lot_number = :house_or_lot_number,
                        street_address = :street_address,
                        district = :district,
                        date_updated = NOW()
                    WHERE user_id = :user_id
                ');

                $update_residents->bindParam(':user_id', $id);
                $update_residents->bindParam(':last_name', $last_name);
                $update_residents->bindParam(':first_name', $first_name);
                $update_residents->bindParam(':maiden_name', $maiden_name);
                $update_residents->bindParam(':middle_name', $middle_name);
                $update_residents->bindParam(':sex', $sex);
                $update_residents->bindParam(':civil_status', $civil_status);
                $update_residents->bindParam(':birth_date', $birth_date);
                $update_residents->bindParam(':place_of_birth', $place_of_birth);
                $update_residents->bindParam(':educational_attainment', $educational_attainment);
                $update_residents->bindParam(':family_planning', $family_planning);
                $update_residents->bindParam(':occupation', $occupation);
                $update_residents->bindParam(':house_or_lot_number', $house_or_lot_number);
                $update_residents->bindParam(':street_address', $street_address);
                $update_residents->bindParam(':district', $district);
                $update_residents->execute();

                $message = 'Profile has been successfully updated.';
            } catch (PDOException $update_residents_message) {
                $message = 'update_residents: ' . $update_residents_message->getMessage();
            }
        }
    }
?>

<script>
    alert(`<?= $message; ?>`)
    location.href = '../profile.php';
</script>
<?php
    include_once 'database.php';

    if (
        !isset($_POST['upload_residents_list']) &&
        !isset($_FILES['csv']['name']) &&
        !isset($_SESSION['id']) &&
        $user['access_level'] == 1
    ) {
        $message = 'Unable to upload residents list.';
    } else {
        $csv = $_FILES['csv']['name'];
        $temp_csv = $_FILES['csv']['tmp_name'];

        if (empty($csv)) {
            $message = 'Select a .csv file.';
        } else {
            $file = fopen($temp_csv, 'r');

            fgetcsv($file);

            while (($row = fgetcsv($file, 10000, ';')) !== FALSE) {
                $registration_key = bin2hex(random_bytes(32));

                if (empty($row[6])) {
                    $row[6] = null;
                }
                
                try {
                    $insert_residents = $connect->prepare('INSERT INTO residents VALUES (
                        "",
                        null,
                        :registration_key,
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

                    $insert_residents->bindParam(':registration_key', $registration_key);
                    $insert_residents->bindParam(':last_name', $row[0]);
                    $insert_residents->bindParam(':first_name', $row[1]);
                    $insert_residents->bindParam(':maiden_name', $row[2]);
                    $insert_residents->bindParam(':middle_name', $row[3]);
                    $insert_residents->bindParam(':sex', $row[4]);
                    $insert_residents->bindParam(':civil_status', $row[5]);
                    $insert_residents->bindParam(':birth_date', $row[6]);
                    $insert_residents->bindParam(':place_of_birth', $row[7]);
                    $insert_residents->bindParam(':educational_attainment', $row[8]);
                    $insert_residents->bindParam(':family_planning', $row[9]);
                    $insert_residents->bindParam(':occupation', $row[10]);
                    $insert_residents->bindParam(':house_or_lot_number', $row[11]);
                    $insert_residents->bindParam(':street_address', $row[12]);
                    $insert_residents->bindParam(':district', $row[13]);
                    $insert_residents->execute();

                    $message = 'Residents list has been uploaded.';
                } catch (PDOException $insert_residents_message) {
                    $message = $insert_residents_message->getMessage();
                }
            }

            fclose($file);
        }
    }
?>

<script>
    alert(`<?= $message; ?>`)
    location.href = '../residents.php';
</script>
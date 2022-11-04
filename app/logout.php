<?php

include_once 'database.php';

if (!isset($_POST['logout']) && !isset($_SESSION['id'])) {
    $message = 'Unable to logout.';
} else {
    session_unset();
    session_destroy();

    $message = 'Logging out.';
}

?>

<script>
    alert(`<?= $message; ?>`)
    location.href = '../';
</script>
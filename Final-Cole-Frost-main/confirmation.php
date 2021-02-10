<?php

include 'top.php';

$keyID = '';
$message = '';
$user = array();
$confirmed = false;
$dateJoined = '';
$welcomeMsg = "<script>window.onload = function(){alert('Thank you for signing up with Watado. Have fun!')}</script>";
$warningMsg = "<script>window.onload = function(){alert('Error confirming registration.')}</script>";

if (isset($_GET['q'])) {
    $keyDate = $_GET['q'];
    $keyID = (int) htmlentities($_GET['w'], ENT_QUOTES, "UTF-8");
    $data = array($keyID);

    $userQuery = "SELECT fldEmail, fldDateJoined from tblUser WHERE pmkUserID = ?";
    if ($thisDatabaseReader->querySecurityOk($userQuery, 1)) {
        $cleanUser = $thisDatabaseReader->sanitizeQuery($userQuery);
        $user = $thisDatabaseReader->select($cleanUser, $data);
    }

    if ($user) {
        $dateJoined = $user[0]['fldDateJoined'];
    }

    if (password_verify($dateJoined, $keyDate)) {
        $updateQuery = "UPDATE tblUser SET fldConfirmed = 1 WHERE pmkUserID = ?";
        if ($thisDatabaseReader->querySecurityOk($updateQuery, 1)) {
            $cleanUpdate = $thisDatabaseReader->sanitizeQuery($updateQuery);
            $confirmed = $thisDatabaseWriter->update($cleanUpdate, $data);
        }
    }

    if ($confirmed) {
        $to = $user[0]['fldEmail'];
        $subject = "Watado Registration Complete";
        $message = "Thank you for signing up with Watado. Have fun!";
        mail($to, $subject, $message, array('From' => 'cole.frost@uvm.edu'));

        echo $welcomeMsg;
    } else {
        echo $warningMsg;
    }
}

include 'footer.php';

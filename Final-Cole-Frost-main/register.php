<?php

$thisURL = DOMAIN . PHPSELF;
$mailed = false;

$messageA = '';
$messageB = '';
$messageC = '';


$successMsg = "<script>window.onload = function(){alert('Account successfully created')}</script>";
$errorMsg1 = "<script>window.onload = function(){alert('This email is already registered. Please login or use a different email to register')}</script>";
$errorMsg2 = "<script>window.onload = function(){alert('Invalid email format. Please enter a valid email')}</script>";
$errorMsg3 = "<script>window.onload = function(){alert('Please ensure the passwords match and try again')}</script>";

function getDataPOST($content) {
    if (!isset($content)) {
        $data = "";
    } else {
        $data = trim($content);
        $data = htmlspecialchars($data);
    }
    return $data;
}

if (isset($_POST['btnRegister']) && isset($_POST['email']) && isset($_POST['password'])) {
    if (strcmp($_POST['password'], $_POST['psw-repeat']) == 0) {
        $success = false;
        $emailQuery = "SELECT fldEmail FROM tblUser WHERE fldEmail = ?";
        $addUserQuery = "INSERT INTO `tblUser` (`fldEmail`, `fldPassword`) VALUES (?,?)";

        $userPW = getDataPOST($_POST['password']);
        $hashPW = password_hash($userPW, PASSWORD_DEFAULT);
        $userEmail = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
        $userInput = array($userEmail, $hashPW);

        $cleanEmailQuery = $thisDatabaseReader->sanitizeQuery($emailQuery);
        $matchingEmails = $thisDatabaseReader->select($cleanEmailQuery, $values = array($userEmail));


        if (filter_var($userEmail, FILTER_VALIDATE_EMAIL)) {

            if (!empty($matchingEmails)) {
                echo $errorMsg1;
            } else {
                $cleanActivity = $thisDatabaseReader->sanitizeQuery($addUserQuery);
                $success = $thisDatabaseWriter->insert($cleanActivity, $userInput);
            }
        } else {
            echo $errorMsg2;
        }

        if ($success) {
            echo $successMsg;
        }

        $dateQuery = "SELECT pmkUserID, fldDateJoined FROM tblUser WHERE fldEmail = ?";
        $cleanDate = $thisDatabaseReader->sanitizeQuery($dateQuery);
        $results = $thisDatabaseReader->select($cleanDate, $values = array($userEmail));

        $key1 = password_hash($results[0]['fldDateJoined'], PASSWORD_DEFAULT);
        $key2 = $results[0]['pmkUserID'];

        $messageB .= "<p>Click this link to confirm your registration: </p>";
        $messageB .= '<button style="margin: 5px;"><a href="http:' . DOMAIN . $PATH_PARTS["dirname"] . '/cs148/dev-final/confirmation.php?q=' . $key1 . '&amp;w=' . $key2 . '">Confirm Registration</a></button>';
        $messageB .= "<p>or copy and paste this url into a web browser: ";
        $messageB .= 'http:' . DOMAIN . $PATH_PARTS["dirname"] . '/confirmation.php?q=' . $key1 . '&amp;w=' . $key2 . "</p>";


        $to = $userEmail;
        $headers = "From: cole.frost@uvm.edu\r\n";
        $headers .= "Reply-To: cole.frost@uvm.edu \r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
        $subject = "Watado Registration Confirmation";
        $mailed = mail($to, $subject, $messageB, $headers);
    } else {
        echo $errorMsg3;
    }
}

print '<button type="button" class="common-button register-button" data-toggle="modal" data-target="#regdModal">Register</button>';

print '<section class="modal fade" id="regdModal">';
print '<article class="modal-dialog modal-dialog-centered">';
print '<form action="';
echo htmlspecialchars($_SERVER["PHP_SELF"]);
print'" method="POST" class="register modal-content">';

print '<fieldset class="modal-header">';
print '<h4 class="modal-title">Create Account</h4>';
print '<button type="button" class="close" data-dismiss="modal">&times;</button>';
print '</fieldset>';

print '<fieldset class="modal-body">';
print '<label for="email">Enter Email:</label>';
print '<input type="text" class="form-control"  placeholder="Enter email" name="email" id="email" required>';
print '<label for="password">Enter Password:</label>';
print '<input type="password" class="form-control" placeholder="Enter password" name="password" id="password" required>';
print '<label for="psw-repeat">Re-Enter Password:</label>';
print '<input type="password" class="form-control" placeholder="Re-Enter password" name="psw-repeat" id="psw-repeat" required>';
print '</fieldset>';

print '<fieldset class="modal-footer">';
print '<input type="submit" name="btnRegister" value="Create">';
print '</fieldset>';

print '</form>';
print '</article>';
print '</section>';

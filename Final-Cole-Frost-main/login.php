<?php

$email = '';
$password = '';
$errorMsg = "<script>window.onload = function(){alert('The email address or password is incorrect. Please try again.')}</script>";

if (isset($_POST['btnLogin']) && $_SERVER['REQUEST_METHOD'] == "POST") {

    $email = getDataPOST($_POST['email']);

    $password = getDataPOST($_POST['password']);


    if (isset($email) && isset($password)) {
        $credentialQuery = "SELECT pmkUserID, fldEmail, fldPassword 
                        FROM tblUser
                        WHERE fldEmail = ?";
        $credentials = array($email);

        if ($thisDatabaseReader->querySecurityOk($credentialQuery, 1)) {
            $cleanQuery = $thisDatabaseReader->sanitizeQuery($credentialQuery);
            $credentials = $thisDatabaseReader->select($cleanQuery, $credentials);
        }

        if (strcmp($credentials[0]['fldEmail'], $email) == 0) {
            if (password_verify($password, $credentials[0]['fldPassword'])) {
                session_start();
                $_SESSION['loggedin'] = true;
                $_SESSION['id'] = $credentials[0]['pmkUserID'];
                $_SESSION['email'] = $email;

                header("location: index.php");
            }
        } else {
            echo $errorMsg;
        }
    } else {
        echo $errorMsg;
    }
}

print '<button type="button" class="common-button login-button" data-toggle="modal" data-target="#myModal">Login</button>';
 
print '<section class="modal fade" id="myModal">';
print '<article class="modal-dialog modal-dialog-centered">';
print '<form action="';echo htmlspecialchars($_SERVER["PHP_SELF"]);print'" method="POST" class="modal-content">';

print '<fieldset class="modal-header">';
print '<h4 class="modal-title">Login</h4>';
print '<button type="button" class="close" data-dismiss="modal">&times;</button>';
print '</fieldset>';

print '<fieldset class="modal-body">';
print '<label>Email:</label>';
print '<input type="text" class= "form-control"  placeholder="Enter email" name="email" required value='.$email.'>';
print '<label>Password:</label>';
print '<input type="password" class= "form-control" placeholder="Enter password" name="password" required>';
print '</fieldset>';

print '<fieldset class="modal-footer">';
print '<input type="submit" name="btnLogin" value="Submit">';
print '</fieldset>';

print '</form>';
print '</article>';
print '</section>';
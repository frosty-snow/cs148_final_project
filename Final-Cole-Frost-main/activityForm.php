<?php
include 'top.php';

$successMsg = "<script>window.onload = function(){alert('Successfully updated activity')}</script>";
$failMsg = "<script>window.onload = function(){alert('Unnsuccessful update. Please try again.')}</script>";

$deleteSuccessMsg =  "<script>window.onload = function(){alert('Successfully deleted the activity')}</script>";
$deleteFailMsg =  "<script>window.onload = function(){alert('Unable to delete activity')}</script>";

$attributeSuccessMsg = "<script>window.onload = function(){alert('Successfully added the attributes')}</script>";
$attributeFailMsg = "<script>window.onload = function(){alert('Attributes not added')}</script>";

function getDataPOST($content) {
    if (!isset($content)) {
        $data = "";
    } else {
        $data = trim($content);
        $data = htmlspecialchars($data);
    }
    return $data;
}

# if the user is not logged in - send them to the login screen
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: index.php");
    exit;
} else {
    #  this block will only be entered if the user came from the edit button on profile.php
    if (isset($_POST['editActivity']) && isset($_POST['activityID'])) {
        $existingActivityQuery = "SELECT pmkActivityID, fldName, fldDescription, fldWebsite, fldImage, fldStreetAddress, 
                                        pfkZipCode, fldMapLink, pfkCreatedBy
                                FROM tblActivity  
                                WHERE pmkActivityID = ?";

        if ($thisDatabaseReader->querySecurityOk($existingActivityQuery, 1)) {
            $cleanActivity = $thisDatabaseReader->sanitizeQuery($existingActivityQuery);
            $activity = $thisDatabaseReader->select($cleanActivity, array(getDataPOST($_POST['activityID'])));
            print '<main>';
            print '<form class="activityForm" method="POST" enctype="multipart/form-data">';
            print '<h2> Edit Activity </h2>';
            print '<fieldset class="form-group">';
            print '<input type="hidden" class="form-control" id="activityID" name="activityID" value="' . $_POST['activityID'] . '">';
            print '<label for="fldName">Activity Name</label>';
            print '<input type="text" class="form-control" name="fldName" value="' . $activity[0]['fldName'] . '" autofocus required>';
            print '</fieldset>';

            print '<fieldset class="form-group">';
            print '<label for="fldDescription">Description</label>';
            print '<textarea name="fldDescription" class="form-control" rows="5" id="fldDescription">' . $activity[0]['fldDescription'] . '</textarea>';
            print '</fieldset>';

            print '<fieldset class="form-group">';
            print '<label for="fldWebsite">Website (optional)</label>';
            print '<input type="text" class="form-control" name="fldWebsite" value="' . $activity[0]['fldWebsite'] . '">';
            print '</fieldset>';

            print '<fieldset class="form-group">';
            print '<label for="fldImage">Select an image: </label>';
            print '<input type="file" class="form-control" name="fldImage">';
            print '</fieldset>';

            print '<fieldset class="form-group">';
            print '<label for="fldStreetAddress">Street Address</label>';
            print '<input type="text" class="form-control" name="fldStreetAddress" value="' . $activity[0]['fldStreetAddress'] . '">';
            print '</fieldset>';

            print '<fieldset class="form-group">';
            print '<label for="pfkZipCode">Zip Code</label>';
            print '<input type="text" class="form-control" name="pfkZipCode" value="' . $activity[0]['pfkZipCode'] . '" required>';
            print '</fieldset>';

            print '<fieldset class="form-group">';
            print '<label for="fldMapLink">Google MapsLink (optional)</label>';
            print '<input type="text" class="form-control" name="fldMapLink" value="' . $activity[0]['fldMapLink'] . '">';
            print '</fieldset>';

            # below code gets the attributes to be added to the activity
            $questionQuery = "SELECT pmkQuestionID, fldAttribute1, fldAttribute2 "
                    . "FROM tblQuestion";

            $attributeSQL = "SELECT DISTINCT pmkActivityID, tblAttributes.fldAttribute
            FROM tblActivity LEFT JOIN tblAttributes ON pmkActivityID = pfkActivityID
            WHERE pfkActivityID = ?";

            if ($thisDatabaseReader->querySecurityOk($questionQuery, 0)) {
                $cleanQuery = $thisDatabaseReader->sanitizeQuery($questionQuery);
                $questions = $thisDatabaseReader->select($cleanQuery);

                $cleanAttribute = $thisDatabaseReader->sanitizeQuery($attributeSQL);
                $attributesChecked = $thisDatabaseReader->select($cleanAttribute, array(getDataPOST($_POST['activityID'])));
                $oldAttributes = array($attributesChecked[0]['fldAttribute'], $attributesChecked[1]['fldAttribute'], $attributesChecked[2]['fldAttribute']);

                print '<h3> Select from the below attributes regarding this activity: </h3>' . PHP_EOL;
                $counter = 1;

                # prints the attribute radio buttons
                foreach ($questions as $question) {
                    print '<fieldset class="form-group">';
                    print '<label>';
                    if (strcmp($attributesChecked[$counter - 1]['fldAttribute'], $question['fldAttribute1']) == 0) {
                        print '<input type="radio" name="attribute' . $counter . '" value="' . $question['fldAttribute1'] . '" checked>' .
                                $question['fldAttribute1'];
                    } else {
                        print '<input type="radio" name="attribute' . $counter . '" value="' . $question['fldAttribute1'] . '">' .
                                $question['fldAttribute1'];
                    }
                    print '</label>' . PHP_EOL;

                    print '<label>';
                    if (strcmp($attributesChecked[$counter - 1]['fldAttribute'], $question['fldAttribute2']) == 0) {
                        print '<input type="radio" name="attribute' . $counter . '" value="' . $question['fldAttribute2'] . '" checked>' .
                                $question['fldAttribute2'];
                    } else {
                        print '<input type="radio" name="attribute' . $counter . '" value="' . $question['fldAttribute2'] . '">' .
                                $question['fldAttribute2'];
                    }
                    print '</label>' . PHP_EOL;
                    print '</fieldset>';
                    $counter++;
                }
            }

            print '<fieldset class="form-group">';
            print '<input type="submit" name="editSubmit" value="Edit" class="form-button">';
            print '<input type="submit" name="delete" value="Delete Activity" class="form-button delete-button">';
            print '</fieldset>';
            print '</form>';
            print '</main>';
        }
    } else {
        #  the below is what happens when the Edit button is clicked
        if (isset($_POST['editSubmit'])) {
            #  if a file is chosen for image - enter the below block
            if (!empty($_FILES['fldImage']['name'])) {
                $targetDir = "image/activities/";
                $targetFile = $targetDir . basename($_FILES["fldImage"]['name']);
                $uploadOk = 1;
                $imgFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

                #check if file exists
                if (file_exists($targetFile)) {
                    $uploadOk = 0;
                    print '<h2>File exists</h2>';
                }

                #restrict size
                if ($_FILES['file']['size'] > 16000000) {
                    $uploadOk = 0;
                    print '<h2>File size issue</h2>';
                }

                # allow certain filetypes
                if ($imgFileType != 'jpg' && $imgFileType != 'png' && $imgFileType != 'jpeg') {
                    $uploadOk = 0;
                    print '<h2>Not right file type</h2>';
                }

                if ($uploadOk == 0) {
                    print '<h2>Not allowed to upload</h2>';
                } else {
                    # if the file was successfully moved to the folder on the server - updates the activity
                    if (move_uploaded_file($_FILES["fldImage"]['tmp_name'], $targetFile)) {
                        $updateSQL = "UPDATE tblActivity SET fldName = ?, fldDescription = ?, fldWebsite = ?, fldImage = ?, 
                                fldStreetAddress = ?, pfkZipCode = ?, fldMapLink = ?
                              WHERE pmkActivityID = ?";

                        $values = array(getDataPOST($_POST['fldName']), getDataPOST($_POST['fldDescription']), getDataPOST($_POST['fldWebsite']),
                            getDataPOST($targetFile), getDataPOST($_POST['fldStreetAddress']), getDataPOST($_POST['pfkZipCode']),
                            getDataPOST($_POST['fldMapLink']), getDataPOST($_POST['activityID']));

                        if ($thisDatabaseReader->querySecurityOk($updateSQL, 1)) {
                            $cleanUpdate = $thisDatabaseReader->sanitizeQuery($updateSQL);
                            $updateSuccess = $thisDatabaseWriter->update($cleanUpdate, $values);

                            if ($updateSuccess) {
                                print '<h2>Successfully updated activity with image</h2>';
                            } else {
                                print '<h2>Unnsuccessful update</h2>';
                            }
                        }
                    }
                }
            } else {
                #  if no file is selected to upload enter this block
                $updateSQL = "UPDATE tblActivity SET fldName = ?, fldDescription = ?, fldWebsite = ?, fldStreetAddress = ?,
                                pfkZipCode = ?, fldMapLink = ? 
                              WHERE pmkActivityID = ?";

                $values = array(getDataPOST($_POST['fldName']), getDataPOST($_POST['fldDescription']), getDataPOST($_POST['fldWebsite']),
                    getDataPOST($_POST['fldStreetAddress']), getDataPOST($_POST['pfkZipCode']),
                    getDataPOST($_POST['fldMapLink']), getDataPOST($_POST['activityID']));

                if ($thisDatabaseReader->querySecurityOk($updateSQL, 1)) {
                    $cleanUpdate = $thisDatabaseReader->sanitizeQuery($updateSQL);
                    $updateSuccess = $thisDatabaseWriter->update($cleanUpdate, $values);

                    if ($updateSuccess) {
                        echo $successMsg;
                    } else {
                        echo $failMsg;
                    }
                }
            }

            #  once the fields are updated on the activity - the below starts the process to update the attributes
            $attributeUpdateSQL = "UPDATE `tblAttributes` SET fldAttribute = ? WHERE pfkActivityID = ? AND fldAttribute = ?";

            if ($thisDatabaseReader->querySecurityOk($attributeUpdateSQL, 1, 1)) {
                $cleanAttUpdate = $thisDatabaseReader->sanitizeQuery($attributeUpdateSQL);

                $attributeSQL = "SELECT DISTINCT pmkActivityID, tblAttributes.fldAttribute
                                FROM tblActivity LEFT JOIN tblAttributes ON pmkActivityID = pfkActivityID
                                WHERE pfkActivityID = ?";

                if ($thisDatabaseReader->querySecurityOk($attributeSQL, 1)) {
                    $cleanAttribute = $thisDatabaseReader->sanitizeQuery($attributeSQL);
                    $attributesChecked = $thisDatabaseReader->select($cleanAttribute, array(getDataPOST($_POST['activityID'])));

                    # old used to pinpoint which record to replace with new
                    $oldAttributes = array($attributesChecked[0][1], $attributesChecked[1][1], $attributesChecked[2][1]);
                    $newAttributes = array(getDataPOST($_POST['attribute1']), getDataPOST($_POST['attribute2']), getDataPOST($_POST['attribute3']));

                    $counter = 0;
                    $successArr = array();
                    $success = false;

                    # each attribute must be replaced one at a time - loop does this
                    foreach ($oldAttributes as $oldAttribute) {
                        $values = array($newAttributes[$counter], getDataPOST($_POST['activityID']), $oldAttribute);
                        $successArray[] = $thisDatabaseWriter->update($cleanAttUpdate, $values);
                        $counter++;
                    }

                    # checks if all the values in the array are true or false
                    if (in_array(false, $successArr, true) === false) {
                        $success = true;
                    } else if (in_array(true, $successArr, true) === false) {
                        $success = false;
                    } else {
                        $success = false;
                    }

                    # feedback if things worked or not
                    if ($success) {
                        echo $successMsg;
                    } else {
                        echo $failMsg;
                    }
                }
            }
        } elseif (isset($_POST['delete'])) {
            $deleteSQL = "DELETE FROM tblActivity WHERE pmkActivityID = ?";

            if ($thisDatabaseReader->querySecurityOk($deleteSQL, 1)) {
                $cleanDelete = $thisDatabaseReader->sanitizeQuery($deleteSQL);
                $successDel = $thisDatabaseWriter->delete($cleanDelete, array(getDataPOST($_POST['activityID'])));

                if ($successDel) {
                    echo $deleteSuccessMsg;
                } else {
                    echo $deleteFailMsg;
                }
            }
        } else {
            #  this runs when you access the page directly - so not from hitting an edit button on profile.php
            $createdBy = $_SESSION['id'];

            #  this block runs when you fill out the required fields and hit submit to create a new activity
            if (isset($_POST['fldName']) && isset($_POST['fldDescription']) && isset($_POST['pfkZipCode']) && isset($_POST['btnSubmit'])) {
                $targetDir = "image/activities/";
                $targetFile = $targetDir . basename($_FILES["fldImage"]['name']);
                $uploadOk = 1;
                $imgFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
                $addActivity = false;


                #check if file exists
                if (file_exists($targetFile) && strcmp($targetFile, $targetDir) !== 0) {
                    $uploadOk = 0;
                    print '<h2>File exists</h2>';
                }

                #restrict size
                if ($_FILES['file']['size'] > 16000000) {
                    $uploadOk = 0;
                    print '<h2>File size issue</h2>';
                }

                # allow certain filetypes
                if ($imgFileType != 'jpg' && $imgFileType != 'png' && $imgFileType != 'jpeg' && strcmp($targetFile, $targetDir) !== 0) {
                    $uploadOk = 0;
                    print '<h2>Not right file type</h2>';
                }

                if ($uploadOk == 0) {
                    print '<h2>Not allowed to upload</h2>';
                } else {
                    # if an image file successfully is moved to the server folder enter this block
                    if (move_uploaded_file($_FILES["fldImage"]['tmp_name'], $targetFile) || strcmp($targetFile, $targetDir) == 0) {

                        $insert = "INSERT INTO tblActivity (pmkActivityID, fldName, fldDescription, fldWebsite, 
                    fldImage, fldStreetAddress, pfkZipCode, fldMapLink, pfkCreatedBy, fldCreated, 
                    fldLastModified, fldApproved) VALUES (NULL,?,?,?,?,?,?,?,?, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, 0)";
                        if (strcmp($targetDir, $targetFile) == 0) {
                            $targetFile = '';
                        }
                        $values = array(getDataPOST($_POST['fldName']), getDataPOST($_POST['fldDescription']), getDataPOST($_POST['fldWebsite']),
                            getDataPOST($targetFile), getDataPOST($_POST['fldStreetAddress']), getDataPOST($_POST['pfkZipCode']),
                            getDataPOST($_POST['fldMapLink']), $createdBy);

                        if ($thisDatabaseReader->querySecurityOk($insert, 0)) {
                            $cleanInsert = $thisDatabaseReader->sanitizeQuery($insert);
                            $addActivity = $thisDatabaseWriter->insert($cleanInsert, $values);
                        }

                        # if adding the activity was successful enter this block
                        if ($addActivity) {
                            echo $successMsg;

                            # if the 3 attributes are set - then grab new activity id and setup array to insert attributes
                            if (isset($_POST['attribute1']) && isset($_POST['attribute2']) && isset($_POST['attribute3'])) {
                                $lastID = "SELECT MAX(pmkActivityID) FROM `tblActivity` WHERE pfkCreatedBy = ?";
                                $newActivityID = 0;

                                if ($thisDatabaseReader->querySecurityOk($lastID, 1)) {
                                    $cleanID = $thisDatabaseReader->sanitizeQuery($lastID);
                                    $theActivity = $thisDatabaseReader->select($cleanID, array($createdBy));
                                    $newActivityID = $theActivity[0][0];
                                }

                                $attributeInsert = "INSERT INTO tblAttributes (pfkActivityID, fldAttribute) VALUES (?,?)";

                                $attributes = array($_POST['attribute1'], $_POST['attribute2'], $_POST['attribute3']);
                                $successArray = array();
                                $success = false;

                                # the foreach inserts each attribute separately using the same activity id
                                if ($thisDatabaseReader->querySecurityOk($attributeInsert, 0)) {
                                    $cleanInsert = $thisDatabaseReader->sanitizeQuery($attributeInsert);
                                    foreach ($attributes as $attribute) {
                                        $successArray[] = $thisDatabaseWriter->insert($cleanInsert, array($newActivityID, $attribute));
                                    }
                                }

                                # checks if all the values in the array are true or false
                                if (in_array(false, $successArray, true) === false) {
                                    $success = true;
                                } else if (in_array(true, $successArray, true) === false) {
                                    $success = false;
                                } else {
                                    $success = false;
                                }

                                # feedback if things worked or not
                                if ($success) {
                                    echo $successMsg;
                                } else {
                                    echo $failMsg;
                                }
                            }
                        } else {
                            echo $failMsg;
                        }
                    } else {
                        print '<h2>Unnable to upload file to folder</h2>';
                    }
                }
            }
            #  creates the form for creating a new activity
            ?>
            <main>
                <form class="activityForm" method="POST" enctype="multipart/form-data">
                    <h2> Add Activity </h2>
                    <fieldset class="form-group">
                        <label for="fldName">Activity Name</label>
                        <input type="text" class="form-control" name="fldName" autofocus required>
                    </fieldset>

                    <fieldset class="form-group">
                        <label for="fldDescription">Description</label>
                        <textarea name="fldDescription" class="form-control" rows="5" id="fldDescription" required></textarea>
                    </fieldset>

                    <fieldset class="form-group">
                        <label for="fldWebsite">Website (optional)</label>
                        <input type="text" class="form-control" name="fldWebsite">
                    </fieldset>

                    <fieldset class="form-group">
                        <label for="fldImage">Select an image:</label>
                        <input type="file" class="form-control" name="fldImage">
                    </fieldset>

                    <fieldset class="form-group">
                        <label for="fldStreetAddress">Street Address</label>
                        <input type="text" class="form-control" name="fldStreetAddress">
                    </fieldset>

                    <fieldset class="form-group">
                        <label for="pfkZipCode">Zip Code</label>
                        <input type="text" class="form-control" name="pfkZipCode" required>
                    </fieldset>

                    <fieldset class="form-group">
                        <label for="fldMapLink">Google Maps Link (optional)</label>
                        <input type="text" class="form-control" name="fldMapLink">
                    </fieldset>

                    <?php
                    # below code adds the attributes to be added to the activity
                    $questionQuery = "SELECT pmkQuestionID, fldAttribute1, fldAttribute2 "
                            . "FROM tblQuestion";

                    if ($thisDatabaseReader->querySecurityOk($questionQuery, 0)) {
                        $cleanQuery = $thisDatabaseReader->sanitizeQuery($questionQuery);
                        $questions = $thisDatabaseReader->select($cleanQuery);

                        print '<h3> Select from the below attributes regarding this activity: </h3>' . PHP_EOL;
                        $counter = 1;

                        # prints the attribute radio buttons
                        foreach ($questions as $question) {
                            print '<fieldset class="form-group">';
                            print '<label>';
                            print '<input type="radio" name="attribute' . $counter . '" value="' . $question['fldAttribute1'] . '">' .
                                    $question['fldAttribute1'];

                            print '</label>' . PHP_EOL;
                            print '<label>';
                            print '<input type="radio" name="attribute' . $counter . '" value="' . $question['fldAttribute2'] . '">' .
                                    $question['fldAttribute2'];

                            print '</label>' . PHP_EOL;
                            print '</fieldset>';
                            $counter++;
                        }
                    }
                    ?>
                    <fieldset class="form-group"><input type="submit" name="btnSubmit" value="Submit" class="form-button"></fieldset>
                </form>
            </main>
            <?php
        }
    }
}
include 'footer.php';

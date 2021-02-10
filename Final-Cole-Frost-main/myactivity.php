<?php

include 'top.php';

# Initialize variable
$numOfResult = 0;
$resultsPerPage = 2; //Display 2 activities per page

if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: index.php");
    exit;
} else {

    /*
     * This query is for counting purpose
     * Determines a number of record in the table based on the given condtion
     */
    $countQuery = "SELECT DISTINCT pmkActivityID "
            . "FROM tblActivity "
            . "INNER JOIN tblLocation ON pfkZipCode = pmkZipCode "
            . "WHERE pfkCreatedBy = ?";

    $userID = array($_SESSION['id']);
    $countMyActivities = array();

    if ($thisDatabaseReader->querySecurityOk($countQuery, 1)) {
        $countCreated = $thisDatabaseReader->sanitizeQuery($countQuery);
        $countMyActivities = $thisDatabaseReader->select($countCreated, $userID);


        // Determine which page number a user is currently on - NEEDS TO BE SANITIZE
        if (!isset($_GET['page'])) {
            $page = 1;
        } else {
            $page = $_GET['page'];
        }

        // Determine the sql LIMIT starting number for the reuslts on the displaying page
        $thisPageFirstResult = ($page - 1) * $resultsPerPage;

        $myCreated = "SELECT DISTINCT pmkActivityID, fldName, fldDescription, fldWebsite, fldImage, fldStreetAddress, pfkZipCode, fldTown, fldCounty, fldState, pfkCreatedBy "
                . "FROM tblActivity "
                . "INNER JOIN tblLocation ON pfkZipCode = pmkZipCode "
                . "WHERE pfkCreatedBy = ? "
                . "LIMIT " . $thisPageFirstResult . ',' . $resultsPerPage;


        $userID = array($_SESSION['id']);
        $myActivities = array();

        if ($thisDatabaseReader->querySecurityOk($myCreated, 1)) {
            $cleanCreated = $thisDatabaseReader->sanitizeQuery($myCreated);
            $theCreated = $thisDatabaseReader->select($cleanCreated, $userID);

            print '<main>';
            print '<img src=image/activities.png class="showcase-logo">';

            print '<button id="main" class="openbtn"><a href="./profile.php"> View My Profile </a></button>';
            print '<button id="main" class="openbtn"><a href="./activityForm.php"> Add New Activity </a></button>';

            print '<section class="showcase">';

            foreach ($theCreated as $activity) {
                print '<article class="column">';
                print '<figure>';
                if (empty($activity['fldImage'])) {
                    $imgPath = "image/activities/defaultImageForOurSite.jpg";
                    print '<img src="' . $imgPath . '">';
                } else {
                    print '<img src="' . $activity['fldImage'] . '">';
                }
                print '<figcaption>' . $activity['fldName'] . '</figcaption>';
                print '</figure>';
                print '<p class="address">' . $activity['fldStreetAddress'] . ', ' . $activity['fldCounty'] . ', ' . $activity['fldState'] . ' ' . $activity['pfkZipCode'];
                print '<p class="description">' . $activity['fldDescription'] . '</p>';

                print '<form method="POST" action="./activityForm.php">';
                print '<input type="hidden" id="activityID" name="activityID" value="' . $activity['pmkActivityID'] . '">';
                print '<input type="submit" name="editActivity" class="favor edit" value="Edit">';
                print '</form>';

                print '</article>' . PHP_EOL;
            }

            print '</section>';

            // Determine number of total pages available
            $numberOfPages = ceil(count($countMyActivities) / $resultsPerPage);

            // Display the links to the page
            print '<ul class="pagination justify-content-center">';

            // Display the links to the page
            for ($page = 1; $page <= $numberOfPages; $page++) {
                echo '<li class="page-item"><a class="page-link" href="myactivity.php?page=' . $page . '" class="pagination">' . $page . '</a></li>';
            }
            print '</ul>';

            print '</main>';
        }
    }
}

include 'footer.php';


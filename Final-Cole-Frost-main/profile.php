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
    $countSql = "SELECT DISTINCT pmkActivityID "
            . "FROM tblActivity "
            . "JOIN tblFavorites ON pfkActivityID = pmkActivityID "
            . "INNER JOIN tblLocation ON pfkZipCode = pmkZipCode "
            . "WHERE fldApproved = 1 AND pfkUserID = ?";

    $userID = array($_SESSION['id']);
    $countFavorites = array();

    if ($thisDatabaseReader->querySecurityOk($countSql, 1, 1)) {
        $cleanSQL = $thisDatabaseReader->sanitizeQuery($countSql);
        $countFavorites = $thisDatabaseReader->select($cleanSQL, $userID);

        // Determine which page number a user is currently on - NEEDS TO BE SANITIZE
        if (!isset($_GET['page'])) {
            $page = 1;
        } else {
            $page = $_GET['page'];
        }

        // Determine the sql LIMIT starting number for the reuslts on the displaying page
        $thisPageFirstResult = ($page - 1) * $resultsPerPage;

        print '<main>';
        print '<img src=image/favorities.png class="showcase-logo">';
      
        print '<button id="main" class="openbtn"><a href="./myactivity.php"> View My Activities </a></button>';

        $sql = "SELECT DISTINCT pmkActivityID, fldName, fldDescription, fldWebsite, fldImage, fldStreetAddress, pfkZipCode, fldTown, fldCounty, fldState "
                . "FROM tblActivity "
                . "JOIN tblFavorites ON pfkActivityID = pmkActivityID "
                . "INNER JOIN tblLocation ON pfkZipCode = pmkZipCode "
                . "WHERE fldApproved = 1 AND pfkUserID = ? "
                . "LIMIT " . $thisPageFirstResult . ',' . $resultsPerPage;

        $userID = array($_SESSION['id']);
        $favorites = array();

        if ($thisDatabaseReader->querySecurityOk($sql, 1, 1)) {
            $cleanSQL = $thisDatabaseReader->sanitizeQuery($sql);
            $favorites = $thisDatabaseReader->select($cleanSQL, $userID);
        }

        print '<section class="showcase">';

        foreach ($favorites as $favorite) {
            print '<article class="column">';
            print '<figure>';
            if (empty($favorite['fldImage'])) {
                $imgPath = "image/activities/defaultImageForOurSite.jpg";
                print '<img src="' . $imgPath . '">';
            } else {
                print '<img src="' . $favorite['fldImage'] . '">';
            }
            print '<figcaption>' . $favorite['fldName'] . '</figcaption>';
            print '</figure>';
            print '<p class="address">' . $favorite['fldStreetAddress'] . ', ' . $favorite['fldCounty'] . ', ' . $favorite['fldState'] . ' ' . $favorite['pfkZipCode'];
            print '<p class="description">' . $favorite['fldDescription'] . '</p>';
            print '</article>' . PHP_EOL;
        }

        print '</section>';

        // Determine number of total pages available
        $numberOfPages = ceil(count($countFavorites) / $resultsPerPage);

        // Display the links to the page
        print '<ul class="pagination justify-content-center">';

        // Display the links to the page
        for ($page = 1; $page <= $numberOfPages; $page++) {
            echo '<li class="page-item"><a class="page-link" href="profile.php?page=' . $page . '" class="pagination">' . $page . '</a></li>';
        }
        print '</ul>';

        print '</main>';
    }
}


include 'footer.php';

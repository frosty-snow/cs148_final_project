<?php
include 'top.php';

$userID = 0;
$loggedIn = false;

$favorMsg = "<script>window.onload = function(){alert('Successfully favorited the activity')}</script>";
$unfavorMsg = "<script>window.onload = function(){alert('Successfully unfavorited the activity')}</script>";

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    $userID = $_SESSION['id'];
    $loggedIn = true;
}

# Initialize variable
$numOfResult = 0;
$resultsPerPage = 2; //Display 2 activities per page
// Sanitize function from the text (GET method)
function getGetData($field) {
    if (!isset($_GET[$field])) {
        $data = "";
    } else {
        $data = trim($_GET[$field]);
        $data = htmlspecialchars($data);
    }
    return $data;
}
?>

<main>
    <?php
    // Query to get county name
    $countyQuery = "SELECT DISTINCT fldCounty FROM tblLocation";

    if ($thisDatabaseReader->querySecurityOK($countyQuery, 0)) {
        $countyQuery = $thisDatabaseReader->sanitizeQuery($countyQuery);
        $countyRecord = $thisDatabaseReader->select($countyQuery);
    }

    // Server side sanitization
    $countyName = getGetData('county');

    // Prob not an effiecient way to do this
    if ($countyName == 'Bennington') {
        print '<img src=image/bennington.png alt="county-logo" class="showcase-logo">';
    } elseif ($countyName == 'Windsor') {
        print '<img src=image/windsor.png alt="county-logo" class="showcase-logo">';
    } elseif ($countyName == 'Orange') {
        print '<img src=image/orange.png alt="county-logo" class="showcase-logo">';
    } elseif ($countyName == 'Caledonia') {
        print '<img src=image/caledonia.png alt="county-logo" class="showcase-logo">';
    } elseif ($countyName == 'Windham') {
        print '<img src=image/windham.png alt="county-logo" class="showcase-logo">';
    } elseif ($countyName == 'Chittenden') {
        print '<img src=image/chittenden.png alt="county-logo" class="showcase-logo">';
    } elseif ($countyName == 'Grand Isle') {
        print '<img src=image/grandisle.png alt="county-logo" class="showcase-logo">';
    } elseif ($countyName == 'Franklin') {
        print '<img src=image/franklin.png alt="county-logo" class="showcase-logo">';
    } elseif ($countyName == 'Lamoille') {
        print '<img src=image/lamoille.png alt="county-logo" class="showcase-logo">';
    } elseif ($countyName == 'Addison') {
        print '<img src=image/addison.png alt="county-logo" class="showcase-logo">';
    } elseif ($countyName == 'Washington') {
        print '<img src=image/washington.png alt="county-logo" class="showcase-logo">';
    } elseif ($countyName == 'Rutland') {
        print '<img src=image/rutland.png alt="county-logo" class="showcase-logo">';
    } elseif ($countyName == 'Orleans') {
        print '<img src=image/orleans.png alt="county-logo" class="showcase-logo">';
    } elseif ($countyName == 'Essex') {
        print '<img src=image/essex.png alt="county-logo" class="showcase-logo">';
    }

    print '<button id="main" class="openbtn" onclick="openNav()"> Check Different County </button>';

    // Display each county name as a menu option
    print '<ul id="side-bar" class="side-nav">';
    print '<li><a href="javascript:void(0)" class="closebtn" onclick="closeNav()">x</a></li>';
    print '<li class="menu-helper">Select County</li>';
    foreach ($countyRecord as $county) {
        print '<li class="side-nav-item">';
        print '<a href="showcase.php?county=' . $county[fldCounty] . '">' . $county[fldCounty] . '</a>';
        print '</li>' . PHP_EOL;
    }

    print '</ul>';

    /*
     * This query is for counting purpose
     * Determines a number of record in the table based on the given condtion
     */
    $userSelection = array($countyName);
    $countQuery = "SELECT pmkActivityID "
            . "FROM tblActivity "
            . "LEFT JOIN tblLocation ON pfkZipCode = pmkZipCode "
            . "WHERE fldCounty = ? AND fldApproved = 1";

    // Sanitize and then call select method
    if ($thisDatabaseReader->querySecurityOk($countQuery, 1, 1, 0, 0, 0)) {
        $countQuery = $thisDatabaseReader->sanitizeQuery($countQuery);
        $countSet = $thisDatabaseReader->select($countQuery, $values = $userSelection);

        // Determine which page number a user is currently on - NEEDS TO BE SANITIZE
        if (!isset($_GET['page'])) {
            $page = 1;
        } else {
            $page = $_GET['page'];
        }

        // Determine the sql LIMIT starting number for the reuslts on the displaying page
        $thisPageFirstResult = ($page - 1) * $resultsPerPage;


        // Retrieve selected results from database and display them on page
        $activityquery = "SELECT pmkActivityID, fldName, fldDescription, fldImage, fldStreetAddress, pfkZipCode, fldTown, fldCounty, fldApproved, fldState "
                . "FROM tblActivity "
                . "LEFT JOIN tblLocation ON pfkZipCode = pmkZipCode "
                . "WHERE fldCounty = ? AND fldApproved = 1 "
                . "LIMIT " . $thisPageFirstResult . ',' . $resultsPerPage;

        // Sanitize and then call select method
        if ($thisDatabaseReader->querySecurityOk($activityquery, 1, 1, 0, 0, 0)) {
            $activityQuery = $thisDatabaseReader->sanitizeQuery($activityquery);
            $acitivitySet = $thisDatabaseReader->select($activityQuery, $values = $userSelection);

            print '<section class="showcase">';

            foreach ($acitivitySet as $activity) {
                print '<article class="column">';
                print '<figure>';
                if(empty($activity['fldImage'])) {
                    $imgPath = "image/activities/defaultImageForOurSite.jpg";
                    print '<img src="' . $imgPath . '">';
                } else {
                    print '<img src="' . $activity['fldImage'] . '">';
                }
                print '<figcaption>' . $activity['fldName'] . '</figcaption>';
                print '</figure>';
                print '<p class="address">' . $activity['fldStreetAddress'] . ', ' . $activity['fldCounty'] . ', ' . $activity['fldState'] . ' ' . $activity['pfkZipCode'];
                print '<p class="description">' . $activity['fldDescription'] . '</p>';
                #  the below block only runs if a user is logged in when accessing this page
                if ($loggedIn) {
                    #  if they've hit the favorite button the following executes
                    if (isset($_POST['favorite'])) {
                        $insert = "INSERT INTO tblFavorites (pfkUserID, pfkActivityID) VALUES (?, ?)";

                        $values = array($userID, $_POST['favorite']);
                        $success = false;

                        if ($thisDatabaseReader->querySecurityOk($insert, 0)) {
                            $cleanInsert = $thisDatabaseReader->sanitizeQuery($insert);
                            $success = $thisDatabaseWriter->insert($cleanInsert, $values);
                        }

                        if ($success) {
                            echo $favorMsg;
                        }

                        unset($_POST['favorite']);
                    }

                    #  the below occurs when the unfavorite button has been pressed only
                    if (isset($_POST['unfavorite'])) {
                        $delete = "DELETE FROM tblFavorites
                                     WHERE pfkUserID = ? AND pfkActivityID = ?";

                        $favToDelete = array($userID, $_POST['unfavorite']);
                        $success = false;

                        if ($thisDatabaseReader->querySecurityOk($delete, 1, 1)) {
                            $cleanDelete = $thisDatabaseReader->sanitizeQuery($delete);
                            $success = $thisDatabaseWriter->delete($cleanDelete, $favToDelete);
                        }

                        if ($success) {
                            echo $unfavorMsg;
                        }

                        unset($_POST['unfavorite']);
                    }

                    $sql = "SELECT DISTINCT pmkActivityID
                            FROM tblActivity JOIN tblFavorites ON pfkActivityID = pmkActivityID 
                            INNER JOIN tblLocation ON pfkZipCode = pmkZipCode 
                            WHERE fldApproved = 1 AND pfkUserID = ?";

                    $searchID = array($userID);
                    $favorites = array();

                    if ($thisDatabaseReader->querySecurityOk($sql, 1, 1)) {
                        $cleanSQL = $thisDatabaseReader->sanitizeQuery($sql);
                        $favorites = $thisDatabaseReader->select($cleanSQL, $searchID);
                    } else {
                        #security not passed for sql query
                    }

                    $favIDs = array();
                    foreach ($favorites as $fav) {
                        $favIDs[] = $fav[0];
                    }

                    #  prints a button depending on if already favorited or not
                    if (in_array($activity['pmkActivityID'], $favIDs)) {
                        print '<form method="POST">';
                        print '<button type="submit" class="favor" name="unfavorite" value="';
                        echo $activity['pmkActivityID'];
                        print '">Unfavorite</button>';
                        print '</form>';
                    } else {
                        print '<form method="POST">';
                        print '<button type="submit" class="favor" name="favorite" value="';
                        echo $activity['pmkActivityID'];
                        print '">Favorite</button>';
                        print '</form>';
                    }
                }
                print '</article>' . PHP_EOL;
            }
        }
        print '</section>';

        // Determine number of total pages available
        $numberOfPages = ceil(count($countSet) / $resultsPerPage);

        // Display the links to the page
        print '<ul class="pagination justify-content-center">';

        // Display the links to the page
        for ($page = 1; $page <= $numberOfPages; $page++) {
            echo '<li class="page-item"><a class="page-link pagination" href="showcase.php?county=' . $countyName . '&page=' . $page . '">' . $page . '</a></li>';
        }
        print '</ul>';
    }
    ?>
</main>

<?php include 'footer.php'; ?>

<script>
    // For side menu in showcase page
    function openNav() {
        document.getElementById("side-bar").style.opacity = "1";

        function sidePanel1(x) {
            if (x.matches) {
                document.getElementById("side-bar").style.width = "20%";
                document.getElementById("showcase").style.marginLeft = "20%";
            } else {
                document.getElementById("side-bar").style.width = "15%";
                document.getElementById("showcase").style.marginLeft = "15%";
            }
        }

        function sidePanel2(y) {
            document.getElementById("side-bar").style.opacity = "1";

            if (y.matches) {
                document.getElementById("side-bar").style.width = "100%";
                document.getElementById("showcase").style.marginLeft = "100%";
            } else {
                document.getElementById("side-bar").style.width = "15%";
                document.getElementById("showcase").style.marginLeft = "15%";
            }
        }

        var x = window.matchMedia("(max-width: 1100px)");
        var y = window.matchMedia("(max-width: 900px)");

        sidePanel1(x);
        sidePanel2(y);

        x.addListener(sidePanel1);
        y.addListener(sidePanel2);
    }

    function closeNav() {
        document.getElementById("side-bar").style.width = "0";
        document.getElementById("side-bar").style.opacity = "0";
        document.getElementById("showcase").style.marginLeft = "0";
    }
</script>
</body>
</html>

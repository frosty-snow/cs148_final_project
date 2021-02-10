<?php
include 'top.php';

$activityQuery = "SELECT DISTINCT pmkActivityID, fldName, fldDescription, fldWebsite, fldImage, fldStreetAddress, pfkZipCode, fldTown, fldCounty, fldState
            FROM tblActivity INNER JOIN tblAttributes ON pfkActivityID = pmkActivityID
            INNER JOIN tblLocation ON pfkZipCode = pmkZipCode
            WHERE fldApproved = 1 AND fldAttribute IN (?, ?, ?)
            GROUP BY pmkActivityID
            HAVING COUNT(DISTINCT fldAttribute) = 3";
?>

<main>
    <!-- Bootstrap class - grid template for different screen width -->
    <section class="col-xl-5 col-lg-6 col-md-8 col-sm-10 mx-auto form">
        <?php
        if (isset($_POST['attribute1']) && isset($_POST['attribute2']) && isset($_POST['attribute3']) && isset($_POST['btnSubmit'])) {
            $attributes = array($_POST['attribute1'], $_POST['attribute2'], $_POST['attribute3']);

            $cleanActivity = $thisDatabaseReader->sanitizeQuery($activityQuery);
            $activities = $thisDatabaseReader->select($cleanActivity, $attributes);
            print '<h2 class="showcase-logo"> Recommended Activity </h2>';
            print '<form method="POST">';
            print '<input type="hidden" name="attribute1" value="' . $attributes[0] . '">';
            print '<input type="hidden" name="attribute2" value="' . $attributes[1] . '">';
            print '<input type="hidden" name="attribute3" value="' . $attributes[2] . '">';
            print '<input type="submit" class="openbtn" value="Suggest Another Activity" name="btnSubmit">';
            print '</form>';

            print '<section class="showcase">';
            print '<article class="column">';

            $randActivity = array_rand($activities, 1);
            print '<figure>';
            if (empty($activities[$randActivity]['fldImage'])) {
                $imgPath = "image/activities/defaultImageForOurSite.jpg";
                print '<img src="' . $imgPath . '">';
            } else {
                print '<img src="' . $activities[$randActivity]['fldImage'] . '">';
            }
            print '<figcaption>' . $activities[$randActivity]['fldName'] . '</figcaption>';
            print '</figure>';
            print '<p class="address">' . $activities[$randActivity]['fldStreetAddress'] . ', ' . $activities[$randActivity]['fldCounty'] . ', ' . $activities[$randActivity]['fldState'] . ' ' . $activities[$randActivity]['pfkZipCode'] . '</p>';
            print '<p class="description">' . $activities[$randActivity]['fldDescription'] . '</p>';
            print '<button type="button" class="favor"><a href="./showcase.php?county=Chittenden">View More</a></button>';
        } else {
            $questionQuery = "SELECT pmkQuestionID, fldQuestionText, fldAttribute1, fldAttribute2 "
                    . "FROM tblQuestion";

            if ($thisDatabaseReader->querySecurityOk($questionQuery, 0)) {
                $cleanQuery = $thisDatabaseReader->sanitizeQuery($questionQuery);
                $questions = $thisDatabaseReader->select($cleanQuery);
                print '<form class="quiz-form" id="regForm" action="#" method="POST">' . PHP_EOL;
                print '<h3> Take Our Adventure Quiz </h3>' . PHP_EOL;
                print '<progress id="progress" max="100" value="0"></progress>' . PHP_EOL;
                $counter = 1;

                foreach ($questions as $question) {
                    print '<fieldset class="tab">' . PHP_EOL;
                    print '<h5>' . $question['fldQuestionText'] . '</h5>' . PHP_EOL;
                    print '<label>';
                    print '<input type="radio" name="attribute' . $counter . '" value="' . $question['fldAttribute1'] . '">' .
                            $question['fldAttribute1'];

                    print '</label>' . PHP_EOL;
                    print '<label>';
                    print '<input type="radio" name="attribute' . $counter . '" value="' . $question['fldAttribute2'] . '">' .
                            $question['fldAttribute2'];

                    print '</label>' . PHP_EOL;
                    print '</fieldset>' . PHP_EOL;
                    $counter++;
                }
                print '<button type="button" id="prevBtn" onclick="nextPrev(-1)">Previous</button>' . PHP_EOL;
                print '<button name="next" type="button" id="nextBtn" onclick="nextPrev(1)">Next</button>' . PHP_EOL;
                print '</form>' . PHP_EOL;
                print '</section>' . PHP_EOL;
            }
        }
        ?>
</main>

<?php include 'footer.php'; ?>

<script>
    var currentTab = 0;
    showTab(currentTab);

    // Display the specified tab of the form
    function showTab(n) {
        var x = document.getElementsByClassName("tab");
        x[n].style.display = "block";

        if (n === 0) {
            document.getElementById("prevBtn").style.display = "none";
        } else {
            document.getElementById("prevBtn").style.display = "inline";
        }

        if (n === (x.length - 1)) {
            document.getElementById("nextBtn").innerHTML = "Submit";
        } else {
            document.getElementById("nextBtn").innerHTML = "Next";
            document.getElementById("nextBtn").setAttribute("name", "next");
            document.getElementById("nextBtn").setAttribute("type", "button");
        }
    }

    // Figure out which tab to display
    function nextPrev(n) {
        var x = document.getElementsByClassName("tab");

        if (n === 1 && !validateForm())
            return false;

        x[currentTab].style.display = "none";

        currentTab = currentTab + n;

        if (currentTab >= x.length) {
            document.getElementById("nextBtn").setAttribute("name", "btnSubmit");
            document.getElementById("nextBtn").setAttribute("type", "submit");
            return false;
        }

        showTab(currentTab);
    }

    // Deals with validation of the form fields
    function validateForm() {

        if (currentTab === 0 && ($("input[name='attribute1']:checked").length === 0)) {
            alert('Please select one');
            return false;

        }

        if (currentTab === 1 && ($("input[name='attribute2']:checked").length === 0)) {
            alert('Please select one');
            return false;
        }

        if (currentTab === 2 && ($("input[name='attribute3']:checked").length === 0)) {
            alert('Please select one');
            return false;
        }

        return true;

    }

    // Determine a value of the progression bar
    $(document).ready(function () {
        $("input:radio[name='attribute1']").click(function () {
            $('#progress').val(33);
        })

        $("input:radio[name='attribute2']").click(function () {
            $('#progress').val(66);
        })

        $("input:radio[name='attribute3']").click(function () {
            $('#progress').val(100);
        })

    });
</script>
</body>
</html>


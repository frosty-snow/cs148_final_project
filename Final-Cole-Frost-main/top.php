<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset = "UTF-8">
        <title>'wataDO!'</title>
        <meta name = "author" content = "Cole Frost and Kiwan Lee">
        <meta name = "description" content = "">
        <meta name = "viewport" content = "width=device-width, initial-scale=1">
        <link rel = "stylesheet" href = "css/custom.css" type = "text/css" media="screen">
        <link rel="stylesheet" media="(max-width: 800px)" href="css/custom-tablet.css" type="text/css">
        <link rel="stylesheet" media="(max-width: 600px)" href="css/custom-phone.css" type="text/css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        <script type='text/javascript' src='js/script.js'></script>

        <?php
        // ####################################################################
        // inlcude all libraries. 
        // #####################################################################
        print '<!-- begin including libraries -->';

        include 'lib/constants.php';

        include LIB_PATH . '/Connect-With-Database.php';

        print '<!-- libraries complete-->';
        ?>
    </head>

    <!-- ######################    Start of Body    ########################## -->

    <?php
    print '<body id="' . PATH_PARTS['filename'] . '">';
    session_start();
    include 'nav.php';
    
    print PHP_EOL;
    
    include 'header.php';

    ?>
<?php
// ###############################################################
//
// Set up database connection
// see lib constants.php for constant values
//
print '<!-- make Database connections -->';

require_once(BIN_PATH . '/Database.php');

// use this for SELECT statements
$thisDatabaseReader = new Database(DATABASE_READER, DATABASE_READER_PWD, DATABASE_NAME);

// use this for INSERT and UPDATE statements
$thisDatabaseWriter = new Database(DATABASE_WRITER, DATABASE_WRITER_PWD, DATABASE_NAME);

print '<!-- Database connections complete -->';
?>
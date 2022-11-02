<?php include "../CMS_TEMPLATE/includes/db.php"?>
<?php require "../CMS_TEMPLATE/includes/header.php"?>
<?php require_once "admin/functions1.php"?>
<?php
var_dump( loggedInUserId());
if(userLikedThisPost(29))
{
    echo "user liked it";
}
else{
    echo "user unlinked it";
}
?>
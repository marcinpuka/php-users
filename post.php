<?php
// This page handles the message post
// It also displays the form if creating a new thread
include ('header.php');

if($_SERVER['REQUEST_METHOD'] == 'POST') { // Handle the form

    // Language id is in the session
    // Validate thread id ($tid), which may not be present:
    if (isset($_POST['tid']) && filter_var($_POST['tid'], FILTER_VALIDATE_INT, array('min_rage' => 1)) ){
        $tid = $_POST['tid'];
    } else {
        $tid = FALSE;
    }

    // If there's no thread id, a subject must be provided:
    if (!$tid && empty($_POST['subject'])){
        $subject = FALSE;
        echo '<p class="bg-danger">Please enter a subject for this post.</p>';
    } elseif (!$tid && !empty($_POST['subject'])) {
        $subject = htmlspecialchars(strip_tags($_POST['subject']));
    } else { // Thread id, no need for subject
        $subject = TRUE;
    }

    // Validate the body:
    if (!empty($_POST['body'])){
        $body = htmlentities($_POST['body']);
    } else {
        $body = FALSE;
        echo '<p class="bg-danger">Please enter a body for this post.</p>';
    }

    if ($subject && $body) { // OK!

        // Add the message to the database ...

        if (!$tid){ // Create a new thread
            $q = "INSERT INTO threads (lang_id, user_id, subject) VALUES ({$_SESSION['lid']}, {$_SESSION['user_id']}, '" . mysqli_real_escape_string($dbc, $subject) . "')";

            $r = mysqli_query($dbc, $q);
            if (mysqli_affected_rows($dbc) == 1){
                $tid = mysqli_insert_id($dbc);
            } else {
                echo '<p class="bg-danger">Your post could not be handled due to a system error.</p>';
            }
        } // No $tid

        if ($tid){ // Add this to the replies table:
            $q = "INSERT INTO posts (thread_id, user_id, message, posted_on) VALUES ($tid, {$_SESSION['user_id']}, '". mysqli_real_escape_string($dbc, $body) . "', UTC_TIMESTAMP())";
            $r = mysqli_query($dbc, $q);

            if (mysqli_affected_rows($dbc) == 1){
                echo '<p class="bg-success">Your post has been entered.</p>';
            } else {
                echo '<p class="bg-danger">Your post could not be handled due to a system error.</p>';
            } // Valid $tid
        }
    } else {
            include('post_form.php');
    }
} else {
        include ('post_form.php');
}

include ('footer.php');
?>

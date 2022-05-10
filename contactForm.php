<?php

include './config.php';
include './contactFormHelper.php';

// Instantiate the variables we will use
$errors = [];
$fields = [];

// Check for empty submission
if(!empty($_POST)) {

    //Validate phrase
    if(strval($_POST['human']) !== 'Hi There.') {
        $errors[] = 'That is not the correct phrase!';
    }

    //Validate the email address given
    if(!empty($_POST['email']) && ! filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Not a valid email address';
    }

    //Perform the field listing
    foreach($field_values as $key) {
        $fields[$key] = $_POST[$key];
    }

    // Validate field data
    foreach($fields as $field => $data) {
        if(empty($data)) {
            $errors[] = 'Please enter your' . $fields;
        }
    }

    //Check and process
    if(empty($errors)) {
        $sent = mail($email_address, $subject, $fields['message']);
    }
}
?>
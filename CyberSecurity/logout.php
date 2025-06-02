<?php
session_start();
session_unset();
session_destroy();

// Redirect to register page with success message
header("Location: register.php?message=logout_success");
exit;

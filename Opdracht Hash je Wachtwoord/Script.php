<?php
// Simulated in-memory database storage
$database = [];

echo "=== REGISTRATION SYSTEM ===\n";

// 1. Password input and user registration (Interactive user input)
$email = readline("Enter your email address: ");
$password = readline("Enter your password: ");
$passwordConfirm = readline("Confirm your password: ");

try {
    // Check for empty input
    if (empty($email) || empty($password) || empty($passwordConfirm)) {
        throw new Exception("All fields are required. Please do not leave any field empty.");
    }

    // Check whether both passwords match (2x password input)
    if ($password !== $passwordConfirm) {
        throw new Exception("The passwords do not match. Please try again.");
    }

    // Prevent duplicate registration (e.g., checking if email already exists)
    if (isset($database[$email])) {
        throw new Exception("This email address is already registered.");
    }

    // Hash the password securely (using password_hash with automatic salt)
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    if ($hashedPassword === false) {
        throw new Exception("Failed to generate password hash.");
    }

    // Store the hash in the simulated database
    $database[$email] = $hashedPassword;
    echo "\n[SUCCESS] Registration complete! Your password has been securely hashed.\n\n";

} catch (Exception $e) {
    // Handle registration errors and inform the user
    echo "\n[REGISTRATION ERROR] " . $e->getMessage() . "\n\n";
    exit; // Stop script execution on registration failure
}


echo "=== LOGIN SYSTEM ===\n";

// 3. Password Verification (Asking the user again for credentials)
$loginEmail = readline("Enter your email to log in: ");
$loginPassword = readline("Enter your password: ");

try {
    // Check for empty input during login
    if (empty($loginEmail) || empty($loginPassword)) {
        throw new Exception("Both email and password are required for login.");
    }

    // Check whether the user exists
    if (!isset($database[$loginEmail])) {
        throw new Exception("Invalid email or password.");
    }

    // Verify the password against the stored hash
    if (password_verify($loginPassword, $database[$loginEmail])) {
        echo "\n[SUCCESS] Login successful! Welcome back, " . $loginEmail . ".\n";
    } else {
        throw new Exception("Invalid email or password.");
    }

} catch (Exception $e) {
    // Handle login verification errors and inform the user
    echo "\n[LOGIN ERROR] " . $e->getMessage() . "\n";
}
?>
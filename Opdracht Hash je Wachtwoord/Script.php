<?php
// Simulated in-memory database
$database = [];

function registreerGebruiker($email, $wachtwoord, $wachtwoordBevestiging) {
    try {
        // Check for empty input
        if (empty($email) || empty($wachtwoord) || empty($wachtwoordBevestiging)) {
            throw new Exception("Alle velden moeten ingevuld zijn.");
        }

        // Check whether both passwords match
        if ($wachtwoord !== $wachtwoordBevestiging) {
            throw new Exception("De ingevoerde wachtwoorden komen niet overeen.");
        }

        // Prevent duplicate registration
        global $database;
        if (isset($database[$email])) {
            throw new Exception("Dit e-mailadres is al geregistreerd.");
        }

        // Hash the password securely
        $gehashteWachtwoord = password_hash($wachtwoord, PASSWORD_DEFAULT);
        if ($gehashteWachtwoord === false) {
            throw new Exception("Het genereren van de hash is mislukt.");
        }

        // Store the hash in the database
        $database[$email] = $gehashteWachtwoord;

        return "Registratie succesvol! Je wachtwoord is veilig opgeslagen.";

    } catch (Exception $e) {
        return "Fout bij registratie: " . $e->getMessage();
    }
}

function logIn($email, $wachtwoord, $database) {
    try {
        // Check for empty login fields
        if (empty($email) || empty($wachtwoord)) {
            throw new Exception("Vul zowel je e-mailadres als wachtwoord in.");
        }

        // Check whether the user exists
        if (!isset($database[$email])) {
            throw new Exception("Onjuist e-mailadres of wachtwoord.");
        }

        // Verify the password against the stored hash
        if (password_verify($wachtwoord, $database[$email])) {
            return "Inloggen gelukt! Welkom terug.";
        } else {
            throw new Exception("Onjuist e-mailadres of wachtwoord.");
        }

    } catch (Exception $e) {
        return "Fout bij inloggen: " . $e->getMessage();
    }
}

// Example execution
echo registreerGebruiker("test@example.com", "Geheim123!", "Geheim123!") . "\n";
echo logIn("test@example.com", "Geheim123!", $database) . "\n";
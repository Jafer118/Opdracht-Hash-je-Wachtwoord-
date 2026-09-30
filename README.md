# Password Hashing Project

This project demonstrates how to securely hash and verify passwords in PHP using `password_hash()` and `password_verify()`.

## How it works
- A user registers with an email and password.
- The password is checked for empty input and matching confirmation.
- The password is hashed with `password_hash()`.
- The hash is stored in an in-memory database.
- On login, the entered password is checked against the stored hash using `password_verify()`.

## Installation
Make sure PHP is installed on your system.

Run:

```bash
php Script.php
```

## Expected output
```text
Registratie succesvol! Je wachtwoord is veilig opgeslagen.
Inloggen gelukt! Welkom terug.
```

## Questions
### Can the original password be recovered from the hash?
No. A hash is a one-way function. It is not possible to reverse it to get the original password.

### Does `password_hash()` use a salt?
Yes. PHP automatically uses a random salt when hashing passwords with `password_hash()`. This makes password storage much more secure.

## Notes
This project is a simple simulation. In a real system, the data would normally be saved in a database such as MySQL.

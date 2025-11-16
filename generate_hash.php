<?php

$password_plain = 'jodi2401';

$password_hashed = password_hash($password_plain, PASSWORD_DEFAULT);

echo "Password Plain: " . $password_plain . "\n";
echo "Password Hash: " . $password_hashed . "\n";

<?php
// Read data from text files into arrays
$firstNames = file('data/first_names.txt', FILE_IGNORE_NEW_LINES);
$lastNames = file('data/last_names.txt', FILE_IGNORE_NEW_LINES);
$domains = file('data/domains.txt', FILE_IGNORE_NEW_LINES);
$streetNames = file('data/street_names.txt', FILE_IGNORE_NEW_LINES);
$streetTypes = file('data/street_types.txt', FILE_IGNORE_NEW_LINES);

// Combine hotmail and com into "hotmail.com" in the domains array
$domains = array_map(function ($domain) {
    return str_replace(['hotmail', 'com'], ['hotmail.com', ''], $domain);
}, $domains);

// Shuffle the arrays to ensure randomness
shuffle($firstNames);
shuffle($lastNames);
shuffle($domains);
shuffle($streetNames);
shuffle($streetTypes);

// Initialize an empty array to store customer data
$customers = [];

// Generate data for 25 customers
for ($i = 0; $i < 25; $i++) {
    $firstName = array_pop($firstNames);
    $lastName = array_pop($lastNames);
    $domain = array_pop($domains);
    $streetName = array_pop($streetNames);
    $streetType = array_pop($streetTypes);

    // Create a random email address
    $email = $firstName . '.' . $lastName . '@' . $domain;

    // Create a random address
    $address = $streetName . ':' . $streetType;

    // Append customer data to the array
    $customers[] = "$firstName:$lastName:$address:$email";
}

// Output the customer data as an HTML table
echo "<table border='1'>";
echo "<tr><th>First Name</th><th>Last Name</th><th>Address</th><th>Email</th></tr>";
foreach ($customers as $customer) {
    list($firstName, $lastName, $address, $email) = explode(':', $customer);
    echo "<tr><td>$firstName</td><td>$lastName</td><td>$address</td><td>$email</td></tr>";
}
echo "</table>";

// Write customer data to a text file
file_put_contents('output.txt', implode("\n", $customers));
?>
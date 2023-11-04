<?php
$host = "mac_mysql_host";
$user = "mac_mysql_user";
$pass = "mac_mysql_password";
$database = "SuperStore";

$conn = new mysqli($host, $user, $pass, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Function to generate SQL insert statements
function generateInsert($table, $columns, $values) {
    return "INSERT INTO `$table` ($columns) VALUES ($values);";
}

// Insert data into the 'address' table
for ($i = 1; $i <= 150; $i++) {
    // Generate random data for address fields
    $street = "Street $i";
    $city = "City $i";
    $state = "State $i";
    $zip = "ZIP $i";
    
    $columns = "`street`, `city`, `state`, `zip`";
    $values = "'$street', '$city', '$state', '$zip'";
    echo generateInsert("address", $columns, $values) . "\n";
}

// Insert data into the 'customer' table
for ($i = 1; $i <= 100; $i++) {
    // Generate random data for customer fields
    $firstName = "First Name $i";
    $lastName = "Last Name $i";
    $email = "email$i@example.com";
    $phone = "555-555-000$i";
    $addressId = rand(1, 150); // Random address_id
    
    $columns = "`first_name`, `last_name`, `email`, `phone`, `address_id`";
    $values = "'$firstName', '$lastName', '$email', '$phone', $addressId";
    echo generateInsert("customer", $columns, $values) . "\n";
}

// Insert data into the 'order' table
for ($i = 1; $i <= 350; $i++) {
    $customerId = rand(1, 100); // Random customer_id
    $addressId = rand(1, 150); // Random address_id
    
    $columns = "`customer_id`, `address_id`";
    $values = "$customerId, $addressId";
    echo generateInsert("order", $columns, $values) . "\n";
}

// Insert data into the 'product' table
for ($i = 1; $i <= 750; $i++) {
    // Generate random data for product fields
    $productName = "Product $i";
    $description = "A wonder $productName for you to enjoy";
    $weight = rand(1, 20); // Random weight between 1 and 20
    $baseCost = rand(10, 200); // Random base cost between 10 and 200
    
    $columns = "`product_name`, `description`, `weight`, `base_cost`";
    $values = "'$productName', '$description', $weight, $baseCost";
    echo generateInsert("product", $columns, $values) . "\n";
}

// Insert data into the 'warehouse' table
for ($i = 1; $i <= 25; $i++) {
    $warehouseName = "Warehouse $i";
    $addressId = rand(1, 150); // Random address_id
    
    $columns = "`name`, `address_id`";
    $values = "'$warehouseName', $addressId";
    echo generateInsert("warehouse", $columns, $values) . "\n";
}

// Insert data into the 'order_item' table
for ($i = 1; $i <= 550; $i++) {
    $orderId = rand(1, 350); // Random order_id
    $productId = rand(1, 750); // Random product_id
    $quantity = rand(1, 10); // Random quantity between 1 and 10
    $price = rand(10, 200); // Random price between 10 and 200
    
    $columns = "`order_id`, `product_id`, `quantity`, `price`";
    $values = "$orderId, $productId, $quantity, $price";
    echo generateInsert("order_item", $columns, $values) . "\n";
}

// Insert data into the 'product_warehouse' table
for ($i = 1; $i <= 1250; $i++) {
    $productId = rand(1, 750); // Random product_id
    $warehouseId = rand(1, 25); // Random warehouse_id
    
    $columns = "`product_id`, `warehouse_id`";
    $values = "$productId, $warehouseId";
    echo generateInsert("product_warehouse", $columns, $values) . "\n";
}
php generate_data.php > data.sql
$conn->close();
?>
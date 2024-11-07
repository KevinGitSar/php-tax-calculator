<?php 

// Form validation.
if(empty($_POST["username"])){
    die("Username is required!");
}

if(!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)){
    die("A valid email is required!");
}

if(strlen($_POST["password"]) < 8){
    die("Password must be atleast 8 characters long!");
}

if(! preg_match("/[a-z]/i", $_POST["password"])){
    die("Password must contain atleast 1 letter!");
}

if(! preg_match("/[0-9]/", $_POST["password"])){
    die("Password must contain atleast 1 number!");
}

if($_POST["password"] !== $_POST["confirm_password"]){
    die("Passwords must match!");
}

$hashedPassword = password_hash($_POST["password"], PASSWORD_DEFAULT);


// // Get database connection.
// $mysqli = require __DIR__ . "/database.php";

// // Prepare insert statement.
// $sql = "INSERT INTO user (email, username, password)
//         VALUES (?, ?, ?)";

// // Initialize the statement with the database.
// $statement = $mysqli->stmt_init();

// // Prepare the statement.
// if (! $statement->prepare($sql)){
//     die("SQL Error: " . $mysqli->error);
// };

// // Bind parameters to the statement.
// $statement->bind_param("sss", 
//                     $_POST["email"], 
//                     $_POST["username"], 
//                     $hashedPassword);

// // Execute Insert statement to the database.
// if($statement->execute()){
//     echo "Sign up was successful!";
// } else {
//     if($mysqli->errorno === 1062){
//         die("Email is already taken.");
//     } else {
//         die($mysqli->error . " " . $mysqli->errorno);
//     }
// };


// Get database (PDO ver.) connection similar to above.
$pdo = require __DIR__ . "/database.php";

// Prepare the SQL statement
$sql = "INSERT INTO user (email, username, password) VALUES (:email, :username, :password)";

try {
    // Prepare statement and bind parameters
    $statement = $pdo->prepare($sql);
    $statement->bindParam(':email', $_POST["email"]);
    $statement->bindParam(':username', $_POST["username"]);
    $statement->bindParam(':password', $hashedPassword);

    // Execute the statement
    $statement->execute();

    echo "Sign up was successful!";
} catch (PDOException $e) {
    // Check for duplicate email error
    if ($e->errorInfo[1] == 1062) {
        die("Email is already taken.");
    } else {
        die("SQL Error: " . $e->getMessage());
    }
}
<!-- <?php
// include "connection.php";



// if (isset($_GET["id"]) || '') {
//     $id = $_GET["id"];


//     function getUserById($con, $id)
//     {

//         $query = "SELECT * FROM `users` WHERE `id`=$id";
//         $result = mysqli_query($con, $query);
//         if ($result->num_rows > 0) {
//             return ["success" => true, "data" => $result->fetch_assoc()];
//             echo $result->fetch_assoc()["sabi_no"];

//         } else {
//             return ["success" => false, "message" => "User Not Found"];
//         }
//     }
//     header("Content-Type: application/json");
//     echo json_encode(getUserById($con, $id));
// }
?> -->

<?php
$conn = mysqli_connect("localhost", "root", "", "mydb");

if (mysqli_connect_error()) {
    echo ' Failed';
}

$jsonInput = file_get_contents("php://input");
$data = json_decode($jsonInput, true);

// Check if JSON was decoded properly
if (!$data) {
    echo json_encode(["success" => false, "message" => "Invalid JSON data received"]);
    exit();
}


if (!isset($data['email']) || !isset($data['password'])) {
    echo json_encode(["success" => false, "message" => "Email and password are required"]);
    exit();
}
$email = $data['email'];
$password = $data['password'];

function userLogin($conn, $email, $password)
{

    $query = "SELECT * from `singin` WHERE `email` = '$email' AND `password`='$password'";
    $result = mysqli_query($conn, $query);
    if ($result->num_rows > 0) {
        return ["sucess" => true, "data" => $result->fetch_assoc()];
        echo $result->fetch_assoc()["username"];

    } else {
        return ["success" => false, "message" => "User Not Found"];
    }

}
header("Content-Type: application/json");
echo json_encode(userLogin($conn, $email, $password));


?>

<!-- 

<?php

// $conn = mysqli_connect("localhost", "root", "", "mydb");

// if (!$conn) {
//     die(json_encode(["success" => false, "message" => "Database connection failed"]));
// }

// // Check if email and password are set
// if (!isset($_POST['email']) || !isset($_POST['password'])) {
//     echo json_encode(["success" => false, "message" => "Email and password are required"]);
//     exit();
// }

// $email = $_POST['email'];
// $password = $_POST['password'];

// function userLogin($conn, $email, $password)
// {
//     // Use prepared statements to prevent SQL injection
//     $query = "SELECT * FROM `singin` WHERE `email` = ? AND `password` = ?";
//     $stmt = $conn->prepare($query);
//     $stmt->bind_param("ss", $email, $password);
//     $stmt->execute();
//     $result = $stmt->get_result();

//     if ($result->num_rows > 0) {
//         return ["success" => true, "data" => $result->fetch_assoc()];
//     } else {
//         return ["success" => false, "message" => "User Not Found"];
//     }
// }

// header("Content-Type: application/json");
// echo json_encode(userLogin($conn, $email, $password));

// ?>
//  json_encode(userLogin($conn, $email, $password));

?>
-->
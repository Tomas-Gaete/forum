<?php
require_once('../../config.php');
require_once("$CFG->libdir/formslib.php");
require_once(__DIR__ . '/locallib.php');
require_once(__DIR__ ."dbconfig.php")
?>


<script>
function submitAnswer(event) {
    event.preventDefault();

    var forum_id = event.currentTarget.getAttribute('forum_id');
    var answer = document.getElementById('answer ').value;

    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'input_data', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
            console.log(xhr.responseText); // Handle the response here
        }
    };

    var params = 'forumId=' + encodeURIComponent(forumId) + '&inputData=' + encodeURIComponent(inputData);
    xhr.send(params);
}
</script>
<?php

$dbHost = 'localhost'; // or your database host
$dbUser = 'moodle'; // your database username
$dbPass = 'moodle'; // your database password
$dbName = 'input_data'; // your database name
$conn = new mysqli($dbHost, $dbUser, $dbPass, $dbName);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $forum_id = $_POST['forum_id'];
    $answers = $_POST['answer'];

    // Perform your validation here

    // Insert into database
    $query = "INSERT INTO input_data (forum_id, data) VALUES (?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("is", $forum_id, $answers);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        echo "Data added successfully";
    } else {
        echo "Error adding data";
    }

    $stmt->close();
    $conn->close();
}

?>
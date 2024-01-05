<?php
require_once('../../config.php');
require_once("$CFG->libdir/formslib.php");
require_once(__DIR__ . '/locallib.php');
require_once(__DIR__ . "/db/dbconfig.php"); // Ensure this path is correct

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $forum_id = isset($_POST['forum_id']) ? $_POST['forum_id'] : '';
    $answer = isset($_POST['answer']) ? $_POST['answer'] : '';

    // Perform your validation here

    // Insert into database
    $query = "INSERT INTO mdl_input_data (forum_id, data) VALUES (?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("is", $forum_id, $answer);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        echo "Data added successfully";
    } else {
        echo "Error adding data";
    }

    $stmt->close();
    $conn->close();
    exit;
}
?>

<!--<script>
function submitAnswer(event) {
    event.preventDefault();

    var forum_id = event.currentTarget.getAttribute('forum_id'); // Updated to match HTML attribute
    var answer = document.getElementById('answer').value;

    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'forum_answers.php', true); // Pointing to the current PHP script
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
            console.log(xhr.responseText); // Handle the response here
        }
    };

    var params = 'forum_id=' + encodeURIComponent(forum_id) + '&answer=' + encodeURIComponent(answer);
    xhr.send(params);
}
</script>-->


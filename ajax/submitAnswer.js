document.addEventListener('DOMContentLoaded', (event) => {
    var submitButton = document.getElementById('submitAnswerButton');
    if (submitButton) {
        submitButton.addEventListener('click', submitAnswer);
    }
});

function submitAnswer(event) {
    event.preventDefault();

    var forumId = event.currentTarget.getAttribute('name'); // Change forum_id to name
    var inputData = document.getElementById('answer').value; // Remove space after 'answer'

    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'forum_answers.php', true); // Change 'mdl_input_data' to 'forum_answers.php'
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
            console.log(xhr.responseText); // Handle the response here
        }
    };

    var params = 'forum_id=' + encodeURIComponent(forumId) + '&answer=' + encodeURIComponent(inputData); // Change forumId to forum_id
    xhr.send(params);
}
export default submitAnswer();

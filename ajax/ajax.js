// ajax.js
function submitAnswer(event) {
    event.preventDefault();

    var forumId = event.currentTarget.getAttribute('forum_id');
    var inputData = document.getElementById('answer ').value;

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
export default submitAnswer();
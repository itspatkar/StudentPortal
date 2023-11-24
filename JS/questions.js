
function addQNA() {
    var container = document.getElementById("questionDetails");
    var row = document.createElement("li");
    row.className = "question-row";
    row.innerHTML = `
            <input type="text" name="question[]" placeholder="Question" required>
            <button type="button" onclick="removeQNA(this)">Remove</button><br><br>
        `;
    container.appendChild(row);
}

function removeQNA(button, q_id) {
    var XHR = new XMLHttpRequest();
    XHR.open('GET', 'PHP/set_question_status.php?question_id=' + q_id);
    XHR.send();
    XHR.onload = function () {
        if (XHR.status != 200) {
            alert(XHR.statusText);
        } else {
            var row = button.parentElement;
            row.parentElement.removeChild(row);
        }
    }
}

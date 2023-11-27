
function addQNA() {
    var XHR = new XMLHttpRequest();
    XHR.open('GET', 'PHP/load_skills.php');
    XHR.send();
    XHR.onload = function () {
        if (XHR.status != 200) {
            alert(XHR.statusText);
        } else {
            var container = document.getElementById("questionDetails");
            var row = document.createElement("li");
            row.className = "question-row";
            row.innerHTML = XHR.response + `&nbsp;<input type="text" name="question[]" placeholder="Question" required>
            <button type="button" class="btn btn-danger btn-sm" onclick="removeQNA(this)">Remove</button><br><br>
        `;
            container.appendChild(row);
        }
    }
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


function selectQuestions() {
    const x = document.getElementsByClassName("skills");

    console.log(x);

    // for (let i = 0; i < x.length; i++) {
    //     alert(x[i].value);
    // }

    var XHR = new XMLHttpRequest();
    XHR.open('GET', 'PHP/load_questions.php?skill_id=' + x);
    XHR.send();
    XHR.onload = function () {
        if (XHR.status != 200) {
            alert("error");
        } else {
            document.getElementById("questions").innerHTML = XHR.response;
        }
    }
}

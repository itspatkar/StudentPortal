
function selectCity() {
    var state_id = document.getElementById('state').value;
    var XHR = new XMLHttpRequest();
    XHR.open('GET', 'PHP/get_cities.php?state_id=' + state_id);
    XHR.send();
    XHR.onload = function () {
        if (XHR.status != 200) {
            alert("error");
        } else {
            document.getElementById("city").innerHTML = XHR.response;
        }
    }
}

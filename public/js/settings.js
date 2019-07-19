function executeActions() {
    var console = document.getElementById("console-log");
    console.innerHTML += "Premještanje svih studenata u mentore </br>";
    var response = callFunction("setStudentsAsMentors");

    response.then(function (response) {
        console.innerHTML += response;
        console.innerHTML += "</br>------------------------------------------</br>";

        console.innerHTML += "Brisanje tablice studenti </br>";
        var truncateResponse = callFunction("truncateStudentsTable");
        truncateResponse.then(function (truncateResponse) {
            console.innerHTML += truncateResponse;
            console.innerHTML += "</br>------------------------------------------</br>";

            console.innerHTML += "Postavljanje svih mentora u status neaktivan</br>";
            var mentorsResponse = callFunction("setMentorsAsInactive");
            mentorsResponse.then(function (mentorsResponse) {
                console.innerHTML += mentorsResponse;
                console.innerHTML += "</br>------------------------------------------</br>";

                console.innerHTML += " Postavljanje broj studenata kod mentora na nulu</br>";
                var resetCountResponse = callFunction("resetStudentCount");
                resetCountResponse.then(function (resetCountResponse) {
                    console.innerHTML += resetCountResponse;
                    console.innerHTML += "</br>------------------------------------------</br>";

                    console.innerHTML += " Slanje emaila mentorima</br>";
                    var emailResponse = callFunction("sendEmailsToMentors");
                    emailResponse.then(function (emailResponse) {
                        console.innerHTML += emailResponse;
                        console.innerHTML += "</br>------------------------------------------</br>";
                    });
                });
            });
        });
    });
}

function startMatching(){
    var console = document.getElementById("console-log");
    console.innerHTML += "Postavljanje matching na true </br>";
    var response = callFunction("setMatching");
    response.then(function (response) {
        console.innerHTML += response;
        console.innerHTML += "</br>------------------------------------------</br>";
    });
}

function callFunction(api) {
    var promise = new Promise(function (resolve, reject) {
        var request = new XMLHttpRequest();
        request.open('GET', '/admin/settings/' + api, true);

        request.onload = function () {
            if (request.status >= 200 && request.status < 400) {
                // Success!
                var resp = request.responseText;
                resolve(resp);
            } else {
                resolve(request.statusText);
            }
        };

        request.onerror = function () {
            // There was a connection error of some sort
        };

        request.send();
    });
    return promise;
}

function notifyMatch(){
    var console = document.getElementById("console-log");
    console.innerHTML += "Slanje mailova </br>";
    var response = callFunction("notifyMatch");
    response.then(function (response) {
        console.innerHTML += response;
        console.innerHTML += "</br>------------------------------------------</br>";
    });
}

function clearConsole(){
    var console = document.getElementById("console-log");
    console.innerHTML = "";
}
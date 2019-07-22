@extends('master.admin')

@section('header') Email - Veliki Buraz @endsection

@section('content')
    <form>
        <div class="row">
            <div class="alert alert-primary" role="alert" id="alert" style="display: none">
                <p id="alert-message"></p>
            </div>
        </div>
        <div class="row">
            <h5> Kome želiš poslati? </h5>
            <div id="radio-recipients" class="col-md-9">
                <input type="radio" name="mentori" value="mentori"> Mentori<br>
                <input type="radio" name="studenti" value="studenti"> Studenti<br>
                <input type="radio" name="svi" value="svi"> Svi<br>
            </div>
            <div class="col-md-3 mt-2 text-right">
                <button type="button" onclick="checkInput();" class="btn btn-dark">Pošalji
                </button>
            </div>
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
        </div>
        <div class="form-group">
            <label for="email-subject">Predmet poruke</label>
            <input type="text" class="form-control" id="email-subject">
        </div>
        <div class="form-group">
            <label for="email-header">Zaglavlje poruke</label>
            <input type="text" class="form-control" id="email-header">
        </div>
        <div class="form-group">
            <div class="message-body">
                <label for="email-message">Poruka</label>
                <textarea name="email-message" id="email-message"> </textarea>
            </div>
        </div>
    </form>
    <script>
        function checkInput() {
            var radios = document.querySelectorAll("input[type=radio]");
            var _token = document.querySelectorAll("input[type=hidden]")[0].value;
            var message = document.getElementsByTagName("textarea")[0].value;
            var messageSubject = document.getElementById("email-subject").value;
            var messageHeader = document.getElementById("email-header").value;
            var valid = false;
            var selectedRadio = false;
            for (var i = 0, length = radios.length; i < length; i++) {
                if (radios[i].checked) {
                    selectedRadio = radios[i].value;
                    valid = true;
                    break;
                }
            }
            if (!valid) {
                alert("Kome želiš poslati?")
            }
            if (message.length === 0) {
                alert("Unesi poruku");
                valid = false;
            }

            if (messageSubject.length === 0) {
                alert("Unesi predmet poruke");
                valid = false;
            }

            if (messageHeader.length === 0) {
                alert("Unesi zaglavlje poruke");
                valid = false;
            }

            if (valid) {
                var alertMessage = document.getElementById("alert-message");
                alertMessage.innerText = "Slanje mailova...";
                var promise = new Promise(function (resolve, reject) {
                    var data = JSON.stringify({
                        'message': message,
                        'recipients': selectedRadio,
                        'subject': messageSubject,
                        'header': messageHeader
                    });

                    var request = new XMLHttpRequest();
                    request.onreadystatechange = function () {
                        if (request.readyState === 4 && request.status === 200) {
                            resolve(request.responseText);
                        }
                    };
                    request.open('POST', '/admin/email/sendEmail', true);
                    request.setRequestHeader('Content-Type', 'application/json; charset=UTF-8');
                    request.setRequestHeader("X-CSRF-TOKEN", _token);
                    request.send(data);
                });
                promise.then(function (response) {
                    alertMessage.innerText = "Mailovi poslani";
                    showAlert();
                });
            }
        }

        function showAlert() {
            var fadeTarget = document.getElementById("alert");
            fadeTarget.style.display = "block";
            fadeTarget.style.opacity = 1;
            setTimeout(function () {
                var fadeEffect = setInterval(function () {
                    if (!fadeTarget.style.opacity) {
                        fadeTarget.style.opacity = 1;
                    }
                    if (fadeTarget.style.opacity > 0) {
                        fadeTarget.style.opacity -= 0.1;
                    } else {
                        fadeTarget.style.display = "none";
                        clearInterval(fadeEffect);
                    }
                }, 50);
            }, 2 * 1000);
        }
    </script>
@endsection
<html>
<head>
    <?php
    /**
     * Created by PhpStorm.
     * User: mmoer
     * Date: 5/23/2018
     * Time: 11:45 AM
     */
    include("../template/header.php");
    ?>
</head>

<body>
<div class="container-fluid pl-0 pr-0">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <?php
            include('../template/nav.php');
            ?>
        </nav>
    <div class="container-fluid">
        <div class="row mt-sm-4 ml-sm-2 mr-sm-2">
            <div class="col-lg-12">
                <h1>Registreren</h1>
                <hr/>
            </div>
        </div>
    <div class="row mx-auto">
        <div class="col-sm-6">
            <!--Registratie form-->
            <form name="signupForm" id="signUpForm" action="../POST/signup.php" method="post">
                <div class="form-group">
                    <label for="naam">Naam</label>
                    <input type="text" name="naam" class="form-control" id="naam" placeholder="John Doe" required>
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" class="form-control" id="email" placeholder="Voorbeeld@info.nl" required>
                    <small id="emailexisterror" class="redLetters">Dit email adres is al geregistreerd. Vul een ander email adres in of vraag je wachtwoord aan.</small>
                </div>

                <div class="form-group">
                    <label for="signUpPassword">Wachtwoord</label>
                    <input type="password" name="password" class="form-control" id="signUpPassword" placeholder="Wachtwoord" required>
                </div>

                <div class="form-group">
                    <label for="signUpconfirmPassword">Herhaal Wachtwoord</label>
                    <input type="password" name="confirmPassword" class="form-control" id="signUpconfirmPassword" placeholder="Wachtwoord" required>
                    <small id="passwordError" class="redLetters">Het wachtwoord is niet hetzelfde.</small>
                </div>

                <div class="form-check">
                    <input type="checkbox" class="form-check-input" name="avgCheck" id="avgCheck" required>
                    <label class="form-check-label" for="avgCheck">Accepteerd u dat wij uw gegevens mogen opslaan.(Deze zullen wij niet delen met een derde.)</label>

                </div>
                <button onclick="submitForm()" type="button" class="btn btn-primary">Registreren</button>
            </form>
        </div>
    </div>
</div>
<script>
    //variables
    var checkEmailDone = false;
    var checkPasswordDone = false;

    //alles uitvoeren als het document geladen is
    $(document).ready(function(){
        $("#passwordError").hide();
        $("#emailexisterror").hide();
    });

    //input velden checken
    function submitForm()
    {

        $("#passwordError").hide();
        $("#emailexisterror").hide();


        if(checkEmailDone !== true || checkPasswordDone !== true)
        {
            //bestaat de email al
            $.post("../POST/email_check.php", {
                    email: $("#email").val()
                },
                function (result)
                {
                    if (result == 1) {
                        $("#emailexisterror").show();
                        checkEmailDone = false;
                    }
                    else {
                        checkEmailDone = true;
                    }

                });


            //wachtwoorden vergelijken
            if ($("#signUpPassword").val() !== $("#signUpconfirmPassword").val())
            {
                $("#passwordError").show();
                checkPasswordDone = false;
            }
            else
            {
                checkPasswordDone = true;
            }

        }

        if(checkEmailDone === true && checkPasswordDone === true)
        {
            $("#signUpForm").submit();
        }


    }
</script>
</body>
</html>

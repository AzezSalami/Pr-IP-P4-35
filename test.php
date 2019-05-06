<?php
?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0"/>
    <title>test</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

</head>
<body class="px-5 mt-5 container border bg-light">
<header>
</header>
<main>

    <div class="container">
        <!-- Button to Open the Modal -->
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
            join
        </button>

        <!-- The Modal -->
        <div class="modal fade bd-example-modal-lg" id="myModal">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">Create your Google Account</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body">
                        <div class="">
                            <div class="row">
                                <div class="col">
                                    <h1 style="font-size:15px">Create your Google Account</h1>
                                    <div class="form-row">
                                        <form method="POST" action="" name="registreren">
                                            <div class="row">
                                                <div class="col">
                                                    <label class="invisible" for="Firstname">First name:<span
                                                                class="error">*</span></label>
                                                    <input class="form-control" placeholder="First name" type="text" name="First name"
                                                           id="Firstname" maxlength="20" required><br>
                                                </div>
                                                <div class="col">
                                                    <label class="invisible" for="Lastname">Last name<span
                                                                class="error">*</span></label>
                                                    <input class="form-control" placeholder="Last name" type="text" name="Last name"
                                                           id="Lastname"
                                                           maxlength="20" required><br>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col">
                                                    <label class="invisible" for="Username">Username<span class="error">*</span></label>
                                                    <input class="form-control" placeholder="Username" type="text" name="Username"
                                                           id="Username"
                                                           maxlength="20" required><br>
                                                </div>
                                            </div>
                                            <div> You can use letters, numbers & periods</div>
                                            <br>
                                            <a href="">Use my current email address instead</a><br>
                                            <div class="row">
                                                <div class="col">
                                                    <label class="invisible" for="Password">Password<span class="error">*</span></label>
                                                    <input class="form-control" placeholder="Password" type="password" name="Password"
                                                           id="Password"
                                                           maxlength="50" required><br>
                                                </div>
                                                <div class="col">
                                                    <label class="invisible" for="confirm">confirm<span class="error">*</span></label>
                                                    <input class="form-control" placeholder="confirm" type="password" name="confirm"
                                                           id="confirm"
                                                           maxlength="50" required><br>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col">
                                                    <a href="">Sign in instead</a><br>
                                                </div>
                                                <div class="col">
                                                    <input class="btn btn-primary" type="submit" name="next" value="next">
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>

                                <div class="col">
                                    <img src="https://ssl.gstatic.com/accounts/signup/glif/account.svg" alt="googlefoto">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>

                </div>
            </div>
        </div>

    </div>

</main>
<footer>
    <div>
        &copy; 2018 - 2019
    </div>
</footer>
</body>
</html>
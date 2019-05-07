<header>
    <div class="container-fluid bg-orange py-2">
        <div class="row">
            <div class="col-lg-2">
                <img src="images/ea.png" class="logo my-1 mx-auto d-block" alt="logo">
            </div>
            <div class="col-lg-8 d-flex align-items-center mb-1" >
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="zoeken">
                    <div class="input-group-append " >
                        <button class="btn btn-outline-secondary bg-white" type="button" id="zoekknop">zoeken</button>
                    </div>
                </div>
            </div>
            <div class="col-lg-2 my-auto text-center">
                <button type="button" class="bg-lightblue btn mb-1" data-toggle="modal" data-target="#loginMenu"><i class="fas fa-user"></i> &nbsp; aanmelden</button>
            </div>
        </div>
    </div>
    <nav class="bg-yellow pt-3 ">
        <div class="row">
            <div class="col-lg-2"></div>
            <div class="col-lg-8 mx-2">
                <ul class="nav nav-tabs nav-fill">
                    <?php
                    $pages = ["home" => "homepage.php", "1" => "1.php", "2" => "2.php", "3" => "3.php", "4" => "4.php", "5" => "5.php", "6" => "6.php", "7" => "7.php"];
                    $html = "";
                    foreach ($pages as $page => $link) {
                        $html .= "<li class='nav-item'><a class='nav-link";
                        if (basename(htmlspecialchars($_SERVER["PHP_SELF"])) == basename($link)) {
                            $html .= " currentpage";
                        }
                        $html .= "' href='$link'>$page</a></li>";
                    }
                    echo $html;
                    ?>
                </ul>
            </div>
            <div class="col-lg-2"></div>
        </div>
    </nav>


    <!-- The Modal -->
    <div class="modal fade" id="loginMenu">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">inloggen</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <form method="POST" action="" name="registreren">
                                    <label class="invisible" for="Username">Username<span
                                                class="error">*</span></label>
                                    <input class="form-control" placeholder="Username" type="text"
                                           name="Username"
                                           id="Username"
                                           maxlength="20" required><br>
                                    <label class="invisible" for="Password">Password<span
                                                class="error">*</span></label>
                                    <input class="form-control" placeholder="Password"
                                           type="password" name="Password"
                                           id="Password"
                                           maxlength="50" required><br>

                                    <div class="row">
                                        <div class="col">
                                            <button type="button" class="btn bg-lightblue" data-toggle="modal"
                                                    data-target="#registerMenu">
                                                New account
                                            </button>

                                        </div>
                                        <div class="col">
                                            <input class="btn bg-lightblue" type="submit" name="next"
                                                   value="inloggen">
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- The Modal -->
    <div class="modal fade" id="registerMenu">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <div class="">
                        <div class="row">
                            <div class="col">
                                <h1 style="font-size:15px">Create an account</h1>
                                <div class="form-row">
                                    <form method="POST" action="" name="registreren">
                                        <div class="row">
                                            <div class="col">
                                                <label class="invisible" for="Firstname">First name:<span
                                                            class="error">*</span></label>
                                                <input class="form-control" placeholder="First name" type="text"
                                                       name="First name"
                                                       id="Firstname" maxlength="20" required><br>
                                            </div>
                                            <div class="col">
                                                <label class="invisible" for="Lastname">Last name<span
                                                            class="error">*</span></label>
                                                <input class="form-control" placeholder="Last name" type="text"
                                                       name="Last name"
                                                       id="Lastname"
                                                       maxlength="20" required><br>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <label class="invisible" for="Username">Username<span
                                                            class="error">*</span></label>
                                                <input class="form-control" placeholder="Username" type="text"
                                                       name="regUsername"
                                                       id="regUsername"
                                                       maxlength="20" required><br>
                                            </div>
                                        </div>

                                        <br>
                                        <div class="row">
                                            <div class="col">
                                                <label class="invisible" for="Password">Password<span
                                                            class="error">*</span></label>
                                                <input class="form-control" placeholder="Password" type="password"
                                                       name="regPassword"
                                                       id="regPassword"
                                                       maxlength="50" required><br>
                                            </div>
                                            <div class="col">
                                                <label class="invisible" for="confirm">confirm<span
                                                            class="error">*</span></label>
                                                <input class="form-control" placeholder="confirm" type="password"
                                                       name="confirm"
                                                       id="confirm"
                                                       maxlength="50" required><br>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <input class="btn btn-primary" type="submit" name="next" value="next">
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</header>
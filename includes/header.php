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
                <button type="button" class="bg-lightblue btn mb-1"><i class="fas fa-user"></i> &nbsp; aanmelden</button>
            </div>
        </div>
    </div>
    <nav class="bg-yellow pt-3">
        <ul class="nav nav-tabs justify-content-center">
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
    </nav>

</header>
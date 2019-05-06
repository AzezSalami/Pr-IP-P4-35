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
                <button type="button" class="bg-lightblue btn mb-1">aanmelden</button>
            </div>
        </div>
    </div>
    <nav class="bg-yellow pt-3">
        <ul class="nav nav-tabs justify-content-center">
            <?php
                $pages = ["home" => "homepage.php", "link" => "link.php", "test" => "test.php"];
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
<!--            <li class="nav-item">-->
<!--                <a class="nav-link" href="#">home</a>-->
<!--            </li>-->
<!--            <li class="nav-item">-->
<!--                <a class="nav-link" href="#">Link</a>-->
<!--            </li>-->
<!--            <li class="nav-item">-->
<!--                <a class="nav-link" href="#">Link</a>-->
<!--            </li>-->
<!--            <li class="nav-item">-->
<!--                <a class="nav-link" href="#">link</a>-->
<!--            </li>-->
<!--            <li class="nav-item">-->
<!--                <a class="nav-link " href="#">link</a>-->
<!--            </li>-->
<!--            <li class="nav-item">-->
<!--                <a class="nav-link" href="#">Link</a>-->
<!--            </li>-->
<!--            <li class="nav-item">-->
<!--                <a class="nav-link" href="#">Link</a>-->
<!--            </li>-->
<!--            <li class="nav-item">-->
<!--                <a class="nav-link" href="#">link</a>-->
<!--            </li>-->
        </ul>
    </nav>

</header>
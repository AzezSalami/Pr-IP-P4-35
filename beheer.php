<!DOCTYPE html>
<html lang="en">
<head>
    <?php include 'includes/head.html'; ?>
    <link rel="stylesheet" href="CSS/beheer.css" type="text/css">
</head>
<body class="bg-gray">

<?php
require "includes/header.php";
?>

<main>
    <div class="row">
        <div class="col-lg-2">
        </div>
        <div class="col-lg-8 admin-page mb-5 pb-3">
            <div class="classic-tabs mx-2">
                <ul class="nav nav-tabs nav-justified" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link  active show" id="profile-tab-classic-shadow" data-toggle="tab"
                           href="#profile-classic-shadow"
                           role="tab">Rubrieken bewerken</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="blockuserTab" data-toggle="tab"
                           href="#follow-classic-shadow"
                           role="tab">Gebruiker blokkeren</a>
                    </li>
                </ul>

                <div class="tab-content card">
                    <div class="adminContainer tab-pane fade active show container admin-tab table-responsive text-center"
                         id="profile-classic-shadow"
                         role="tabpanel">
                        <table class="table table-bordered table-sm col-lg mt-3">
                            <thead>
                            <tr>
                                <th scope="col" class="fit"></th>
                                <th scope="col" class="fit">#</th>
                                <th scope="col">Rubrieknaam</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $rubricQuery = $pdo ->prepare("SELECT * FROM TBL_Rubric WHERE super=-1 ");
                            $rubricQuery -> execute();
                            $rubrics = $rubricQuery->fetchAll();
                            foreach ($rubrics as $result) {
                                echo " <tr>
                                      <th scope=\"row\" class=\"fit\"><input type=\"radio\" value=\"" . $result['name'] . "\"
                                                                   name=\"rubricRadio\"></th>
                                     <td class=\"fit\">" . $result['sort_number'] . "</td>
                                     
                                    <td>" . $result['name'] . "</td>
                                   </tr>";
                            }
                            ?>
                            <tr>
                                <th scope="row" class="fit"></th>
                                <td class="inputRubric"><input type="number" name="addRubricNumber"
                                                               placeholder="Positie rubriek">
                                </td>
                                <td class="inputRubric"><input type="text" name="addRubricName"
                                                               placeholder="Naam rubriek"></td>
                            </tr>
                            </tbody>
                        </table>
                        <div class="row pb-2 mb-2">
                            <div class="col-lg admin-buttons text-center">
                                <input type="submit" class="btn mb-1" value="Aanpassen" name="changeRubric">
                                <input type="submit" class="btn mb-1" value="Uitfaseren" name="depracateRubric">
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade admin-tab text-center " id="follow-classic-shadow" role="tabpanel">
                        <form method="POST" name="block">
                            <div class="col-lg-10 input-group mx-auto mt-3">

                                <label for="blockUsername"></label>
                                <input type="text" class="form-control" placeholder="block user" name="blockUsername" id="blockUsername">
                                <div class="input-group-append">
                                    <input class="btn" type="submit" id="blockUser" name="blockUser" value="Block">
                                </div>
                            </div>
                            <div class="text-danger"><?php blockUser()?></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-2">
    </div>
</main>
<div class="fixed-bottom">
    <?php
    include_once "includes/footer.php";
    ?>
</div>
</body>
</html>

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
        <div class="col-lg-8 admin-page pb-4">
            <div class="classic-tabs mt-2 mx-2">
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
                <form method="post">
                    <div class="tab-content card">
                        <div class="adminContainer tab-pane fade active show container admin-tab table-responsive text-center"
                             id="profile-classic-shadow"
                             role="tabpanel">
                            <table class="table table-bordered table-sm col-lg mt-3">
                                <?php
                                echo  "<div class='col ml-1 text-danger'>" . updateRubrics()."</div>";
                                $super = isset($_GET['rubrics']) ? $_GET['rubrics'] : -1;

                                $rubricUpQuery = $pdo->prepare("SELECT super FROM TBL_Rubric WHERE rubric=? ");
                                $rubricUpQuery->execute(array($super));
                                $upRubrics = $rubricUpQuery->fetch()['super'];
                                $up = isset($upRubrics) ? $upRubrics : -1;
                                ?>

                                <thead>
                                <tr>
                                    <th scope="col" class="fit"></th>
                                    <th scope="col" class="fit">#</th>
                                    <th scope="col">Rubrieknaam
                                        <?php
                                        echo "<a  href=\"beheer.php?rubrics=$up\"><i class=\"fas fa-arrow-up\"></i></a>"
                                        ?>

                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $rubricQuery = $pdo->prepare("SELECT * FROM TBL_Rubric WHERE super=?");
                                $rubricQuery->execute(array($super));
                                $rubrics = $rubricQuery->fetchAll();
                                foreach ($rubrics as $result) {
                                    echo " <tr>
                                      <th scope=\"row\" class=\"fit\"><input type=\"radio\" value=\"" . $result['rubric'] . "\"
                                                                   name=\"rubricRadio\"></th>
                                     <td class=\"fit\">" . $result['sort_number'] . "</td> <td>";
                                     if($result['phased_out'] == 1){
                                      echo  "<a class='text-muted'>" . $result['name'] . "</a>" ;
                                    }else{
                                    echo "<a href='beheer.php?rubrics=" . $result['rubric'] . "'>" . $result['name'] . "</a>";
                                    }
                                    echo "</td>
                                   </tr>";
                                }
                                ?>
                                <tr>
                                    <th scope="row"></th>

                                    <td  class="fit">
                                        <label for="editRubricSort_number"></label>
                                        <input type="number" name="editRubricSort_number" id="editRubricSort_number"
                                               placeholder="Positie rubriek">
                                    </td>
                                    <td  class="fit">
                                        <label for="editRubricName"></label>
                                        <input type="text" name="editRubricName" id="editRubricName"
                                               placeholder="Naam rubriek">
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                            <div class="row pb-2 mb-2">
                                <div class="col-lg admin-buttons text-center">
                                    <input type="submit" class="btn mb-1" value="Aanpassen" name="changeRubric">
                                    <input type="submit" class="btn mb-1" value="Uitfaseren" name="phaseOutRubric">
                                    <input type="submit" class="btn mb-1" value="heractiveren" name="reactivateRubric">
                                </div>
                            </div>
                            <table class="table table-bordered table-sm col-lg mt-3">
                                <thead>
                                <tr>
                                    <th scope="col" class="fit"></th>
                                    <th scope="col" class="fit">#</th>
                                    <th scope="col">Rubrieknaam
                                        <?php
                                        echo "<a  href=\"beheer.php?rubrics=$up\"><i class=\"fas fa-arrow-up\"></i></a>"
                                        ?>

                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <th scope="row"></th>

                                    <td class="fit">
                                        <label for="addRubricNumber"></label>
                                        <input type="number" name="addRubricNumber" id="addRubricNumber"
                                               placeholder="Positie rubriek">
                                    </td>
                                    <td
                                            class="fit">
                                        <label for="addRubricName"></label>
                                        <input type="text" name="addRubricName" id="addRubricName"
                                               placeholder="Naam rubriek">
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                            <div class="row pb-2 mb-2">
                                <div class="col-lg admin-buttons text-center">
                                    <input type="submit" class="btn mb-1" value="toevoeg" name="addRubric">
                                </div>
                            </div>
                        </div>
                </form>

                <div class="tab-pane fade admin-tab text-center " id="follow-classic-shadow" role="tabpanel">
                    <form method="POST" name="block">
                        <div class="col-lg-10 input-group mx-auto mt-3">
                            <input type="text" class="form-control" placeholder="gebruikersnaam" name="blockUsername"
                                   id="blockUsername">
                            <div class="input-group-append">
                                <button class="btn" type="submit" id="blockUser" name="blockUser" value="Block">
                                    blokkeer
                                </button>
                            </div>
                        </div>
                        <div class="text-danger"><?php blockUser() ?></div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-2">
    </div>
</main>

<?php
include_once "includes/footer.php";
?>

</body>
</html>


<!--/*    N. Eenink, A. Salami, I. Hamoudi            */-->
<!--/*    M. Vermeulen, D. Haverkamp & J. van Vugt    */-->
<!--/*    HAN ICA HBO ICT - IProject, 13-06-2019      */-->

<?php
require_once "../includes/functions.php";
if(isset($_GET['super'])){
$super = cleanUpUserInput($_GET['super']);

$rubricQuery = $pdo ->prepare("SELECT rubric, [name] FROM TBL_Rubric where super =? AND (phased_out = 0 OR phased_out IS null)");
$rubricQuery -> execute(array($super));

$rubrics = $rubricQuery->fetchAll();
if(!empty($rubrics)) {
    echo "<div class=\"form-group\">
                            <label class=\"d-none\" for=\"rubriek\"></label>
                            <select class=\"form-control\" name=\"rubriek\" id=\"-1\" onchange=\"showRubric(this.value, this)\">
                                <option selected disabled>Rubriek</option>";
    foreach ($rubrics as $result) {
        echo $result["name"];
        echo '<option value="' . (int)$result["rubric"] . '" >' . $result["name"] . ' </option>';
    }
    echo "</select>
                            
                        </div><div></div>";
}}
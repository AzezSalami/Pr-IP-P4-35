

<?php
require_once "../includes/functions.php";
if(isset($_GET['super'])){
$super = cleanUpUserInput($_GET['super']);

$rubricQuery = $pdo ->prepare("SELECT rubric, [name] FROM TBL_Rubric where super =? AND phased_out != 1");
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
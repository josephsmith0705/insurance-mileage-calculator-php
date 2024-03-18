<?php

$title = 'Insurance Mileage Calculator';

require_once 'include/header.php';
require_once 'include/InsuranceMileageCalculator.php';

?>

    <h1>Milage Calculator</h1><br>

    <form action="" method="POST">
        <label for="date">Insurance Start Date:</label>
        <input type="date" id="date" name="startDate"><br>

        <label for="miles">Current Miles:</label>
        <input type="number" id="miles" name="miles"><br>

        <label for="maxMiles">Maximum Mileage:</label>
        <input type="number" id="maxMiles" name="maxMiles"><br>

        <?php
        if(!empty($_POST))
        {
            $errors = InsuranceMileageCalculator::validate($_POST);

            if (empty($errors)) {
                $insuranceMileageData = InsuranceMileageCalculator::calculate($_POST);

                echo '<p>'
                    . 'You have used ' . $insuranceMileageData['milesProgress']
                    . ' of your annual mileage, ' . $insuranceMileageData['yearProgress']
                    . ' through the year. You have ' . $insuranceMileageData['remainingMiles'] . ' miles remaining.'
                    . '</p>';

            } else {
                echo 'Error:<br />';
                foreach ($errors AS $errorMessage) {
                    echo '<p>' . $errorMessage . '</p>';
                }
            }
        }
        ?>

        <button type="submit">Calculate</button>
    </form>

<?php
require_once('include/footer.php');
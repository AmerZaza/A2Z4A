<?php
include 'configuration.php';
include 'admin/connect.php';
include 'includes/functions/functions.php';

$do = isset($_GET['do']) ? $_GET['do'] : 'NULL';


if ($do == 'Model-List') {

	echo '<option value = "">'.getT('Select Models').'</option>'; // value = 0
	if (!empty($_POST['makid'])) {
	$makerID = $_POST['makid'];
	$models = superGet('*','models',"make_id = $makerID");
	foreach ($models as $model) {
		echo '<option value = "'.$model['id'].'">'.$model['Model_Name'].'</option>';
	}
	echo '<option value = "0">'.getT('Other Model').'</option>';
    }



}elseif($do == 'Model-Text'){  

        if (isset($_POST['model']) && $_POST['model'] == 0) {
		?>
			<div class="form-group container">
                    <label class="col-md-12 control-lable"><?php getTE('Other Model'); ?></label>
                    <div class=" col-md-12">
                        <input class="form-control " type="text"   name="model-text">
                        </div>
                    </div>

					<?php
			}


}elseif($do == 'Maker-Text'){  

        if (isset($_POST['maker']) && $_POST['maker'] == 0) {
		?>
			<div class="form-group container">
                    <label class="col-md-12 control-lable"><?php getTE('Other Maker');?></label>
                    <div class=" col-md-12">
                        <input class="form-control " type="text"   name="maker-text">
                        </div>
                    </div>

					<?php
			}

}elseif($do == 'Fuel-Text'){

	if (isset($_POST['fuel']) && $_POST['fuel'] == 0) {
	?>

	<div class="form-group container">
             <label class="col-md-12 control-lable"><?php getTE('Fuel'); ?></label>
        <div class="col-md-12">
            <input class="form-control " type="text"  name="fuel-text">
        </div>
    </div>
	<?php
		}
}

?>
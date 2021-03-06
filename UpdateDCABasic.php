<?php
ob_start();
include 'includes/overall/overallworkheader.php';

$id = $_SESSION['id'];
$namearray = referal($id);
$name = $namearray[0];

if (empty($_POST) === false){
    $required_fields = array ('fname','lname','phone','school','cell','area','dept');
    foreach ($_POST as $key => $value){
    if (empty ($value) && in_array($key, $required_fields)=== true){
      $errors[] = 'Fill in all required fields';      
    }
    }
    if(strlen($_POST['phone']) < 11){
      $errors[] = 'A Valid Phone Number is required';
    }
    if(empty($_POST['phone']) === false && strlen($_POST['phone']) < 11){
      $errors[] = 'A Valid Phone Number is required on the second phone number field';
    }
    if (empty($_POST['email']) === false && filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) === false){
        $errors[]= 'A Valid email address is required';
    }
    if (empty($_POST) === false && empty($errors) === true ){
        $register_data = array(
          'firstname'  => $_POST['fname'],
          'lastname'   => $_POST['lname'],
          'phone'      => $_POST['phone'],
          'phone2'     => $_POST['phone2'],
          'email'      => $_POST['email'],
          'dept'       => $_POST['dept'],
          'cell'       => $_POST['cell'],
          'area'       => $_POST['area'],
          'school'      => $_POST['school'],
          'referral'   => $name     
        );
        update($register_data);
        exit();
    }
    else if(empty($errors) === false){ ?>
    <section id="error" class="card-panel lighten-5 scrollspy">
      <div class="row">
        <div class="col s12 m8 center-align" style="font-size:15px;">
            <?php
            echo output_error($errors);
            ?>
        </div>
      </div>
    </section>
    <?php
    }
}
include 'includes/discipleshiptopmenu.php';
?> 
<div id="workarea" class="col s12 m8 l10 ">
    <div class="card-panel mainwork">
          <span class="black-text">
          <?php
           global $valid;
            if(isset ($_GET['success']) && empty ($_GET['success'])) {
               echo 'You\'ve Successfully Updated DCA Basic Database';
            }
            else if(isset ($_GET['error']) && empty ($_GET['error'])) {
                echo 'Confirm that the Firstname and Phone number inputs are correctly combined';
             }
          ?>
          </span>
    <div id="new_register" class="new_register">
        <form class="new_register-content" method="post" action="">
            <div class="container" style="font-size:18px">
                <h1 style="font-size:40px" id='newreg'>Update DCA Basic</h1>
                <p style="font-size:20px" id="membernote">Please fill in this form to Update DCA Basic Database</p>
                <hr>
                <div class="row">
                <div class=" worker input-field col s12">
                    <input type="text" placeholder="Enter Firstname" name="fname" required>
                </div>
                <div class=" worker input-field col s12">
                    <input type="text" placeholder="Enter Lastname" name="lname">
                </div>
                </div>
                <div class="row">
                <div class=" worker input-field col s12">
                    <input type="number" placeholder="Enter Phone Number" name="phone" required>
                </div>
                <div class=" worker input-field col s12">
                    <input type="number" placeholder="Enter Another Phone Number if any..." name="phone2">
                </div>
                </div>
                <div class="row">
                <div class=" worker input-field col s12">
                    <input type="text" placeholder="Enter Email" name="email">
                </div>
                <div class=" worker input-field col s12">
                    <?php $cell = getCell();?>
                    <select class="browser-default" name="cell" required>
                        <option value=""disabled selected>Cell</option>
                        <?php foreach ($cell as $option):?>
                        <option value="<?php echo $option->cellname;?>"><?php echo $option->cellname;?></option>
                        <?php endforeach;?> 
                    </select>  
                </div>
                <div class="row">
                <div class=" worker input-field col s12">
                    <?php $area = getarea();?>
                    <select class="browser-default" name="area" required>
                    <option value=""disabled selected>Area</option>
                    <?php foreach ($area as $option): ?>
                    <option value="<?php echo $option->area;?>"><?php echo $option->area;?></option>
                    <?php endforeach;?> 
                    </select>  
                    </div> 
                    <div class=" worker input-field col s12">
                    <?php $dept = getdept();?>
                    <select class="browser-default" name="dept" required>
                    <option value=""disabled selected>Department</option>
                    <?php foreach ($dept as $option): ?>
                    <option value="<?php echo $option->dept;?>"><?php echo $option->dept;?></option>
                    <?php endforeach;?> 
                    </select>  
                    </div>
                </div> 
                <div class="row">
                    <div class="input-field col s12" >
                        <input type="text" class="datepicker" name="school" placeholder="Enter Date Graduted" required>
                    </div>
                </div>
                    <button type="submit" class="new_register">Update</button>
                </div>
            </form>
        </div>
   </div>
</div>
</section>
<?php 
include 'includes/script.php';
ob_end_flush();
?>

                   
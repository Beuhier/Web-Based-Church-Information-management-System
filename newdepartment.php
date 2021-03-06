<?php 
ob_start();
include 'includes/overall/overallworkheader.php';
$id = $_SESSION['id'];
$namearray = referal($id);
$name = $namearray[0];
$rol = $namearray[1];
$area = $namearray[2];

if (empty($_POST) === false){
      if (empty ($_POST['dept'])){
        $errors[] = 'Fill in required field';
      }
      if(dept_exists($_POST['dept'],'newdept_tb') === true){
          $errors[] = 'Department Already exists';}

      if (empty($_POST) === false && empty($errors) === true ){
          $register_data = array(
            'dept'  => $_POST['dept'],
            'referal'   => $name   
          );
          register($register_data);
          header('Location: newdepartment.php?success');
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
      </section> <?php
      }
}
include 'includes/workmenutop.php'; 
?>
<div id="workarea" class="col s12 m8 l10 ">
<div class="card-panel mainwork">
    <span class="black-text right" style='font-size:20px'> 
    <?php
        if(isset ($_GET['success']) && empty ($_GET['success']) ){
        echo 'You\'ve Successfully Registered a Department';
        }
        ?>
    </span>
    <div id="new_register" class="new_register">
  <form class="new_register-content" method="post" action="">
    <div class="container" style="font-size:18px">
        <h1 style="font-size:40px" id='newreg'>New Department</h1>
        <p style="font-size:20px" id="membernote">Please fill in this form to register a New Department</p>
        <hr>
        <div class="row">
          <div class=" worker input-field col s12">
            <input type="text" placeholder="Enter Name Of Department" name="dept" required>
          </div>
        </div>
        
             <button type="submit" class="new_register">Register</button>
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
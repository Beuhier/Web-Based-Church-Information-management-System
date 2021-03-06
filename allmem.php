<?php 
include 'includes/overall/overallworkheader.php';
include 'includes/workmenutop.php'; 
$month = ['January','February','March','April','May','June','July','August','September','October','November','December'];
?>
<script>
function showperson(value,name,id) {
    event.preventDefault();
    if (name ==="") {
        document.getElementById("txtHint").innerHTML = " ";
        document.getElementById("txtHint").style.display = "none";        
        return;
        }       
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200 && id == undefined ) {
                document.getElementById("txtHint").innerHTML = xmlhttp.responseText; 
            }
            else if (xmlhttp.readyState == 4 && xmlhttp.status == 200 && value == undefined ) {
                document.getElementById("person_details").innerHTML = xmlhttp.responseText; 
            }
        };

        if (name === "gender"){
        xmlhttp.open("GET","includes/loadTable.php?gender="+document.viewperson.gender.value,true);
        }
        else if (name === "marital"){
        xmlhttp.open("GET","includes/loadTable.php?marital="+document.viewperson.marital.value,true);          
        }
        else if (name === "dept"){
        xmlhttp.open("GET","includes/loadTable.php?dept="+document.viewperson.dept.value,true);          
        }
        else if (name === "discipleship"){
        xmlhttp.open("GET","includes/loadTable.php?discipleship="+document.viewperson.discipleship.value,true);          
        }
        else if (name === "member"){
        xmlhttp.open("GET","includes/loadTable.php?member="+document.viewperson.member.value,true);          
        }
        else if (name === "birth"){
        xmlhttp.open("GET","includes/loadTable.php?birth="+document.viewperson.birth.value,true);          
        }
        else if (name === 'view'){
        document.getElementById("modaldetails").style.display = "block";    
        xmlhttp.open("GET","includes/fetch.php?id="+id,true);    
        }
        xmlhttp.send();
}
</script>

<div id="workarea" class="col s12 m8 l10 ">
  <div class="card-panel mainwork">
    <div id="new_register" class="new_register">
    <form id="viewperson" class="new_register-content" name="viewperson">
       <div class="container" style="font-size:18px">
        <h1 style="font-size:30px" id='newreg'>View All Members</h1>
        <p style="font-size:20px" id="membernote">Search for all Members by:</p>
        <hr>   
        <div class="row">
          <div class=" worker input-field col m4 s12">
          <select onchange="showperson(this.value,this.name)" class="browser-default" name="gender">
                  <option value="" disabled selected>Gender</option>
                  <option value="male">Male</option>
                  <option value="female">Female</option>
                  </select>
          </div>
          <div class=" worker input-field col m4 s12">
          <select onchange="showperson(this.value,this.name)" class="browser-default" name="marital">
                  <option value="" disabled selected>Marital Status</option>
                  <option value="single">Single</option>
                  <option value="married">Married</option>
                  <option value="divorced">Divorced</option>
                  <option value="separated">Separated</option>
                  </select>
          </div>
          <div class=" worker input-field col m4 s12">
            <?php $dept = getdept();?>
            <select onchange="showperson(this.value,this.name)" class="browser-default" name="dept" >
            <option value=""disabled selected>Department</option>
            <?php foreach ($dept as $option): ?>
            <option value="<?php echo $option->dept;?>"><?php echo $option->dept;?></option>
            <?php endforeach;?> 
            </select>   
        </div>
        <div class="row">
        <div class=" worker input-field col m4 s12">
            <select onchange="showperson(this.value,this.name)" class="browser-default" name="discipleship">
                  <option value="" disabled selected>Discipleship</option>
                  <option value="dcabasic">DCA Basic</option>
                  <option value="mat">DCA Maturity</option>
                  <option value="enc">Encounter</option>
                  <option value="discipleship">Discipleship</option>
                  <option value="school_of_ministry">School Of Ministry</option>
                  <option value="dli">DLI</option> 
                  </select>
          </div>
          <div class=" worker input-field col m4 s12">
            <select  onchange="showperson(this.value,this.name)" class="browser-default" name="birth" >
            <option value=""disabled selected>Birth Month</option>
            <?php foreach ($month as $option): ?>
            <option value="<?php echo $option?>"><?php echo $option?></option>
            <?php endforeach;?> 
            </select> 
          </div>
          <div class="worker input-field col m4 s12">
                <button onclick="showperson(this.value,this.name)" value="all" name="member" class="all">All</button>
          </div>
        </div>
      </div>
    </form>
    <br>
    <div id="txtHint"></div> 
  </div>
  </div>
</div>
</section>
<?php 
include 'includes/modal.php';
include 'includes/script.php'; ?>   
    
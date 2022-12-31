<?php

session_start();
require_once("Conexion.php");
require_once("Crud.php");

//TEACHER INSERT
if (isset($_POST["name"])){
    $_SESSION['name']=$_POST["name"];
    $_SESSION['surname']=$_POST["surname"];
    $_SESSION['telephone']=$_POST["telephone"];
    $_SESSION['nif']=$_POST["nif"];
    $_SESSION['email']=$_POST["email"];
}

//TEACHER MODIFY
if(isset($_SESSION["name"])&&!(empty($_SESSION["name"]))&&$_POST['accion']=='teacher_modify'){
    $id_teacher=$_SESSION['id_teacher'];
    $name=$_SESSION['name'];
    $surname=$_SESSION['surname'];
    $telephone=$_SESSION['telephone'];
    $nif=$_SESSION['nif'];
    $email=$_SESSION['email'];
    $crud = new Crud("teachers");
    $crud->where("id_teacher","=",$id_teacher)->update([
        "id_teacher"=>$id_teacher,  
        "name"=>$name,
        "surname"=>$surname,
        "telephone"=>$telephone,
        "nif"=>$nif,
        "email"=>$email
    ]);
    if(!(isset($_SESSION['trueModificacion']))&&($_SESSION['trueModificacion']==false)){
        $_SESSION['trueModificacion']=true;
    }else{
        $_SESSION['trueModificacion']=false;
    }
    header("Location: ../view/admin.php");
}

//TEACHER DELETE
if(isset($_SESSION["name"])&&!(empty($_SESSION["name"]))&&$_POST['accion']=='teacher_delete'){
   $crud = new Crud("teachers");
   $id_teacher=$_SESSION['id_teacher'];
   $crud->where("id_teacher","=",$id_teacher)->delete();
   $_SESSION['trueDelete']=true;
   header("Location: ../view/admin.php");
}

//COURSE INSERT
if (isset($_POST["name"])){
    $_SESSION['name']=$_POST["name"];
    $_SESSION['description']=$_POST["description"];
    $_SESSION['date_start']=$_POST["date_start"];
    $_SESSION['date_end']=$_POST["date_end"];
    $_SESSION['active']=$_POST["active"];
}

//COURSE MODIFY
if(isset($_POST['name'])&&!(empty($_POST['name']))&&$_POST['accion']=='course_modify'){
    $id_course=$_SESSION['id_course'];
    $name=$_POST['name'];
    $description=$_POST['description'];
    $inicio=$_POST['date_start'];
    $fin=$_POST['date_end'];
    $activo=$_POST['active'];
    $crud = new Crud("courses");
    $crud->where("id_course","=",$id_course)->update([
        "id_course"=>$id_course,  
        "name"=>$name,
        "description"=>$description,
        "date_start"=>$date_start,
        "date_end"=>$date_end,
        "active"=>$active
    ]);
    if(!(isset($_SESSION['trueModificacion']))&&($_SESSION['trueModificacion']==false)){
        $_SESSION['trueModificacion']=true;
    }else{
        $_SESSION['trueModificacion']=false;
    }
    header("Location: ../view/admin.php");
}

//COURSE DELETE
if(isset($_POST['name'])&&!(empty($_POST['name']))&&$_POST['accion']=='course_delete'){
    $crud = new Crud("courses");
    $id_course =$_SESSION['id_course'];
    $crud->where("id_course","=",$id_course)->delete();
    $_SESSION['trueDelete']=true;
    header("Location: ../view/admin.php");
}

//CLASS INSERT
if (isset($_POST["name"])){
    $_SESSION['name']=$_POST["name"];
    $_SESSION['id_teacher']=$_POST["id_teacher"];
    $_SESSION['id_course']=$_POST["id_course"];
    $_SESSION['id_schedule']=$_POST["id_schedule"];
    $_SESSION['color']=$_POST["color"];
}

//CLASS MODIFY
if(isset($_POST['name'])&&!(empty($_POST['name']))&&$_POST['accion']=='class_modify'){
    $id_class=$_SESSION['id_class'];
    $name=$_POST['name'];
    $description=$_POST['id_teacher'];
    $inicio=$_POST['id_course'];
    $fin=$_POST['id_schedule'];
    $activo=$_POST['color'];
    $crud = new Crud("courses");
    $crud->where("id_class","=",$id_class)->update([
        "id_class"=>$id_class,  
        "name"=>$name,
        "id_teacher"=>$id_teacher,
        "id_course"=>$id_course,
        "id_schedule"=>$id_schedule,
        "color"=>$color
    ]);
    if(!(isset($_SESSION['trueModificacion']))&&($_SESSION['trueModificacion']==false)){
        $_SESSION['trueModificacion']=true;
    }else{
        $_SESSION['trueModificacion']=false;
    }
    header("Location: ../view/admin.php");
}

//CLASS DELETE
if(isset($_POST['name'])&&!(empty($_POST['name']))&&$_POST['accion']=='class_delete'){
    $crud = new Crud("classes");
    $id_class =$_SESSION['id_class'];
    $crud->where("id_class","=",$id_class)->delete();
    $_SESSION['trueDelete']=true;
    header("Location: ../view/admin.php");
}

//STUDENT INSERT
if (isset($_POST["username"])){
    $_SESSION['username']=$_POST["username"];
    $_SESSION['email']=$_POST["email"];
    $_SESSION['pass']=$_POST["pass"];
    $_SESSION['name']=$_POST["name"];
    $_SESSION['surname']=$_POST["surname"];
    $_SESSION['telephone']=$_POST["telephone"];
    $_SESSION['nif']=$_POST["nif"];
    $_SESSION['date_registered']=$_POST["date_registered"];
}

//STUDENT MODIFY
if(isset($_POST['username'])&&!(empty($_POST['username']))&&$_POST['accion']=='student_modify'){
    $id=$_SESSION['id'];
    $username=$_POST['username'];
    $email=$_POST['email'];
    $pass=$_POST['pass'];
    $name=$_POST['name'];
    $surname=$_POST['surname'];
    $telephone=$_POST['telephone'];
    $nif=$_POST['nif'];
    $date_registered=$_POST['date_registered'];
    $crud = new Crud("students");
    $crud->where("id","=",$id)->update([
        "id"=> $id,
        "username" => $username,
        "email" => $email,
        "pass" => $pass,
        "name" => $name,
        "surname" => $surname,
        "telephone" => $telephone,
        "nif" => $nif,
        "date_registered" => $date_registered
    ]);
    if(!(isset($_SESSION['trueModificacion']))&&($_SESSION['trueModificacion']==false)){
        $_SESSION['trueModificacion']=true;
    }else{
        $_SESSION['trueModificacion']=false;
    }
    header("Location: ../view/admin.php");
}

//STUDENT DELETE
if(isset($_POST['username'])&&!(empty($_POST['username']))&&$_POST['accion']=='student_delete'){
    $crud = new Crud("students");
    $id=$_SESSION['id'];
    $crud->where("id","=",$id)->delete();
    $_SESSION['trueDelete']=true;
    header("Location: ../view/admin.php");
}

//ENROLLMENT INSERT
if (isset($_POST["id_enrollment"])){
    $_SESSION['id_enrollment']=$_POST["id_enrollment"];
    $_SESSION['id_student']=$_POST["id_student"];
    $_SESSION['id_course']=$_POST["id_course"];
    $_SESSION['status']=$_POST["status"];
}

//ENROLLMENT MODIFY
if(isset($_POST['id_enrollment'])&&!(empty($_POST['id_enrollment']))&&$_POST['accion']=='enrollment_modify'){
    $id_enrollment=$_SESSION['id_enrollment'];
    $id_student=$_POST['id_student'];
    $id_course=$_POST['id_course'];
    $status=$_POST['status'];
    $crud = new Crud("enrollment");
    $crud->where("id_enrollment","=",$id_enrollment)->update([
        "id_enrollment"=>$id_enrollment,  
        "id_student"=>$id_student,
        "id_course"=>$id_course,
        "status"=>$status
    ]);
    if(!(isset($_SESSION['trueModificacion']))&&($_SESSION['trueModificacion']==false)){
        $_SESSION['trueModificacion']=true;
    }else{
        $_SESSION['trueModificacion']=false;
    }
    header("Location: ../view/admin.php");
}

//ENROLLMENT DELETE
if(isset($_POST['id_enrollment'])&&!(empty($_POST['id_enrollment']))&&$_POST['accion']=='enrollment_delete'){
    $crud = new Crud("enrollment");
    $id_enrollment=$_SESSION['id_enrollment'];
    $crud->where("id_enrollment","=",$id_enrollment)->delete();
    $_SESSION['trueDelete']=true;
    header("Location: ../view/admin.php");
}

//MENU INSERT
if(isset($_POST["insert"])&&!(empty($_POST["insert"]))){
    $btn=$_POST["insert"];
    switch($btn){
        case 'teacher_insert':
            teacher_insert();
            break;
        case 'course_insert':
            course_insert();
            break;
        case 'class_insert':
            class_insert();
            break;
        case 'student_insert':
            student_insert();
            break;
        case 'enrollment_insert':
            enrollment_insert();
            break; 
    }
}

//TEACHER INSERT
function teacher_insert() {
    $exito=false;
    $name=$_POST["name"];
    $surname=$_POST["surname"];
    $telephone=$_POST["telephone"];
    $nif=$_POST["nif"];
    $email=$_POST["email"];  
    $crud = new Crud("teachers");
    $crud->insert([
        "name" => $name,
        "surname" => $surname,
        "telephone" => $telephone,
        "nif" => $nif,
        "email" => $email   
    ]);
    $exito=true;
    $_SESSION["trueInsert"]=true;
    header("Location: ../view/admin.php");    
    return $exito;
}

//COURSE INSERT
function course_insert() {
    $exito=false;
    $name=$_POST["name"];
    $description=$_POST["description"];
    $date_start=$_POST["date_start"];
    $date_end=$_POST["date_end"];
    $active=$_POST["active"];
    $crud = new Crud("courses");
    $crud->insert([
        "name" => $name,
        "description" => $description,
        "date_start" => $date_start,
        "date_end" => $date_end,
        "active" => $active
    ]);
    $exito=true;
    $_SESSION["trueInsert"]=true;
    header("Location: ../view/admin.php");    
    return $exito;
}

//CLASS INSERT
function class_insert() {
    $exito=false;
    $name=$_POST["name"];
    $id_teacher = $_POST["id_teacher"];
    $id_course = $_POST["id_course"];
    $id_schedule =$_POST["id_schedule"];
    $color =$_POST["color"];
    $crud = new Crud("class");
    $crud->insert([
        "name"=> $name,
        "id_teacher" => $id_teacher,
        "id_course" => $id_course,
        "id_schedule" => $id_schedule,
        "color"=> $color
    ]);
    $exito=true;
    $_SESSION["trueInsert"]=true;
    header("Location: ../view/admin.php");    
    return $exito; 
}

//STUDENT INSERT
function student_insert(){
    $username=$_POST["username"];
    $email=$_POST["email"];
    $pass=$_POST["pass"];
    $name=$_POST["name"];
    $surname=$_POST["surname"];
    $telephone=$_POST["telephone"];
    $nif=$_POST["nif"];
    $date_registered =$_POST["date_registered"];
    $crud = new Crud("students");
    $crud->insert([
        "username" => $username,
        "email" => $email,
        "pass" => $pass,
        "name" => $name,
        "surname" => $surname,
        "telephone" => $telephone,
        "nif" => $nif,
        "date_registered" => $date_registered
    ]);
    $_SESSION["trueInsert"]=true;
    header("Location: ../view/admin.php");     
}

//ENROLLMENT INSERT
function enrollment_insert(){
    $id_enrollment=$_POST["id_enrollment"];
    $id_student=$_POST["id_student"];
    $id_course=$_POST["id_course"];
    $status = $_POST["status"];
    $crud = new Crud("enrollment");
    $crud->insert([
        "id_student"=>$id_student,
        "id_course"=>$id_course,
        "status"=>$status
    ]);
    $_SESSION["trueInsert"]=true;
    header("Location: ../view/admin.php");  
}

?>

<?php

//TEACHER GETALL
function teacher_getall($lista){
    echo("<div class='table-responsive-sm'>");
    echo("<table class='table tabla'>");
    echo("<tbody>");
    foreach($lista as $teacher){
        ?>
        <tr>  
            <td style='float:left; margin-left:10%;'>
                <?php echo($teacher->id_teacher) ?></td>
            <td style='float:left; margin-left:10px;'>
                <?php echo($teacher->name) ?></td>            
            <td style='float:left; margin-left:10px;'>
                <?php echo($teacher->surname) ?></td>
            <td style='float:left; margin-left:10px;'>
                <?php echo($teacher->telephone) ?></td>
            <td style='float:left; margin-left:10px;'>
                <?php echo($teacher->nif) ?></td>
            <td style='float:left; margin-left:10px;'>
                <?php echo($teacher->email) ?></td>
        <?php
            echo("<td>");
        ?>
        <form action="../view/admin.php" method='post'>
            <input type="hidden" name="id_teacher" value=<?php echo($teacher->id_teacher); ?>>
            <input type="hidden" name="name" value=<?php echo($teacher->name); ?>>
            <input type="hidden" name="surname" value=<?php echo($teacher->surname); ?>>
            <input type="hidden" name="telephone" value=<?php echo($teacher->telephone); ?>>
            <input type="hidden" name="nif" value=<?php echo($teacher->nif); ?>>
            <input type="hidden" name="email" value=<?php echo($teacher->email); ?>>
            <input class='btn btn-warning btn-listado' type='submit' name='teacher_modify' value="Alterar Registro">
        </form>
        <?php
            echo("</td>");
            echo("</tr>"); 
    }
    echo("</tbody>");
    echo("</table");
    echo("</div");
}

//COURSE GETALL
function course_getall($lista){
    echo("<div class='table-responsive-sm'>");
    echo("<table class='table tabla'>");
    echo("<tbody>");
    foreach($lista as $course){
        ?>
        <tr>  
            <td style='float:left; margin-left:10px;'>
                <?php echo($course->id_course) ?></td>
            <td style='float:left; margin-left:10px;'>
                <?php echo($course->name) ?></td>            
            <td style='float:left; margin-left:10px;'>
                <?php echo($course->description) ?></td>
            <td style='float:left; margin-left:10px;'>
                <?php echo($course->date_start) ?></td>
            <td style='float:left; margin-left:10px;'>
                <?php echo($course->date_end) ?></td>
            <td style='float:left; margin-left:10px;'>
                <?php echo($course->active) ?></td>
        <?php
            echo("<td>");
        ?>
        <form action="../view/admin.php" method='post'>
            <input type="hidden" name="id_course" value=<?php echo($course->id_course); ?>>
            <input type="hidden" name="name" value=<?php echo($course->name); ?>>
            <input type="hidden" name="description" value=<?php echo($course->description); ?>>
            <input type="hidden" name="date_start" value=<?php echo($course->date_start); ?>>
            <input type="hidden" name="date_end" value=<?php echo($course->date_end); ?>>
            <input type="hidden" name="active" value=<?php echo($course->active); ?>>
            <input class='btn btn-warning btn-listado' type='submit' name='course_modify' value="Alterar Registro">
        </form>
        <?php
            echo("</td>");
            echo("</tr>");
    }
    echo("</tbody>");
    echo("</table");
    echo("</div");  
}

//CLASS GETALL
function class_getall($lista){
    echo("<div class='table-responsive-sm'>");
    echo("<table class='table tabla'>");
    echo("<tbody>");
    foreach($lista as $class){
        ?>
        <tr>  
            <td style='float:left; margin-left:10%;'>
                <?php echo($class->id_class) ?></td>
            <td style='float:left; margin-left:10px;'>
                <?php echo($class->id_teacher) ?></td>            
            <td style='float:left; margin-left:10px;'>
                <?php echo($class->id_course) ?></td>
            <td style='float:left; margin-left:10px;'>
                <?php echo($class->id_schedule) ?></td>
            <td style='float:left; margin-left:10px;'>
                <?php echo($class->name) ?></td>
            <td style='float:left; margin-left:10px;'>
                <?php echo($class->color) ?></td>
        <?php
            echo("<td>");
        ?>
        <form action="../view/admin.php" method='post'>
            <input type="hidden" name="id_class" value=<?php echo($class->id_class); ?>>
            <input type="hidden" name="id_teacher" value=<?php echo($class->id_teacher); ?>>
            <input type="hidden" name="id_course" value=<?php echo($class->id_course); ?>>
            <input type="hidden" name="id_schedule" value=<?php echo($class->id_schedule); ?>>
            <input type="hidden" name="name" value=<?php echo($class->name); ?>>
            <input type="hidden" name="color" value=<?php echo($class->color); ?>>
            <input class='btn btn-warning btn-listado' type='submit' name='course_modify' value="Alterar Registro">
        </form>
        <?php
            echo("</td>");
            echo("</tr>");
    }
    echo("</tbody>");
    echo("</table");
    echo("</div");
}

//STUDENT GETALL
function student_getall($lista){
    echo("<div class='table-responsive-sm'>");
    echo("<table class='table tabla'>");
    echo("<tbody>");
    foreach($lista as $student){
        ?>
        <tr>  
            <td style='float:left; margin-left:10%;'>
                <?php echo($student->id) ?></td>
            <td style='float:left; margin-left:10px;'>
                <?php echo($student->username) ?></td>
            <td style='float:left; margin-left:10px;'>
                <?php echo($student->pass) ?></td>            
            <td style='float:left; margin-left:10px;'>
                <?php echo($student->email) ?></td>
            <td style='float:left; margin-left:10px;'>
                <?php echo($student->name) ?></td>
            <td style='float:left; margin-left:10px;'>
                <?php echo($student->surname) ?></td>
            <td style='float:left; margin-left:10px;'>
                <?php echo($student->telephone) ?></td>
            <td style='float:left; margin-left:10px;'>
                <?php echo($student->nif) ?></td>
            <td style='float:left; margin-left:10px;'>
                <?php echo($student->date_registered) ?></td>
        <?php
            echo("<td>");
        ?>
        <form action="../view/admin.php" method='post'>
            <input type="hidden" name="id" value=<?php echo($student->id); ?>>
            <input type="hidden" name="username" value=<?php echo($student->username); ?>>
            <input type="hidden" name="pass" value=<?php echo($student->pass); ?>>
            <input type="hidden" name="email" value=<?php echo($student->email); ?>>
            <input type="hidden" name="name" value=<?php echo($student->name); ?>>
            <input type="hidden" name="surname" value=<?php echo($student->surname); ?>>
            <input type="hidden" name="telephone" value=<?php echo($student->telephone); ?>>
            <input type="hidden" name="nif" value=<?php echo($student->nif); ?>>
            <input type="hidden" name="date_registered" value=<?php echo($student->date_registered); ?>>
            <input class='btn btn-warning btn-listado' type='submit' name="student_modify" value="Alterar Registro">
        </form>
        <?php
            echo("</td>");
            echo("</tr>");
    }
    echo("</tbody>");
    echo("</table");
    echo("</div");
}

//ENROLLMENT GETALL
function enrollment_getall($lista){
    echo("<div class='table-responsive-sm'>");
    echo("<table class='table tabla'>");
    echo("<tbody>");
    foreach($lista as $enrollment){
        ?>
        <tr> 
            <td style='float:left; margin-left:10%;'>
                <?php echo($enrollment->id_enrollment) ?></td> 
            <td style='float:left; margin-left:10%;'>
                <?php echo($enrollment->id_student) ?></td>
            <td style='float:left; margin-left:10px;'>
                <?php echo($enrollment->id_course) ?></td>            
            <td style='float:left; margin-left:10px;'>
                <?php echo($enrollment->status) ?></td>
        <?php
        echo("<td>");
        ?>
        <form action="../view/admin.php" method='post'>
            <input type="hidden" name="id_enrollment" value=<?php echo($enrollment->id_enrollment); ?>>
            <input type="hidden" name="id_student" value=<?php echo($enrollment->id_student); ?>>
            <input type="hidden" name="id_course" value=<?php echo($enrollment->id_course); ?>>
            <input type="hidden" name="status" value=<?php echo($enrollment->status); ?>>
            <input class='btn btn-warning btn-listado' type='submit' name="enrollment_modify" value="Alterar Registro">
        </form>
        <?php
            echo("</td>");
            echo("</tr>");
    }
    echo("</tbody>");
    echo("</table");
    echo("</div");
}

?>
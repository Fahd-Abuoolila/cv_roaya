<?php
    require('../inc/config.php');

    $IDemploy = $_POST['employid'];
    if(isset($_POST['submit'])){
        $mood = $_POST['mood'];
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $ability = $_POST['ability'];
        $job = $_POST['job'];
        $active = $_POST['active'];
        if($mood == 'create'){
            mysqli_query($conection, "INSERT INTO employs(employ_name, employ_email, employ_password, ability, job, active) VALUES('$name', '$email', '$password', '$ability', '$job', '$active')");
        }else if($mood == 'update'){
            $id = $_POST['rowid'];
            mysqli_query($conection, "UPDATE employs SET employ_name='$name', employ_email='$email', employ_password='$password', ability='$ability', job='$job', active='$active' WHERE employ_id=$id");
        }
    }
?>
<form action="../settings" method="POST" id="form">
    <input type="hidden" name="employid" value="<?php echo $IDemploy; ?>">
    <input type="hidden" name="mood" value="create">
</form>
<script>
    document.getElementById('form').submit();
</script>
<?php
session_start();
if(isset($_SESSION['id'])){
    header("location:platano_play.php");
    die();
}else{
     
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <link rel="stylesheet" href="../css/style_login.css">
    <link rel="stylesheet" href="../css/materialize.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Registrarse Artistas</title>
  
    <link rel="icon" type="image/png" href="../img/Platano_PLay_Verde.png"/>
    <script src="../js/materialize.min.js"></script>
    <script src="../js/jquery-3.3.1.min.js"></script>
</head>
<body>
    <div class="header">
        <header>
             <img src="../img/PlatanoPLayVerde.png" class="img_header">
             <a href="index.php" class="iniciar">Ya tengo una cuenta</a>
        </header>
    </div>
    <div class="error">
        <span>Error al registrarse</span>
    </div>

    <form id="formreg" class="form_regis">
    <div class="input-field col s12">
        <div class="row">

    <div class="input-field col s12">
    <i class="material-icons">account_circle</i><input id="nombre" name="nombre" type="text" class="validate" required>
        <label class="active" for="nombre">Nombre</label>
    </div>
    
    <div class="input-field col s12">
        <i class="material-icons">mail</i><input  id="correo" name="correo" type="text" class="validate" required>
        <label class="active" for="correo">Correo Electronico</label>
    </div>
    <br>

        
        <h3>Genero</h3>
        <select name="genero" id="genero" required>
          <option value="0" disabled selected>Genero</option>
        <?php 
             require '../conexion.php';
             $nueva_consulta= $mysqli->prepare("SELECT * FROM genero where estado='A'");
             $nueva_consulta->execute();
             $resultado=$nueva_consulta->get_result();
             while($datos=$resultado->fetch_assoc()){
        ?>
            <option value="<?php echo $datos['id_genero']?>"><?php echo $datos['genero']?></option>
            <?php
             }
             ?>
          </select>
      <br>
      <br>
        <div class="input-field col s12">
        <i class="material-icons">lock</i><input  id="contra" name="contra" type="password" class="validate" minlength="8" pattern="[A-Za-z0-9_-]{1,15}"required>
          <label class="active" for="contra" a>Contraseña</label>
          <p><i class="material-icons">priority_high</i>Las contraseñas deben tener al menos 8 caracteres.</p>
        </div>

        <div class="input-field col s12">
          <i class="material-icons">lock</i><input  id="repcontra" name="repcontra" type="password" class="validate" minlength="8" pattern="[A-Za-z0-9_-]{1,15}" required>
          <label class="active" for="repcontra">Repetir Contraseña</label>
        </div>
        
        
        
        <input type="submit" name="botonlg" class="botonlg" value="Registrarse">
  
        <h6>Al crear una cuenta, acepta las <a href="#">Condiciones de uso</a> y el <a href="#">Aviso de privacidad</a> de Platano Play.</h6>
          
        <script>
          $(document).ready(function() {
              M.updateTextFields();
          });
        </script>
        
    </form>
    
    <script src="../js/main3.js"></script>

    
</body>
</html>
    

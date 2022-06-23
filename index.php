<html>
    <head>
        <title>UPLOAD</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    </head>

    <style>

        .upload{

            position: relative;
            margin: auto;
            height: 300px;
            width: 805px;
            top: 3%;
            display: flex;
            justify-content: center;
            align-items: center; 
            background-size: cover;
            opacity: 1;
            

        }

        .submit{

            position: center;
        }

        strong{

            color: black;
            font-size: 17px;

        }

        b,i,h1{

            color: white;

        }

        body{

            background-image: url("https://fondosmil.com/fondo/43448.jpg");
            background-position: center center;
            background-size: cover;
            background-attachment: fixed;

        }

    </style>

    <?php

    include 'conexion.php';

    if (isset($_POST['submit'])) {

        if (is_uploaded_file($_FILES['fichero']['tmp_name'])) {

            $ruta = "upload/";
            $nombrefinal = trim($_FILES['fichero']['name']);
            $upload = $ruta . $nombrefinal;

            if (!file_exists($upload)) {

                if (move_uploaded_file($_FILES['fichero']['tmp_name'], $upload)) {
                    echo "<b>!Upload exitoso!</b><br>";
                    echo "<b>Datos:</b><br>";
                    echo "<b> Nombre: <i><a href=\"" . $ruta . $nombrefinal . "\">" . $_FILES['fichero']['name'] . "</a></i><br> </b>";
                    echo "<b>Tipo MIME: <i>" . $_FILES['fichero']['type'] . "</i><br> </b>";
                    echo "<b>Peso: <i>" . $_FILES['fichero']['size'] . " bytes</i><br> </b>";
                    echo "<br><hr><br>";

                    $nombre = $_POST["nombre"];
                    $description = $_POST["description"];

                    $query = "INSERT INTO archivos (name,description,ruta,tipo,size) VALUES ('$nombre','$description','" . $nombrefinal . "','" . $_FILES['fichero']['type'] . "','" . $_FILES['fichero']['size'] . "')";

                    mysqli_query($con, $query) or die(mysql_error());

                    echo "<b>El archivo '" . $nombre . "' se ha subido con éxito <br> </b>";
                }
            }
            echo "<b>El archivo ya existe</b>";
        }
    }
    ?>  

    <body> 

        <div class="upload" >

            <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data"> 

                <center> <h1> UPLOAD </h1> </center>

                <br>

                <b>Seleccione archivo:  <input name="fichero" type="file" size="500" maxlength="500"> </b>  

                <br>
                <br>

                <b>Nombre: <input name="nombre" type="text" size="70" maxlength="70"> </b>

                <br>
                <br>

                <b> Descripcion: <input name="description" type="text" size="70" maxlength="70"> </b>

                <br>
                <br>

                <center> <input name="submit" type="submit" value="SUBIR ARCHIVO"> </center> 

            </form>

        </div>

        <br>
        <br>
        <br>
        <br>
        <br>

        <center>
                
                <?php
                    $query = "select * from archivos";
                    $resultado = mysqli_query($con, $query);

                ?>

                <div class="col-lg-8">
                 <h1 class="text-primary text-center"><b>GALERIA DE IMAGENES</b></h1>
                 <hr>
                 <div class="card-columns">
                     <?php foreach ($resultado as $row) { ?>
                         <div class="card">
                             <img src="upload/<?php echo $row['ruta']; ?>" class="card-img-top" alt="...">
                             <div class="card-body">
                                 <h5 class="card-title"><strong><?php echo $row['name']; ?></strong></h5>
                             </div>
                         
                         </div>
                         
                         <?php } ?>
                 </div>
             </div>
         
        </center>

    </body>

</html>

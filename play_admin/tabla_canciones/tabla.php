<?php
session_start();
$id_album=$_SESSION['id_album'];
?>
<script src="tabla_canciones/reproducir.js"></script>
<div class="row">
    <div class="col-sm-12">
        <div class="canciones">

        
        <table class="table table-hover table-condensed table-bordered" id="tabladinamica">
            <thead>
                <tr>
                    <th>Codigo</th>
                    <th>Titulo</th>
                    <th>Duracion</th>
                    <th></th>
                    
                </tr>
            </thead>
            <tbody>
            <?php  
                require '../../conexion.php';
                $nueva_consulta= $mysqli->prepare("SELECT * FROM musica where estado='A' AND autorizacion='A' AND id_album='$id_album'");
                $nueva_consulta->execute();
                $resultado=$nueva_consulta->get_result();
                while($datos=$resultado->fetch_assoc()){
                    $id_genero=$datos['id_genero'];
                    require '../../conexion.php';
                    $nueva_consulta1= $mysqli->prepare("SELECT * FROM genero where id_genero='$id_genero'");
                    $nueva_consulta1->execute();
                    $resultado1=$nueva_consulta1->get_result();
                    $datos2=$resultado1->fetch_assoc();
                    
                    $id_artista=$datos['id_artista'];
                    require '../../conexion.php';
                    $nueva_consulta2= $mysqli->prepare("SELECT * FROM artistas where id_artista='$id_artista'");
                    $nueva_consulta2->execute();
                    $resultado2=$nueva_consulta2->get_result();
                    $datos3=$resultado2->fetch_assoc();

                    $datos1=$datos['id_musica'].'||'.$datos3['nombre'].'||'.$datos2['genero'].'||'.$datos['id_genero'].'||'.$datos['titulo'].'||'.$datos['duracion'].'||'.$datos['explisito'];
                    
            ?>
            <tr>
                <td><?php echo $datos['id_musica']?></td>
                <td><?php echo $datos['titulo']?></td>
                <td><?php echo $datos['duracion']?></td>
              
                <td>
                    <button class="btn btn-warning " data-toggle="modal" data-target="#modalEdicion" onclick="agregarForm('<?php echo $datos1 ?>')"><i class="fa fa-pencil"></i></button>
                
                    <section id="reproductor">
                        <audio id="<?php echo $datos['id_musica'] ?>">
                            <source src="../Musica/<?php echo $datos['musica']?>" type="audio/mp3">
                        </audio>
                        
                        <button class="btn btn-primary " id="<?php echo $datos['titulo']?>" onclick="reproducir('<?php echo $datos1?>')" >  <i class="fas fa-play"></i></button>
                        
                        
                    </section>

                    
            
                    <button class="btn btn-danger" onclick="preguntarSiNo(<?php echo $datos['id_musica'] ?>)"><i class="fas fa-trash"></i></button>
                </td>
            </tr>
        <?php
        }
        ?>
        </tbody>
        </table>    
    </div>
    </div>
    </div>


    

<script type="text/javascript">
    $(document).ready(function(){
        $('#tabladinamica').DataTable({
            language:{
                "sProcessing":     "Procesando...",
                "sZeroRecords":    "No se encontraron resultados",
                "sEmptyTable":     "Ningún dato disponible en esta tabla",
                "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
                "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
                "sInfoPostFix":    "",
                "sSearch":         "Buscar:",
                "sUrl":            "",
                "sInfoThousands":  ",",
                "sLoadingRecords": "Cargando...",
                "oPaginate": {
                    "sFirst":    "Primero",
                    "sLast":     "Último",
                    "sNext":     "Siguiente",
                    "sPrevious": "Anterior"
                },
                "oAria": {
                    "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                    "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                }
            }
        });
    });
</script>
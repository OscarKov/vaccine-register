<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro Vacunacion</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/cirrus-ui@0.6.2/dist/cirrus.min.css">
</head>
<body>
<div class="u-flex u-center h-100">
    <div class="intro-card frame px-3 py-4">
        <div class="frame__body">
            <h3><span></span>Formulario de registro</h3>
            <?php
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    validate_form();
                }
            ?>
            <form method="POST">
                <div class="input-control">
                    <input type="text" required name="txt_name" placeholder="Nombre">
                </div>
                <div class="input-control">
                    <input type="text" required name="txt_lastname" placeholder="Apellido">
                </div>
                <div class="input-control">
                    <input type="text" required name="txt_id" placeholder="Identificacion">
                </div>
                <div class="input-control">
                    <input type="text" required name="txt_lab" placeholder="Laboratorio">
                </div>
                <div class="row level">
                    <div class="col-xs-3 level-item">
                        <p class="m-0">Fecha primera dosis:</p>
                    </div>
                    <div class="col-xs-9 level-item"><input type="date" required name="date_fdosis"></div>
                </div>
                <div class="row level">
                    <div class="col-xs-3 level-item">
                        <p class="m-0">Fecha segunda dosis:</p>
                    </div>
                    <div class="col-xs-9 level-item"><input type="date" required name="date_sdosis"></div>
                </div>
                <div class="divider"></div>
                <div class="u-flex u-justify-flex-start">
                    <input class="btn-primary" type="submit" value="Enviar">
                </div>
            </form>
            <div class="space"></div>
            <h3><span></span>Ultimos registros</h3>
            <table class="table">
			    <thead>
			        <tr>
			            <th>Nombre</th>
			            <th>Apellido</th>
			            <th>Identificacion</th>
			            <th>Laboratorio</th>
			            <th>Fecha primera dosis</th>
			            <th>Fecha segunda dosis</th>
			        </tr>
			    </thead>
			    <tbody>
		    	<?php
				    $read_handle = fopen('form_data.txt', 'r+');
					$text = fread($read_handle, filesize('form_data.txt'));
					$records = explode("\n", $text);
					foreach($records as $key => $record){
						echo "<tr>\n";
						$values = explode(';', $record);
						foreach($values as $key => $value) {
							echo("<td>". $value ."</td>\n");
						}
						echo "</tr>";
					}
					fclose($read_handle);
			    ?>
			    </tbody>
			</table>
        </div>
    </div>
</div>
</body>
</html>

<?php




    function print_toast($text, $variant) {
        echo '<div class="toast toast--'.$variant.'">
                <p>'.$text.'</p>
            </div>';
    }

    function validate_form() {
    	$content = implode(';',$_POST);

    	$filename = 'form_data.txt';

    	$handle = fopen($filename, "a");
        fwrite($handle, $content."\n");


        fclose($handle);
        print_toast("Formulario registrado", "success");
    }

?>
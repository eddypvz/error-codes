<?php
$prefix = $_GET['prefix'] ?? "ERR";
$size = $_GET['size'] ?? 10;

function generateRandomString($length = 10) {
    global $prefix;

    $time = time();
    $characters = $time . 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }

    $code = $randomString;
    if (!empty(trim($prefix))) {
        $code = "{$prefix}-{$randomString}";
    }

    return strtoupper($code);
}

$code = generateRandomString($size);

?>
<!DOCTYPE HTML>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <title>Generador de errores</title>
    <link rel="stylesheet" href="src/bootstrap.min.css">
</head>
<body>
<section class="container text-center py-5">
    <div>
        <div class="input-group mb-3">
            <form action="index.php" method="GET" class="m-auto">
                <div class="text-muted my-2">
                    Prefijo de error y tamaño
                </div>
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Escriba aquí" name="prefix" value="<?= $prefix ?>">
                    <input type="number" class="form-control" placeholder="Escriba aquí" name="size" value="<?= $size ?>">
                    <button type="submit" class="btn btn-primary">Generar</button>
                </div>

            </form>
        </div>
    </div>
    <br>
    <div class="my-5">
        <h3><?php print $code ?></h3>
    </div>
    <button id="copy" class="copy btn btn-success" data-clipboard-text="<?php print $code ?>" data-bs-toggle="tooltip" data-bs-placement="top" title="Copiar a portapapeles">
        Copiar a portapapeles
    </button>
</section>

<script src="src/jquery-3.6.0.min.js"></script>
<script src="src/popper.min.js"></script>
<script src="src/bootstrap.min.js"></script>
<script src="src/clipboard.min.js"></script>

<script type="text/javascript">
    $(document).ready(function (){
        let tooltip = new bootstrap.Tooltip(document.getElementById('copy'));
        // Clipboard
        var clipboard = new ClipboardJS('.copy');
        clipboard.on('success', function(e) {
            $('#copy').attr('title', 'Copiado!');
            tooltip.hide();
            tooltip = new bootstrap.Tooltip(document.getElementById('copy'));
            tooltip.show();
        });
    })
</script>
</body>
</html>

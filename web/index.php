<?php
include("config.php");
?>
<html>
    <head>
        <title>Foscam Cameras</title>
        <link rel="stylesheet" href="style.css">
        <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
        <link rel="icon" href="favicon.ico" type="image/x-icon">
        <script>
        var rate = <?php echo $config['refresh'];?>;
        function imgReady(id) {
            console.log(id + " is ready!");
            var spinner = document.getElementById("spinner-" + id);
            spinner.style.display = "none";
            setTimeout (
                function(id) {
                    console.log("timeout fired for " + id);
                    var cam = document.getElementById(id);
                    var spinner = document.getElementById("spinner-" + id);
                    var d=new Date();
                    cam.src = cam.title + ".jpg?time=" + d.getTime();
                    spinner.style.display = "inline";
                }, rate, id
            )
        }
        </script>
    </head>
    <body>
        <h1><img src="icon.png"><br>Foscam Cameras</h1>
        <div class="row">
        <?php
        $files = glob('*.{jpg}', GLOB_BRACE);
        $c = 0;
        foreach($files as $file) {
            $this_img = $file;
            $cam_id = explode(".", $file)[0];
            $cam_name = ucwords($cam_id);
            if (isset($config['cam_names'])) {
                if (isset($config['cam_names'][$c])) {
                    $cam_name = $config['cam_names'][$c];
                }
            }
            ?>
            <div class="column">
                <p align="center">
                    <span class="camera-name"><?php echo $cam_name; ?></span><br>
                    <img class="camera" id="<?php echo $cam_id; ?>" onload="imgReady('<?php echo $cam_id ?>');" title="<?php echo $cam_id; ?>" src="<?php echo $this_img; ?>">
                    <img class="spinner" id="spinner-<?php echo $cam_id ?>" src="spinner.gif">
                </p>

            </div>
        <?php
            $c++;
        }
        ?>
        </div>
    </body>
</html>

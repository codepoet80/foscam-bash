<?php
include("config.php");
?>
<html>
    <head>
        <title>Foscam Cameras</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
        <link rel="stylesheet" href="style.css">
        <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
        <link rel="icon" href="favicon.ico" type="image/x-icon">
        <script>
        var rate = <?php echo $config['refresh'];?>;
        function imgReady(self) {
            console.log(self.id + " is ready!");
            var spinner = document.getElementById("spinner-" + self.id);
            spinner.style.display = "none";
            setTimeout (
                function(self) {
                    console.log("timeout fired for " + self.id);
                    var cam = document.getElementById(self.id);
                    var spinner = document.getElementById("spinner-" + self.id);
                    var d=new Date();
                    cam.src = self.id + ".jpg?time=" + d.getTime();
                    spinner.style.display = "inline";
                }, rate, self
            );
        }
        function camError(self) {
            self.src='offline.png';
            var spanToMove = document.getElementById("span-" + self.id);
            var spans = document.getElementsByTagName("span");
            spanToMove.parentNode.appendChild(spanToMove.parentNode.replaceChild(spans[spans.length-1], spanToMove));
        }
        </script>
    </head>
    <body>
    <table width=100% height=100% border=0 cellpadding=0 cellspacing=0>
    <tr>
    <td width=100% height=100% align="center" valign="middle">
        <h1><img src="icon.png"><br>Foscam Cameras</h1>
        <div id="container">
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
            <span class="item" id="span-<?php echo $cam_id; ?>">
                <p align="center">
                    <p class="camera-name"><?php echo $cam_name; ?></p>
                    <?php
                    if (isset($config['cam_links']) && $config['cam_links'][$c] != "") {
                    ?>
                    <a href="<?php echo $config['cam_links'][$c]?>">
                    <?php } else { echo "<a>"; } ?>
                        <img class="camera" id="<?php echo $cam_id; ?>" onload="imgReady(this);" title="<?php echo $cam_name; ?>" src="<?php echo $this_img . '?time=' . hrtime(true); ?>" onerror="camError(this)">
                    </a>
                </p>
                <img class="spinner" id="spinner-<?php echo $cam_id ?>" src="spinner.gif">
            </span>
        <?php
            $c++;
        }
        ?>
    </td>
    </tr>
    </table>
    </body>
</html>

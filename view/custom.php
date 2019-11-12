<?php ob_start(); ?>
<div>
    <div id="videoContainer" style="width: 500px; height: 500px;"></div>     <!-- put Camera in this div -->
    <div id="imageContainer" style="width: 500px; height: 500px;"></div>     <!-- put Picture taken in this div -->        <!-- think of a way to make it go it Camera div-->
    <button onclick="acquireImage();">Take a picture</button>
    <div></div>     <!-- put filters and images for collage -->
</div>
<script type="text/javascript" src="DCSResources/dynamsoft.webcam.config.js"></script>
<script type="text/javascript" src="DCSResources/dynamsoft.webcam.initiate.js"></script>
<script type="text/javascript" src="./view/custom.js"></script>
<?php
$content = ob_get_clean();
require_once "view/home.php";
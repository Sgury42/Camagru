<?php ob_start(); ?>
<div>
    <div></div>     <!-- put Camera in this div -->
    <div></div>     <!-- put filters and images for collage -->
</div>
<script type="" src=""></script>
<?php
$content = ob_get_clean();
require_once "view/home.php";
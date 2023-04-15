<?php

require __DIR__ . "/../../vendor/autoload.php";

$theme = "porto-admin";

$css = new \MatthiasMullie\Minify\CSS();

$css->add(__DIR__ . "/../../themes/". $theme ."/vendor/bootstrap/css/bootstrap.css");
$css->add(__DIR__ . "/../../themes/". $theme ."/vendor/animate/animate.css");
$css->add(__DIR__ . "/../../themes/". $theme ."/vendor/font-awesome/css/all.min.css");
$css->add(__DIR__ . "/../../themes/". $theme ."/vendor/magnific-popup/magnific-popup.css");
$css->add(__DIR__ . "/../../themes/". $theme ."/vendor/bootstrap-datepicker/css/bootstrap-datepicker3.css");
$css->add(__DIR__ . "/../../themes/". $theme ."/vendor/bootstrap-fileupload/bootstrap-fileupload.min.css");
$css->add(__DIR__ . "/../../themes/". $theme ."/vendor/sweetalert/sweetalert.css");
$css->add(__DIR__ . "/../../themes/". $theme ."/vendor/datatables/media/css/dataTables.bootstrap4.css");
$css->add(__DIR__ . "/../../themes/". $theme ."/vendor/summernote/summernote-bs4.css");
$css->add(__DIR__ . "/../../themes/". $theme ."/vendor/dropzone/dropzone.css");
$css->add(__DIR__ . "/../../themes/". $theme ."/css/theme.css");
$css->add(__DIR__ . "/../../themes/". $theme ."/css/skins/default.css");
$css->add(__DIR__ . "/../../themes/". $theme ."/css/skins/default.css");
$css->add(__DIR__ . "/../../themes/". $theme ."/css/custom.css");
$css->add(__DIR__ . "/../../shared/css/custom.css");

$css->minify(__DIR__ . "/../../themes/". $theme ."/assets/style.css");


$js = new \MatthiasMullie\Minify\JS();

$js->add(__DIR__ . "/../../themes/". $theme ."/vendor/jquery/jquery.js");
$js->add(__DIR__ . "/../../themes/". $theme ."/vendor/jquery-browser-mobile/jquery.browser.mobile.js");
$js->add(__DIR__ . "/../../themes/". $theme ."/vendor/popper/umd/popper.min.js");
$js->add(__DIR__ . "/../../themes/". $theme ."/vendor/bootstrap/js/bootstrap.js");
$js->add(__DIR__ . "/../../themes/". $theme ."/vendor/bootstrap-datepicker/js/bootstrap-datepicker.js");
$js->add(__DIR__ . "/../../themes/". $theme ."/vendor/bootstrap-fileupload/bootstrap-fileupload.min.js");
$js->add(__DIR__ . "/../../themes/". $theme ."/vendor/common/common.js");
$js->add(__DIR__ . "/../../themes/". $theme ."/vendor/nanoscroller/nanoscroller.js");
$js->add(__DIR__ . "/../../themes/". $theme ."/vendor/magnific-popup/jquery.magnific-popup.js");
$js->add(__DIR__ . "/../../themes/". $theme ."/vendor/jquery-placeholder/jquery.placeholder.js");
$js->add(__DIR__ . "/../../themes/". $theme ."/vendor/sweetalert/sweetalert.min.js");
$js->add(__DIR__ . "/../../themes/". $theme ."/vendor/sweetalert/jquery.sweet-alert.custom.js");
$js->add(__DIR__ . "/../../themes/". $theme ."/vendor/inputmask/dist/min/jquery.inputmask.bundle.min.js");

$js->add(__DIR__ . "/../../themes/". $theme ."/vendor/datatables/media/js/jquery.dataTables.min.js");
$js->add(__DIR__ . "/../../themes/". $theme ."/vendor/datatables/media/js/dataTables.bootstrap4.min.js");
$js->add(__DIR__ . "/../../themes/". $theme ."/vendor/datatables/extras/TableTools/Buttons-1.4.2/js/dataTables.buttons.min.js");
$js->add(__DIR__ . "/../../themes/". $theme ."/vendor/datatables/extras/TableTools/Buttons-1.4.2/js/buttons.bootstrap4.min.js");
$js->add(__DIR__ . "/../../themes/". $theme ."/vendor/datatables/extras/TableTools/Buttons-1.4.2/js/buttons.html5.min.js");
$js->add(__DIR__ . "/../../themes/". $theme ."/vendor/datatables/extras/TableTools/Buttons-1.4.2/js/buttons.print.min.js");
$js->add(__DIR__ . "/../../themes/". $theme ."/vendor/datatables/extras/TableTools/JSZip-2.5.0/jszip.min.js");
$js->add(__DIR__ . "/../../themes/". $theme ."/vendor/datatables/extras/TableTools/pdfmake-0.1.32/pdfmake.min.js");
$js->add(__DIR__ . "/../../themes/". $theme ."/vendor/datatables/extras/TableTools/pdfmake-0.1.32/vfs_fonts.js");
$js->add(__DIR__ . "/../../themes/". $theme ."/vendor/datatables/extras/TableTools/Buttons-1.4.2/js/buttons.colVis.js");
$js->add(__DIR__ . "/../../themes/". $theme ."/vendor/summernote/summernote-bs4.js");
$js->add(__DIR__ . "/../../themes/". $theme ."/vendor/ios7-switch/ios7-switch.js");
$js->add(__DIR__ . "/../../themes/". $theme ."/vendor/dropzone/dropzone.js");
$js->add(__DIR__ . "/../../themes/". $theme ."/js/examples/examples.lightbox.js");

$js->add(__DIR__ . "/../../themes/". $theme ."/js/theme.js");
$js->add(__DIR__ . "/../../themes/". $theme ."/js/theme.init.js");

$js->add(__DIR__ . "/../../shared/js/custom.js");

$js->minify(__DIR__ . "/../../themes/". $theme ."/assets/scripts.js");
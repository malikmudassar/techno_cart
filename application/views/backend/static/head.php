<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?= $title ?></title>
    <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=no">
    <meta name="description" content="Codeigniter Master Bioler plate advance crud engine with email notification and Login system.">
    <meta property="og:type" content="website">
    <meta property="og:title" content="Codeigniter Master Bioler plate advance crud engine with email notification and Login system.">
    <meta property="og:description" content="Codeigniter Master Bioler plate advance crud engine with email notification and Login system.">
    <link rel="apple-touch-icon" sizes="180x180" href="apple-touch-icon.png">
    <link rel="icon" type="image/png" href="<?= base_url() ?>assets/img/favicon-32x32.png" sizes="32x32">
    <link rel="icon" type="image/png" href="<?= base_url() ?>assets/img/favicon-16x16.png" sizes="16x16">
    <link rel="manifest" href="manifest.json">
    <link rel="mask-icon" href="safari-pinned-tab.svg" color="#1c90fb">
    <meta name="theme-color" content="#ffffff">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,400italic,500,700">
    <link rel="stylesheet" href="<?= base_url() ?>backend_assets/<?= $theme?>/css/vendor.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>backend_assets/<?= $theme?>/css/main.css">
    <link rel="stylesheet" href="<?= base_url() ?>backend_assets/<?= $theme?>/css/application.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>backend_assets/<?= $theme?>/css/demo.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>backend_assets/<?= $theme?>/css/login-2.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>backend_assets/selectize.default.css">
    <link rel="stylesheet" href="<?= base_url() ?>backend_assets/my_style.css">
    <script type="text/javascript" src="<?= base_url()?>backend_assets/<?= $theme ?>/js/jquery-2.1.1.min.js"></script>
    <script src="<?=  base_url()?>backend_assets/selectize.min.js"></script>
    <!-- Sweet alert css -->
    <link rel="stylesheet" href="<?= base_url()?>backend_assets/<?= $theme?>/sweetalert/sweetalert2.min.css">
    <script>base_url = "<?= base_url() ?>";</script>
    <script src="<?=  base_url()?>backend_assets/particles.min.js"></script>
    <script type="text/javascript">
        particlesJS.load('particles-js', '<?=  base_url()?>backend_assets/particlesjs-config.json', function() {
            console.log('callback - particles.js config loaded');
        });
    </script>
</head>
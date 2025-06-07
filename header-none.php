<?php

if (isset($_COOKIE["mode_theme"])) {
    $mode = $_COOKIE["mode_theme"];
} else {
    $mode = get_theme_mod('thememode_option', 'light');
}

?>

<!doctype html>
<html <?php language_attributes(); ?> class="<?php if ($mode == 'dark') echo 'dm-on'; ?>" x-data="{ menu: false, search: false, userm: false, darkm: <?php echo ($mode == 'dark') ? 'true' : 'false'; ?>}" :class="{ 'mn-on': menu, 'sr-on': search, 'um-on': userm }" @keydown.escape="{ menu = false, search = false, userm = false }">

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width,minimum-scale=1,initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <?php wp_head();
    #code scripts
    $code_script_header = base64_decode(get_option('script_code_header'));
    if ($code_script_header) echo $code_script_header; ?>
</head>

<body <?php body_class('tt-nsdbs logreg-page'); ?>>
<!DOCTYPE html>
<html dir="<?php echo $direction; ?>" lang="<?php echo $lang; ?>">
  <head>
    <noscript><meta http-equiv="refresh" content="0; URL=<?php echo $noscript; ?>"></noscript>
    <meta charset="UTF-8" />
    <title><?php echo $title; ?></title>
    <base href="<?php echo $base; ?>" />
    <?php if ($description) { ?><meta name="description" content="<?php echo $description; ?>" /><?php } ?>
    <?php if ($keywords) { ?><meta name="keywords" content="<?php echo $keywords; ?>" /><?php } ?>
    <?php if ($icon) { ?><link href="<?php echo $icon; ?>" rel="icon" /><?php } ?>
    <?php foreach ($links as $link) { ?><link href="<?php echo $link['href']; ?>" rel="<?php echo $link['rel']; ?>" /><?php } ?>
    <link rel="stylesheet" type="text/css" href="frontend/view/theme/<?php echo $config_template; ?>/stylesheet/stylesheet.css" />
    <?php foreach ($styles as $style) { ?><link rel="<?php echo $style['rel']; ?>" type="text/css" href="<?php echo $style['href']; ?>" media="<?php echo $style['media']; ?>" /><?php } ?>
    <script type="text/javascript" src="frontend/view/javascript/jquery/jquery-1.7.1.min.js"></script>
    <script type="text/javascript" src="frontend/view/javascript/jquery/ui/jquery-ui-1.8.16.custom.min.js"></script>
    <link rel="stylesheet" type="text/css" href="frontend/view/javascript/jquery/ui/themes/ui-lightness/jquery-ui-1.8.16.custom.css" />
    <script type="text/javascript" src="frontend/view/javascript/common.js"></script>
    <?php foreach ($scripts as $script) { ?><script type="text/javascript" src="<?php echo $script; ?>"></script><?php } ?>
    <!--[if IE 7]> 
    <link rel="stylesheet" type="text/css" href="frontend/view/theme/<?php echo $config_template; ?>/stylesheet/ie7.css" />
    <![endif]-->
    <!--[if lt IE 7]>
    <link rel="stylesheet" type="text/css" href="frontend/view/theme/<?php echo $config_template; ?>/stylesheet/ie6.css" />
    <script type="text/javascript" src="frontend/view/javascript/DD_belatedPNG_0.0.8a-min.js"></script>
    <script type="text/javascript">
    DD_belatedPNG.fix('#logo img');
    </script>
    <![endif]-->
  </head>
  <body>
    <div class="header-conteiner">
        <div class="message">
            <span class="success">Success message.</span>
            <span class="error">Error.message.</span>
            <span class="notice">Notice message.</span>
            <span class="info">Info message.</span>
        </div>
    </div>
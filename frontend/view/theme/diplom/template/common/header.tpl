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
    <script type="text/javascript" src="frontend/view/javascript/jquery/tiktak_clock.js"></script>
    <script type="text/javascript" src="frontend/view/javascript/jquery/ui/jquery-ui-1.8.16.custom.min.js"></script>
    <script type="text/javascript" src="frontend/view/javascript/jquery/superfish/js/superfish.js"></script>
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
    <script type="text/javascript">
        $("#clock").tiktak({
            "selectors": {
                "day": "#day",
                "dayNumb": "#day-numb",
                "month": "#month",
                "year": "#year",
                "hours": "#hour",
                "minutes": "#minute",
                "seconds": "#second"
            },
            "dateFormat": "symbol",
            "timeFormat": "24"
        });
        $(function(){
            $("#message span").live("click", function(){$(this).slideUp();});
            $('#search-keyword').keydown(function(e) {
                if(e.keyCode == 13)
                    $(this).parent("form").submit();
            });
            $("#account-bar li a").hover(function(){
                $(this).addClass("active");
                $(this).next("div").slideDown();
            }).parent("li").mouseleave(function(){
                $(this).children("a").removeClass("active");
                $(this).children("div").slideUp();
            });
        });
    </script>
  </head>
  <body>
    <!-- Top -->
    <div class="header-conteiner">
        <?php if($message) : ?>
        <div id="message" class="message">
            <?php foreach($message as $key => $text) : ?>
            <span class="<?php echo $key; ?>"><?php echo $text; ?></span>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>
        <div id="clock" class="clock">
            <span id="day" class="day"></span>
            <span id="month" class="month"></span>
            <span id="day-numb" class="day-numb"></span>
            <span id="year" class="year"></span>
            <span id="hour" class="hour"></span>
            <span id="minute" class="minute"></span>
        </div>
        <div id="search-bar" class="search-conteiner">
            <form id="form" name="search" action="#" method="get">
                <input id="search-keyword" type="text" name="keyword" value="" placeholder="<?php echo $text_search; ?>" />
                <input type="submit" value="" />
            </form>
        </div>
        <div class="account-conteiner">
            <ul id="account-bar">
                <?php foreach($navigation as $obj) : ?>
                <li><a href="<?php echo $obj["href"]; ?>"><?php echo $obj["text"]; ?></a></li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
    <div class="content-conteiner">
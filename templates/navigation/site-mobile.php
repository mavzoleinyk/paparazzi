<?php //var_dump($matchedSites); ?>

<ul class="nav navbar-nav">
    <li>

        <a class="collapsed" data-toggle="collapse" aria-expanded="false" href="#sites"><?php echo $siteName; ?> <span class="caret"></span></a>

        <ul role="menu" id="sites" class="all-sites-menu-nav collapse">
            <?php foreach($matchedSites as $key => $site): ?>
            <li>
                <a href="//<?php echo $site['domain']; ?>" title="Paparazzi proposals: <?php echo $site['siteName']; ?>"><?php echo $site['siteName']; ?></a>
            </li>

            <?php endforeach; ?>
        </ul>

    </li>
</ul>

<?php if(!empty($phoneNumber)): ?>
<!--    <ul class="nav navbar-nav pull-right">-->
        <li class="nav-fixed-xs-right">
            <a href="tel:<?php echo $phoneNumber; ?>"><?php echo $phoneNumber; ?></a>
        </li>
<!--    </ul>-->
<?php endif; ?>
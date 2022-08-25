<?php //var_dump($matchedSites); ?>

<ul class="nav navbar-nav">

    <li class="pipe pull-left">
        <a href="<?php bloginfo('url'); ?>" title="Paparazzi proposals: <?php echo $site['siteName']; ?>"><?php echo $siteName; ?>
        </a>
    </li>

    <?php if(!empty($phoneNumber)): ?>
    <li class="pull-right text-right">
        <a href="tel:<?php echo $phoneNumber; ?>"><?php echo $phoneNumber; ?></a>
    </li>
    <?php endif; ?>

</ul>
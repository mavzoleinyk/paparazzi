<?php //var_dump($matchedSites); ?>

<ul class="nav navbar-nav">
    <li class="dropdown pipe">

        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
           aria-expanded="false"><?php echo $siteName; ?> <span class="caret"></span></a>

        <ul class="dropdown-menu" role="menu">
            <?php foreach($matchedSites as $key => $site): ?>
            <li>
                <a href="//<?php echo $site['domain']; ?>" title="Paparazzi proposals: <?php echo $site['siteName']; ?>"><?php echo $site['siteName']; ?></a>
            </li>

            <?php endforeach; ?>
        </ul>

    </li>

    <?php if(!empty($phoneNumber)): ?>
    <li>
        <a href="tel:<?php echo $phoneNumber; ?>"><?php echo $phoneNumber; ?></a>
    </li>
    <?php endif; ?>
</ul>
<?php //var_dump($matchedSites); ?>

<ul class="nav navbar-nav pull-left">

    <li>
        <a href="<?php bloginfo('url'); ?>" title="Paparazzi proposals: <?php echo $site['siteName']; ?>"><?php echo $siteName; ?></a>
    </li>

</ul>

<?php if(!empty($phoneNumber)): ?>
<ul class="nav navbar-nav pull-right">
    <li>
        <a href="tel:<?php echo $phoneNumber; ?>"><?php echo $phoneNumber; ?></a>
    </li>
</ul>
<?php endif; ?>
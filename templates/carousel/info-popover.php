<?php if(is_array($location)): ?>
    <p class='small'>Location: <a href='<?php echo $location['link']; ?>' title='View the <?php echo $location['title']; ?> package'><?php echo $location['title']; ?></a></p>
<?php endif; ?>
<?php if(is_array($package)): ?>
    <p class='small'>Package: <a href='<?php echo $package['link']; ?>' title='View the <?php echo $package['title']; ?> package'><?php echo $package['title']; ?></a></p>
<?php endif; ?>

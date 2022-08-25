<aside class="widget">


    <?php if(!empty($title)): ?>

    <header>

        <h3><?php if(!empty($icon)) echo '<i class="fa ' . $icon . '"></i>'; ?> <?php echo $title; ?></h3>

    </header>

    <?php endif; ?>

    <?php if(!empty($content)): ?>

    <article>

        <?php echo $content; ?>

    </article>

    <?php endif; ?>


</aside>
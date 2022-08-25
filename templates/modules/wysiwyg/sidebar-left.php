<div class="wysiwyg container margin-top-reg">

    <div class="row">

        <div class="col-md-4">

            <?php if (!empty($sidebarContent)): ?>

                <div class="text-uppercase">
                    <?php echo $sidebarContent; ?>
                </div>

            <?php endif; ?>

            <?php if (is_array($sidebarPrimary)): ?>

                <?php the_button('btn-primary btn-block btn-lg', $sidebarPrimary); ?>

            <?php endif; ?>

            <?php if (is_array($sidebarDefault)): ?>

                <?php the_button('btn-default btn-block btn-lg', $sidebarDefault); ?>

            <?php endif; ?>

        </div>

        <div class="col-md-8 hentry">

            <?php if (!empty($title)): ?>

                <h2><?php echo $title; ?></h2>

            <?php endif; ?>

            <?php if (!empty($content)): ?>

                <?php echo $content; ?>

            <?php endif; ?>

        </div>

    </div>

</div>
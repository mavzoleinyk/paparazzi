<div class="wysiwyg container margin-top-reg">

    <div class="row">

        <div class="col-md-offset-2 col-md-8 text-center">

            <?php if (!empty($content)): ?>

                <div class="lead">
                    <?php echo $content; ?>
                </div>

            <?php endif; ?>

            <?php if (!empty($sidebarContent)): ?>

                <div class="text-uppercase">
                    <?php echo $sidebarContent; ?>
                </div>

            <?php endif; ?>

            <div class="row">

                <?php if (is_array($sidebarPrimary)): ?>

                    <div class="col-md-6 col-md-offset-3 margin-top-sm">

                        <?php the_button('btn-primary btn-lg', $sidebarPrimary); ?>

                    </div>

                <?php endif; ?>

                <?php if (is_array($sidebarDefault)): ?>

                    <div class="col-md-6 col-md-offset-3 margin-top-sm">

                        <?php the_button('btn-default btn-lg', $sidebarDefault); ?>

                    </div>

                <?php endif; ?>

            </div>

        </div>

    </div>

</div>
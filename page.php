<?php include('header.php'); ?>

    <div class="container">

        <div class="row main-content">

            <section <?php post_class('col-md-8'); ?> role="main">

            <?php if(have_posts()) : while(have_posts()) : the_post(); ?>

                <header>

                    <h1 class="text-uppercase"><?php the_title(); ?></h1>

                </header>

                <article id="post-<?php the_ID(); ?>">

                    <?php the_content(); ?>

                </article>

            <?php endwhile; endif; ?>

            </section>

            <?php render_template('sidebar'); ?>

        </div>

    </div>

<?php include('footer.php'); ?>
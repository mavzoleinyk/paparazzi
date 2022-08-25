<aside class="widget <?php $class; ?>">


    <header>

        <h4><?php echo $title; ?></h4>

    </header>

    <?php while($query->have_posts()) : $query->the_post(); ?>

    <article>

        <?php if(has_post_thumbnail()) : ?>

            <figure>

                <?php the_post_thumbnail('sidebar_news'); ?>

            </figure>

        <?php endif; ?>

        <h3><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>

        <p class="date"><?php the_date('jS F Y'); ?></p>

        <?php the_excerpt(); ?>

        <a class="news-link" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php _e('Read More...', 'hh-bootstrap'); ?></a>

    </article>

    <?php endwhile; ?>

    <?php wp_reset_postdata(); ?>

    <footer>



    </footer>

</aside>
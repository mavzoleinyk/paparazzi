<div class="meta-wrap hidden-xs">
	<div class="post-meta post-categories text-uppercase inline-block-list margin-top-sm"><?php echo get_the_term_list( $post->ID, 'category', 'Categories: ', '', '' ); ?></div>
	<div class="post-meta post-tags text-uppercase inline-block-list margin-top-sm"><?php echo get_the_term_list( $post->ID, 'post_tag', 'Tags: ', '', '' ); ?></div>
</div>

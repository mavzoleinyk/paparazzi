<?php $name = get_article_author_name(); ?>

<article class="widget user hentry author-wrap clearfix">
	
	<h3 class="h2"><a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>" title="Posts by <?php echo $name; ?>"><?php echo $name; ?></a></h3>

	<?php if($profileurl = get_profile_img('sidebar')) :?>
		<img class="profile-img" src="<?php echo $profileurl; ?>" alt="<?php echo $name; ?>" />
	<?php endif; ?>
	
	<?php 
		$desc = get_the_author_meta('description'); 
		$desc = truncateLimit($desc, 120);
	?>
	
	<p><?php echo $desc; ?></p>
	
	<?php if($userurl = get_the_author_meta('user_url')): ?>
		<a class="author-url" href="<?php echo $userurl; ?>"><?php echo $userurl; ?></a>
	<?php endif; ?>	
	
	<div class="social-icons pull-right">
		<?php if($twitterid = get_the_author_meta('twitter')) : ?>
		<li>
			<a href="http://www.twitter.com/<?php echo $twitterid; ?>" title="<?php echo $name; ?> Twitter profile" target="_blank"><i class="twitter"></i></a>
		</li>
		<?php endif; ?>
		
		<?php if($linkedinprofile = get_linkedin()): ?>
		<li>
			<a href="<?php echo $linkedinprofile; ?>" title="<?php echo $name; ?> Linked In profile" target="_blank"><i class="linkedin"></i></a>
		</li>
		<?php endif; ?>
	</div>	
	
</article>


<?php $name = get_article_author_name(); ?>

<article class="hentry author-wrap">

	<?php if($profileurl = get_profile_img('main')) :?>
		<img class="profile-img" src="<?php echo $profileurl; ?>" alt="<?php echo $name; ?>" />
	<?php endif; ?>

	<p><?php the_author_meta('description'); ?></p>

	<?php if($userurl = get_the_author_meta('user_url')): ?>
		<a class="author-url" href="<?php echo $userurl; ?>"><?php echo $userurl; ?></a>
	<?php endif; ?>

	<div class="social-icons">
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


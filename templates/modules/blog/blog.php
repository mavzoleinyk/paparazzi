<?php if(!empty($firstPost)): ?>

<div id="<?php echo $id; ?>" data-section="<?php echo $id; ?>" class="container margin-top-reg">

	<?php render_template('modules/module-heading', array('icon' => $icon, 'title' => $title)); ?>

	<div class="row">

		<?php echo $firstPost; ?>

        <?php if(!empty($otherPosts)): ?>

		<div class="col-xs-12 col-sm-6">

			<div class="row" data-equal="height">

				<?php echo $otherPosts; ?>

			</div>

		</div>

        <?php endif; ?>

	</div>

</div>

<?php endif; ?>

<div class="well well-lg text-center">

    <?php if(!empty($title)): ?>

    <h2><?php echo $title; ?></h2>

    <?php endif; ?>

    <?php if(!empty($description)): ?>

    <p class="lead"><?php echo $description; ?></p>

    <?php endif; ?>

    <a class="btn btn-default" href="#" data-toggle="modal" data-target="#<?php echo $type; ?>"><?php echo $buttontext; ?></a>

</div>

<select class="btn btn-action navbar-btn menu-item visible-xs text-uppercase" data-action="link">

    <option value="">Locations</option>

    <?php foreach($locations as $location): $active = ''; if($currLocation->term_id == $location->term_id) $active = ' selected="selected"'?>

        <option value="<?php echo get_term_link($location); ?>"<?php echo $active; ?>><?php echo $location->name; ?></option>

    <?php endforeach; ?>

</select>

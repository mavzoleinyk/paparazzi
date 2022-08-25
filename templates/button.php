<?php

$dataAttributes = '';

if(!empty($role) && $role === 'modal')
{
    $dataAttributes = ' data-toggle="modal" data-target="#' . $link . '"';
}
elseif(!empty($role) && $role === 'scroller')
{
    $dataAttributes = ' data-scroller="#' . $link . '"';
}

?>

<a class="btn <?php echo $class; ?>" href="<?php echo $link; ?>"<?php echo $dataAttributes; ?>><?php echo $buttonText; ?></a>
<?php

include('header.php');

    global $ppModules;

    $term = get_queried_object();

    the_modules($ppModules, $term);

include('footer.php');

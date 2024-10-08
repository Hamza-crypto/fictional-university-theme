<?php

get_header();

while(have_posts()) {
    the_post(); ?>
<div class="page-banner">
    <div class="page-banner__bg-image"
        style="background-image: url(<?php echo get_theme_file_uri('/images/ocean.jpg') ?>);"></div>
    <div class="page-banner__content container container--narrow">
        <h1 class="page-banner__title"><?php the_title(); ?></h1>
        <div class="page-banner__intro">
            <p>DONT FORGET TO REPLACE ME LATER (single-professor)</p>
        </div>
    </div>
</div>

<div class="container container--narrow page-section">


    <div class="generic-content"><?php the_content(); ?></div>

    <?php
        $related_programs = get_field('related_programs');

    if($related_programs) {
        echo '<hr class="section-break">';
        echo '<h2 class="headline headline--medium">Subject(s) Taught</h2>';

        echo '<ul class="link-list min-list">';
        foreach($related_programs as $program) { ?>
    <li><a href="<?= get_the_permalink($program) ?>"><?= get_the_title($program) ?></a></li>
    <?php }

        echo "</ul>";

    }


    ?>
</div>



<?php }

get_footer();

?>
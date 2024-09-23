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
            <p>DONT FORGET TO REPLACE ME LATER (single-program)</p>
        </div>
    </div>
</div>

<div class="container container--narrow page-section">
    <div class="metabox metabox--position-up metabox--with-home-link">
        <p><a class="metabox__blog-home-link" href="<?= get_post_type_archive_link('program'); ?>"><i class="fa fa-home"
                    aria-hidden="true"></i> All Programs</a> <span class="metabox__main">
                <?php the_title(); ?>
            </span></p>
    </div>

    <div class="generic-content"><?php the_content(); ?></div>


    <?php
            

    $related_professors = new WP_Query([
        'posts_per_page' => -1,
        'post_type' => 'professor',
      
        // 'orderby' => 'meta_value_num',
        'order' => 'ASC',
        'meta_query' => [
            [
                'key' => 'related_programs',
                'compare' => 'LIKE',
                'value' => '"' . get_the_ID() . '"',
            ]
        ]
    ]);

    if($related_professors->have_posts()) {
        echo '<hr class="section-break">';

        echo '<h2 class="headline headline--medium">' . get_the_title() . ' Professors</h2>';
        while($related_professors->have_posts()) {
            $related_professors->the_post();
            ?>

    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
    <?php
        }

    }

    ?>


    <?php

    wp_reset_query(  );
            $today = date('Ymd');

        $upcoming_events = new WP_Query([
            'posts_per_page' => -1,
            'post_type' => 'event',
            'meta_key' => 'event_date',
            'orderby' => 'meta_value_num',
            'order' => 'ASC',
            'meta_query' => [
                [
                    'key' => 'event_date',
                    'compare' => '>=',
                    'value' => $today,
                    'type' => 'numeric'
                ],
                [
                    'key' => 'related_programs',
                    'compare' => 'LIKE',
                    'value' => '"' . get_the_ID() . '"',
                ]
            ]
        ]);

    if($upcoming_events->have_posts()) {
        echo '<hr class="section-break">';

        echo '<h2 class="headline headline--medium">Upcoming ' . get_the_title() . ' events</h2>';
       
        while($upcoming_events->have_posts()) {
            $upcoming_events->the_post();
            ?>

    <div class="event-summary">
        <a class="event-summary__date t-center" href="<?php the_permalink(); ?>">
            <span class="event-summary__month"><?php the_time('M'); ?></span>
            <span class="event-summary__day"><?php the_time('d'); ?></span>
        </a>
        <div class="event-summary__content">
            <h5 class="event-summary__title headline headline--tiny"><a
                    href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
            <p><?php echo wp_trim_words(get_the_content(), 18) ; ?> <a href="<?php the_permalink(); ?>"
                    class="nu gray">Learn more</a>
            </p>
        </div>
    </div>
    <?php
        }

    }

    ?>


</div>



<?php }

get_footer();

?>
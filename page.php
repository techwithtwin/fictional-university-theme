<?php

get_header();

while (have_posts()) {
    the_post(); ?>

    <div class="page-banner">
        <div class="page-banner__bg-image" style="background-image: url(<? echo get_theme_file_uri('/images/ocean.jpg') ?>)"></div>
        <div class="page-banner__content container container--narrow">
            <h1 class="page-banner__title"><? the_title() ?></h1>
            <div class="page-banner__intro">
                <p>DON'T forget to replace me later</p>
            </div>
        </div>
    </div>

    <div class="container container--narrow page-section">
        <?
        $parent = get_post_parent();

        if ($parent) { ?>
            <div class="metabox metabox--position-up metabox--with-home-link">
                <p>
                    <a class="metabox__blog-home-link" href=<? echo get_permalink($parent->ID) ?>>
                        <i class="fa fa-home" aria-hidden="true"></i>
                        Back to <? echo $parent->post_title ?>
                    </a>
                    <span class="metabox__main"><? the_title() ?></span>
                </p>
            </div>
        <? } ?>

        <?php
        $parentChildPages = get_pages(
            array(
                'child_of' => get_the_ID()
            )
        );
        if ($parent or $parentChildPages) { ?>
            <div class="page-links">
                <h2 class="page-links__title">
                    <a href=<? echo $parent ? get_permalink($parent->ID) : '' ?>>
                        <?
                        echo $parent ? get_the_title($parent->ID) : the_title()
                        ?>
                    </a>
                </h2>
                <ul class="min-list">
                    <?
                    wp_list_pages(array(
                        'title_li' => NULL,
                        'child_of' => $parent ? $parent->ID : get_the_ID()
                    ));
                    ?>
                </ul>
            </div>
        <?php } ?>

        <div class="generic-content">
            <? the_content() ?>
        </div>
    </div>

<?php
}

get_footer();
?>
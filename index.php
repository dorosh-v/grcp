<?php
/*
Template Name: Home Page Template
*/
get_header(); ?>

<div id="primary" class="content-area col-sm-12 col-md-8">
    <main id="main" class="site-main" role="main">

        <?php
        $loop = get_transient('realestate_cache');
        if (false === $loop) {
            $loop = new WP_Query(array(
                    'post_type' => 'realestate',
                    'posts_per_page' => get_option('posts_per_page'))
            );
            set_transient('realestate_cache', $loop, 10);
        }

        $metacache = array();
        $mct = false;
        $mct = get_transient('realestate_meta_cache');
        $metacache = $mct;
        while ($loop->have_posts()) : $loop->the_post();
            if (false === $mct) {
                $metacache[get_the_ID()] = array(
                    'address' => get_field('address'),
                    'cost_of' => get_field('cost_of'),
                    'area' => get_field('area'),
                    'living_area' => get_field('living_area'),
                    'floor' => get_field('floor')
                );
            }
        endwhile;


        if (array_key_exists('aid', $_GET) && intval($_GET)) {
            $loop = new WP_Query(array(
                    'post_type' => 'realestate',
                    'meta_query' => array(
                        array(
                            'key' => 'agency',
                            'value' => intval($_GET['aid']),
                        )
                    ),
                    'posts_per_page' => get_option('posts_per_page'))
            );
        } elseif (array_key_exists('t', $_GET)) {
            $loop = new WP_Query(array(
                    'post_type' => 'realestate',
                    'tax_query' => array(
                        array(
                            'taxonomy' => 'realestate_type',
                            'field' => 'slug',
                            'terms' => esc_attr($_GET['t']),
                        )
                    ),
                    'posts_per_page' => get_option('posts_per_page'))
            );
        }

        while ($loop->have_posts()) : $loop->the_post();
            ?>
            <div class="entry-content col-sm-6">
                <a href="<?php echo get_permalink(); ?>" class="item-thumb">
                    <?php the_post_thumbnail('medium'); ?>
                    <span class="item-info">
						<b><?php _e('Location', 'unite'); ?>: <?php echo $metacache[get_the_ID()]['address'] ? $metacache[get_the_ID()]['address'] : __('N/A', 'unite'); ?></b>
						<i><?php _e('Price', 'unite'); ?>: <?php echo $metacache[get_the_ID()]['cost_of'] ? $metacache[get_the_ID()]['cost_of'] . __('EUR', 'unite') : __('N/A', 'unite'); ?></i>
						<i><?php _e('Area', 'unite'); ?>: <?php echo $metacache[get_the_ID()]['area'] ? $metacache[get_the_ID()]['area'] . __('sq.m.', 'unite') : __('N/A', 'unite'); ?></i>
						<i><?php _e('Living area', 'unite'); ?>: <?php echo $metacache[get_the_ID()]['living_area'] ? $metacache[get_the_ID()]['living_area'] . __('sq.m.', 'unite') : __('N/A', 'unite'); ?></i>
						<i><?php _e('Floor', 'unite'); ?>: <?php echo $metacache[get_the_ID()]['floor'] ? $metacache[get_the_ID()]['floor'] : __('N/A', 'unite'); ?></i>
					</span>
                </a>
                <?php the_title('<h2 class="item-title"><a href="' . get_permalink() . '" title="' . the_title_attribute('echo=0') . '" rel="bookmark">', '</a></h2>'); ?>
                <a name="aid" class="btn btn-primary"
                   href="<?php echo get_permalink(); ?>"><?php _e('Read more', 'unite'); ?></a>
                <?php $agency = get_field('agency', $post_object->ID); ?>
                <a name="aid" class="btn btn-primary read-more"
                   href="<?php echo get_permalink($agency->ID); ?>"><?php echo get_the_title($agency->ID) ?></a>
            </div>
        <?php

        endwhile;
        if (false === $mct) {
            $mct = $metacache;
            set_transient('realestate_meta_cache', $mct, 10);
        }
        ?>
        <?php unite_paging_nav(); ?>

    </main><!-- #main -->
</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>

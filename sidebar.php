<?php
/**
 * The Sidebar containing the main widget areas.
 *
 * @package unite
 */
?>
<div id="secondary" class="widget-area col-sm-12 col-md-4" role="complementary">
    <?php do_action('before_sidebar'); ?>
    <?php if (!dynamic_sidebar('sidebar-1')) : ?>

        <aside id="search" class="widget widget_search">
            <?php get_search_form(); ?>
        </aside>

        <aside id="archives" class="widget">
            <h1 class="widget-title"><?php _e('Archives', 'unite'); ?></h1>
            <ul>
                <?php wp_get_archives(array('type' => 'monthly')); ?>
            </ul>
        </aside>

        <aside id="meta" class="widget">
            <h1 class="widget-title"><?php _e('Meta', 'unite'); ?></h1>
            <ul>
                <?php wp_register(); ?>
                <li><?php wp_loginout(); ?></li>
                <?php wp_meta(); ?>
            </ul>
        </aside>
    <?php endif; // end sidebar widget area ?>

    <aside id="agencies" class="widget">
        <h3 class="widget-title">
            <a href="/agency/">
                <?php is_front_page() ? _e('Filter by agency', 'unite') : _e('Agencies', 'unite'); ?>
            </a>
        </h3>

        <?php $loop = new WP_Query(array('post_type' => 'agency', 'posts_per_page' => get_option('posts_per_page'), 'orderby' => 'title', 'order' => 'ASC')); ?>
        <?php
        if ($loop->have_posts()) :
            $queried_object = get_queried_object();
            if ($queried_object) $post_id = $queried_object->ID;
            ?>
            <ul class="entry-content">

                <?php while ($loop->have_posts()) : $loop->the_post(); ?>

                    <?php
                    $agency = get_field('agency', $post_object->ID);
                    ?>
                    <li class="descr">
                        <a href="<?php echo(is_front_page() ? ('/?aid=' . get_the_ID($agency->ID)) : get_permalink($agency->ID)); ?>">
                            <?php if ((isset($_GET['aid']) && get_the_ID($agency->ID) == intval($_GET['aid'])) || get_the_ID($agency->ID) == intval($post_id)) : ?>
                                <b><?php echo get_the_title($agency->ID) . $agency->ID ?> </b>
                            <?php else : ?>
                                <?php echo get_the_title($agency->ID) ?>
                            <?php endif; ?>
                        </a>
                    </li>

                <?php endwhile; ?>
            </ul>

        <?php else : ?>
            <?php _e('No agency registered', 'unite'); ?>
        <?php endif; ?>
    </aside>

    <?php if (is_front_page()) : ?>
        <aside id="tax" class="widget">
            <h3 class="widget-title">
                <?php _e('Filter by real estate type', 'unite'); ?></a>
            </h3>
            <?php
            $terms = get_terms(
                array(
                    'taxonomy' => 'realestate_type',
                    'hide_empty' => false,
                )
            );

            if (!empty($terms) && is_array($terms)) : ?>
                <ul class="entry-content"> <?php
                    foreach ($terms as $term) : ?>
                        <li class="descr">
                            <a href="/?t=<?php echo $term->slug ?>">
                                <?php echo $term->name; ?>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>
        </aside>
    <?php endif; ?>
</div>
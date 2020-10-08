<?php
/**
 * The template for displaying Archive Agency pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package unite
 */

get_header(); ?>

<div id="agency" class="content-area col-sm-12 col-md-8">
    <?php $loop = new WP_Query(array('post_type' => 'agency', 'posts_per_page' => get_option('posts_per_page'))); ?>

    <?php while ($loop->have_posts()) : $loop->the_post(); ?>
        <div class="col-sm-6">
            <a href="<?php echo get_permalink($agency->ID); ?>" class="item-thumb">
                <?php the_post_thumbnail('medium'); ?>
            </a>
            <h2 class="item-title">
                <a href="<?php echo get_permalink($agency->ID); ?>">
                    <?php the_title(); ?>
                </a>
            </h2>
            <?php //the_content(); ?>
        </div>

    <?php endwhile; ?>
</div>

<?php get_sidebar(); ?>
<?php get_footer(); ?>

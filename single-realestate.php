<?php
/**
 * The Template for displaying single Real Estate item.
 *
 * @package unite
 */

get_header(); ?>

<div id="primary" class="content-area col-sm-12 col-md-8 <?php echo esc_attr(unite_get_option('site_layout')); ?>">
    <main id="main" class="site-main" role="main">
        <?php while (have_posts()) : the_post(); ?>

            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                <header class="entry-header page-header">
                    <?php the_post_thumbnail('unite-featured', array('class' => 'thumbnail')); ?>
                    <h1 class="entry-title "><?php the_title(); ?></h1>
                </header><!-- .entry-header -->

                <div class="entry-content">
                    <div class="col-md-8">
                        <?php the_content(); ?>
                    </div>
                    <div class="col-md-4">
                        <ul>
                            <li><b><?php echo get_field('address') ? get_field('address') : __('N/A', 'unite'); ?></b>
                            </li>
                            <li><?php _e('Price', 'unite'); ?>:
                                <?php echo get_field('cost_of') ? number_format_i18n(get_field('cost_of'), 2) . __('EUR', 'unite') : __('N/A', 'unite'); ?></li>
                            <li><?php _e('Area', 'unite'); ?>:
                                <?php echo get_field('area') ? get_field('area') . __('sq.m.', 'unite') : __('N/A', 'unite'); ?></li>
                            <li><?php _e('Living area', 'unite'); ?>:
                                <?php echo get_field('living_area') ? get_field('living_area') . __('sq.m.', 'unite') : __('N/A', 'unite'); ?></li>
                            <li><?php _e('Floor', 'unite'); ?>:
                                <?php echo get_field('floor') ? get_field('floor') : __('N/A', 'unite'); ?></li>
                        </ul>
                        <a name="aid" class="btn btn-primary read-more"
                           href="<?php $agency = get_field('agency', $post_object->ID);
                           echo get_permalink($agency->ID); ?>"><?php echo get_the_title($agency->ID) ?></a>
                    </div>

                    <?php
                    wp_link_pages(array(
                        'before' => '<div class="page-links">' . __('Pages:', 'unite'),
                        'after' => '</div>',
                    ));
                    ?>
                </div><!-- .entry-content -->

                <footer class="entry-meta">
                    <?php
                    /* translators: used between list items, there is a space after the comma */
                    $category_list = get_the_category_list(__(', ', 'unite'));

                    /* translators: used between list items, there is a space after the comma */
                    $tag_list = get_the_tag_list('', __(', ', 'unite'));

                    if (!unite_categorized_blog()) {
                        // This blog only has 1 category so we just need to worry about tags in the meta text
                        if ('' != $tag_list) {
                            $meta_text = '<i class="fa fa-folder-open-o"></i> %2$s. <i class="fa fa-link"></i> <a href="%3$s" rel="bookmark">' . esc_html__('permalink', 'unite') . '</a>.';
                        } else {
                            $meta_text = '<i class="fa fa-link"></i> <a href="%3$s" rel="bookmark">' . esc_html__('permalink', 'unite') . '</a>.';
                        }

                    } else {
                        // But this blog has loads of categories so we should probably display them here
                        if ('' != $tag_list) {
                            $meta_text = '<i class="fa fa-folder-open-o"></i> %1$s <i class="fa fa-tags"></i> %2$s. <i class="fa fa-link"></i> <a href="%3$s" rel="bookmark">' . esc_html__('permalink', 'unite') . '</a>.';
                        } else {
                            $meta_text = '<i class="fa fa-folder-open-o"></i> %1$s. <i class="fa fa-link"></i> <a href="%3$s" rel="bookmark">' . esc_html__('permalink', 'unite') . '</a>.';
                        }

                    } // end check for categories on this blog

                    printf(
                        $meta_text,
                        $category_list,
                        $tag_list,
                        esc_url(get_permalink())
                    );
                    ?>

                    <?php edit_post_link(__('Edit', 'unite'), '<i class="fa fa-pencil-square-o"></i><span class="edit-link">', '</span>'); ?>
                    <hr class="section-divider">

                    <?php unite_post_nav(); ?>

                </footer><!-- .entry-meta -->
            </article><!-- #post-## -->


        <?php endwhile; ?>

    </main>
</div>

<?php get_sidebar(); ?>
<?php get_footer(); ?>

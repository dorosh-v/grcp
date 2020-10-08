<?php
/**
 * The Template for displaying all single Agency
 * .
 *
 * @package unite
 */

get_header();
?>

    <div id="primary"
         class="site-main content-area col-sm-12 col-md-8 <?php echo esc_attr(unite_get_option('site_layout')); ?>">
        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            <header class="entry-header page-header">
                <h1 class="entry-title "><?php the_title(); ?></h1>
            </header>

            <div class="entry-content">
                <a href="<?php echo get_permalink(); ?>" class="item-thumb">
                    <?php the_post_thumbnail('large'); ?>
                </a>
                <?php the_content(); ?>
                <p>
                    <a href="/?aid=<?php the_ID(); ?>" class="btn btn-primary">
                        <?php _e('View Real Estate listing', 'unite'); ?>
                    </a>
                </p>
            </div>

            <footer class="entry-meta">
                <?php edit_post_link(__('Edit', 'unite'), '<i class="fa fa-pencil-square-o"></i><span class="edit-link">', '</span>'); ?>
                <hr class="section-divider">
                <?php unite_post_nav(); ?>
            </footer>
        </article>
    </div>

<?php get_sidebar(); ?>
<?php get_footer(); ?>
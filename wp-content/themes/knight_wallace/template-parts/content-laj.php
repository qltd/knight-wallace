<?php
/**
* Template part for displaying single library items.
*
* @link https://codex.wordpress.org/Template_Hierarchy
*
* @package knight_wallace
*/

?>

<?php
$image = get_the_post_thumbnail();
$pmeta = get_post_meta($post->ID);
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="row board-of-directors">
        <div class="large-10 large-centered columns">
            <div class="row director judge">
                <?php if(!empty($image)): ?>
                <div class="medium-2 columns text-right">
                    <div class="featured-image-wrap">
                        <?php echo $image; ?>
                    </div>
                </div>
                <?php endif; ?>
                <div class="medium-10 columns">
                    <header class="entry-header">
                        <?php the_title( '<h2 class="name">', '</h2>' ); ?>
                        </header><!-- .entry-header -->
                        <div class="content">
                            <p class="title">
                                <?php echo !empty($pmeta['_kw_person_laj_title']) ? $pmeta['_kw_person_laj_title'][0] : ''; ?><?php echo !empty($pmeta['_kw_person_laj_aff']) ? ', ' . $pmeta['_kw_person_laj_aff'][0] : ''; ?><br />
                                <?php echo !empty($pmeta['_kw_person_laj_nat']) ? $pmeta['_kw_person_laj_nat'][0] : ''; ?>
                                Judge
                            </p>
                            <p class="bio">
                                <?php echo !empty($pmeta['_kw_person_laj_bio']) ? $pmeta['_kw_person_laj_bio'][0] : ''; ?>
                            </p>
                        </div>
                        <footer class="entry-footer">
                            <?php knight_wallace_entry_footer(); ?>
                            </footer><!-- .entry-footer -->
                        </div>
                    </div>
                </div>
            </div>

            </article><!-- #post-## -->
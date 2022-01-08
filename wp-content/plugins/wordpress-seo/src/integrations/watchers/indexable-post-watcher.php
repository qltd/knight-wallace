<?php

namespace Yoast\WP\SEO\Integrations\Watchers;

use Exception;
use WP_Post;
use Yoast\WP\SEO\Builders\Indexable_Builder;
use Yoast\WP\SEO\Builders\Indexable_Link_Builder;
use Yoast\WP\SEO\Conditionals\Migrations_Conditional;
use Yoast\WP\SEO\Helpers\Author_Archive_Helper;
use Yoast\WP\SEO\Helpers\Post_Helper;
use Yoast\WP\SEO\Integrations\Integration_Interface;
use Yoast\WP\SEO\Loggers\Logger;
use Yoast\WP\SEO\Models\Indexable;
use Yoast\WP\SEO\Repositories\Indexable_Hierarchy_Repository;
use Yoast\WP\SEO\Repositories\Indexable_Repository;
use YoastSEO_Vendor\Psr\Log\LogLevel;

/**
 * WordPress Post watcher.
 *
 * Fills the Indexable according to Post data.
 */
class Indexable_Post_Watcher implements Integration_Interface {

	/**
	 * The indexable repository.
	 *
	 * @var Indexable_Repository
	 */
	protected $repository;

	/**
	 * The indexable builder.
	 *
	 * @var Indexable_Builder
	 */
	protected $builder;

	/**
	 * The indexable hierarchy repository.
	 *
	 * @var Indexable_Hierarchy_Repository
	 */
	private $hierarchy_repository;

	/**
	 * The link builder.
	 *
	 * @var Indexable_Link_Builder
	 */
	protected $link_builder;

	/**
	 * The author archive helper.
	 *
	 * @var Author_Archive_Helper
	 */
	private $author_archive;

	/**
	 * Holds the Post_Helper instance.
	 *
	 * @var Post_Helper
	 */
	private $post;

	/**
	 * Holds the logger.
	 *
	 * @var Logger
	 */
	protected $logger;

	/**
	 * Returns the conditionals based on which this loadable should be active.
	 *
	 * @return array
	 */
	public static function get_conditionals() {
		return [ Migrations_Conditional::class ];
	}

	/**
	 * Indexable_Post_Watcher constructor.
	 *
	 * @param Indexable_Repository           $repository           The repository to use.
	 * @param Indexable_Builder              $builder              The post builder to use.
	 * @param Indexable_Hierarchy_Repository $hierarchy_repository The hierarchy repository to use.
	 * @param Indexable_Link_Builder         $link_builder         The link builder.
	 * @param Author_Archive_Helper          $author_archive       The author archive helper.
	 * @param Post_Helper                    $post                 The post helper.
	 * @param Logger                         $logger               The logger.
	 */
	public function __construct(
		Indexable_Repository $repository,
		Indexable_Builder $builder,
		Indexable_Hierarchy_Repository $hierarchy_repository,
		Indexable_Link_Builder $link_builder,
		Author_Archive_Helper $author_archive,
		Post_Helper $post,
		Logger $logger
	) {
		$this->repository           = $repository;
		$this->builder              = $builder;
		$this->hierarchy_repository = $hierarchy_repository;
		$this->link_builder         = $link_builder;
		$this->author_archive       = $author_archive;
		$this->post                 = $post;
		$this->logger               = $logger;
	}

	/**
	 * Initializes the integration.
	 *
	 * This is the place to register hooks and filters.
	 *
	 * @return void
	 */
	public function register_hooks() {
		\add_action( 'wp_insert_post', [ $this, 'build_indexable' ], \PHP_INT_MAX );
		\add_action( 'delete_post', [ $this, 'delete_indexable' ] );
<<<<<<< HEAD
=======
		\add_action( 'wpseo_save_indexable', [ $this, 'updated_indexable' ], \PHP_INT_MAX, 2 );
>>>>>>> 4f5257590d2e7c22bdac7a915861fa8f02a12394

		\add_action( 'edit_attachment', [ $this, 'build_indexable' ], \PHP_INT_MAX );
		\add_action( 'add_attachment', [ $this, 'build_indexable' ], \PHP_INT_MAX );
		\add_action( 'delete_attachment', [ $this, 'delete_indexable' ] );
	}

	/**
	 * Deletes the meta when a post is deleted.
	 *
	 * @param int $post_id Post ID.
	 *
	 * @return void
	 */
	public function delete_indexable( $post_id ) {
		$indexable = $this->repository->find_by_id_and_type( $post_id, 'post', false );

		// Only interested in post indexables.
		if ( ! $indexable || $indexable->object_type !== 'post' ) {
			return;
		}

<<<<<<< HEAD
		$this->update_relations( $this->post->get_post( $post_id ) );
=======
		if ( $indexable->is_public ) {
			$this->update_relations( $this->post->get_post( $post_id ) );
		}
>>>>>>> 4f5257590d2e7c22bdac7a915861fa8f02a12394

		$this->update_has_public_posts( $indexable );

		$this->hierarchy_repository->clear_ancestors( $indexable->id );
		$this->link_builder->delete( $indexable );
		$indexable->delete();
	}

	/**
	 * Updates the relations when the post indexable is built.
	 *
<<<<<<< HEAD
	 * @param Indexable $indexable The indexable.
	 * @param WP_Post   $post      The post.
	 */
	public function updated_indexable( $indexable, $post ) {
		// Only interested in post indexables.
		if ( $indexable->object_type !== 'post' ) {
			return;
		}

		if ( is_a( $post, Indexable::class ) ) {
			_deprecated_argument( __FUNCTION__, '17.7', 'The $old_indexable argument has been deprecated.' );
			$post = $this->post->get_post( $indexable->object_id );
		}

		$this->update_relations( $post );
		$this->update_has_public_posts( $indexable );

		$indexable->save();
=======
	 * @param Indexable $updated_indexable The updated indexable.
	 * @param Indexable $old_indexable     The old indexable.
	 */
	public function updated_indexable( $updated_indexable, $old_indexable ) {
		// Only interested in post indexables.
		if ( $updated_indexable->object_type !== 'post' ) {
			return;
		}

		$post = $this->post->get_post( $updated_indexable->object_id );

		// When the indexable is public or has a change in its public state.
		if ( $updated_indexable->is_public || $updated_indexable->is_public !== $old_indexable->is_public ) {
			$this->update_relations( $post );
		}

		$this->update_has_public_posts( $updated_indexable );

		$updated_indexable->save();
>>>>>>> 4f5257590d2e7c22bdac7a915861fa8f02a12394
	}

	/**
	 * Saves post meta.
	 *
	 * @param int $post_id Post ID.
	 *
	 * @return void
	 */
	public function build_indexable( $post_id ) {
		// Bail if this is a multisite installation and the site has been switched.
		if ( $this->is_multisite_and_switched() ) {
			return;
		}

		try {
			$indexable = $this->repository->find_by_id_and_type( $post_id, 'post', false );
			$indexable = $this->builder->build_for_id_and_type( $post_id, 'post', $indexable );

			$post = $this->post->get_post( $post_id );

			// Build links for this post.
			if ( $post && $indexable && \in_array( $post->post_status, $this->post->get_public_post_statuses(), true ) ) {
				$this->link_builder->build( $indexable, $post->post_content );
				// Save indexable to persist the updated link count.
				$indexable->save();
<<<<<<< HEAD
				$this->updated_indexable( $indexable, $post );
=======
>>>>>>> 4f5257590d2e7c22bdac7a915861fa8f02a12394
			}
		} catch ( Exception $exception ) {
			$this->logger->log( LogLevel::ERROR, $exception->getMessage() );
		}
	}

	/**
	 * Updates the has_public_posts when the post indexable is built.
	 *
	 * @param Indexable $indexable The indexable to check.
	 */
	protected function update_has_public_posts( $indexable ) {
		// Update the author indexable's has public posts value.
		try {
			$author_indexable                   = $this->repository->find_by_id_and_type( $indexable->author_id, 'user' );
			$author_indexable->has_public_posts = $this->author_archive->author_has_public_posts( $author_indexable->object_id );
			$author_indexable->save();
		} catch ( Exception $exception ) {
			$this->logger->log( LogLevel::ERROR, $exception->getMessage() );
		}

		// Update possible attachment's has public posts value.
		$this->post->update_has_public_posts_on_attachments( $indexable->object_id, $indexable->is_public );
	}

	/**
	 * Updates the relations on post save or post status change.
	 *
	 * @param WP_Post $post The post that has been updated.
	 */
	protected function update_relations( $post ) {
		$related_indexables = $this->get_related_indexables( $post );

<<<<<<< HEAD
		foreach ( $related_indexables as $indexable ) {
			$indexable->object_last_modified = max( $indexable->object_last_modified, $post->post_modified_gmt );
=======
		$updated_at = \gmdate( 'Y-m-d H:i:s' );
		foreach ( $related_indexables as $indexable ) {
			if ( ! $indexable->is_public ) {
				continue;
			}

			$indexable->updated_at = $updated_at;
>>>>>>> 4f5257590d2e7c22bdac7a915861fa8f02a12394
			$indexable->save();
		}
	}

	/**
	 * Retrieves the related indexables for given post.
	 *
	 * @param WP_Post $post The post to get the indexables for.
	 *
	 * @return Indexable[] The indexables.
	 */
	protected function get_related_indexables( $post ) {
		/**
		 * The related indexables.
		 *
		 * @var Indexable[] $related_indexables .
		 */
		$related_indexables   = [];
		$related_indexables[] = $this->repository->find_by_id_and_type( $post->post_author, 'user', false );
		$related_indexables[] = $this->repository->find_for_post_type_archive( $post->post_type, false );
		$related_indexables[] = $this->repository->find_for_home_page( false );

		$taxonomies = \get_post_taxonomies( $post->ID );
		$taxonomies = \array_filter( $taxonomies, 'is_taxonomy_viewable' );
<<<<<<< HEAD
		$term_ids   = [];
=======
>>>>>>> 4f5257590d2e7c22bdac7a915861fa8f02a12394
		foreach ( $taxonomies as $taxonomy ) {
			$terms = \get_the_terms( $post->ID, $taxonomy );

			if ( empty( $terms ) || \is_wp_error( $terms ) ) {
				continue;
			}

<<<<<<< HEAD
			$term_ids = \array_merge( $term_ids, \wp_list_pluck( $terms, 'term_id' ) );
		}
		$related_indexables = \array_merge(
			$related_indexables,
			$this->repository->find_by_multiple_ids_and_type( $term_ids, 'term', false )
		);
=======
			foreach ( $terms as $term ) {
				$related_indexables[] = $this->repository->find_by_id_and_type( $term->term_id, 'term', false );
			}
		}
>>>>>>> 4f5257590d2e7c22bdac7a915861fa8f02a12394

		return \array_filter( $related_indexables );
	}

	/**
	 * Tests if the site is multisite and switched.
	 *
	 * @return bool True when the site is multisite and switched
	 */
	protected function is_multisite_and_switched() {
		return \is_multisite() && \ms_is_switched();
	}
}

<?php

/**
 * Custom Block Patterns
 */

/* Accordions */
add_action('init', function () {
    register_block_pattern(
        'q/accordion',
        array(
            'title' => __('Accordion Block Pattern', 'q-accordion-block'),
            'description' => _x('Accordion block pattern', 'Block pattern description', 'q-accordion-block'),
            'categories' => array('text'),
            'icon' => 'admin-settings',
            'keywords' => array('accordion', 'faq', 'hide', 'show'),
            'content' => '
                <!-- wp:group -->
                <div class="wp-block-group q-accordion-block">
                    <!-- wp:heading -->
                    <h2 class="q-accordion-block__header">Accordion Header</h2>
                    <!-- /wp:heading -->

                    <!-- wp:group -->
                    <div class="wp-block-group q-accordion-block__content"></div>
                    <!-- /wp:group -->
                </div>
                <!-- /wp:group -->',
        )
    );
});

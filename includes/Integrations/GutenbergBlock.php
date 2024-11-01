<?php

namespace SREL_Calculator_Lib\Integrations;

class Gutenberg_Block {

    /**
     * Indicate if current integration is allowed to load.
     *
     * @since 1.4.8
     *
     * @return bool
     */
    public function allow_load() {
        return function_exists( 'register_block_type' );
    }

    /**
     * Load an integration.
     */
    public function load() {
        $this->hooks();
    }

    /**
     * Integration hooks.
     *
     * @since 1.4.8
     */
    protected function hooks() {
        add_action( 'init', [ $this, 'register_block' ] );
        add_action( 'enqueue_block_editor_assets', [ $this, 'enqueue_block_editor_assets' ] );
    }

    /**
     * Register the block.
     *
     * @since 1.4.8
     */
    public function register_block() {
        // Register the block.
        register_block_type(
            'stylish-real-estate-leads/lead-forms-picker',
            [
                'attributes'      => [
                    'leadFormId' => [
                        'type' => 'number',
                    ],
                ],
                'render_callback' => [ $this, 'render_block' ],
            ]
        );
    }

    public function render_block( $attr ) {
        // $lead_form_id = $attr['leadFormId'];

        return do_shortcode( "[srel-mortgage-calc]" );
    }

    public function enqueue_block_editor_assets() {
        wp_enqueue_script(
            'stylish-real-estate-leads-gutenberg-block',
            SREL_MORTGAGE_CALCULATOR_ASSETS . '/js/gutenberg-block.es5.js',
            [ 'wp-blocks', 'wp-i18n', 'wp-element', 'wp-components', 'wp-editor' ],
            SREL_MORTGAGE_CALCULATOR_BETA ? filemtime( SREL_MORTGAGE_CALCULATOR_ASSETS_DIR . '/js/gutenberg-block.es5.js' ) : SREL_MORTGAGE_CALCULATOR_VERSION,
            true
        );
        wp_enqueue_style(
            'stylish-real-estate-leads-gutenberg-block',
            SREL_MORTGAGE_CALCULATOR_ASSETS . '/css/gutenberg-block.css',
            [ 'wp-edit-blocks' ],
            SREL_MORTGAGE_CALCULATOR_BETA ? filemtime( SREL_MORTGAGE_CALCULATOR_ASSETS_DIR . '/css/gutenberg-block.css' ) : SREL_MORTGAGE_CALCULATOR_VERSION
        );
        wp_localize_script(
            'stylish-real-estate-leads-gutenberg-block',
            'srel_data',
            $this->get_lead_form_data()
        );
    }
    private function get_lead_form_data() {
        return [
            'logo' => SREL_MORTGAGE_CALCULATOR_ASSETS . '/images/srel-logo-gutenberg.png',
            ['value' => 'test',
            "label" => "test",]
        ];
    }
}

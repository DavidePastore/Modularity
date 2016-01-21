<?php

namespace Modularity\Module\Hero;

class Hero extends \Modularity\Module
{
    public function __construct()
    {
        $this->register(
            'hero',
            __("Hero (slider)", 'modularity-plugin'),
            __("Heroes (sliders)", 'modularity-plugin'),
            __("Outputs multiple images or videos in a sliding apperance.", 'modularity-plugin'),
            array(),
            null,
            'acf-website-field/acf-website_field.php'
        );

        add_action('plugins_loaded', array($this,'acfFields'));
    }

    public function acfFields()
    {
		if( function_exists('acf_add_local_field_group') ):
		
		acf_add_local_field_group(array (
			'key' => 'group_5666e53f3848a',
			'title' => 'Slides',
			'fields' => array (
				array (
					'key' => 'field_5666e565c457c',
					'label' => 'Images in this slide widget',
					'name' => 'hero_repeater',
					'type' => 'repeater',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array (
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'collapsed' => 'field_5666e5e1e134d',
					'min' => '',
					'max' => '',
					'layout' => 'block',
					'button_label' => 'Add Cell',
					'sub_fields' => array (
						array (
							'key' => 'field_5666e58bc457d',
							'label' => 'Cell Type',
							'name' => 'hero_rep_type',
							'type' => 'select',
							'instructions' => '',
							'required' => 0,
							'conditional_logic' => 0,
							'wrapper' => array (
								'width' => '',
								'class' => '',
								'id' => '',
							),
							'choices' => array (
								'image' => 'Image',
								'image_overlay' => 'Image With Overlay Text',
								'image_video' => 'Video',
								'image_video_overlay' => 'Video With Overlay Text',
							),
							'default_value' => array (
								'image' => 'image',
							),
							'allow_null' => 0,
							'multiple' => 0,
							'ui' => 0,
							'ajax' => 0,
							'placeholder' => '',
							'disabled' => 0,
							'readonly' => 0,
						),
						array (
							'key' => 'field_5666e5e1e134d',
							'label' => 'Cell Image',
							'name' => 'hero_rep_image',
							'type' => 'image',
							'instructions' => '',
							'required' => 0,
							'conditional_logic' => 0,
							'wrapper' => array (
								'width' => 40,
								'class' => '',
								'id' => '',
							),
							'return_format' => 'array',
							'preview_size' => 'thumbnail',
							'library' => 'all',
							'min_width' => '',
							'min_height' => '',
							'min_size' => '',
							'max_width' => '',
							'max_height' => '',
							'max_size' => '',
							'mime_types' => 'jpeg,jpg,png',
						),
						array (
							'key' => 'field_5666f98ae79b2',
							'label' => 'Cell Link',
							'name' => 'hero_rep_link',
							'type' => 'website',
							'instructions' => '',
							'required' => 0,
							'conditional_logic' => array (
								array (
									array (
										'field' => 'field_5666e58bc457d',
										'operator' => '==',
										'value' => 'image',
									),
								),
								array (
									array (
										'field' => 'field_5666e58bc457d',
										'operator' => '==',
										'value' => 'image_overlay',
									),
								),
							),
							'wrapper' => array (
								'width' => '',
								'class' => '',
								'id' => '',
							),
							'website_title' => 1,
							'internal_link' => 1,
							'output_format' => 1,
							'default_value' => '',
						),
						array (
							'key' => 'field_5666ed2ecddc8',
							'label' => 'Cell Title',
							'name' => 'hero_rep_title',
							'type' => 'text',
							'instructions' => '',
							'required' => 0,
							'conditional_logic' => array (
								array (
									array (
										'field' => 'field_5666e58bc457d',
										'operator' => '==',
										'value' => 'image_overlay',
									),
								),
								array (
									array (
										'field' => 'field_5666e58bc457d',
										'operator' => '==',
										'value' => 'image_video_overlay',
									),
								),
							),
							'wrapper' => array (
								'width' => '',
								'class' => '',
								'id' => '',
							),
							'default_value' => '',
							'placeholder' => '',
							'prepend' => '',
							'append' => '',
							'maxlength' => '',
							'readonly' => 0,
							'disabled' => 0,
						),
						array (
							'key' => 'field_5666ed3fcddc9',
							'label' => 'Cell Content',
							'name' => 'hero_rep_content',
							'type' => 'textarea',
							'instructions' => '',
							'required' => 0,
							'conditional_logic' => array (
								array (
									array (
										'field' => 'field_5666e58bc457d',
										'operator' => '==',
										'value' => 'image_overlay',
									),
								),
								array (
									array (
										'field' => 'field_5666e58bc457d',
										'operator' => '==',
										'value' => 'image_video_overlay',
									),
								),
							),
							'wrapper' => array (
								'width' => '',
								'class' => '',
								'id' => '',
							),
							'default_value' => '',
							'placeholder' => 'Write your content here.',
							'maxlength' => 500,
							'rows' => 2,
							'new_lines' => '',
							'readonly' => 0,
							'disabled' => 0,
						),
						array (
							'key' => 'field_5666edb33b26c',
							'label' => 'Cell Video Url',
							'name' => 'hero_rep_video',
							'type' => 'text',
							'instructions' => 'Supported video sources: YouTube, Vimeo',
							'required' => 0,
							'conditional_logic' => array (
								array (
									array (
										'field' => 'field_5666e58bc457d',
										'operator' => '==',
										'value' => 'image_video',
									),
								),
								array (
									array (
										'field' => 'field_5666e58bc457d',
										'operator' => '==',
										'value' => 'image_video_overlay',
									),
								),
							),
							'wrapper' => array (
								'width' => '',
								'class' => '',
								'id' => '',
							),
							'default_value' => '',
							'placeholder' => '',
							'prepend' => '',
							'append' => '',
							'maxlength' => '',
							'readonly' => 0,
							'disabled' => 0,
						),
					),
				),
			),
			'location' => array (
				array (
					array (
						'param' => 'post_type',
						'operator' => '==',
						'value' => 'mod-hero',
					),
				),
			),
			'menu_order' => 100,
			'position' => 'normal',
			'style' => 'default',
			'label_placement' => 'top',
			'instruction_placement' => 'label',
			'hide_on_screen' => '',
			'active' => 1,
			'description' => '',
		));
		
		acf_add_local_field_group(array (
			'key' => 'group_5666d1ab3fed2',
			'title' => 'Apperance',
			'fields' => array (
				array (
					'key' => 'field_5666d3e6e5890',
					'label' => 'Cell Width',
					'name' => 'mod_hero_app_width',
					'type' => 'number',
					'instructions' => 'Enter the with of the slide image in relation to the wrapper element (10-100%). ',
					'required' => 1,
					'conditional_logic' => 0,
					'wrapper' => array (
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'default_value' => 100,
					'placeholder' => '',
					'prepend' => '',
					'append' => '%',
					'min' => 10,
					'max' => 100,
					'step' => 10,
					'readonly' => 0,
					'disabled' => 0,
				),
				array (
					'key' => 'field_5666ded69f815',
					'label' => 'Cell Align',
					'name' => 'mod_hero_app_align',
					'type' => 'radio',
					'instructions' => 'Select alignment of content if a lower width than 100% is selected. ',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array (
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'choices' => array (
						'left' => 'Left',
						'center' => 'Center',
						'right' => 'Right',
					),
					'other_choice' => 0,
					'save_other_choice' => 0,
					'default_value' => '',
					'layout' => 'horizontal',
				),
				array (
					'key' => 'field_5666e1f8a6715',
					'label' => 'Contain Cells',
					'name' => 'mod_hero_app_contain',
					'type' => 'true_false',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array (
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'message' => 'Yes, contain images in wrapper (no whitespace left/right on scroll).',
					'default_value' => 1,
				),
				array (
					'key' => 'field_5666e39bce24c',
					'label' => 'Stick Scroll to Cells',
					'name' => 'mod_hero_app_sticky',
					'type' => 'true_false',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array (
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'message' => 'Yes, make cells sticky',
					'default_value' => 1,
				),
				array (
					'key' => 'field_5666e3fcafd40',
					'label' => 'Wrap Around',
					'name' => 'mod_hero_app_wrap',
					'type' => 'true_false',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array (
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'message' => 'Yes, make hero as an infinite loop.',
					'default_value' => 1,
				),
				array (
					'key' => 'field_5666e443d107a',
					'label' => 'Autoplay',
					'name' => 'mod_hero_app_ap',
					'type' => 'true_false',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array (
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'message' => 'Yes, enable autoplay (go to next slide automatically)',
					'default_value' => 1,
				),
				array (
					'key' => 'field_5666e474d107b',
					'label' => 'Autoplay - Time',
					'name' => 'mod_hero_app_time',
					'type' => 'number',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => array (
						array (
							array (
								'field' => 'field_5666e443d107a',
								'operator' => '==',
								'value' => '1',
							),
						),
					),
					'wrapper' => array (
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'default_value' => 1500,
					'placeholder' => '',
					'prepend' => 'I want to pause on each slide for',
					'append' => 'milliseconds',
					'min' => 100,
					'max' => 12000,
					'step' => 100,
					'readonly' => 0,
					'disabled' => 0,
				),
			),
			'location' => array (
				array (
					array (
						'param' => 'post_type',
						'operator' => '==',
						'value' => 'mod-hero',
					),
				),
			),
			'menu_order' => 200,
			'position' => 'normal',
			'style' => 'default',
			'label_placement' => 'top',
			'instruction_placement' => 'label',
			'hide_on_screen' => '',
			'active' => 1,
			'description' => '',
		));
		
		endif;
    }
}

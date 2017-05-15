<?php 

if (function_exists('acf_add_local_field_group')) {
    acf_add_local_field_group(array(
    'key' => 'group_569e054a7f9c2',
    'title' => __('List', 'modularity'),
    'fields' => array(
        0 => array(
            'key' => 'field_569e0559eb084',
            'label' => __('Lista', 'modularity'),
            'name' => 'items',
            'type' => 'repeater',
            'instructions' => '',
            'required' => 0,
            'conditional_logic' => 0,
            'wrapper' => array(
                'width' => '',
                'class' => '',
                'id' => '',
            ),
            'min' => 1,
            'max' => 0,
            'layout' => 'block',
            'button_label' => 'Lägg till rad',
            'collapsed' => '',
            'sub_fields' => array(
                0 => array(
                    'key' => 'field_569e068b33f31',
                    'label' => __(__(__('Link type', 'modularity'), 'modularity'), 'modularity'),
                    'name' => 'type',
                    'type' => 'radio',
                    'instructions' => '',
                    'required' => 1,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ),
                    'layout' => 'horizontal',
                    'choices' => array(
                        'internal' => __(__(__('Internal link', 'modularity'), 'modularity'), 'modularity'),
                        'external' => __(__(__('External link', 'modularity'), 'modularity'), 'modularity'),
                    ),
                    'default_value' => 'internal',
                    'other_choice' => 0,
                    'save_other_choice' => 0,
                    'allow_null' => 0,
                    'return_format' => 'value',
                ),
                1 => array(
                    'key' => 'field_569e0567eb085',
                    'label' => __(__(__('Titel', 'modularity'), 'modularity'), 'modularity'),
                    'name' => 'title',
                    'type' => 'text',
                    'instructions' => __(__(__('If empty, title will default to the linked post\'s/page\'s title', 'modularity'), 'modularity'), 'modularity'),
                    'required' => 0,
                    'conditional_logic' => array(
                        0 => array(
                            0 => array(
                                'field' => 'field_569e068b33f31',
                                'operator' => '==',
                                'value' => 'internal',
                            ),
                        ),
                    ),
                    'wrapper' => array(
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ),
                    'default_value' => '',
                    'maxlength' => '',
                    'placeholder' => '',
                    'prepend' => '',
                    'append' => '',
                    'readonly' => 0,
                    'disabled' => 0,
                ),
                2 => array(
                    'key' => 'field_569e05bceb086',
                    'label' => __(__(__('Link', 'modularity'), 'modularity'), 'modularity'),
                    'name' => 'link_internal',
                    'type' => 'post_object',
                    'instructions' => '',
                    'required' => 1,
                    'conditional_logic' => array(
                        0 => array(
                            0 => array(
                                'field' => 'field_569e068b33f31',
                                'operator' => '==',
                                'value' => 'internal',
                            ),
                        ),
                    ),
                    'wrapper' => array(
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ),
                    'post_type' => array(
                    ),
                    'taxonomy' => array(
                    ),
                    'allow_null' => 0,
                    'multiple' => 0,
                    'return_format' => 'object',
                    'ui' => 1,
                ),
                3 => array(
                    'key' => 'field_569e05f8eb087',
                    'label' => __(__(__('Date', 'modularity'), 'modularity'), 'modularity'),
                    'name' => 'date',
                    'type' => 'true_false',
                    'instructions' => __(__(__('If checked, the publish/last modified date of the linked post will be displayed.', 'modularity'), 'modularity'), 'modularity'),
                    'required' => 0,
                    'conditional_logic' => array(
                        0 => array(
                            0 => array(
                                'field' => 'field_569e068b33f31',
                                'operator' => '==',
                                'value' => 'internal',
                            ),
                        ),
                    ),
                    'wrapper' => array(
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ),
                    'default_value' => 0,
                    'message' => __(__(__('Show publish date', 'modularity'), 'modularity'), 'modularity'),
                    'ui' => 0,
                    'ui_on_text' => '',
                    'ui_off_text' => '',
                ),
                4 => array(
                    'key' => 'field_569e06f633f32',
                    'label' => __(__(__('Link', 'modularity'), 'modularity'), 'modularity'),
                    'name' => 'link_external',
                    'type' => 'url',
                    'instructions' => '',
                    'required' => 1,
                    'conditional_logic' => array(
                        0 => array(
                            0 => array(
                                'field' => 'field_569e068b33f31',
                                'operator' => '==',
                                'value' => 'external',
                            ),
                        ),
                    ),
                    'wrapper' => array(
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ),
                    'default_value' => '',
                    'placeholder' => '',
                ),
            ),
        ),
    ),
    'location' => array(
        0 => array(
            0 => array(
                'param' => 'post_type',
                'operator' => '==',
                'value' => 'post',
            ),
        ),
    ),
    'menu_order' => 0,
    'position' => 'normal',
    'style' => 'default',
    'label_placement' => 'top',
    'instruction_placement' => 'label',
    'hide_on_screen' => '',
    'active' => 1,
    'description' => '',
));
}
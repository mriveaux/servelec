<?php

    if (!class_exists('bascula')) {
        class bascula
        {
            const POST_TYPE = "bascula";

            public function __construct ()
            {
                add_action('init', [&$this, 'init']);
                add_action('admin_init', [&$this, 'admin_init']);

                add_filter('bulk_post_updated_messages', [$this, 'bulk_post_updated_messages_bascula'], 10, 2);
                add_filter('post_updated_messages', [$this, 'post_updated_messages_bascula']);
            }

            public function init ()
            {
                // Initialize Post Type
                $this->create_post_type();
            }

            public function create_post_type ()
            {
                $labels = [
                    "name" => __( "Básculas", "alante-ebusiness" ),
                    "singular_name" => __( "Báscula", "alante-ebusiness" ),
                    "all_items" => __( "Básculas", "alante-ebusiness" ),
                    "add_new" => __( "Añadir nueva", "alante-ebusiness" ),
                    "add_new_item" => __( "Añadir nueva báscula", "alante-ebusiness" ),
                    "edit_item" => __( "Editar báscula", "alante-ebusiness" ),
                    "new_item" => __( "Nueva báscula", "alante-ebusiness" ),
                    "view_item" => __( "Ver báscula", "alante-ebusiness" ),
                    "view_items" => __( "Ver básculas", "alante-ebusiness" ),
                    "search_items" => __( "Buscar básculas", "alante-ebusiness" ),
                    "not_found" => __( "No se han encontrado básculas", "alante-ebusiness" ),
                    "not_found_in_trash" => __( "No se han encontrado básculas en la papelera", "alante-ebusiness" ),
                    "parent" => __( "Báscula padre:", "alante-ebusiness" ),
                    "parent_item_colon" => __( "Báscula padre:", "alante-ebusiness" ),
                ];
                $args = [
                    "label" => __( "Básculas", "alante-ebusiness" ),
                    "labels" => $labels,
                    "description" => "Básculas",
                    "public" => true,
                    "publicly_queryable" => true,
                    "show_ui" => true,
                    "show_in_rest" => true,
                    "rest_base" => "",
                    "rest_controller_class" => "WP_REST_Posts_Controller",
                    "has_archive" => false,
                    "show_in_menu" => "servelec",
                    "show_in_nav_menus" => true,
                    "delete_with_user" => false,
                    "exclude_from_search" => false,
                    "capability_type" => "post",
                    "map_meta_cap" => true,
                    "hierarchical" => false,
                    "rewrite" => [ "slug" => "bascula", "with_front" => true ],
                    "query_var" => true,
                    "supports" => [ "title", "editor", "thumbnail", "excerpt", "custom-fields" ],
                ];
                register_post_type(self::POST_TYPE, $args);
            }

            public function admin_init ()
            {
                // Add metaboxes
                self::generate_fields();
                // Validate metaboxes
                self::validate_fields();
                //Update post title with value name
                add_filter('acf/update_value/name=nombre_bascula', [$this, 'update_title_value_with_name_bascula'], 10, 3);
                // Add custom columns
                add_filter('manage_' . self::POST_TYPE . '_posts_columns', [$this, 'set_manage_bascula_posts_columns']);
                // Fill the columns
                add_action('manage_posts_custom_column', [$this, 'set_manage_bascula_posts_custom_column'], 10, 2);
                // Make Sorteable
                add_filter('manage_edit-' . self::POST_TYPE . '_sortable_columns', [$this, 'set_manage_edit_bascula_sortable_columns']);
                // Publish Actions
                add_action('post_submitbox_start', [$this, 'post_submitbox_start_'. self::POST_TYPE]);
                // Bulk Actions
                add_filter('handle_bulk_actions-edit-' . self::POST_TYPE, [$this, 'set_handle_bulk_actions_edit_bascula'], 10, 3);
                add_action('admin_notices', [$this, 'register_my_bulk_action_admin_notice_bascula']);
            }

            function generate_fields ()
            {
                if( function_exists('acf_add_local_field_group') ):
                    acf_add_local_field_group(array(
                        'key' => 'group_5c8dd40862f38',
                        'title' => 'Datos del producto',
                        'fields' => array(
                            array(
                                'key' => 'field_5d6d081d22bbe',
                                'label' => 'Nombre',
                                'name' => 'nombre_bascula',
                                'type' => 'text',
                                'instructions' => '',
                                'required' => 1,
                                'conditional_logic' => 0,
                                'wrapper' => array(
                                    'width' => '',
                                    'class' => '',
                                    'id' => '',
                                ),
                                'default_value' => '',
                                'placeholder' => '',
                                'prepend' => '',
                                'append' => '',
                                'maxlength' => 100,
                            ),
                            array(
                                'key' => 'field_5d6d08b522bbf',
                                'label' => 'Descripción',
                                'name' => 'descripcion_bascula',
                                'type' => 'textarea',
                                'instructions' => '',
                                'required' => 1,
                                'conditional_logic' => 0,
                                'wrapper' => array(
                                    'width' => '',
                                    'class' => '',
                                    'id' => '',
                                ),
                                'default_value' => '',
                                'placeholder' => '',
                                'maxlength' => 1000,
                                'rows' => '',
                                'new_lines' => 'wpautop',
                            ),
                            array(
                                'key' => 'field_5c9474b54d733',
                                'label' => 'Categoría del producto',
                                'name' => 'categoria_bascula',
                                'type' => 'post_object',
                                'instructions' => '',
                                'required' => 1,
                                'conditional_logic' => 0,
                                'wrapper' => array(
                                    'width' => '',
                                    'class' => '',
                                    'id' => '',
                                ),
                                'post_type' => array(
                                    0 => 'category_bascula',
                                ),
                                'taxonomy' => '',
                                'allow_null' => 0,
                                'multiple' => 0,
                                'return_format' => 'id',
                                'ui' => 1,
                            ),
                            array(
                                'key' => 'field_5c8dd8f4aacbe',
                                'label' => 'Formato de presentación',
                                'name' => 'formato_bascula',
                                'type' => 'wysiwyg',
                                'instructions' => '',
                                'required' => 1,
                                'conditional_logic' => 0,
                                'wrapper' => array(
                                    'width' => '',
                                    'class' => '',
                                    'id' => '',
                                ),
                                'default_value' => '',
                                'tabs' => 'all',
                                'toolbar' => 'full',
                                'media_upload' => 1,
                                'delay' => 0,
                            ),
                            array(
                                'key' => 'field_5c94659cd3479',
                                'label' => 'Valor energético',
                                'name' => 'valor_energetico_bascula',
                                'type' => 'text',
                                'instructions' => '',
                                'required' => 1,
                                'conditional_logic' => 0,
                                'wrapper' => array(
                                    'width' => '',
                                    'class' => '',
                                    'id' => '',
                                ),
                                'default_value' => '',
                                'placeholder' => '',
                                'prepend' => '',
                                'append' => '',
                                'maxlength' => 1000,
                            ),
                            array(
                                'key' => 'field_5c9465cfd347a',
                                'label' => 'Proteínas',
                                'name' => 'proteinas_bascula',
                                'type' => 'text',
                                'instructions' => '',
                                'required' => 1,
                                'conditional_logic' => 0,
                                'wrapper' => array(
                                    'width' => '',
                                    'class' => '',
                                    'id' => '',
                                ),
                                'default_value' => '',
                                'placeholder' => '',
                                'prepend' => '',
                                'append' => '',
                                'maxlength' => 100,
                            ),
                            array(
                                'key' => 'field_5c9465eed347b',
                                'label' => 'Hidratos de carbono',
                                'name' => 'hidratos_bascula',
                                'type' => 'text',
                                'instructions' => '',
                                'required' => 1,
                                'conditional_logic' => 0,
                                'wrapper' => array(
                                    'width' => '',
                                    'class' => '',
                                    'id' => '',
                                ),
                                'default_value' => '',
                                'placeholder' => '',
                                'prepend' => '',
                                'append' => '',
                                'maxlength' => 100,
                            ),
                            array(
                                'key' => 'field_5c946617d347c',
                                'label' => 'Grasas',
                                'name' => 'grasas_bascula',
                                'type' => 'text',
                                'instructions' => '',
                                'required' => 1,
                                'conditional_logic' => 0,
                                'wrapper' => array(
                                    'width' => '',
                                    'class' => '',
                                    'id' => '',
                                ),
                                'default_value' => '',
                                'placeholder' => '',
                                'prepend' => '',
                                'append' => '',
                                'maxlength' => 100,
                            ),
                            array(
                                'key' => 'field_5c8dd8ceaacbd',
                                'label' => 'Talla',
                                'name' => 'talla_bascula',
                                'type' => 'text',
                                'instructions' => '',
                                'required' => 1,
                                'conditional_logic' => 0,
                                'wrapper' => array(
                                    'width' => '',
                                    'class' => '',
                                    'id' => '',
                                ),
                                'default_value' => '',
                                'placeholder' => '',
                                'prepend' => '',
                                'append' => '',
                                'maxlength' => 1000,
                            ),
                            array(
                                'key' => 'field_5c8dd421aacbc',
                                'label' => 'Recetas',
                                'name' => 'recetas_bascula',
                                'type' => 'post_object',
                                'instructions' => '',
                                'required' => 0,
                                'conditional_logic' => 0,
                                'wrapper' => array(
                                    'width' => '',
                                    'class' => '',
                                    'id' => '',
                                ),
                                'post_type' => array(
                                    0 => 'receta',
                                ),
                                'taxonomy' => '',
                                'allow_null' => 0,
                                'multiple' => 1,
                                'return_format' => 'object',
                                'ui' => 1,
                            ),
                        ),
                        'location' => array(
                            array(
                                array(
                                    'param' => 'post_type',
                                    'operator' => '==',
                                    'value' => 'bascula',
                                ),
                            ),
                        ),
                        'menu_order' => 0,
                        'position' => 'normal',
                        'style' => 'default',
                        'label_placement' => 'top',
                        'instruction_placement' => 'label',
                        'hide_on_screen' => array(
                            0 => 'discussion',
                            1 => 'revisions',
                            2 => 'slug',
                            3 => 'format',
                            4 => 'page_attributes',
                            5 => 'send-trackbacks',
                        ),
                        'active' => true,
                        'description' => '',
                    ));
                endif;
            }

            function validate_fields ()
            {
                add_filter('acf/validate_value/name=nombre_bascula', [$this, 'acf_unique_value_field_bascula'], 10, 4);
                add_filter('acf/validate_value/name=nombre_bascula', [$this, 'acf_a_letter_bascula'], 10, 4);
                add_filter('acf/validate_value/name=nombre_bascula', [$this, 'acf_not_only_spaces_bascula'], 10, 4);
                add_filter('acf/validate_value/name=nombre_bascula', [$this, 'acf_validate_length_100_words_bascula'], 10, 4);

                add_filter('acf/validate_value/name=descripcion_bascula', [$this, 'acf_a_letter_bascula'], 10, 4);
                add_filter('acf/validate_value/name=descripcion_bascula', [$this, 'acf_not_only_spaces_bascula'], 10, 4);
                add_filter('acf/validate_value/name=descripcion_bascula', [$this, 'acf_validate_length_1000_words_bascula'], 10, 4);

                add_filter('acf/validate_value/name=formato_bascula', [$this, 'acf_a_letter_bascula'], 10, 4);
                add_filter('acf/validate_value/name=formato_bascula', [$this, 'acf_not_only_spaces_bascula'], 10, 4);
                add_filter('acf/validate_value/name=formato_bascula', [$this, 'acf_validate_length_1000_words_bascula'], 10, 4);

                add_filter('acf/validate_value/name=valor_energetico_bascula', [$this, 'acf_not_only_spaces_bascula'], 10, 4);
                add_filter('acf/validate_value/name=valor_energetico_bascula', [$this, 'acf_validate_length_100_words_bascula'], 10, 4);

                add_filter('acf/validate_value/name=proteinas_bascula', [$this, 'acf_not_only_spaces_bascula'], 10, 4);
                add_filter('acf/validate_value/name=proteinas_bascula', [$this, 'acf_validate_length_100_words_bascula'], 10, 4);

                add_filter('acf/validate_value/name=hidratos_bascula', [$this, 'acf_not_only_spaces_bascula'], 10, 4);
                add_filter('acf/validate_value/name=hidratos_bascula', [$this, 'acf_validate_length_100_words_bascula'], 10, 4);

                add_filter('acf/validate_value/name=grasas_bascula', [$this, 'acf_not_only_spaces_bascula'], 10, 4);
                add_filter('acf/validate_value/name=grasas_bascula', [$this, 'acf_validate_length_100_words_bascula'], 10, 4);

                add_filter('acf/validate_value/name=talla_bascula', [$this, 'acf_not_only_spaces_bascula'], 10, 4);
                add_filter('acf/validate_value/name=talla_bascula', [$this, 'acf_validate_length_1000_words_bascula'], 10, 4);

            }

            function bulk_post_updated_messages_bascula ($messages, $bulk_counts)
            {
                $messages[self::POST_TYPE] = [
                    'updated' => _n('La operación se ha realizado satisfactoriamente.', '%s productos han sido actualizados satisfactoriamente.', $bulk_counts['updated']),
                    'locked' => (1 == $bulk_counts['locked']) ? __('El producto no ha sido actualizado, alguien más lo está editando.') : _n('%s productos no han sido actualizados, alguien más los está editando.', '%s productos no han sido actualizados, alguien más los está editando.', $bulk_counts['locked']),
                    'deleted' => _n('El producto se ha eliminado satisfactoriamente.', '%s producto se han eliminado satisfactoriamente.', $bulk_counts['deleted'], 'wp_gesicu'),
                    'trashed' => _n('El producto se ha movido a la papelera.', '%s productos han sido movidos a la papelera.', $bulk_counts['trashed']),
                    'untrashed' => _n('El producto ha sido restaurado de la papelera.', '%s productos han sido restaurados de la papelera.', $bulk_counts['untrashed']),
                ];
                return $messages;
            }

            function post_updated_messages_bascula ($messages)
            {
                $messages[self::POST_TYPE] = [
                    0 => '', // Unused. Messages start at index 1.
                    1 => __('La operación se ha realizado satisfactoriamente.', 'wp_gesicu'),
                    2 => __('Campo personalizado actualizado.', 'wp_gesicu'),
                    3 => __('Campo personalizado borrado.', 'wp_gesicu'),
                    4 => __('La operación se ha realizado satisfactoriamente.', 'wp_gesicu'),
                    /* translators: %s: date and time of the revision */
                    5 => isset($_GET['revision']) ? sprintf(__('El producto se ha restaurado a la revisión %s'), wp_post_revision_title((int)$_GET['revision'], false)) : false,
                    6 => __('La operación se ha realizado satisfactoriamente.', 'wp_gesicu'),
                    7 => __('La operación se ha realizado satisfactoriamente.', 'wp_gesicu'),
                    8 => __('La operación se ha realizado satisfactoriamente.', 'wp_gesicu'),
                    9 => __('La operación se ha realizado satisfactoriamente.', 'wp_gesicu'),
                    10 => __('La operación se ha realizado satisfactoriamente.', 'wp_gesicu')
                ];
                return $messages;
            }

            function update_title_value_with_name_bascula ($value, $post_id, $field)
            {
                $my_post = ['ID' => $post_id, 'post_title' => $value, 'post_name' => sanitize_title($value)];  // Update the post into the database
                wp_update_post($my_post);
                return $value;
            }

            function set_manage_bascula_posts_columns ($columns)
            {
                unset($columns['title']);
                return array_merge([
                    'cb' => '<input type="checkbox" />',
                    'nombre_bascula' => __('Nombre', 'wp_gesicu'),
                    'categoria_bascula' => __('Categor&iacute;a', 'wp_gesicu')
                ], $columns);
            }

            function set_manage_bascula_posts_custom_column ($column, $post_id)
            {
                if (get_post_type() === self::POST_TYPE)
                    switch ($column) {
                        case 'nombre_bascula':
                            //First set up some variables
                            global $post;
                            $title = $post->post_title;
                            echo $title;
                            $actions = [];
                            $post_type_object = get_post_type_object($post->post_type);
                            $can_edit_post = current_user_can($post_type_object->cap->edit_post, $post->ID);
                            //Actions to edit
                            if ($can_edit_post && 'trash' != $post->post_status) {
                                $actions['edit'] = '<a href="' . get_edit_post_link($post->ID, true) . '" title="' . __('Edit') . '">' . __('Edit') . '</a>';
                            }
                            //Actions to delete/trash
                            if (current_user_can($post_type_object->cap->delete_post, $post->ID)) {
                                if ('trash' == $post->post_status) {
                                    $actions['untrash'] = sprintf(
                                        '<a href="%s" aria-label="%s">%s</a>',
                                        wp_nonce_url(admin_url(sprintf($post_type_object->_edit_link . '&amp;action=untrash', $post->ID)), 'untrash-post_' . $post->ID),
                                        /* translators: %s: post title */
                                        esc_attr(sprintf(__('Restore &#8220;%s&#8221; from the Trash'), $title)),
                                        __('Restore')
                                    );
                                } elseif (EMPTY_TRASH_DAYS) {
                                    $actions['trash'] = sprintf(
                                        '<a href="%s" class="submitdelete" onclick="return confirm(\'' . sprintf(__('¿Está seguro que desea eliminar %s (%s)?', 'wp_gesicu'), __('el producto', 'wp_gesicu'), get_field('nombre_bascula', $post_id)) . '\');" aria-label="%s">%s</a>',
                                        get_delete_post_link($post->ID),
                                        /* translators: %s: post title */
                                        esc_attr(sprintf(__('Move &#8220;%s&#8221; to the Trash'), $title)),
                                        _x('Trash', 'verb')
                                    );
                                }
                                if ('trash' === $post->post_status || !EMPTY_TRASH_DAYS) {
                                    $actions['delete'] = sprintf(
                                        '<a href="%s" class="submitdelete" onclick="return confirm(\'' . sprintf(__('¿Está seguro que desea eliminar %s (%s)?', 'wp_gesicu'), __('el producto', 'wp_gesicu'), get_field('nombre_bascula', $post_id)) . '\');" aria-label="%s">%s</a>',
                                        get_delete_post_link($post->ID, '', true),
                                        /* translators: %s: post title */
                                        esc_attr(sprintf(__('Delete &#8220;%s&#8221; permanently'), $title)),
                                        __('Delete Permanently')
                                    );
                                }
                            }
                            //Actions to view/preview
                            if (is_post_type_viewable($post_type_object)) {
                                if (in_array($post->post_status, ['pending', 'draft', 'future'])) {
                                    if ($can_edit_post) {
                                        $preview_link = get_preview_post_link($post);
                                        $actions['view'] = sprintf(
                                            '<a href="%s" rel="bookmark" aria-label="%s">%s</a>',
                                            esc_url($preview_link),
                                            /* translators: %s: post title */
                                            esc_attr(sprintf(__('View &#8220;%s&#8221;'), $title)),
                                            __('Preview')
                                        );
                                    }
                                } elseif ('trash' != $post->post_status) {
                                    $actions['view'] = sprintf(
                                        '<a href="%s" rel="bookmark" aria-label="%s">%s</a>',
                                        get_permalink($post->ID),
                                        /* translators: %s: post title */
                                        esc_attr(sprintf(__('View &#8220;%s&#8221;'), $title)),
                                        __('View')
                                    );
                                }
                            }
                            echo '<br>';
                            echo join(' | ', $actions);
                            break;
                        case 'categoria_bascula':
                            $idPost = get_field('categoria_bascula');
                            $title = get_post($idPost)->post_title;
                            $link = get_edit_post_link($idPost, true);
                            echo '<a href="' . $link . '">' . $title . '</a>';
                            break;
                    }
            }

            function set_manage_edit_bascula_sortable_columns ($sortable_columns)
            {
                $sortable_columns['nombre_bascula'] = 'nombre_bascula';
                $sortable_columns['categoria_bascula'] = 'categoria_bascula';
                return $sortable_columns;
            }

            function set_handle_bulk_actions_edit_bascula ($redirect_to, $doaction, $post_ids)
            {
                if ($doaction !== 'my_delete') {
                    return $redirect_to;
                }
                $count = 0;
                foreach ($post_ids as $post_id) {
                    $asd = wp_delete_post($post_id);
                    if ($asd !== false) $count++;
                }
                $redirect_to = add_query_arg([
                    'success_on_delete' => $count,
                    'error_on_delete' => count($post_ids) - $count,
                ], $redirect_to);
                return $redirect_to;
            }

            function register_my_bulk_action_admin_notice_bascula ()
            {
                if (!empty($_REQUEST['bulk_my_delete'])) {
                    $delete_count = intval($_REQUEST['bulk_my_delete']);
                    if (get_post_type() === self::POST_TYPE) {
                        printf('<div id="message" class="notice notice-success is-dismissible"><p>' .
                            _n('El producto ha sido eliminado satisfactoriamente.',
                                'Se han eliminado %s productos satisfactoriamente.',
                                $delete_count,
                                'wp_gesicu'
                            ) . '</p></div>', $delete_count);
                    }
                }
                if (get_post_type() === self::POST_TYPE) {
                    if (!empty($_REQUEST['saved'])) {
                        echo '<div id="message" class="notice notice-success is-dismissible"><p>' .
                            __('La operación se ha realizado satisfactoriamente.', 'wp_gesicu') . '</p></div>';
                    }
                }
            }

            function acf_unique_value_field_bascula ($valid, $value, $field, $input)
            {
                    if ($value == '')
                        return $valid;
                    if (!$valid || (!isset($_POST['post_ID']) && !isset($_POST['post_id']))) {
                        return $valid;
                    }
                    if (isset($_POST['post_ID'])) {
                        $post_id = intval($_POST['post_ID']);
                    } else {
                        $post_id = intval($_POST['post_id']);
                    }
                    if (!$post_id) {
                        return $valid;
                    }
                    $post_type = get_post_type($post_id);
                    $field_name = $field['name'];
                    $args = [
                        'post_type' => $post_type,
                        'post_status' => 'publish, draft, trash',
                        'post__not_in' => [$post_id],
                        'meta_query' => [
                            [
                                'key' => $field_name,
                                'value' => $value
                            ]
                        ]
                    ];
                    $query = new WP_Query($args);
                    if (count($query->posts)) {
                        return sprintf(__('Ya existe un %s con ese campo: %s.', 'wp_gesicu'), __('producto', 'wp_gesicu'), $field['label']);
                    }
                return true;
            }

            function acf_validate_length_100_words_bascula ($valid, $value, $field, $input)
            {
                if (!empty($value)) {
                    $characters = str_split($value);
                    $length_word = 0;
                    foreach ($characters as $character) {
                        if ($character == ' ') {
                            $length_word = 0;
                        } else {
                            $length_word++;
                        }
                        if ($length_word >= 100) {
                            return __('Las palabras deben contener menos de 100 caracteres.', 'wp_gesicu');
                        }
                    }
                }

                return $valid;
            }

            function acf_validate_length_1000_words_bascula ($valid, $value, $field, $input)
            {
                if (!empty($value)) {
                    $characters = str_split($value);
                    $length_word = 0;
                    foreach ($characters as $character) {
                        if ($character == ' ') {
                            $length_word = 0;
                        } else {
                            $length_word++;
                        }
                        if ($length_word >= 1000) {
                            return __('Las palabras deben contener menos de 1000 caracteres.', 'wp_gesicu');
                        }
                    }
                }

                return $valid;
            }

            function acf_a_letter_bascula ($valid, $value, $field, $input)
            {
                if (empty($value))
                    return $valid;
                $characters = str_split($value);
                foreach ($characters as $character) {
                    if (ctype_alpha($character))
                        return $valid;
                }
                return sprintf(__('El campo %s debe contener al menos una letra.', 'wp_gesicu'), $field['label']);
            }

            function acf_not_only_spaces_bascula ($valid, $value, $field, $input)
            {
                $characters = str_split($value);
                foreach ($characters as $character) {
                    if ($character != ' ')
                        return $valid;

                }
                return sprintf(__('El campo %s no puede contener solo espacios.', 'wp_gesicu'), $field['label']);
            }

        }
    }

<?php
/*Replace = contatti*/

function HT_custom_contatti() {
    register_post_type( 'contatti',
        array(
            'labels'                =>          array(
                'name'              =>          'Contatti utili', //nome principale nella sidebar
                'singular_name'     =>          'Contatto',
                'all_items'         =>          'Tutti i contatti', //nome link per visualizzare tutti i post
                'add_new'           =>          'Aggiungi nuovo contatto', //nome link per aggiungere nuovo post
                'add_new_item'      =>          'Aggiungi nuovo  contatto', //titolo della pagina di aggiunta di un nuovo post
                'edit_item'         =>          'Modifica contatto', //titolo della pagina di aggiunta di un nuovo post
                'new_item'          =>          'Nuovo contatto',
                'view_item'         =>          'Visualizza contatto',
                'search_items'      =>          'Cerca',
                'not_found'         =>          'Nessun elemento trovato',
                'not_found_in_trash'=>          'Nessun elemento nel cestino',
                'parent_item_colon' =>          '',
            ),
            'description'           =>          'Contatti',
            'public'                =>          true,
            'publicly_queryable'    =>          true,
            'exclude_from_search'   =>          false,
            'show_ui'               =>          true,
            'query_var'             =>          true,
            'menu_position'         =>          20,
            'menu_icon'             =>          'dashicons-id-alt', //Dashicon
            'rewrite'               =>          array(
                'slug'              =>          'contatti',
                'with-front'        =>          false,
            ),
            'has_archive'           =>          true,
            'capability_type'       =>          'post',
            'hierarchycal'          =>          false,
            // 'taxonomies'            =>          array(''),
            'show_in_rest'          =>          false, //gutemberg disattivato
            'supports'              =>          array('title') //campi supportati
        ), flush_rewrite_rules() /*fine delle opzioni*/
    );
}
add_action( 'init', 'HT_custom_contatti');

?>
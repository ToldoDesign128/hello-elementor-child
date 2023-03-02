<?php
/*Replace = documenti*/

function HT_custom_documenti() {
    register_post_type( 'documenti',
        array(
            'labels'                =>          array(
                'name'              =>          'Approfondimenti', //nome principale nella sidebar
                'singular_name'     =>          'Approfondimento',
                'all_items'         =>          'Tutti', //nome link per visualizzare tutti i post
                'add_new'           =>          'Aggiungi nuovo', //nome link per aggiungere nuovo post
                'add_new_item'      =>          'Aggiungi nuovo ', //titolo della pagina di aggiunta di un nuovo post
                'edit_item'         =>          'Modifica', //titolo della pagina di aggiunta di un nuovo post
                'new_item'          =>          'Nuovo',
                'view_item'         =>          'Visualizza',
                'search_items'      =>          'Cerca',
                'not_found'         =>          'Nessun elemento trovato',
                'not_found_in_trash'=>          'Nessun elemento nel cestino',
                'parent_item_colon' =>          '',
            ),
            'description'           =>          'Approfondimenti',
            'public'                =>          true,
            'publicly_queryable'    =>          true,
            'exclude_from_search'   =>          false,
            'show_ui'               =>          true,
            'query_var'             =>          true,
            'menu_position'         =>          20,
            'menu_icon'             =>          'dashicons-clipboard', //Dashicon
            'rewrite'               =>          array(
               'slug'              =>          'documenti',
               'with-front'        =>          false,
            ),
            'has_archive'           =>          false,
            'capability_type'       =>          'post',
            'hierarchycal'          =>          false,
            'taxonomies'            =>          array(''),
            'show_in_rest'          =>          false, //gutemberg disattivato
            'supports'              =>          array('title') //campi supportati
        ), flush_rewrite_rules() 
    );
}
add_action( 'init', 'HT_custom_documenti');

//aggiunta categorie
function HT_documenti_taxonomies() {
    register_taxonomy(
        'documenti_tax',
        'documenti',
        array(
            'labels' => array(
                'name' => 'Categorie',
                'add_new_item' => 'Aggiungi nuova categoria',
                'new_item_name' => "Nuova categoria"
            ),
            'show_ui' => true,
            'show_tagcloud' => false,
            'hierarchical' => true,
            'show_admin_column' => true,
            'show_in_rest' => true,
        )
    );

}
add_action( 'init', 'HT_documenti_taxonomies', 0 );

?>
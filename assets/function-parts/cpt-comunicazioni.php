<?php
/*Replace = comunicazioni*/

function HT_custom_comunicazioni() {
    register_post_type( 'comunicazioni',
        array(
            'labels'                =>          array(
                'name'              =>          'Comunicazioni',
                'singular_name'     =>          'Comunicazione',
                'all_items'         =>          'Tutte le comunicazioni', 
                'add_new'           =>          'Aggiungi nuova comunicazione',
                'add_new_item'      =>          'Aggiungi nuova comunicazione', 
                'edit_item'         =>          'Modifica comunicazione', 
                'new_item'          =>          'Nuova comunicazione',
                'view_item'         =>          'Visualizza comunicazione',
                'search_items'      =>          'Cerca',
                'not_found'         =>          'Nessun elemento trovato',
                'not_found_in_trash'=>          'Nessun elemento nel cestino',
                'parent_item_colon' =>          '',
            ),
            'description'           =>          'Comunicazioni',
            'public'                =>          true,
            'publicly_queryable'    =>          true,
            'exclude_from_search'   =>          false,
            'show_ui'               =>          true,
            'query_var'             =>          true,
            'menu_position'         =>          20,
            'menu_icon'             =>          'dashicons-format-status', //Dashicon
            'rewrite'               =>          array(
               'slug'              =>          'comunicazioni',
               'with-front'        =>          false,
            ),
            'has_archive'           =>          true,
            'capability_type'       =>          'post',
            'hierarchycal'          =>          false,
            'taxonomies'            =>          array(''),
            'show_in_rest'          =>          false, //gutemberg disattivato
            'supports'              =>          array('title') //campi supportati
        ), flush_rewrite_rules() /*fine delle opzioni*/
    );
}
add_action( 'init', 'HT_custom_comunicazioni');

//aggiunta categorie
function HT_comunicazioni_taxonomies() {
    register_taxonomy(
        'comunicazioni_tax',
        'comunicazioni',
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
            // 'show_in_quick_edit'         => false,
            // 'meta_box_cb'                => false,
        )
    );

}
add_action( 'init', 'HT_comunicazioni_taxonomies', 0 );

?>
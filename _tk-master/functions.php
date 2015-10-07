<?php
/**
 * _tk functions and definitions
 *
 * @package _tk
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) )
	$content_width = 750; /* pixels */

if ( ! function_exists( '_tk_setup' ) ) :
/**
 * Set up theme defaults and register support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 */
function _tk_setup() {
	global $cap, $content_width;

	// This theme styles the visual editor with editor-style.css to match the theme style.
	add_editor_style();

	/**
	 * Add default posts and comments RSS feed links to head
	*/
	add_theme_support( 'automatic-feed-links' );

	/**
	 * Enable support for Post Thumbnails on posts and pages
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	*/
	add_theme_support( 'post-thumbnails', array( 'post', 'page', 'products_tk', 'persons_tk' ) );

	/**
	 * Enable support for Post Formats
	*/
	add_theme_support( 'post-formats', array( 'aside', 'image', 'video', 'quote', 'link' ) );

	/**
	 * Setup the WordPress core custom background feature.
	*/
	add_theme_support( 'custom-background', apply_filters( '_tk_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
	
	/**
	 * Make theme available for translation
	 * Translations can be filed in the /languages/ directory
	 * If you're building a theme based on _tk, use a find and replace
	 * to change '_tk' to the name of your theme in all the template files
	*/
	load_theme_textdomain( '_tk', get_template_directory() . '/languages' );

	/**
	 * This theme uses wp_nav_menu() in one location.
	*/
	register_nav_menus( array(
		'primary'  => __( 'Header bottom menu', '_tk' ),
		'extra-menu'  => __( 'Extra Menu', '_tk' )
	) );

}
endif; // _tk_setup
add_action( 'after_setup_theme', '_tk_setup' );

/**
 * Register widgetized area and update sidebar with default widgets
 */
function _tk_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', '_tk' ),
		'id'            => 'sidebar-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
}
add_action( 'widgets_init', '_tk_widgets_init' );

/* ------------------ Add my Custom Widgets ---------------------------- */

function arphabet_widgets_init() {

	register_sidebar( array(
		'name'          => 'Custom sidebar',
		'id'            => 'custom_sidebar',
		'before_widget' => '<div>',
		'after_widget'  => '</div>',
		'before_title'  => '<h2 class="rounded">',
		'after_title'   => '</h2>',
	) );

}
add_action( 'widgets_init', 'arphabet_widgets_init' );

/* ------------------ close my Custom Widgets ------------------------- */

/* ------------------ Add my Theme Customize Redister ----------------- */

function mytheme_customize_register( $wp_customize ) {
   //All our sections, settings, and controls will be added here
	
	$wp_customize->add_section( 'site_other' , array(
	    'title'      => __( 'Site Other', '_tk' ),
	    'priority'   => 30,
	) );

	$wp_customize->add_setting( 'site_other_setting' , array(
	    'transport'   => 'refresh',
	) );

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'site_other', array(
		'label'      => __( 'After site', '_tk' ),
		'section'    => 'site_other',
		'settings'   => 'site_other_setting',
	) ) );
}
add_action( 'customize_register', 'mytheme_customize_register' );

/* ------------------ Close my Theme Customize Redister --------------- */

/* ------------------ add my Custom Post Type ------------------------- */

add_action( 'init', 'products_custom_post_type' );
function products_custom_post_type() {
  register_post_type( 'products_tk',
    array(
      'labels' => array(
        'name' => __( 'Products' ),
        'singular_name' => __( 'Product' )
      ),
      'public' => true,
      'has_archive' => true,
      'supports' => array('title', 'editor', 'thumbnail', 'excerpt'),

    )
  );
}

add_action( 'init', 'persons_custom_post_type' );
function persons_custom_post_type() {
  register_post_type( 'persons_tk',
    array(
      'labels' => array(
        'name' => __( 'Persons' ),
        'singular_name' => __( 'Person' )
      ),
      'public' => true,
      'has_archive' => true,
    )
  );
}

/* ------------------ close my Custom Post Type ------------------------- */

/* ------------------ add my Custom Taxonomies ------------------------ */

add_action('init', 'create_products_taxonomy');
function create_products_taxonomy() {
	// Add new taxonomy, make it hierarchical (like categories)
	$labels = array(
		'name'              => _x( 'Products-cat', 'taxonomy general name' ),
		'singular_name'     => _x( 'Product-cat', 'taxonomy singular name' ),
		'search_items'      => __( 'Search Products-cat' ),
		'all_items'         => __( 'All Products-cat' ),
		'parent_item'       => __( 'Parent Product-cat' ),
		'parent_item_colon' => __( 'Parent Product-cat:' ),
		'edit_item'         => __( 'Edit Product-cat' ),
		'update_item'       => __( 'Update Product-cat' ),
		'add_new_item'      => __( 'Add New Product-cat' ),
		'new_item_name'     => __( 'New Product-cat Name' ),
		'menu_name'         => __( 'Product Categories' ),
	);

	$args = array(
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'product_cat' ),
	);

	register_taxonomy( 'product_cat', array( 'products_tk' ), $args );

}

add_action('init', 'create_persons_taxonomy');
function create_persons_taxonomy() {
	// Add new taxonomy, make it hierarchical (like categories)
	$labels = array(
		'name'              => _x( 'Persons-tax', 'taxonomy general name' ),
		'singular_name'     => _x( 'Person-tax', 'taxonomy singular name' ),
		'search_items'      => __( 'Search Products-cat' ),
		'all_items'         => __( 'All Persons-tax' ),
		'parent_item'       => __( 'Parent Person-tax' ),
		'parent_item_colon' => __( 'Parent Person-tax:' ),
		'edit_item'         => __( 'Edit Person-tax' ),
		'update_item'       => __( 'Update Person-tax' ),
		'add_new_item'      => __( 'Add New Person-tax' ),
		'new_item_name'     => __( 'New Person-tax Name' ),
		'menu_name'         => __( 'Persons Taxonomies' ),
	);

	$args = array(
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'person_tax' ),
	);

	register_taxonomy( 'person_tax', array( 'persons_tk' ), $args );

}

/* ------------------ close my Custom Taxonomies ------------------------ */

/* ------------------ add my Meta Boxes ------------------------------- */

function my_meta_box() {  
    add_meta_box(  
        'my_meta_box', // Идентификатор(id)
        'My Meta Box', // Заголовок области с мета-полями(title)
        'show_my_metabox', // Вызов(callback)
        'products_tk', // Где будет отображаться наше поле, в нашем случае в Записях
        'normal',
        'high');
}  
add_action('add_meta_boxes', 'my_meta_box'); // Запускаем функцию
 
$meta_fields = array(  
    array(  
        'label' => 'Price',  
        'desc'  => 'Field description',  
        'id'    => 'mytextinput', // даем идентификатор.
        'type'  => 'text'  // Указываем тип поля.
    ),  
    array(  
        'label' => 'Weight',  
        'desc'  => 'Field description',  
        'id'    => 'mytextinput2', // даем идентификатор.
        'type'  => 'text'  // Указываем тип поля.
    ), 
    array(  
        'label' => 'Size',  
        'desc'  => 'Field description',  
        'id'    => 'mytextarea',  // даем идентификатор.
        'type'  => 'textarea'  // Указываем тип поля.
    ),    
);
 
// Вызов метаполей  
function show_my_metabox() {  
wp_nonce_field( basename( __FILE__ ), 'custom_meta_box_nonce' );
global $meta_fields; // Обозначим наш массив с полями глобальным
global $post;  // Глобальный $post для получения id создаваемого/редактируемого поста
// Выводим скрытый input, для верификации. Безопасность прежде всего!
echo '<input type="hidden" name="custom_meta_box_nonce" value="'.wp_create_nonce(basename(__FILE__)).'" />';  
 
    // Начинаем выводить таблицу с полями через цикл
    echo '<table class="form-table">';  
    foreach ($meta_fields as $field) {  
        // Получаем значение если оно есть для этого поля 
        $meta = get_post_meta($post->ID, $field['id'], true);  
        // Начинаем выводить таблицу
        echo '<tr> 
                <th><label for="'.$field['id'].'">'.$field['label'].'</label></th> 
                <td>';  
                switch($field['type']) {  
                    case 'text':  
    echo '<input type="text" name="'.$field['id'].'" id="'.$field['id'].'" value="'.$meta.'" size="30" />
        <br /><span class="description">'.$field['desc'].'</span>';  
break;
case 'textarea':  
    echo '<textarea name="'.$field['id'].'" id="'.$field['id'].'" cols="60" rows="4">'.$meta.'</textarea> 
        <br /><span class="description">'.$field['desc'].'</span>';  
break;
case 'checkbox':  
    echo '<input type="checkbox" name="'.$field['id'].'" id="'.$field['id'].'" ',$meta ? ' checked="checked"' : '','/>
        <label for="'.$field['id'].'">'.$field['desc'].'</label>';  
break;
// Всплывающий список  
case 'select':  
    echo '<select name="'.$field['id'].'" id="'.$field['id'].'">';  
    foreach ($field['options'] as $option) {  
        echo '<option', $meta == $option['value'] ? ' selected="selected"' : '', ' value="'.$option['value'].'">'.$option['label'].'</option>';  
    }  
    echo '</select><br /><span class="description">'.$field['desc'].'</span>';  
break;
                }
        echo '</td></tr>';  
    }  
    echo '</table>'; 
}
 
// Пишем функцию для сохранения
function save_my_meta_fields($post_id) {  
    global $meta_fields;  // Массив с нашими полями
 
    // проверяем наш проверочный код 
    if (!wp_verify_nonce($_POST['custom_meta_box_nonce'], basename(__FILE__)))   
        return $post_id;  
    // Проверяем авто-сохранение 
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)  
        return $post_id;  
    // Проверяем права доступа  
    if ('page' == $_POST['post_type']) {  
        if (!current_user_can('edit_page', $post_id))  
            return $post_id;  
        } elseif (!current_user_can('edit_post', $post_id)) {  
            return $post_id;  
    }  
 
    // Если все отлично, прогоняем массив через foreach
    foreach ($meta_fields as $field) {  
        $old = get_post_meta($post_id, $field['id'], true); // Получаем старые данные (если они есть), для сверки
        $new = $_POST[$field['id']];  
        if ($new && $new != $old) {  // Если данные новые
            update_post_meta($post_id, $field['id'], $new); // Обновляем данные
        } elseif ('' == $new && $old) {  
            delete_post_meta($post_id, $field['id'], $old); // Если данных нету, удаляем мету.
        }  
    } // end foreach  
}  
add_action('save_post', 'save_my_meta_fields'); // Запускаем функцию сохранения

// =================================================================================================

function prfx_custom_meta() {
    add_meta_box( 'prfx_meta', __( 'Meta Box Title', 'prfx-textdomain' ), 'prfx_meta_callback', 'post' );
}
add_action( 'add_meta_boxes', 'prfx_custom_meta' );

function prfx_meta_callback( $post ) {
	wp_nonce_field( basename( __FILE__ ), 'prfx_nonce' );
    $prfx_stored_meta = get_post_meta( $post->ID );
    ?>
    <p>
    	<label for="meta-color" class="prfx-row-title"><?php _e( 'Color Picker', 'prfx-textdomain' )?></label>
    	<input name="meta-color" type="text" value="<?php if ( isset ( $prfx_stored_meta['meta-color'] ) ) echo $prfx_stored_meta['meta-color'][0]; ?>" class="meta-color" />
	</p>
<?php
}

function prfx_meta_save( $post_id ) {
 
    // Checks save status
    $is_autosave = wp_is_post_autosave( $post_id );
    $is_revision = wp_is_post_revision( $post_id );
    $is_valid_nonce = ( isset( $_POST[ 'prfx_nonce' ] ) && wp_verify_nonce( $_POST[ 'prfx_nonce' ], basename( __FILE__ ) ) ) ? 'true' : 'false';
 
    // Exits script depending on save status
    if ( $is_autosave || $is_revision || !$is_valid_nonce ) {
        return;
    }
 
    // Checks for input and sanitizes/saves if needed
   if( isset( $_POST[ 'meta-color' ] ) ) {
    update_post_meta( $post_id, 'meta-color', $_POST[ 'meta-color' ] );
}
 
}
add_action( 'save_post', 'prfx_meta_save' );

/**
 * Loads the color picker javascript
 */
function prfx_color_enqueue() {
    global $typenow;
    if( $typenow == 'post' ) {
        wp_enqueue_style( 'wp-color-picker' );
        wp_enqueue_script( 'meta-box-color-js', 'meta-box-color.js', array( 'wp-color-picker' ) );
    }
}
add_action( 'admin_enqueue_scripts', 'prfx_color_enqueue' );

/* ------------------ close my Meta Boxes ------------------------------- */

/**
 * Enqueue scripts and styles
 */
function _tk_scripts() {

	// Import the necessary TK Bootstrap WP CSS additions
	wp_enqueue_style( '_tk-bootstrap-wp', get_template_directory_uri() . '/includes/css/bootstrap-wp.css' );

	// load bootstrap css
	wp_enqueue_style( '_tk-bootstrap', get_template_directory_uri() . '/includes/resources/bootstrap/css/bootstrap.min.css' );

	// load Font Awesome css
	wp_enqueue_style( '_tk-font-awesome', get_template_directory_uri() . '/includes/css/font-awesome.min.css', false, '4.1.0' );

	// load _tk styles
	wp_enqueue_style( '_tk-style', get_stylesheet_uri() );

	// load bootstrap js
	wp_enqueue_script('_tk-bootstrapjs', get_template_directory_uri().'/includes/resources/bootstrap/js/bootstrap.min.js', array('jquery') );

	// load bootstrap wp js
	wp_enqueue_script( '_tk-bootstrapwp', get_template_directory_uri() . '/includes/js/bootstrap-wp.js', array('jquery') );

	wp_enqueue_script( '_tk-skip-link-focus-fix', get_template_directory_uri() . '/includes/js/skip-link-focus-fix.js', array(), '20130115', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	if ( is_singular() && wp_attachment_is_image() ) {
		wp_enqueue_script( '_tk-keyboard-image-navigation', get_template_directory_uri() . '/includes/js/keyboard-image-navigation.js', array( 'jquery' ), '20120202' );
	}

}
add_action( 'wp_enqueue_scripts', '_tk_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/includes/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/includes/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/includes/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/includes/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/includes/jetpack.php';

/**
 * Load custom WordPress nav walker.
 */
require get_template_directory() . '/includes/bootstrap-wp-navwalker.php';


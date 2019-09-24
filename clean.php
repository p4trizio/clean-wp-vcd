<?php

//first we get all directories that are considered WP installations
$wps = array();
get_wp_dirs('*', $wps);
?>

<textarea style="width:100%" rows="10">

<?php
echo "Found " . count($wps) . " Wordpress installations: \r\n";
echo implode(" \r\n", $wps);
echo "\r\n";
echo "- - - - - - - - - - - - - - - ";
echo " \r\n";
echo "- - - - - - - - - - - - - - - ";
echo " \r\n";
echo " \r\n";

foreach ($wps as $dir) {
  if (file_exists($dir . '/wp-config.php')) {
    echo "$dir is a Wordpress installation, start cleanup process \r\n";
    $version = '4.8'; //we set a default version starting from 4.8
    //then we get the real version of wp
    if (file_exists($dir . '/wp-includes/version.php')) {
      include_once($dir . '/wp-includes/version.php');
      if (isset($wp_version)) {
        $version = substr($wp_version, 0, 3);
      }
    }
    echo "WP version: $version \r\n";
    echo "STEP1: delete malware files in wp-includes \r\n";
    /**
     * STEP1:
     * delete files in wp-includes
     *  - class.wp.php
     *  - wp-feed.php
     *  - wp-tmp.php
     *  - wp-vcd.php
     */
    $wp_includes = $dir . '/wp-includes';
    $files2delete = array(
      'class.wp.php',
      'wp-feed.php',
      'wp-tmp.php',
      'wp-vcd.php',
    );
    foreach ($files2delete as $fd) {
      if (file_exists($wp_includes . '/' . $fd)) {
        echo " - Delete file $wp_includes/$fd \r\n";
        unlink($wp_includes . '/' . $fd);
      }
    }

    /**
     * STEP2:
     * remove infected code from themes functions.php
     */
    echo "STEP2: remove infected code from themes files functions.php \r\n";
    $themes = $dirs = array_filter(glob($dir . '/wp-content/themes/*'), 'is_dir');
    $patterns =array(
      '/<\?php.*"wp_vcd".*?\?>/is',
      '/<\?php.*wp-tmp\.php.*?\?>/is',
      '/<\?php.*wp-feed\.php.*?\?>/is',
      '/<\?php.*wp-vcd\.php.*?\?>/is',

    );

    foreach ($themes as $t) {
      $file_name = $t . '/functions.php';
      if (file_exists($file_name)) {
        $myfile = fopen($file_name, "r");
        if ($myfile) {
          $file_content = fread($myfile, filesize($file_name));
          fclose($myfile);
          foreach($patterns as $regex) {
            $new_content = preg_replace($regex, '', $file_content);
            if ($new_content != $file_content) {
              echo " - Rewriting content of $file_name based on regex $regex \r\n";
              $myfile = fopen($file_name, "w");
              fwrite($myfile, $new_content);
              fclose($myfile);
              $file_content = $new_content;
            }
          }
        }
        else {
          echo " - Could not read $file_name \r\n";
        }
      }
    }

    /**
     * STEP3:
     * substitute wp-includes/post.php
     */
    echo "STEP3: substitute wp-includes/post.php \r\n";
    $myfile = fopen($dir . '/wp-includes/post.php', 'w');
    $file_row = 'https://raw.githubusercontent.com/WordPress/WordPress/' . $version . '-branch/wp-includes/post.php';
    $content = file_get_contents($file_row);
    if ($content && substr($content, 0, 5) == '<?php') {
      fwrite($myfile, $content);
      echo " - Replaced wp-includes/post.php with fresh one from $file_row";
    }
    fclose($myfile);
    echo " \r\n";
    echo " \r\n - - - - - - - - - - - - - - -  \r\n";
    echo " \r\n";
  }
}
?>

</textarea>

<?php

/**
 * @param string $base
 * @param $wps
 * recursive function to find all WPs installations
 */
function get_wp_dirs($base, &$wps) {
  $dirs = array_filter(glob($base), 'is_dir');
  foreach ($dirs as $dir) {
    //skip "example_filesystem" dir, we need for this repository
    if ($dir == 'example_filesystem') {
      continue;
    }
    if (file_exists($dir . '/wp-config.php')) {
      $wps[] = $dir;
    }
    get_wp_dirs($base = $dir . '/*', $wps);
  }
}




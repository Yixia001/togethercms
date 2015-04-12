<?php
/**
 * @file
 */

/**
 * drupal_get_breadcrumb() is a major bottleneck since it will try to call
 * menu_get_active_breadcrumb() if breadcrumb is not set, and menu_get_active_breadcrumb()
 * is very slow due to menu access check. We set breadcrumb here to avoid this.
 * @param unknown $vars
 */
function main_preprocess_page(&$vars) {
  drupal_set_breadcrumb(array());
}

/**
 * Implements hook_ctools_plugin_directory() to provide our own entityreference select handler
 * for og, select this handler in og field property to speed up og performance
 */
function main_ctools_plugin_directory($module, $plugin) {
  if ($module == 'entityreference') {
    return "plugins/entityreference/$plugin";
  }
}
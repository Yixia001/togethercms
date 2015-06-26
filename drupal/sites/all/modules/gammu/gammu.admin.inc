<?php
/**
 * @file
 * Settings page callback file for the gammu module.
 */

/**
 * Menu callback;
 */

/**
 * @todo Please document this function.
 * @see http://drupal.org/node/1354
 */
function gammu_settings($form, &$form_state) {
  $form = array();
  // only administrators can access this function

  // Generate the form - settings applying to all patterns first
  $form['gammu_settings_db'] = array(
    '#type' => 'fieldset',
    '#weight' => -30,
    '#title' => t('Database settings'),
    '#collapsible' => TRUE,
    '#collapsed' => FALSE,
  );

  $form['gammu_settings_db']['gammu_dbhost'] = array(
    '#type' => 'textfield',
    '#title' => t('Database Hostname/IP'),
    '#default_value' => variable_get('gammu_dbhost', 'localhost'),
    '#description' => t("Database Hostname or IP, e.g.: localhost, 192.168.0.1, dbase.drupal.org. Leave blank if you use same Hostname for Drupal and Gammu"),
  );

  $form['gammu_settings_db']['gammu_dbengine'] = array(
    '#type' => 'textfield',
    '#title' => t('Database Engine'),
    '#default_value' => variable_get('gammu_dbengine', 'mysql'),
    '#description' => t("Database Engine, e.g.: mysql, mysqli, pgsql"),
  );

  $form['gammu_settings_db']['gammu_dbname'] = array(
    '#type' => 'textfield',
    '#title' => t('Database Name'),
    '#default_value' => variable_get('gammu_dbname', 'smsd'),
    '#description' => t("Database Name, e.g.: smsd, drpl_123, mydata. Leave blank if you use same Database Name for Drupal and Gammu"),
  );

  $form['gammu_settings_db']['gammu_dbuser'] = array(
    '#type' => 'textfield',
    '#title' => t('Database Username'),
    '#default_value' => variable_get('gammu_dbuser', ''),
    '#description' => t("Database Username, e.g.: root, user_123. Leave blank if you use same Username for Drupal and Gammu"),
  );

  $form['gammu_settings_db']['gammu_dbpass'] = array(
    '#type' => 'password',
    '#title' => t('Database Password'),
    '#default_value' => variable_get('gammu_dbpass', ''),
    '#description' => t("Database Password, leave blank if you use same database Password for Drupal and Gammu"),
  );

  $form['gammu_settings_advanced'] = array(
    '#type' => 'fieldset',
    '#weight' => -20,
    '#title' => t('Advanced settings'),
    '#collapsible' => TRUE,
    '#collapsed' => FALSE,
  );

  $form['gammu_settings_advanced']['gammu_ussd_balance'] = array(
    '#type' => 'textfield',
    '#title' => t('Balance code'),
    '#default_value' => variable_get('gammu_ussd_balance', '*888#'),
    '#description' => t("USSD Code to check Balance/Deposit, e.g.: *888#"),
  );

  $form['gammu_settings_advanced']['gammu_cli'] = array(
    '#type' => 'checkbox',
    '#title' => t('Use Gammu CLI'),
    '#default_value' => variable_get('gammu_statistic_today', 0),
    '#description' => t("Use Gammu CLI (Command Line Interface) instead SQL Command. This option requires PHP exec() function."),
  );

  $form['gammu_settings_test'] = array(
    '#type' => 'fieldset',
    '#weight' => -20,
    '#title' => t('Test Gammu'),
    '#collapsible' => TRUE,
    '#collapsed' => FALSE,
  );

  $form['gammu_settings_test']['gammu_test_number'] = array(
    '#type' => 'textfield',
    '#title' => t('Your mobile number'),
    '#default_value' => variable_get('gammu_test_number', ''),
    '#description' => t("Enter your mobile number for testing."),
  );

  $form['gammu_settings_test']['gammu_test_text'] = array(
    '#type' => 'textarea',
    '#title' => t('SMS Text'),
    '#rows' => 2,
    '#default_value' => variable_get('gammu_test_text', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.'),
  );

  $form['gammu_settings_test']['gammu_test_submit'] = array(
    '#type' => 'submit',
    '#value' => t('Test SMS Sending'),
    '#submit' => array('gammu_test'),
  );

  return system_settings_form($form);
}


/**
 * @todo Please document this function.
 * @see http://drupal.org/node/1354
 */
function gammu_test($form) {
  $gammu_test_number = $form['gammu_settings_test']['gammu_test_number']['#value'];
  $gammu_test_text   = $form['gammu_settings_test']['gammu_test_text']['#value'];

  gammu_sendsms($gammu_test_number, $gammu_test_text);
}



<?php
// 
/**
 * Implements hook_form_FORM_ID_alter().
 *
 * Allows the profile to alter the site configuration form.
 */
function unikue_form_install_configure_form_alter(&$form, $form_state) {
  $form['site_information']['site_name']['#default_value'] = 'Unikue';
  $form['#submit'][] = 'unikue_install_configure_form_submit';
}

/**
 * Forms API submit for the site configuration form.
 */
function unikue_install_configure_form_submit($form, &$form_state) {
  global $user;
  $sql_file = dirname(__FILE__) . '/unikue.sql';
  $count = unikue_import_sql($sql_file);

  drupal_set_message("Please delete $sql_file or move it from your server webroot for security");


  variable_set('site_name', $form_state['values']['site_name']);
  variable_set('site_mail', $form_state['values']['site_mail']);
  variable_set('date_default_timezone', $form_state['values']['date_default_timezone']);
  variable_set('site_default_country', $form_state['values']['site_default_country']);

  if ($form_state['values']['update_status_module'][1]) {
    module_enable(array('update'), FALSE);

    if ($form_state['values']['update_status_module'][2]) {
      variable_set('update_notify_emails', array($form_state['values']['account']['mail']));
    }
  }

  $account = user_load(1);
  $merge_data = array('init' => $form_state['values']['account']['mail'], 'roles' => !empty($account->roles) ? $account->roles : array(), 'status' => 1);
  user_save($account, array_merge($form_state['values']['account'], $merge_data));

  $user = user_load(1);
  user_login_finalize();

  if (isset($form_state['values']['clean_url'])) {
    variable_set('clean_url', $form_state['values']['clean_url']);
  }

  variable_set('install_time', $_SERVER['REQUEST_TIME']);

}

function unikue_import_sql($filename) {
  global $databases;
  $databasesName = array(
    "pgsql" => "PostgreSQL",
    "sqlite" => "SQLite"
  );

  // Backup current settings site
  $cron_key = db_select("variable", "v")
    ->fields("v")
    ->condition("name", "cron_key")
    ->range(0, 1)
    ->execute()
    ->fetchAssoc();

  $private_key = db_select("variable", "v")
    ->fields("v")
    ->condition("name", "drupal_private_key")
    ->range(0, 1)
    ->execute()
    ->fetchAssoc();

  // Import database from sql file
  $count = 0;
  $file = @fopen($filename, "r");
  if ($file) {
    $sql_command = "";

    // Open connect to database
    switch ($databases["default"]["default"]["driver"]) {
      case "mysql":
        $connect = new PDO(sprintf("mysql:host=%s;port=%s;dbname=%s", $databases["default"]["default"]["host"],$databases["default"]["default"]["port"], $databases["default"]["default"]["database"]), $databases["default"]["default"]["username"], $databases["default"]["default"]["password"]);
        break;

      case "pgsql":
        $connect = NULL;
        break;

      case "sqlite":
        $connect = NULL;
    }

    if ($connect) {
      while (!feof($file)) {
        $line = fgets($file);
        $sql_command .= $line;

        if (preg_match('|;$|', $line)) {
          try {
            $connect->exec(unikue_prefixTables($sql_command));
          } catch (PDOException $ex) {
            pass;
          }
          $sql_command = "";
          $count++;
        }
      }

      // Restore site settings
      db_update("system")
        ->fields(array("status" => 1))
        ->condition("filename", "profiles/standard/standard.profile")
        ->execute();

      db_update("variable")
        ->fields(array("value" => $cron_key["value"]))
        ->condition("name", "cron_key")
        ->execute();
      db_update("variable")
        ->fields(array("value" => $private_key["value"]))
        ->condition("name", "drupal_private_key")
        ->execute();

      drupal_set_message(t("Import demo data successful."));

      // Close database connection
      $connect = NULL;
    }
    else {
      drupal_set_message(t(sprintf("Import demo data unsuccessful. We are only support demo data for MySQL database. You are using %s database.", $databasesName[$databases["default"]["default"]["driver"]])), "warning");
    }

    fclose($file);
  }

  return $count;
}

function unikue_prefixTables($sql) {
  global $databases;
  return str_replace("dp7_", $databases["default"]["default"]["prefix"], $sql);
}
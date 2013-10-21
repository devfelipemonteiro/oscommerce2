<?php
/*
  $Id$

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2013 osCommerce

  Released under the GNU General Public License
*/

  class cm_login_login_form {
    var $code = 'cm_login_login_form';
    var $group = 'login';
    var $title;
    var $description;
    var $sort_order;
    var $enabled = false;

    function cm_login_login_form() {
      $this->title = MODULE_CONTENT_LOGIN_LOGIN_FORM_TITLE . ' (' . $this->group . ')';
      $this->description = MODULE_CONTENT_LOGIN_LOGIN_FORM_DESCRIPTION;

      if ( defined('MODULE_CONTENT_LOGIN_LOGIN_FORM_STATUS') ) {
        $this->sort_order = MODULE_CONTENT_LOGIN_LOGIN_FORM_SORT_ORDER;
        $this->enabled = (MODULE_CONTENT_LOGIN_LOGIN_FORM_STATUS == 'True');
      }
    }

    function execute() {
      global $oscTemplate;

      ob_start();
      include(DIR_WS_MODULES . 'content/templates/login_login_form.php');
      $template = ob_get_clean();

      $oscTemplate->addContent($template, $this->group);
    }

    function isEnabled() {
      return $this->enabled;
    }

    function check() {
      return defined('MODULE_CONTENT_LOGIN_LOGIN_FORM_STATUS');
    }

    function install() {
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Enable Login Form Module', 'MODULE_CONTENT_LOGIN_LOGIN_FORM_STATUS', 'True', 'Do you want to enable the login form module?', '6', '1', 'tep_cfg_select_option(array(\'True\', \'False\'), ', now())");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Content Width', 'MODULE_CONTENT_LOGIN_LOGIN_FORM_CONTENT_WIDTH', 'Half', 'Should the content be shown in a full or half width container?', '6', '1', 'tep_cfg_select_option(array(\'Full\', \'Half\'), ', now())");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Sort Order', 'MODULE_CONTENT_LOGIN_LOGIN_FORM_SORT_ORDER', '0', 'Sort order of display. Lowest is displayed first.', '6', '0', now())");
    }

    function remove() {
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key in ('" . implode("', '", $this->keys()) . "')");
    }

    function keys() {
      return array('MODULE_CONTENT_LOGIN_LOGIN_FORM_STATUS', 'MODULE_CONTENT_LOGIN_LOGIN_FORM_CONTENT_WIDTH', 'MODULE_CONTENT_LOGIN_LOGIN_FORM_SORT_ORDER');
    }
  }
?>

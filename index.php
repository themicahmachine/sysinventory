<?php
    /**
    * @author Micah Carter <mcarter at tux dot appstate dot edu>
    */

// Make sure the source directory is defined
if (!defined('PHPWS_SOURCE_DIR')) {
    include '../../config/core/404.html';
    exit();
}

// Check some permissions
if (!Current_User::allow('sysinventory')) {
    return;
}

$error = NULL;

switch (isset($_REQUEST['action']) ? $_REQUEST['action'] : 42) {
    case 'add_system':
        PHPWS_Core::initModClass('sysinventory','UI/Sysinventory_SystemUI.php');
        Sysinventory_SystemUI::showAddSystem();
        break;
    case 'report':
        PHPWS_Core::initModClass('sysinventory', 'UI/Sysinventory_ReportUI.php');
        Sysinventory_ReportUI::display();
        break;
    case 'build_query':
        PHPWS_Core::initModClass('sysinventory','Sysinventory_Query.php');
        Sysinventory_Query::showQueryBuilder();
        break;
    case 'edit_locations':
        PHPWS_Core::initModClass('sysinventory','UI/Sysinventory_LocationUI.php');
        Sysinventory_LocationUI::showLocations();
        break;
    case 'edit_departments':
        PHPWS_Core::initModClass('sysinventory','Sysinventory_Department.php');
        if (isset($_REQUEST['addDep']) && !empty($_REQUEST['description'])) {
            $todo = 'addDep';
            $thing = $_REQUEST['description'];
        }else if (isset($_REQUEST['delDep'])) {
            $todo = 'delDep';
            $thing = $_REQUEST['id'];
        }else{
            $todo = NULL;
            $thing = NULL;
        }
        Sysinventory_Department::showDepartments($todo,$thing);
        break;
    case 'edit_admins':
        PHPWS_Core::initModClass('sysinventory','UI/Sysinventory_AdminUI.php');
        Sysinventory_AdminUI::showAdmins();
        break;
    case '42':
        PHPWS_Core::initModClass('sysinventory','Sysinventory_Menu.php');
        Sysinventory_Menu::showMenu($error);
        break;
}

?>

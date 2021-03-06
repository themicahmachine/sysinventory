<?php
/**
 * Class for handling UI for Admin editing and creation
 * @author Micah Carter <mcarter at tux dot appstate dot edu>
**/

class Sysinventory_AdminUI {

    // Show a list of admins and a form to add a new one.
    function showAdmins() {
        // permissions...
        if(!Current_User::isDeity()) {
           PHPWS_Core::initModClass('sysinventory','Sysinventory_Error.php');
           $error = 'Uh Uh Uh! You didn\'t say the magic word!';
           Sysinventory_Error::error($error);
           return;
        }

        // set up some stuff for the page template
        $tpl                     = array();
        $tpl['PAGE_TITLE']       = 'Edit Administrators';
        $tpl['HOME_LINK']        = PHPWS_Text::moduleLink('Back to menu','sysinventory');

        // create the list of admins
        PHPWS_Core::initModClass('sysinventory','Sysinventory_Admin.php');
        $adminList = Sysinventory_Admin::generateAdminList();
        // get the list of departments
        PHPWS_Core::initModClass('sysinventory','Sysinventory_Department.php');
        $depts = Sysinventory_Department::getDepartmentsByUsername();

        // build the array for the department drop-down box
        $deptIdSelect = array();
        foreach($depts as $dept) {
            $deptIdSelect[$dept['id']] = $dept['description'];
        }

        // make the form for adding a new admin
        $form = new PHPWS_Form('add_admin');
        $form->addSelect('department_id',$deptIdSelect);
        $form->setLabel('department_id','Department');
        $form->addText('username');
        $form->setLabel('username','Username');
        $form->addSubmit('submit','Create Admin');
        $form->setAction('index.php?module=sysinventory&action=edit_admins');
        $form->addHidden('newadmin','add');

        $tpl['PAGER'] = $adminList;

        $form->mergeTemplate($tpl);

        $template = PHPWS_Template::process($form->getTemplate(),'sysinventory','edit_admin.tpl');

        Layout::addStyle('sysinventory','style.css');
        Layout::add($template);

    }
}

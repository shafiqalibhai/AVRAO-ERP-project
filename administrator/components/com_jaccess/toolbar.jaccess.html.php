<?php
defined( '_JEXEC' ) or die( 'Restricted access' );
class menuCLIENTS{

function DEFAULTGROUPS_MENU() {


JToolBarHelper::custom('','back.png','back.png','Back', false);

JToolBarHelper::custom('newGroup','new.png','new.png','New', false);

JToolBarHelper::custom('editGroup','edit.png','edit.png','Edit', false);

JToolBarHelper::custom('deleteGroup','trash.png','trash.png','Delete', false);


}
function GROUPS_MENU() {


if ( $id ) {
// for existing content items the button is renamed `close`
JToolBarHelper::custom('listGroups','cancel.png','cancel.png','Cancel', false);
} else {
JToolBarHelper::custom('listGroups','cancel.png','cancel.png','Close', false);
}
JToolBarHelper::custom('saveGroup','save.png','save.png','Save', false);


}

}
?>
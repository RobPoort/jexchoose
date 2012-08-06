<?php
	/**
	*	admin part
	*/
defined('_JEXEC') or die('restricted access');

jimport('joomla.application.component.controller');

//Access check
If(!JFactory::getUser()->authorize('core.manage', 'com_jexchoose')){
	return JError::raiseWarning(404, JText::_('JERROR_ALERTNOAUTHOR'));
}
// helper file ophalen
JLoader::register('JexchooseHelper', dirname(__FILE__) . DS . 'helpers' . DS . 'jexchoose.php');

//controller instantiëren
$controller = JController::getInstance('Jexchoose');

//task uitvoeren
$controller->execute(JRequest::getCmd('task'));

$controller->redirect();
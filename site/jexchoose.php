<?php
	/**
	*	site part
	*/
defined('_JEXEC') or die('restricted access');

jimport('joomla.application.component.controller');

//create an instance of the controller
$controller = JController::getInstance('jexchoose');

//perform the request task
$controller->execute(JRequest::getCmd('task'));

//redirect if set by the controller
$controller->redirect();
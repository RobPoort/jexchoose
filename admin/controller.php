<?php
	/**
	*	admin part
	*/
defined('_JEXEC') or die('restricted access');
jimport('joomla.application.component.controller');

class JexchooseController extends JController
{
	/**
	*	display	task
	*	@return	void
	*/
	function display($cachable = false)
	{
		//set default view if not set by task
		JRequest::setVar('view',JRequest::getCmd('view','Locations'));
		
		//call to parent
		parent::display($cachable);
		
		//set the submenu
		JexchooseHelper::addSubmenu('Jexlocations');
	}
}
<?php
	/**
	*	site part
	*/
defined('_JEXEC') or die('restricted access');

jimport('joomla.application.component.controller');

class JexchooseController extends JController
{
	function display($cachable = false){
		
		$grouped = JRequest::getInt('group');
		
		if($grouped){
			JRequest::setVar('layout','grouped');
		}
		
		parent::display($cachable);
	}
}
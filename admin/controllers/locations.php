<?php
defined('_JEXEC') or die('restricted access');

jimport('joomla.application.component.controlleradmin');

class JexchooseControllerLocations extends JControllerAdmin
{
	/**
	*	proxy voor getModel
	*/
	public function getModel($name='Location', $prefix = 'JexchooseModel')
	{
		$model = parent::getModel($name, $prefix, array('ignore_request' => true));
			
		return $model;
	}
}
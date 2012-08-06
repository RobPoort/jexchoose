<?php
defined('_JEXEC') or die('restricted access');

jimport('joomla.application.component.controlleradmin');

class JexchooseControllerGroups extends JControllerAdmin
{
	/**
	*	proxy voor getModel
	*/
	public function getModel($name='Group', $prefix = 'JexchooseModel')
	{
		$model = parent::getModel($name, $prefix, array('ignore_request' => true));
			
		return $model;
	}
}
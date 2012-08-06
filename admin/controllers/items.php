<?php
defined('_JEXEC') or die('Restricted Access, Moron');
jimport('joomla.application.component.controlleradmin');

class JexchooseControllerItems extends JControllerAdmin
{
	/**
	*	proxy voor getModel
	*/
	public function getModel($name='Item', $prefix = 'JexchooseModel')
	{
		$model = parent::getModel($name, $prefix, array('ignore_request' => true));
			
		return $model;
	}
}
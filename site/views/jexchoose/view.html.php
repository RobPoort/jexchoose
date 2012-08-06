<?php
	/**
	*	view for site part default view
	*/
defined('_JEXEC') or die('restricted access');

jimport('joomla.application.component.view');

class JexchooseViewJexchoose extends JView
{
	function display($tpl=null)
	{
		$data = JRequest::get('post');
		$app = JFactory::getApplication();
		$this->items = $this->get('Items');
		$grouped = JRequest::getInt('group');
		if($grouped){
			$this->items = $this->get('ItemsGrouped');
		}
		$this->selected = $this->get('Selected');
		if(isset($data['reset'])){
			$this->selected = false;
		}
		
		if($this->selected){
			$this->locations = $this->get('Locations');
		} else {
			$this->locations = false;
		}
		
		
		
		if(count($errors = $this->get('Errors'))){
			JError::raiseError(500, implode('<br />',$errors));
			return false;
		}
		
		parent::display($tpl);
	}
}
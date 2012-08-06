<?php
	/**
	*	admin part
	*/
defined('_JEXEC') or die('Restricted Access');

jimport('joomla.application.component.view');

class JexchooseViewLocations extends JView
{
	function display($tpl = null)
	{
		$items = $this->get('Items');		
		$pagination = $this->get('Pagination');
		
		
		if(count($errors = $this->get('Errors'))){
			JError::raiseError(500,implode('<br />',$errors));
			return false;
		}
		$this->items = $items;
		$this->pagination = $pagination;
		
		//toolbar toevoegen
		$this->addToolbar();
		
		$canDo = JexchooseHelper::getActions();
		if($canDo->get('core.edit')){
			$this->canEdit = true;
		}
		
		//toon template
		parent::display($tpl);
		
		//doc klaarzetten
		$this->setDocument();
	}
	
	/**
	*	toolbar initialiseren
	*/
	protected function addToolBar()
	{
		$canDo = JexchooseHelper::getActions();
		JToolBarHelper::title(JText::_('COM_JEXCHOOSE_MANAGER_LOCATIONS'), 'jexchoose');
		if($canDo->get('core.create'))
		{
			JToolBarHelper::addNew('location.add', 'JTOOLBAR_NEW');
		}
		if($canDo->get('core.edit'))
		{
			JToolBarHelper::editList('location.edit', 'JTOOLBAR_EDIT');
		}
		if($canDo->get('core.delete'))
		{
			JToolBarHelper::deleteList('', 'locations.delete', 'JTOOLBAR_DELETE');
		}
		if($canDo->get('core.admin'))
		{
			JToolBarHelper::divider();
			JToolBarHelper::preferences('com_jexchoose');
		}
	}
	/**
	*	method to set up the document properties
	*	@return	void
	*/
	protected function setDocument()
	{
		$document = JFactory::getDocument();
		$document->setTitle(JText::_('COM_JEXCHOOSE_ADMINISTRATION'));
	}
}
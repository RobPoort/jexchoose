<?php
defined('_JEXEC') or die('Restricted Access');

jimport('joomla.application.component.view');

class JexchooseViewItems extends JView
{
	function display($tpl = null)
	{
		$items = $this->get('Items');
		$pagination = $this->get('Pagination');
		
		// check for errors
		if(count($errors = $this->get('Errors'))){
			JError::raiseError(500, implode('<br />', $errors));
		}
		
		//assign data to the view
		$this->items = $items;
		$this->pagination = $pagination;
		
		$this->addToolBar();
		
		parent::display($tpl);
		
		$this->setDocument();
	}
	protected function addToolBar()
	{
		$canDo = JexchooseHelper::getActions(); //optioneel om actions te kunnen doen
		JToolBarHelper::title(JText::_('COM_JEXCHOOSE_MANAGER_ITEMS'), 'jexchoose');
		if($canDo->get('core.create'))
		{
			JToolBarHelper::addNew('item.add', 'JTOOLBAR_NEW');
		}
		if($canDo->get('core.edit'))
		{
			JToolBarHelper::editList('item.edit', 'JTOOLBAR_EDIT');
		}
		if($canDo->get('core.delete'))
		{
			JToolBarHelper::deleteList('', 'items.delete', 'JTOOLBAR_DELETE');
		}
	}
	protected function setDocument()
	{
		$document = JFactory::getDocument();
		$document->setTitle(JText::_('COM_JEXCHOOSE_ADMINISTRATION'));
	}
}
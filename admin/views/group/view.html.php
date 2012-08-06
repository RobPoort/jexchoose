<?php
defined('_JEXEC') or die('restricted access');

jimport('joomla.application.component.view');

class JexchooseViewGroup extends JView
{
	public function display($tpl = null)
	{
		$form = $this->get('Form');
		$item = $this->get('Item');
		$script = $this->get('Script');
		
		//check for errors
		if(count($errors = $this->get('Errors'))){
			JError::raiseError(500, implode('<br />',$errors));
			return false;
		}
		//assign the data
		$this->form = $form;
		$this->item = $item;
		$this->script = $script;
		
		//toolbar toevoegen
		$this->addToolbar();
		
		parent::display($tpl);
		
		//set Document
		$this->setDocument();
	}
	protected function addToolbar()
	{
		JRequest::setVar('hidemainmenu', true);
		$user = JFactory::getUser();
		$userId = $user->id;
		$isNew = $this->item->id == 0;
		$canDo = JexchooseHelper::getActions($this->item->id);
		JToolBarHelper::title($isNew ? JText::_('COM_JEXCHOOSE_MANAGER_GROUP_NEW')
									: JText::_('COM_JEXCHOOSE_MANAGER_GROUP_EDIT'), 'jexchoose');
		
		//built the actions for new and existings records
		if($isNew)
		{
			//for new records, check the create permission
			if($canDo->get('core.create'))
			{
				JToolBarHelper::apply('group.apply', 'JTOOLBAR_APPLY');
				JToolBarHelper::save('group.save', 'JTOOLBAR_SAVE');
				JToolBarHelper::custom('group.save2new', 'save-new.png', 'save-new_f2.png',
										'JTOOLBAR_SAVE_AND_NEW', false);
			}
			JToolBarHelper::cancel('group.cancel', 'JTOOLBAR_CANCEL');
		} else
		{
			if($canDo->get('core.edit'))
			{
				//we can save the new record
				JToolBarHelper::apply('group.apply', 'JTOOLBAR_APPLY');
				JToolBarHelper::save('group.save', 'JTOOLBAR_SAVE');
				
				//we can save this record, but check the create permission to see
				//if we can return to make a new one
				if($canDo->get('core.create'))
				{
					JToolBarHelper::custom('group.save2new', 'save-new.png', 'save-new_f2.png',
											'JTOOLBAR_SAVE_AND_NEW', false);
				}
			}
			if($canDo->get('core.create'))
			{
				JToolBarHelper::custom('group.save2copy', 'save-copy.png', 'save-copy_f2.png',
										'JTOOLBAR_SAVE_AS_COPY', false);
			}
			JToolBarHelper::cancel('group.cancel', 'JTOOLBAR_CLOSE');
		}
	}
	/**
	*	method to set up the document properties
	*	@return	void
	*/
	protected function setDocument()
	{
		$isNew = ($this->item->id < 1);
		$document = JFactory::getDocument();
		$document->setTitle($isNew ? JText::_('COM_JEXCHOOSE_GROUP_CREATING') : JTEXT::_('COM_JEXCHOOSE_GROUP_EDITING'));
		
		$document->addScript(JURI::root() . $this->script);
		$document->addScript(JURI::root() . "/administrator/components/com_jexchoose/views/group/submitbutton.js");
		JText::script('COM_JEXCHOOSE_JEXCHOOSE_ERROR_UNACCEPTABLE');
	}
}
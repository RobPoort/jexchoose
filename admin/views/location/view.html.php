<?php
defined('_JEXEC') or die('restricted Access');

jimport('joomla.application.component.view');

class JexchooseViewLocation extends JView
{
	public function display($tpl = null)
	{
		$form = $this->get('Form');
		$item = $this->get('Item');
		$locitems = $this->get('LocItems');
		$script = $this->get('Script');
		
		//check for errors
		if(count($errors = $this->get('Errors'))){
			JError::raiseError(500, implode('<br />',$errors));
			return false;
		}
		//assign the data
		$this->form = $form;
		$this->item = $item;
		$this->locitems = $locitems;
		$this->script = $script;
		
		//toolbar toevoegen
		$this->addToolbar();
		
		parent::display($tpl);
		
		//set Document
		$this->setDocument();
	}
	//function to set the toolbar
	protected function addToolbar()
	{
		JRequest::setVar('hidemainmenu', true);
		$user = JFactory::getUser();
		$userId = $user->id;
		$isNew = $this->item->id == 0;
		$canDo = JexchooseHelper::getActions($this->item->id);
		JToolBarHelper::title($isNew ? JText::_('COM_JEXCHOOSE_MANAGER_JEXTLOCATION_NEW')
									: JText::_('COM_JEXCHOOSE_MANAGER_JEXLOCATION_EDIT'), 'jexchoose');
		
		//built the actions for new and existings records
		if($isNew)
		{
			//for new records, check the create permission
			if($canDo->get('core.create'))
			{
				JToolBarHelper::apply('location.apply', 'JTOOLBAR_APPLY');
				JToolBarHelper::save('location.save', 'JTOOLBAR_SAVE');
				JToolBarHelper::custom('location.save2new', 'save-new.png', 'save-new_f2.png',
										'JTOOLBAR_SAVE_AND_NEW', false);
			}
			JToolBarHelper::cancel('location.cancel', 'JTOOLBAR_CANCEL');
		} else
		{
			if($canDo->get('core.edit'))
			{
				//we can save the new record
				JToolBarHelper::apply('location.apply', 'JTOOLBAR_APPLY');
				JToolBarHelper::save('location.save', 'JTOOLBAR_SAVE');
				
				//we can save this record, but check the create permission to see
				//if we can return to make a new one
				if($canDo->get('core.create'))
				{
					JToolBarHelper::custom('location.save2new', 'save-new.png', 'save-new_f2.png',
											'JTOOLBAR_SAVE_AND_NEW', false);
				}
			}
			if($canDo->get('core.create'))
			{
				JToolBarHelper::custom('location.save2copy', 'save-copy.png', 'save-copy_f2.png',
										'JTOOLBAR_SAVE_AS_COPY', false);
			}
			JToolBarHelper::cancel('location.cancel', 'JTOOLBAR_CLOSE');
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
		$document->setTitle($isNew ? JText::_('COM_JEXCHOOSE_LOCATION_CREATING') : JTEXT::_('COM_JEXCHOOSE_LOCATION_EDITING'));
		
		$document->addScript(JURI::root() . $this->script);
		$document->addScript(JURI::root() . "/administrator/components/com_jexchoose/views/location/submitbutton.js");
		JText::script('COM_JEXCHOOSE_JEXCHOOSE_ERROR_UNACCEPTABLE');
	}
}
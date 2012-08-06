<?php

defined('_JEXEC') or die('restricted access');

	/**
	*	Jexchoose component helper
	*/

abstract class JexchooseHelper
{
	/**
	*	configuratie van de link balk
	*/
	
	public static function addSubmenu($submenu)
	{
		JSubMenuHelper::addEntry(JText::_('COM_JEXCHOOSE_SUBMENU_LOCATIONS'), 'index.php?option=com_jexchoose', $submenu == 'locations');
		JSubMenuHelper::addEntry(JText::_('COM_JEXCHOOSE_SUBMENU_ITEMS'), 'index.php?option=com_jexchoose&view=items', $submenu == 'items');
		JSubMenuHelper::addEntry(JText::_('COM_JEXCHOOSE_SUBMENU_CATEGORIES'), 'index.php?option=com_categories&view=categories&extension=com_jexchoose', $submenu == 'categories');
		JSubMenuHelper::addEntry(JText::_('COM_JEXCHOOSE_SUBMENU_GROUPS'),'index.php?option=com_jexchoose&view=groups',$submenu = 'groups');
		
		//set some global property
		$document = JFactory::getDocument();
		$document->addStyleDeclaration('.icon-48-jexchoose'.'{background-image:url(../media/com_jexchoose/images/jexChoose-48x48.png);}');
		
	}
	/**
	*	get the actions
	*/
	public static function getActions($messageId = 0)
	{
		jimport('joomla.access.access');
		$user = JFactory::getUser();
		$result = new JObject;
		
		if(empty($messageId))
		{
			$assetName = 'com_jexchoose';
		} else
		{
			$assetName = 'com_jexchoose.message.'.(int)$messageId;
		}
		
		$actions = JAccess::getActions('com_jexchoose', 'component');
		foreach($actions as $action)
		{
			$result->set($action->name, $user->authorise($action->name, $assetName));
		}
		return $result;
	}
}
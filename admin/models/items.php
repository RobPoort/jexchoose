<?php
defined('_JEXEC') or die('Restricted Access');

jimport('joomla.application.component.modellist');

class JexchooseModelItems extends JModelList
{
	/**
	*	model to build the query to load the data
	*	 @return string
	*/
	protected function getListQuery()
	{
		$db = JFactory::getDBO();
		$query = $db->getQuery(true);
		
		$query->from('#__jexchoose_items as ji');
		$query->select('ji.id as id, ji.ordering as ordering, ji.published as published, ji.text as text, ji.params as params, jg.title as group_title, jg.text as group_text,c.title as category_title');
		$query->join('LEFT','#__jexchoose_groups as jg ON jg.id=ji.group_id');
		$query->join('LEFT','#__categories as c ON c.id=ji.catid');		
		$query->order('ji.ordering');
		
		return $query;
	}
}
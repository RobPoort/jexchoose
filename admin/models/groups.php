<?php
defined('_JEXEC') or die('restricted access');

jimport('joomla.application.component.modellist');

class JexchooseModelGroups extends JModelList
{
	protected function getListQuery()
	{
		$db = JFactory::getDBO();
		$query = $db->getQuery(true);
		
		$query->select('jg.id as id, jg.title as title, jg.text as text, jg.published as published, jg.ordering as ordering, jg.params as params, c.title as category');
		$query->from('#__jexchoose_groups as jg');
		$query->join('LEFT', '#__categories as c ON c.id=jg.catid');
		$query->order('jg.ordering');
		
		return $query;
	}
	
	function publish()
	{
		$data = JRequest::get('post');
		$value = JRequest::getCmd('task');
		$ids = JRequest::getVar('cid', array(), 'post', 'array');
		$where = array();
		foreach($ids as $id){
			$where[] = ' id='.(int)$id;
		}
		switch($value){
			case 'publish':
				$value = 1;
				break;
			case 'unpublish';
				$value = 0;
				break;
			default:
				$value = 1;
				break;
		}
				
		$db = JFactory::getDBO();
		$query = $db->getQuery(true);
		$query->clear();
		$query->update('#__jexchoose_groups');
		$query->set('published = '.(int)$value);
		$query->where($where, ' OR ');
		$db->setQuery((string)$query);
		if (!$db->query()) {
            JError::raiseError(500, $db->getErrorMsg());
        	return false;
        } else {
        	return true;
		}	
		 
	}
}
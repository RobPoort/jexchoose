<?php
	/**
	*	admin part
	*/
defined('_JEXEC') or die('restricted access');

jimport('joomla.application.component.modellist');

class JexchooseModelLocations extends JModellist
{
	/**
	*	method om query op te bouwen om data te laden
	*	@return	string	sql-query
	*/
	protected function getListQuery()
	{
		$db = JFactory::getDBO();
		$query = $db->getQuery(true);
		
		$query->from('#__jexchoose_locations as jl');
		$query->join('LEFT', '#__categories as c ON c.id=jl.catid');		
		$query->select('jl.id as id, jl.ordering as ordering, jl.published as published, jl.name as name, jl.link as link, jl.logo as logo, jl.mtime as mtime, jl.params as params, c.title as title, c.id as cat_id');
		
		$query->order('jl.ordering');
		
		
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
		$query->update('#__jexchoose_locations');
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
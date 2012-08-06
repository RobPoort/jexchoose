<?php
	/**
	*	site part
	*/
defined('_JEXEC') or die('restricted access');

jimport('joomla.application.component.modelitem');

class JexchooseModelJexchoose extends JModelItem
{
	protected function populateState()
	{
		$app = JFactory::getApplication();
		$catid = JRequest::getInt('catid');
		$group = JRequest::getInt('group');
		$data = JRequest::get('post');
		if(isset($data['select'])){
			$selected = $data['select'];
			$this->setState('selected.id',$selected);
		}
		
		//algehele config in state opnemen
		$config->category = $catid;
		$config->groups = $group;
		$this->setState('chooseConfig', $config);
		$this->setState('category.id',$catid);
		
		
		parent::populateState();
	}
	public function getTable($type = 'Locations', $prefix = 'JexchooseTable', $config = array()){
		return JTable::getInstance($type,$prefix,$config);
	}
	public function getItems()
	{
		$config = $this->getState('chooseConfig');
		$catid = $config->category;
		
		$db = JFactory::getDBO();
		$query = $db->getQuery(true);
		$query->select('ji.id as id, ji.text as text');		
		$query->from('#__jexchoose_items as ji');
		$query->where('ji.catid='.(int)$catid);
		$query->where('ji.published=1');
		$query->order('ji.ordering');
		$db->setQuery($query);
		$items = $db->loadObjectList();
		
		return $items;
	}
	public function getItemsGrouped()
	{
		$config = $this->getState('chooseConfig');
		$catid = $config->category;
		
		$db = JFactory::getDBO();
		$query = $db->getQuery(true);
		$query->from('#__jexchoose_items as ji');
		$query->select('jg.id as id, jg.title as title');
		$query->join('LEFT','#__jexchoose_groups as jg ON ji.group_id=jg.id');
		$query->where('ji.catid='.(int)$catid);
		$query->where('ji.published=1');
		$query->order('jg.ordering');
		$db->setQuery($query);
		$rows = $db->loadObjectList();
		$result = array();
		foreach($rows as $row){
			$result[] = $row->id;
		}
		$groups = array_unique($result,SORT_STRING);
		$items = array();
		foreach($groups as $group){
			$db = JFactory::getDBO();
			$query = $db->getQuery(true);
			$query->from('#__jexchoose_items as ji');
			$query->select('ji.id as id, ji.text as text, jg.title as group_title, jg.text as group_text');
			$query->join('LEFT','#__jexchoose_groups as jg ON jg.id='.(int)$group);
			$query->where('group_id='.(int)$group);
			$query->where('ji.published=1');
			$query->order('ji.ordering');
			$db->setQuery($query);
			$items[$group] = $db->loadObjectList();			
		}
		
		// $db = JFactory::getDBO();
		// $query = $db->getQuery(true);
		// $query->select('ji.id as id, ji.text as text, ji.group_id as group_id, jg.title as title, jg.text as group_text, jg.ordering as group_ordering');
		// $query->join('LEFT', '#__jexchoose_groups as jg ON ji.group_id=jg.id');
		// $query->from('#__jexchoose_items as ji');
		// $query->where('ji.catid='.(int)$catid);
		// $query->where('ji.published=1');
		// $query->order('jg.ordering, ji.ordering DESC');
		// $db->setQuery($query);
		// $items = $db->loadObjectList();
		
		return $items;
	}
	public function getLocations()
	{
		$selected = $this->getState('selected.id');
		$where = array();
		foreach($selected as $key=>$id){
			$where[] = $id;
		}
		$db = JFactory::getDBO();
		$query = $db->getQuery(true);
		$query->from('#__jexchoose_locations as jl');
		$query->select('*');
		$query->where('jl.published=1');		
		$db->setQuery($query);
		$rows = $db->loadObjectList();	
		
		foreach($rows as $row){
			$db = JFactory::getDBO();
			$query = $db->getQuery(true);
			$query->select('jx.item_id as item_id');
			$query->from('#__jexchoose_xref as jx');
			$query->where('location_id='.$row->id);
			$db->setQuery($query);
			$locs[$row->id] = $db->loadAssocList();			
		}
		$items = array();
		$result = array();
		$count = count($selected);
		if($locs){
			foreach($locs as $key=>$values){
				$result[$key] = 0;
				foreach($values as $val){
					foreach($selected as $select){
						if(in_array((int)$select,$val)){
							$result[$key]++;
						}
					}
				}
			}
		}
		
		$results = array();
		foreach($rows as $row){
			$results[$row->id] = $row;
		}
		foreach($result as $key=>$val){
			if($val == $count){
				$items[] = $results[$key];
			}
		}
		
		return $items;
	}
	
	public function getSelected(){
		
		$items = $this->getState('selected.id');
		if($items){
			return $items;
		} else{
			return false;
		}
	}
}
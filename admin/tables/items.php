<?php
defined('_JEXEC') or die('You mentally challenged testkip');

jimport('joomla.database.table');

class JexchooseTableItems extends JTable
{
	/**
	*	constructor
	*	param	object	Database connector object
	*/
	function __construct(&$db){
		parent::__construct('#__jexchoose_items', 'id', $db);
	}
	/**
	*	overloaded bind function
	*
	*	@param	array	named array
	*	@return	null|string		null if operation was succesfull, otherwise returns error (string)
	*	@see JTable::bind
	*/
	public function bind($array, $ignore = '')
	{
		if(isset($array['params']) && is_array($array['params']))
		{
			//convert the params field to a string
			$parameter = new JRegistry;
			$parameter->loadArray($array['params']);
			$array['params'] = (string)$parameter;
		}
		return parent::bind($array, $ignore);
	}
	
	/**
	*	overwritten load function
	*	@param	int	$pk	primary key
	*	@param	boolean
	*	@return	boolean
	*	@see JTable::load
	*/
	public function load($pk = null, $reset = true)
	{
		if(parent::load($pk,$reset))
		{
			//convert the params field to a registry
			$params = new JRegistry;
			//loadJSON is @deprecated	12.1 Use loadString passing JSON as the format instead
			$params->loadString($this->params, 'JSON');
			//"item" should not be present
			//$params->loadJSON($this->params);
			
			$this->params = $params;
			return true;
		} else
		{
			return false;
		}
	}
	/**
	*	method to compute teh default name of the asset.
	*	The default name is in the form `table name.id`
	*	where id is the value of the primary key of the table
	*
	*	@return	string
	*	@SINCE 2.5
	*/
	protected function _getAssetName()
	{
		$k = $this->_tbl_key;
		return 'com_jexchoose.message.'.(int)$this->$k;
	}
	/**
	*	method to return the title to use for the asset table
	*	@return	string
	*/
	protected function _getAssetTitle()
	{
		return $this->name;
	}
	
	/**
	*	method to get the parent asset id for the record
	*	
	*	@return	int
	*	@since	2.5
	*/
	protected function _getAssetParentId()
	{
		$asset = JTable::getInstance('Asset');
		$asset->loadByName('com_jexchoose');
		
		return $asset->id;
	}
}
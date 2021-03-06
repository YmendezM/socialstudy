<?php
namespace TeachMe\Repositories;

abstract class BaseRepository
{
	abstract public function getmodel();

	public function newQuery()
	{
		return $this->getModel()->newQuery();
	}

	public function findOrFail($id)
	{
		return $this->newQuery()->findOrFail($id);
		
	}
}
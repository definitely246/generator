<?php namespace Codesleeve\Generator\Contexts;

use Codesleeve\Generator\Support\Transform;
use Codesleeve\Generator\Interfaces\ContextInterface;

class EntityContext implements ContextInterface
{
	/**
	 * Dependency setup in constructor
	 */
	public function __construct(Transfrom $transformer = null)
	{
		$this->transformer = $transformer ?: new Transform;
	}

	/**
	 * Generates the context for us
	 *
	 * @return Context
	 */
	public function context(array $parameters)
	{
		$this->parameters = $parameters;

		$this->entity = $parameters['entity'];
		$this->fields = isset($parameters['fields']) ? $parameters['fields'] : '';

		return $this->populateContext();
	}

	/**
	 * Generates all the context for an entity
	 * 
	 * @return 
	 */
	protected function populateContext()
	{
		$context = array();

		$context = $this->transformer->transformAll($context, 'entity', $this->entity);

		// $this->attributes();

		// $this->belongsTo();

		// $this->hasMany();

		// $this->belongsToMany();

		return $context;
	}

	/**
	 * Model could have attributes attached to it
	 */
	// protected function attributes()
	// {
	// 	$attributes = array();

	// 	foreach ($this->attributes as $attribute)
	// 	{
	// 		list($name, $type, $index) = $this->parseAttribute($attribute);

	// 		if ($this->isAttribute($name, $type))
	// 		{
	// 			$attributes[] = compact('name', 'type', 'index');			
	// 		}
	// 	}

	// 	$this->context['attributes'] = $attributes;
	// }

	// /**
	//  * Model could have belongsTo relationships attached to it
	//  */
	// protected function belongsTo()
	// {
	// 	$belongsTo = array();

	// 	foreach ($this->attributes as $attribute)
	// 	{
	// 		list($name, $type, $index) = $this->parseAttribute($attribute);

	// 		if (strtolower($type) === "belongsto")
	// 		{
	// 			$belongsTo[] = compact('name', 'type', 'index');
	// 		}
	// 	}

	// 	$this->context['belongsTo'] = $belongsTo;
	// }

	// *
	//  * Model could have hasMany relationships attached to it
	 
	// protected function hasMany()
	// {
	// 	$hasMany = array();

	// 	foreach ($this->attributes as $attribute)
	// 	{
	// 		list($name, $type, $index) = $this->parseAttribute($attribute);

	// 		if (strtolower($type) === "hasmany")
	// 		{
	// 			$hasMany[] = compact('name', 'type', 'index');
	// 		}
	// 	}

	// 	$this->context['hasMany'] = $hasMany;
	// }

	// /**
	//  * Model could have belongsToMany relationships attached to it
	//  */
	// protected function belongsToMany()
	// {
	// 	$belongsToMany = array();

	// 	foreach ($this->attributes as $attribute)
	// 	{
	// 		list($name, $type, $index) = $this->parseAttribute($attribute);

	// 		if (strtolower($type) === "belongstomany")
	// 		{
	// 			$belongsToMany[] = compact('name', 'type', 'index');
	// 		}
	// 	}

	// 	$this->context['belongsToMany'] = $belongsToMany;
	// }
}
<?php namespace Codesleeve\Generator;

use Codesleeve\Generator\Support\Transform;
use Codesleeve\Generator\Interfaces\ContextInterface;

class EntityContext implements ContextInterface
{
	/**
	 * List of names that are not really attributes when we search
	 * through fields
	 *
	 * @var array
	 */
	static protected $nonAttributes = array('belongsto', 'hasmany', 'belongstomany');

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

		$this->fields = isset($parameters['fields']) ? $parameters['fields'] : array();

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

		$context = $this->attributes($context);

		$context = $this->belongsTo($context);

		$context = $this->hasMany($context);

		$context = $this->belongsToMany($context);

		return $context;
	}

	/**
	 * Model could have attributes attached to it
	 *
	 */
	protected function attributes($context)
	{
		$attributes = array();

		foreach ($this->fields as $field)
		{
			list($name, $type, $index) = $this->parseField($field);

			if ($this->isAttribute($name, $type))
			{
				$attribute = $this->transformer->transformAll(array(), 'name', $name);

				$attribute['type'] = $type;
				$attribute['index'] = $index;
				$attributes[] = $attribute;
			}
		}

		$context['attributes'] = $attributes;

		return $context;
	}

	/**
	 * Model could have belongsTo relationships attached to it
	 */
	protected function belongsTo($context)
	{
		$context['belongsTo'] = $this->findRelationshipByType('belongsTo');

		return $context;
	}

	/**
	 * Model could have hasMany relationships attached to it
	 *
	 * @return boolean
	 */
	protected function hasMany($context)
	{
		$context['hasMany'] = $this->findRelationshipByType('hasMany');

		return $context;
	}

	/**
	 * Model could have belongsToMany relationships attached to it
	 */
	protected function belongsToMany($context)
	{
		$context['belongsToMany'] = $this->findRelationshipByType('belongsToMany');

		return $context;
	}

	/**
	 * Turns a string of ':' fields and turns into Fields
	 *
	 * @param  string $field
	 * @return array(3)
	 */
	protected function parseField($field)
	{
		$fields = explode(':', $field);

		return array_merge($fields, array('', '', ''));
	}

	/**
	 * Not every field is an attribute, we also support
	 * relationship types like 'belongsTo', 'hasMany', and 'belongsToMany'
	 *
	 * @param  string  $name
	 * @param  string  $type
	 * @return boolean
	 */
	protected function isAttribute($name, $type)
	{
		return !in_array(strtolower($name), static::$nonAttributes);
	}

	/**
	 * Searches our fields array and tries to find relationships with
	 * the given type
	 *
	 * @param  string $type
	 * @return array
	 */
	protected function findRelationshipByType($relationshipType)
	{
		$results = array();

		foreach ($this->fields as $field)
		{
			list($name, $type, $index) = $this->parseField($field);

			if (strtolower($name) === strtolower($relationshipType))
			{
				foreach (explode(',', $type) as $relationship)
				{
					$results[] = $this->transformer->transformAll(array(), 'name', $relationship);
				}
			}
		}

		return $results;
	}
}
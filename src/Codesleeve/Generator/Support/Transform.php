<?php namespace Codesleeve\Generator\Support;

class Transform
{
	/**
	 * List of transforms we use for transformAll method
	 *
	 * @var array
	 */
	public $allTransforms = array(
		'transformPluralStudly',
		'transformPluralSnake',
		'transformPluralCamel',
		'transformSingularStudly',
		'transformSingularSnake',
		'transformSingularCamel',
	);

	/**
	 * Creates versions of this attribute, some versions
	 * include,
	 *
	 * 	1. Singular StudyCase
	 * 	2. Singular camelCase
	 * 	3. Singular snake_case
	 * 	4. Plural StudyCase
	 * 	5. Plural camelCase
	 * 	6. Plural snake_case
	 *
	 * @return array $context
	 */
	public function transformAll($context, $attributeKey, $attributeValue)
	{
		foreach ($this->allTransforms as $transform)
		{
			list($key, $value) = call_user_func_array(array($this, $transform), array($attributeKey, $attributeValue));
			$context[$key] = $value;
		}

		return $context;
	}

	/**
	 * Creates a studly singular
	 */
	public function transformSingularStudly($key, $value)
	{
		return array(Str::singular(Str::studly($key)), Str::singular(Str::studly($value)));
	}

	/**
	 * Creates a studly plural
	 */
	public function transformPluralStudly($key, $value)
	{
		return array(Str::plural(Str::studly($key)), Str::plural(Str::studly($value)));
	}

	/**
	 * Creates a snake singular
	 */
	public function transformSingularSnake($key, $value)
	{
		return array('_' . Str::singular(Str::snake($key)) . '_', Str::singular(Str::snake($value)));
	}

	/**
	 * Creates a snake plural
	 */
	public function transformPluralSnake($key, $value)
	{
		return array('_' . Str::plural(Str::snake($key)) . '_', Str::plural(Str::snake($value)));
	}

	/**
	 * Creates a camel singular
	 */
	public function transformSingularCamel($key, $value)
	{
		return array(Str::singular(Str::camel($key)), Str::singular(Str::camel($value)));
	}

	/**
	 * Creates a camel plural
	 */
	public function transformPluralCamel($key, $value)
	{
		return array(Str::plural(Str::camel($key)), Str::plural(Str::camel($value)));
	}

}


<?php

class {{Entity}} extends Eloquent
{
{% for relationship in belongsTo %}
	/**
	 * A {{entity}} belongsTo a {{relationship.Name}}
	 */
	public function {{relationship.name}}()
	{
		return $this->belongsTo('{{Entity}}');
	}
{% endfor %}
}

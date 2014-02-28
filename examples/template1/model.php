<?php

class {{Model}} extends Eloquent
{
{% for rel in belongsTo %}
	/**
	 * A {{model}} belongsTo a {{rel.Name}}
	 */
	public function {{rel.name}}()
	{
		return $this->belongsTo('{{Model}}');
	}
{% endfor %}
}



@section('test')

	{{test}}

@endsection('durka')
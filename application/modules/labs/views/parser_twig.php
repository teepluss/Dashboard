<h3>This is {{name}} speaking.</h3>
<ul>
	{% for item in rows %}
	<li>{{item.title}}</li>
	{% endfor %}
</ul>
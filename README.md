# Twig2Blade

Converts Twig templates to Blade templates.

Running this:

```sh
$ composer install
$ php tools/convert.php template.twig
```

Converts this Twig template:

```twig
<ul id="navigation">
{% for item in navigation %}
    <li><a href="{{ item.href }}">{{ item.caption }}</a></li>
{% endfor %}
</ul>

<h1>My Webpage</h1>
{{ a_variable }}
```

To this Blade template:

```blade
<ul id="navigation">
@foreach ($navigation as $item)
    <li><a href="{{ $item->href }}">{{ $item->caption }}</a></li>
@endforeach
</ul>

<h1>My Webpage</h1>
{{ $a_variable }}
```
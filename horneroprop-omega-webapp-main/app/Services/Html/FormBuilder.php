<?php 
namespace App\Services\Html;

use Carbon\Carbon;
use Illuminate\Support\Facades\Request;

class FormBuilder extends \Collective\Html\FormBuilder {
    /**
     * Open up a new HTML form.
     *
     * @param  array $options
     *
     * @return \Illuminate\Support\HtmlString
     */
    public function open(array $options = [])
    {
        $method = array_get($options, 'method', 'post');

        $options = array_merge($options,array('autocomplete' => 'off'));
        // We need to extract the proper method from the attributes. If the method is
        // something other than GET or POST we'll use POST since we will spoof the
        // actual method since forms don't support the reserved methods in HTML.
        $attributes['method'] = $this->getMethod($method);

        $attributes['action'] = $this->getAction($options);

        $attributes['accept-charset'] = 'UTF-8';

        // If the method is PUT, PATCH or DELETE we will need to add a spoofer hidden
        // field that will instruct the Symfony request to pretend the method is a
        // different method than it actually is, for convenience from the forms.
        $append = $this->getAppendage($method);

        if (isset($options['files']) && $options['files']) {
            $options['enctype'] = 'multipart/form-data';
        }

        // Finally we're ready to create the final form HTML field. We will attribute
        // format the array of attributes. We will also add on the appendage which
        // is used to spoof requests for this PUT, PATCH, etc. methods on forms.
        $attributes = array_merge(

          $attributes, array_except($options, $this->reserved)

        );

        // Finally, we will concatenate all of the attributes into a single string so
        // we can build out the final form open statement. We'll also append on an
        // extra value for the hidden _method field if it's needed for the form.
        $attributes = $this->html->attributes($attributes);

        return $this->toHtmlString('<form' . $attributes . '>' . $append);
    }
    /**
     * Create a select box field.
     *
     * @param  string $name
     * @param  array  $list
     * @param  string|bool $selected
     * @param  array  $selectAttributes
     * @param  array  $optionsAttributes
     * @param  array  $optgroupsAttributes
     *
     * @return \Illuminate\Support\HtmlString
     */
    public function select(
        $name,
        $list = [],
        $selected = null,
        array $selectAttributes = [],
        array $optionsAttributes = [],
        array $optgroupsAttributes = []
    ) {
        $this->type = 'select';

        // When building a select box the "value" attribute is really the selected one
        // so we will use that when checking the model or session for a value which
        // should provide a convenient method of re-populating the forms on post.
        $selected = $this->getValueAttribute($name, $selected);

        $selectAttributes['id'] = $this->getIdAttribute($name, $selectAttributes);

        if (! isset($selectAttributes['name'])) {
            $selectAttributes['name'] = $name;
        }

        // We will simply loop through the options and build an HTML value for each of
        // them until we have an array of HTML declarations. Then we will join them
        // all together into one single HTML element that can be put on the form.
        $html = [];

        if (isset($selectAttributes['placeholder'])) {
            $html[] = $this->placeholderOption($selectAttributes['placeholder'], $selected);
            unset($selectAttributes['placeholder']);
        }

        foreach ($list as $value => $display) {
            $optionAttributes = $optionsAttributes[$value] ?? [];
            $optgroupAttributes = $optgroupsAttributes[$value] ?? [];
            $html[] = $this->getSelectOption($display, $value, $selected, $optionAttributes, $optgroupAttributes);
        }

        // Once we have all of this HTML, we can join this into a single element after
        // formatting the attributes into an HTML "attributes" string, then we will
        // build out a final select statement, which will contain all the values.
        $selectAttributes = $this->html->attributes($selectAttributes);

        $list = implode('', $html);

        return $this->toHtmlString("<select{$selectAttributes}><option></option>{$list}</select>");
    }

}
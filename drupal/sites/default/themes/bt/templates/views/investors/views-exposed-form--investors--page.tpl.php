<?php

/**
 * @file
 * This template handles the layout of the views exposed filter form.
 *
 * Variables available:
 * - $widgets: An array of exposed form widgets. Each widget contains:
 * - $widget->label: The visible label to print. May be optional.
 * - $widget->operator: The operator for the widget. May be optional.
 * - $widget->widget: The widget itself.
 * - $sort_by: The select box to sort the view using an exposed form.
 * - $sort_order: The select box with the ASC, DESC options to define order. May be optional.
 * - $items_per_page: The select box with the available items per page. May be optional.
 * - $offset: A textfield to define the offset of the view. May be optional.
 * - $reset_button: A button to reset the exposed filter applied. May be optional.
 * - $button: The submit button for the form.
 *
 * @ingroup views_templates
 */
$name_widget = $widgets['filter-field_real_name_value'];
unset($widgets['filter-field_real_name_value']);
?>
<?php if (!empty($q)): ?>
  <?php
    // This ensures that, if clean URLs are off, the 'q' is added first so that
    // it shows up first in the URL.
    print $q;
  ?>
<?php endif; ?>
<div class="views-exposed-form">
  <div class="views-exposed-widgets clearfix">
    <div class="investor_filter filterZone hid">
    <ul>
    <?php foreach ($widgets as $id => $widget): ?>
      <li class="item clear"">
        <?php if (!empty($widget->label)): ?>
        <label for="<?php print $widget->id; ?>">
            <?php print $widget->label; ?>
          </label>
         
        <?php endif; ?>
        
          <?php print $widget->widget; ?>
        
      </li>
    <?php endforeach; ?>
    </ul>

    </div>
    <div class="views-exposed-widget">
    <ul>
    <li>
      <?php print $name_widget->widget; ?>
    </li>
    <li>
      <?php print $button; ?>		
    </li>
    <?php if (!empty($reset_button)): ?>
      <li>
        <?php print $reset_button; ?>
      </li>
    <?php endif; ?>
    
    <li>      
			<span class="filter_btn"><button class="btn btn-default form-submit">过滤</button></span>
		</li>
    </ul>
    </div>
    
  </div>
</div>

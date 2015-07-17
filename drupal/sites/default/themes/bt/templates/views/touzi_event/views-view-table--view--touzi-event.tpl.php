<?php

/**
 * @file
 * Template to display a view as a table.
 *
 * - $title : The title of this group of rows.  May be empty.
 * - $header: An array of header labels keyed by field id.
 * - $caption: The caption for this table. May be empty.
 * - $header_classes: An array of header classes keyed by field id.
 * - $fields: An array of CSS IDs to use for each field id.
 * - $classes: A class or classes to apply to the table, based on settings.
 * - $row_classes: An array of classes to apply to each row, indexed by row
 *   number. This matches the index in $rows.
 * - $rows: An array of row items. Each row is an array of content.
 *   $rows are keyed by row number, fields within rows are keyed by field ID.
 * - $field_classes: An array of classes to apply to each field, indexed by
 *   field id, then row number. This matches the index in $rows.
 * @ingroup views_templates
 */
?>
<!--zhb add 2015-7-14 :< table class="children-norml-link" id="company-member-list" style="margin: 20px auto; width: 90%;">-->

<table id="company-member-list" style="margin: 20px auto; width: 100%;" class="children-norml-link" >
   <?php if (!empty($title) || !empty($caption)) : ?>
     <caption><?php print $caption . $title; ?></caption>
  <?php endif; ?>
  <?php if (!empty($header)) : ?>
    <thead>
    
      <tr class="" style="background: #ff6600; color: #fff;">
        <?php foreach ($header as $field => $label): ?>
      
          <th  class="mytdFirst" >
            <?php print $label; ?>
          </th>
        <?php endforeach; ?>
         <TH class="mytdFirst" width="5%"><INPUT id="all" value="全选"  type=checkbox name="all"></TH>
      </tr>
      
     
     
    </thead>
  <?php endif; ?>
  <tbody>
    <?php foreach ($rows as $row_count => $row): ?>
    <!-- zhb add 2015-7-14：<tr class="tb_even" jQuery19107944535226066767="28"> -->
      <tr class="tb_even">
        <?php foreach ($row as $field => $content): ?>
          <td style="font-family:微软雅黑, Helvetica Neue, Helvetica, Arial, sans-serif; font-size:100%" <?php print drupal_attributes($field_attributes[$field][$row_count]); ?>>
            <?php print $content; ?>
          </td>
        <?php endforeach; ?>
        
		<TD><INPUT id="eventSelected" value="" type="checkbox" name="eventSelected"></TD>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>

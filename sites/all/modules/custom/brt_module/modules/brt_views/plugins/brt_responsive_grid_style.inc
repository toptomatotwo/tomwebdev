<?php
/**
 * @file
 * Contains the responsive grid style plugin.
 */

/**
 * Style plugin to render each item in a responsive grid.
 *
 * @ingroup views_style_plugins
 */
class BrtViewsResponsiveGridStyle extends views_plugin_style {
  /**
   * Set default options.
   */
  function option_definition() {
    $options = parent::option_definition();
    $options['columns'] = array('default' => '4');
/*    $options['animate'] = array('default' => 1);
    $options['animation_type'] = array('default' => 'bounceIn');*/
    $options['alignment'] = array('default' => 'horizontal');
    $options['wrapper_classes'] = array('default' => '');
    $options['column_classes'] = array('default' => 'views-column');
    $options['first_column_classes'] = array('default' => 'views-column-first');
    $options['last_column_classes'] = array('default' => 'views-column-last');
    $options['row_classes'] = array('default' => 'views-row');
    $options['first_row_classes'] = array('default' => 'views-row-first');
    $options['last_row_classes'] = array('default' => 'views-row-last');
    $options['default_classes'] = array('default' => 0);
    return $options;
  }

  /**
   * Render the given style.
   */
  function options_form(&$form, &$form_state) {
    parent::options_form($form, $form_state);
    
    // Flatten options to deal with the various hierarchy changes.
    $options = brt_responsive_grid_style_get_options($this->options);

    $form['columns'] = array(
      '#type' => 'textfield',
      '#title' => t('Number of columns'),
      '#default_value' => $options['columns'],
      '#required' => TRUE,
      '#element_validate' => array('views_element_validate_integer'),
    );
/*
    $form['animate'] = array(
          '#type' => 'checkbox',
          '#title' => t('Animated this view content'),
          '#default_value' => $options['animate'],
          '#element_validate' => array('views_element_validate_integer'),
    );
    $animated_array = md_official_animation_options();
    $form['animation_type'] = array(
        '#type'     => 'select',
        '#options'  => $animated_array,
        '#default_value'    => $options['animation_type'],
        '#states'       => array(
            'visible' => array(
                ':input[name="style_options[animate]"]' => array('checked' => TRUE),
            ),
        )
    );*/
    $form['alignment'] = array(
      '#type' => 'radios',
      '#title' => t('Alignment'),
      '#options' => array('horizontal' => t('Horizontal'), 'vertical' => t('Vertical')),
      '#default_value' => $options['alignment'],
      '#description' => t('Horizontal alignment will place items starting in the upper left and moving right. Vertical alignment will place items starting in the upper left and moving down.'),
    );
    $form['default_classes'] = array(
      '#type' => 'checkbox',
      '#title' => t('Remove default views classes'),
      '#default_value' => $options['default_classes'],
    );
    $form['grid']= array(
      '#type' => 'fieldset',
      '#title' => t('Grid Classes'),
      '#weight' => 70,
      '#collapsible' => TRUE,
      '#collapsed' => TRUE,
    );
    $form['wrapper_classes'] = array(
      '#type' => 'textfield',
      '#title' => t('Wrapper'),
      '#default_value' => $options['wrapper_classes'],
      '#fieldset' => 'grid',
      '#prefix' => '<div class="views-left-30">',
      '#suffix' => '</div>',
    );
    $form['column_class_wrapper']= array(
      '#type' => 'fieldset',
      '#title' => t('Column Classes'),
      '#weight' => 80,
      '#collapsible' => TRUE,
      '#collapsed' => TRUE,
    );
    $form['column_classes'] = array(
      '#type' => 'textfield',
      '#title' => t('Every Column'),
      '#default_value' => $options['column_classes'],
      '#fieldset' => 'column_class_wrapper',
      '#prefix' => '<div class="views-left-30">',
      '#suffix' => '</div>',
    );
    $form['first_column_classes'] = array(
      '#type' => 'textfield',
      '#title' => t('First Column'),
      '#default_value' => $options['first_column_classes'],
      '#fieldset' => 'column_class_wrapper',
      '#prefix' => '<div class="views-left-30">',
      '#suffix' => '</div>',
    );
    $form['last_column_classes'] = array(
      '#type' => 'textfield',
      '#title' => t('Last Column'),
      '#default_value' => $options['last_column_classes'],
      '#fieldset' => 'column_class_wrapper',
      '#prefix' => '<div class="views-left-30">',
      '#suffix' => '</div>',
    );
    $form['rows']= array(
      '#type' => 'fieldset',
      '#title' => t('Row Classes'),
      '#weight' => 90,
      '#collapsible' => TRUE,
      '#collapsed' => TRUE,
    );
    $form['row_classes'] = array(
      '#type' => 'textfield',
      '#title' => t('Every Row'),
      '#default_value' => $options['row_classes'],
      '#fieldset' => 'rows',
      '#prefix' => '<div class="views-left-30">',
      '#suffix' => '</div>',
    );
    $form['first_row_classes'] = array(
      '#type' => 'textfield',
      '#title' => t('First Row'),
      '#default_value' => $options['first_row_classes'],
      '#fieldset' => 'rows',
      '#prefix' => '<div class="views-left-30">',
      '#suffix' => '</div>',
    );
    $form['last_row_classes'] = array(
      '#type' => 'textfield',
      '#title' => t('Last Row'),
      '#default_value' => $options['last_row_classes'],
      '#fieldset' => 'rows',
      '#prefix' => '<div class="views-left-30">',
      '#suffix' => '</div>',
    );
  }
}
function brt_animation_options() {
    $animation_name = array(
        'hinge'         => 'hinge',
        'flash'         => 'flash',
        'shake'         => 'shake',
        'bounce'        => 'bounce',
        'tada'          => 'tada',
        'swing'         => 'swing',
        'wobble'        => 'wobble',
        'pulse'         => 'pulse',
        'flip'          => 'flip',
        'flipInX'       => 'flipInX',
        'flipInY'           => 'flipInY',
        'fadeIn'            => 'fadeIn',
        'fadeInUp'          => 'fadeInUp',
        'fadeInDown'          => 'fadeInDown',
        'fadeInLeft'          => 'fadeInLeft',
        'fadeInRight'         => 'fadeInRight',
        'fadeInUpBig'         => 'fadeInUpBig',
        'fadeInDownBig'       => 'fadeInDownBig',
        'fadeInLeftBig'       => 'fadeInLeftBig',
        'fadeInRightBig'      => 'fadeInRightBig',
        'bounceIn'              => 'bounceIn',
        'slideInDown'           => 'slideInDown',
        'slideInLeft'           => 'slideInLeft',
        'slideInRight'          => 'slideInRight',
        'bounceInUp'            => 'bounceInUp',
        'bounceInDown'          => 'bounceInDown',
        'bounceInLeft'          => 'bounceInLeft',
        'bounceInRight'         => 'bounceInRight',
        'rotateIn'              => 'rotateIn',
        'rotateInUpLeft'        => 'rotateInUpLeft',
        'rotateInDownLeft'      => 'rotateInDownLeft',
        'rotateInUpRight'       => 'rotateInUpRight',
        'rotateInDownRight'     => 'rotateInDownRight',
        'rollIn'                => 'rollIn',
        'lightSpeedIn'          => 'lightSpeedIn',
        'lr'                    => 'lr',
    );
    return $animation_name;
}
/**
 * Set default options.
 */
function brt_responsive_grid_style_get_options($array) {
    $options = array();
    foreach ($array as $key => $value) {
        if (!is_array($value)) {
            $options[$key] = $value;
        }
        else {
            $options = array_merge($options, brt_responsive_grid_style_get_options($value));
        }
    }
    return $options;
}
<?php

/**
 * Enqueue scripts and styles
 *
 * @return void
 */
function myawesometheme_scripts_styles() {

	// Load our custom Gravity Forms validation so the form isn't submitted with default values
	wp_register_script( 'gravityformsclearit', trailingslashit( get_template_directory_uri() ) . 'js/gravity-forms-clearit.js', array( 'jquery' ), '1.0.0', false );
	wp_enqueue_script( 'gravityformsclearit' );

}
add_action( 'wp_enqueue_scripts', 'myawesometheme_scripts_styles' );


/**
 * Custom Gravity Forms validation. Make sure the form isn't submitted with the default values
 * Useful for when your Gravity Form is displaying default values instead of the field labels.
 *
 * Tie our validation function to the 'gform_validation' hook. Since we've appended _1 to the filter name (gform_validation_1)
 * it will only trigger on form ID 1. Change this number if you want it to trigger on some other form ID.
 * There's no sense in running this function on every form submission, now is there!
 *
 * @return validation results
 */

function myawesometheme_validate_gravity_default_values( $validation_result ) {
	
	// Get the form object from the validation result
	$form = $validation_result["form"];
	
	// Get the current page being validated
	$current_page = rgpost( 'gform_source_page_number_' . $form['id'] ) ? rgpost( 'gform_source_page_number_' . $form['id'] ) : 1;
	
	// Loop through the form fields
	foreach( $form['fields'] as &$field ){

		$value_number = rgpost( "input_{$field['id']}" );

		// If there's a default value for the field, make sure the submitted value isn't the default value
		if ( !empty( $field['defaultValue'] ) && $field['defaultValue'] === $value_number ) {
		  $is_valid = false;
		}
		else {
		  $is_valid = true;
		}
		
		// If the field is valid we don't need to do anything, skip it
		if( !$is_valid ) {
			// The field failed validation, so first we'll need to fail the validation for the entire form
			$validation_result['is_valid'] = false;
			
			// Next we'll mark the specific field that failed and add a custom validation message
			$field['failed_validation'] = true;
			$field['validation_message'] = "You can't submit the default value.";
		}
	}

	// Assign our modified $form object back to the validation result
	$validation_result['form'] = $form;
	
	// Return the validation result
	return $validation_result;
}
add_filter( 'gform_validation_1', 'myawesometheme_validate_gravity_default_values' );

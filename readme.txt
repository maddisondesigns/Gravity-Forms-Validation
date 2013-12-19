=== Gravity Forms Validation ===
Contributors: ahortin

Sample code for a custom Gravity Forms validation filter


== Description ==

Occasionally us developers get site designs where a form's labels are displayed within the input fields themselves, rather than sitting above or beside them. This style of form design is quite often used when space on the page is limited.

Gravity Forms doesn't support this by default so to get around it you can specify a default value for the form field and then simply hide the original label.

The Gravity Forms help pages have a nifty little bit of jQuery that will clear the default value when you click on the input field. To set this up, simply specify a default value for your Gravity Form field and then also give it a class of 'clearit' (without the apostrophes). You can see this explained in more detail here... http://www.gravityhelp.com/clearing-default-form-field-values-with-jquery/

The problem with this solution though, is that since the field has a value you're able to submit the form with these default values, which is not what you want. This is especially annoying when you have fields specified as 'required' as they will validate, even though no value has been entered (since it already has the default value in the field)

To get around this, use this custom validation filter by integrating these files into your WordPress theme. It will check to see if the Gravity Form field has a default value and if it does, it will then check the value submitted against the default value and it they match, it will fail the validation. Simple eh!

Obviously, you don't wont to use this if you actually want the default values to be submitted. But you knew that right!?


== Changelog ==

= 1.1 =
- Change the gform_wrapper class to an ID so we only hide the labels on forms with ID 1

= 1.0 =
- Initial version


jQuery(document).ready(function($) {
    // Handle adding and removing fields
    $(".add-field").click(function(e) {
        e.preventDefault();
        var field = $(".custom-field:first").clone();
        field.find("input").val("");
        field.find(".field-type").val(""); // Set the field type to an empty value
        field.find("select[name^=\'field_options\']").empty(); // Clear selected options
        field.appendTo(".custom-fields");
        field.show();
    });
    $(".custom-fields").on("click", ".remove-field", function(e) {
        e.preventDefault();
        $(this).parent(".custom-field").remove();
    });
});

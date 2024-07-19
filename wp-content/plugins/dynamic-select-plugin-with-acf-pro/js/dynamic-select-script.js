jQuery(document).ready(function ($) {
  if (acfData.repeaterData) {
    var repeaterData = acfData.repeaterData;
    var option1Select = $("#option1");
    var option2Select = $("#option2");

    var uniqueOption1 = [];

    // Populate unique option1 values
    $.each(repeaterData, function (index, value) {
      if ($.inArray(value.option1, uniqueOption1) === -1) {
        uniqueOption1.push(value.option1);
        option1Select.append(
          '<option value="' + value.option1 + '">' + value.option1 + "</option>"
        );
      }
    });

    // Update option2 based on selected option1
    option1Select.change(function () {
      var selectedOption1 = $(this).val();
      option2Select.empty();
      option2Select.append('<option value="">Select Option 2</option>');

      $.each(repeaterData, function (index, value) {
        if (value.option1 === selectedOption1) {
          option2Select.append(
            '<option value="' +
              value.option2 +
              '">' +
              value.option2 +
              "</option>"
          );
        }
      });
    });

    // Handle form submission
    $("#redirectForm").submit(function (event) {
      event.preventDefault();

      var selectedOption1 = $("#option1").val();
      var selectedOption2 = $("#option2").val();

      // Find the URL based on selected options
      var selectedUrl = "";
      $.each(repeaterData, function (index, value) {
        if (
          value.option1 === selectedOption1 &&
          value.option2 === selectedOption2
        ) {
          selectedUrl = value.url;
          return false; // break the loop
        }
      });

      if (selectedUrl) {
        window.location.href = selectedUrl;
      } else {
        alert("No URL found for the selected options.");
      }
    });
  }
});

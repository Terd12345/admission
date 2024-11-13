$(document).ready(function () {
  $("#addAdminAccountForm").submit(function (e) {
    e.preventDefault(); // Prevent form submission
    var formData = $(this).serializeArray(); // Serialize form data

    console.log(formData);
    // Perform AJAX request to add member details
    $.ajax({
      url: "controller.php",
      type: "POST",
      data: {
        action: "addAdminAccount",
        formData: formData,
      },
      dataType: "json",
      success: function (response) {
        // Handle success response
        console.log(response);

        if (response.success) {
          $("#addAdminAccountForm")[0].reset();
          $("#addAdminAccountModal").modal("hide");
          $(".alert")
            .removeClass("alert-danger")
            .addClass("alert-warning")
            .show();
          $(".alert p").text(response.message);
        } else {
          $(".alert")
            .removeClass("alert-warning")
            .addClass("alert-danger")
            .show();
          $(".alert p").text(response.message);
        }
        setTimeout(function () {
          $(".alert").hide();
        }, 3000);

        $(".student-pro-list .row").empty();
        fetchAdmins();
      },
      error: function (xhr, status, error) {
        // Handle error
        console.error(error);
        $(".alert")
          .removeClass("alert-warning")
          .addClass("alert-danger")
          .show();
        $(".alert p").text(error);

        setTimeout(function () {
          $(".alert").hide();
        }, 3000);
      },
    });
  });

  function fetchAdmins() {
    $.ajax({
      url: "controller.php",
      type: "POST",
      data: { action: "getAdmins" },
      dataType: "json",
      success: function (response) {
        if (typeof response.image === "undefined" || response.image === null) {
          var photoUrl = "assets/uploads/profileImage/profile-template.jpg";
        } else {
          var photoUrl = "assets/uploads/profileImage/" + response.image;
        }
        response.forEach(function (application) {
          console.log(application);

          var $gridDetails = $("<div>")
            .addClass("col-xl-3 col-lg-4 col-md-6 grid-details-box hoverable")
            .attr("data-bs-toggle", "modal")
            .attr("data-bs-target", "#memberDetailsModal")
            .attr("data-id", application.AdminID);
          var $card = $("<div>").addClass("card");
          var $cardBody = $("<div>").addClass("card-body");
          var $studentBox = $("<div>").addClass("student-box flex-fill");
          var $studentImg = $("<div>").addClass("student-img");

          var $img = $("<img>")
            .addClass("img-fluid")
            .attr("src", photoUrl)
            .css("max-width", "150px")
            .css("max-height", "150px");
          var $studentContent = $("<div>").addClass("student-content pb-0");
          var $name = $("<h5>")
            .addClass("member-name")
            .html("<p>" + application.Name + "</p>");
          var $position = $("<h6>")
            .addClass("member-position")
            .text(application.Role.toUpperCase());
          var $badgeNumber = $("<h6>")
            .addClass("badge-number")
            .text(application.AdminID);
          // Appending elements
          $studentImg.append($img);
          $studentBox.append($studentImg);
          $studentContent.append($name, $position, $badgeNumber);
          $cardBody.append($studentBox, $studentContent);
          $card.append($cardBody);
          $gridDetails.append($card);
          // Append grid details to the container
          $(".student-pro-list .row").append($gridDetails);
        });
      },
      error: function (xhr, status, error) {
        console.error(error);
      },
    });
  }

  fetchAdmins();

  //   END OF JS
});

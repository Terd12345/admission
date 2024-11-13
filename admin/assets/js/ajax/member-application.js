$(document).ready(function () {
  $(document).on("click", ".hoverable", function () {
    var $row = $(this);
    var applicationId = $(this).data("id");
    $.ajax({
      url: "controller.php",
      type: "POST",
      data: { action: "fetch", applicationId: applicationId },
      dataType: "json",
      success: function (response) {
        var status = response.status;

        toggleDateJoinedField($row, status);

        var photoUrl = "assets/img/" + response.image;
        $("#modalPhoto").attr("src", photoUrl);
        $("#modalJoined").text(response.date_accepted);
        $("#modalDate").text(response.date_of_application);
        $("#modalPayment").text(response.payment_type);
        $("#modalPosition").text(response.position);
        $("#modalName").text(response.name);
        $("#modalAddress").text(response.address);
        $("#modalEmail").text(response.email);
        $("#modalCellphone").text(response.cellphone);
        $("#modalCivilStatus").text(response.civil_status);
        $("#modalGender").text(response.gender);
        $("#modalNationality").text(response.nationality);
        $("#modalBirthday").text(response.birthday);
        $("#modalAge").text(response.age);
        $("#modalAffiliation").text(response.affiliation);
        $("#modalRegion").text(response.region_province);
        $("#modalHeight").text(response.height);
        $("#modalWeight").text(response.weight);
        $("#modalBloodType").text(response.blood_type);
        $("#modalEyeColor").text(response.eye_color);
        $("#modalSkinColor").text(response.skin_color);
        $("#modalSSS").text(response.sss_number);
        $("#modalTIN").text(response.tin_number);
        $("#modalEmergencyContact").text(response.emergency_contact);
        $("#modalEmergencyCellphone").text(response.emergency_cellphone);

        // Educational Attainment
        var educationTable = $("#educationTable tbody");
        educationTable.empty();
        var educationOrder = [
          "Elementary",
          "Secondary",
          "Tertiary",
          "Post-Graduate Studies",
        ];
        educationOrder.forEach(function (level) {
          var found = response.educational_attainment.find(function (
            education
          ) {
            return education.level === level;
          });

          var yearsGraduated = found ? found.year_graduated : "";
          var row =
            "<tr><td>" +
            level +
            "</td><td>" +
            (found ? found.school_university_name : "") +
            "</td><td>" +
            (found ? found.course || "" : "") +
            "</td><td>" +
            yearsGraduated +
            "</td></tr>";
          educationTable.append(row);
        });

        // Work Experience
        var workTable = $("#workTable tbody");
        workTable.empty();
        response.work_experiences.forEach(function (experience) {
          var row =
            "<tr><td>" +
            experience.job_description +
            "</td><td>" +
            experience.years +
            "</td></tr>";
          workTable.append(row);
        });

        // Character References
        var refTable = $("#refTable tbody");
        refTable.empty();
        response.character_references.forEach(function (reference) {
          var row =
            "<tr><td>" +
            reference.name +
            "</td><td>" +
            reference.position +
            "</td><td>" +
            reference.contact_number +
            "</td></tr>";
          refTable.append(row);
        });
      },
      error: function (xhr, status, error) {
        console.error(error);
      },
    });
  });

  function fetchAndRenderMembershipApplications() {
    $.ajax({
      url: "controller.php",
      type: "POST",
      data: { action: "getMembershipApplications" },
      dataType: "json",
      success: function (response) {
        var table = $("#membershipApplicationsTable").DataTable();
        table.clear().draw();

        response.forEach(function (application) {
          var $row = $("<tr>")
            .addClass("text-center hoverable")
            .attr("data-bs-toggle", "modal")
            .attr("data-bs-target", "#applicationModal")
            .attr("data-id", application.id);

          $row.append(
            '<td><div class="form-check check-tables"><input class="form-check-input" type="checkbox" value="something"></div></td>'
          );
          $row.append("<td>" + application.application_date + "</td>");
          $row.append(
            '<td><h2 class="table-avatar"><a href="student-details.php" class="avatar avatar-sm me-2"><img class="avatar-img rounded-circle" src="assets/uploads/profileImage/' +
              application.image +
              '" alt="User Image"></a><a href="student-details.php">' +
              application.name +
              "</a></h2></td>"
          );
          $row.append("<td>" + application.position + "</td>");
          $row.append("<td>" + application.cellphone + "</td>");
          $row.append("<td>" + application.address + "</td>");
          $row.append("<td>" + application.affiliation + "</td>");
          $row.append("<td>" + application.payment_type + "</td>");
          $row.append("<td>" + application.status + "</td>");

          var $actionCell = $("<td>")
            .addClass("text-end")
            .append('<div class="actions">');
          if (application.status === "Accepted") {
            $actionCell
              .find(".actions")
              .append(
                '<i class="feather-check-circle text-success m-auto" style="font-size:1.3rem;"></i>'
              );
          } else {
            $actionCell
              .find(".actions")
              .append(
                '<a href="" class="btn btn-sm bg-success-light me-2 btn-accept" data-bs-toggle="tooltip" data-bs-placement="top" title="Accept" data-id="' +
                  application.id +
                  '"><i class="feather-check-circle"></i></a>'
              )
              .append(
                '<a href="" class="btn btn-sm bg-danger-light me-2" data-bs-toggle="tooltip" data-bs-placement="top" title="Reject"><i class="feather-x-circle"></i></a>'
              )
              .append(
                '<a href="mailto:example@example.com?subject=Membership Application Rejection&body=Dear Applicant,%0D%0A%0D%0AWe regret to inform you that your membership application has been rejected.%0D%0A%0D%0ABest regards,%0D%0A[Your Name]" class="btn btn-sm bg-secondary-light" data-bs-toggle="tooltip" data-bs-placement="top" title="Reject with Email"><i class="feather-mail"></i></a>'
              );
          }
          $row.append($actionCell);

          // Append the row to the table
          table.row.add($row).draw();
        });
      },
      error: function (xhr, status, error) {
        console.error(error);
      },
    });
  }

  fetchAndRenderMembershipApplications();

  // Handle click event for accepting an application
  $(document).on("click", ".btn-accept", function (e) {
    e.preventDefault();
    e.stopPropagation();
    $(this).removeClass(".hoverable");
    $(this).removeAttr("data-bs-toggle");
    e.stopImmediatePropagation();

    var applicationId = $(this).data("id");
    $.ajax({
      url: "controller.php",
      type: "POST",
      data: { action: "accept", applicationId: applicationId },
      success: function (response) {
        fetchAndRenderMembershipApplications();
      },
      error: function (xhr, status, error) {
        console.error(error);
      },
    });
    e.preventDefault();
    e.stopPropagation();
    e.stopImmediatePropagation();
    $("#applicationModal").modal("hide");
  });

  //   Hide Date Joined when Status is Pending
  function toggleDateJoinedField($row, status) {
    var $dateApplication = $("#modalDate");
    var $modalPayment = $("#modalPayment");
    var $modalJoined = $("#modalJoined");

    if (status === "Accepted") {
      $modalJoined.closest(".col-md-4").show();
      $dateApplication
        .closest(".col-md-6")
        .removeClass("col-md-6")
        .addClass("col-md-4");

      $modalPayment
        .closest(".col-md-6")
        .removeClass("col-md-6")
        .addClass("col-md-4");
    } else {
      $modalJoined.closest(".col-md-4").hide();

      $dateApplication
        .closest(".col-md-4")
        .removeClass("col-md-4")
        .addClass("col-md-6");

      $modalPayment
        .closest(".col-md-4")
        .removeClass("col-md-4")
        .addClass("col-md-6");
    }
  }
});

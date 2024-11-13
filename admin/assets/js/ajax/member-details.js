$(document).ready(function () {
  $(document).on("click", ".hoverable", function () {
    var applicationId = $(this).data("id");
    $.ajax({
      url: "controller.php",
      type: "POST",
      data: { action: "fetch", applicationId: applicationId },
      dataType: "json",
      success: function (response) {
        console.log(response.image);
        if (typeof response.image === "undefined" || response.image === null) {
          var photoUrl = "assets/uploads/profileImage/profile-template.jpg";
          $("#modalPhoto").attr("src", photoUrl);
        } else {
          var photoUrl = "assets/uploads/profileImage/" + response.image;
          $("#modalPhoto").attr("src", photoUrl);
        }

        $("#modalJoined").text(response.date_accepted);
        $("#modalBadge").text(response.badge_number);
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

  function fetchAndRenderMembers() {
    $.ajax({
      url: "controller.php",
      type: "POST",
      data: { action: "getMembers" },
      dataType: "json",
      success: function (response) {
        var table = $("#membersTable").DataTable();
        table.clear().draw();

        response.forEach(function (application) {
          var $row = $("<tr>")
            .addClass("hoverable")
            .attr("data-bs-toggle", "modal")
            .attr("data-bs-target", "#memberDetailsModal")
            .attr("data-id", application.id);

          var $imageName = application.image;
          if (typeof $imageName === "undefined" || $imageName === null) {
            $imageName = "profile-template.jpg";
          }

          $row.append(
            '<td><div class="form-check check-tables"><input class="form-check-input" type="checkbox" value="something"></div></td>'
          );
          $row.append("<td>" + application.badge_number + "</td>");
          $row.append(
            '<td><h2 class="table-avatar"><a href="student-details.php" class="avatar avatar-sm me-2"><img class="avatar-img rounded-circle" src="assets/uploads/profileImage/' +
              $imageName +
              '" alt="User Image"></a><a href="student-details.php">' +
              application.name +
              "</a></h2></td>"
          );
          $row.append("<td>" + application.position + "</td>");
          $row.append("<td>" + application.cellphone + "</td>");
          $row.append("<td>" + application.email + "</td>");
          $row.append("<td>" + application.address + "</td>");
          $row.append("<td>" + application.affiliation + "</td>");
          $row.append("<td>" + application.date_accepted + "</td>");

          var $actionCell = $("<td>")
            .addClass("text-end")
            .append('<div class="actions">');

          $actionCell
            .find(".actions")
            .append(
              '<a href="" class="btn btn-sm bg-warning-light me-2 btn-edit" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit" data-id="' +
                application.id +
                '"><i class="feather-edit"></i></a>'
            )
            .append(
              '<a href="https://mail.google.com/mail/?view=cm&fs=1&to=' +
                application.email +
                '&su=Email%20From%20POILEI&body=Dear%20Applicant,%0D%0A%0D%0AWe%20would%20like%20to%20discuss%20your%20membership%20application.%0D%0A%0D%0ABest%20regards,%0D%0A[Your%20Name]" class="btn btn-sm bg-secondary-light" data-bs-toggle="tooltip" data-bs-placement="top" title="Mail" target="_blank"><i class="feather-mail"></i></a>'
            );

          $row.append($actionCell);

          // Append the row to the table
          table.row.add($row).draw();

          //   ADDING DETAILS FOR GRID VIEW
          var $gridDetails = $("<div>")
            .addClass("col-xl-3 col-lg-4 col-md-6 grid-details-box hoverable")
            .attr("data-bs-toggle", "modal")
            .attr("data-bs-target", "#memberDetailsModal")
            .attr("data-id", application.id);
          var $card = $("<div>").addClass("card");
          var $cardBody = $("<div>").addClass("card-body");
          var $studentBox = $("<div>").addClass("student-box flex-fill");
          var $studentImg = $("<div>").addClass("student-img");
          var $img = $("<img>")
            .addClass("img-fluid")
            .attr("src", "assets/uploads/profileImage/" + application.image);
          var $studentContent = $("<div>").addClass("student-content pb-0");
          var $name = $("<h5>")
            .addClass("member-name")
            .html("<a href='student-details.php'>" + application.name + "</a>");
          var $position = $("<h6>")
            .addClass("member-position")
            .text(application.position);
          var $badgeNumber = $("<h6>")
            .addClass("badge-number")
            .text(application.badge_number);

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

  fetchAndRenderMembers();

  $("#tableView").removeClass("d-none");

  // Toggle between table and grid view
  $(".view-table, .view-grid").click(function (e) {
    e.preventDefault();
    var target = $(this).data("target");
    if (target === "table") {
      $("#tableView").removeClass("d-none");
      $("#gridView").addClass("d-none");
    } else if (target === "grid") {
      $("#tableView").addClass("d-none");
      $("#gridView").removeClass("d-none");
    }
  });

  //   SEARCH FUNCTION

  // Function to filter data based on search input
  function filterData(searchText) {
    var $tableRows = $("#membersTableBody tr");
    var $gridItems = $(".student-pro-list .row .grid-details-box");

    $tableRows.each(function () {
      var $row = $(this);
      var badgeNumber = $row.find("td:nth-child(2)").text().trim();
      var name = $row.find("td:nth-child(3)").text().trim();

      if (
        badgeNumber.toLowerCase().includes(searchText.toLowerCase()) ||
        name.toLowerCase().includes(searchText.toLowerCase())
      ) {
        $row.show();
      } else {
        $row.hide();
      }
    });

    $gridItems.each(function () {
      var $item = $(this);
      var badgeNumber = $item.find(".badge-number").text().trim();
      var name = $item.find(".member-name").text().trim();

      if (
        badgeNumber.toLowerCase().includes(searchText.toLowerCase()) ||
        name.toLowerCase().includes(searchText.toLowerCase())
      ) {
        $item.css("display", "block");
      } else {
        $item.css("display", "none");
      }
    });
  }

  // Event listener for search input
  $("#badgeNumberSearch, #nameSearch").on("input", function () {
    var badgeNumber = $("#badgeNumberSearch").val().trim();
    var name = $("#nameSearch").val().trim();
    console.log(badgeNumber);

    if (badgeNumber !== "") {
      filterData(badgeNumber);
    } else if (name !== "") {
      filterData(name);
    } else {
      $(
        "#membersTableBody tr, .student-pro-list .row .grid-details-box"
      ).show();
    }
  });

  //   ADD PICTURE ON MODAL
  $("#addInputPhoto").change(function () {
    if (this.files && this.files[0]) {
      var reader = new FileReader();

      reader.onload = function (e) {
        $("#addModalPhoto").attr("src", e.target.result);
      };
      console.log($("#addModalPhoto").attr("src"));
      reader.readAsDataURL(this.files[0]);
    }
  });

  //   ADD NEW MEMBER  FUNCTION
  $("#addMemberDetailsForm").submit(function (e) {
    e.preventDefault();

    var formData = new FormData(this);

    // Append characterReferences data to formData
    var characterReferences = getFormDataArray("#addRefTable");
    characterReferences.forEach(function (reference, index) {
      Object.entries(reference).forEach(function ([key, value]) {
        formData.append(
          "characterReferences[" + index + "][" + key + "]",
          value
        );
      });
    });

    // Append educationalAttainment data to formData
    var educationalAttainment = getFormDataArray("#addEducationTable");
    educationalAttainment.forEach(function (education, index) {
      Object.entries(education).forEach(function ([key, value]) {
        formData.append(
          "educationalAttainment[" + index + "][" + key + "]",
          value
        );
      });
    });

    // Append ministerialWorkExperience data to formData
    var ministerialWorkExperience = getFormDataArray("#addWorkTable");
    ministerialWorkExperience.forEach(function (experience, index) {
      Object.entries(experience).forEach(function ([key, value]) {
        formData.append(
          "ministerialWorkExperience[" + index + "][" + key + "]",
          value
        );
      });
    });

    formData.append("action", "addMemberDetails");

    // formData.forEach(function (value, key) {
    //   console.log(key + ": " + value);
    // });

    $.ajax({
      url: "controller.php",
      type: "POST",
      data: formData, // Use FormData object to send form data
      processData: false, // Prevent jQuery from processing the data
      contentType: false, // Prevent jQuery from setting contentType
      dataType: "json",
      success: function (response) {
        console.log(response);

        if (response.success) {
          $("#addMemberDetailsForm")[0].reset();
          $("#addMemberDetailsModal").modal("hide");
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
      },
      error: function (xhr, status, error) {
        console.error(error);
      },
    });
  });

  // Function to serialize form data from tables
  function getFormDataArray(tableId) {
    var formDataArray = [];
    $(tableId + " tbody tr").each(function () {
      var rowData = {};
      $(this)
        .find("input")
        .each(function () {
          rowData[$(this).attr("name")] = $(this).val();
        });
      formDataArray.push(rowData);
    });
    return formDataArray;
  }

  //   END OF JS
});

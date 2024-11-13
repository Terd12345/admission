<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Account</title>
    <link rel="shortcut icon" href="./assets/images/logoG.png" type="image/x-icon">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style/createAcc.css">
</head>
<body>

<?php if (isset($_GET['success']) && $_GET['success'] == 'true'): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success!</strong> You've successfully created an account.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
<?php endif; ?>

<div class="container">
    <div class="card">
        <div class="card-header bg-success text-white text-center">
            CREATE ACCOUNT
        </div>
        <div class="card-body">
            <form action="createAccRegister.php" method="POST" id="createAccForm">
                <div class="form-group">
                    <label for="username">User Name<span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="username" name="username" required>
                </div>

                <div class="form-group">
                    <label for="last_name">Last Name <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="last_name" name="last_name" required>
                    <small class="error">Please use your legal name as it appears on your birth certificate.</small>
                </div>
                <div class="form-group">
                    <label for="given_name">Given Name <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="given_name" name="given_name" required>
                </div>

                <div class="form-group">
                    <label for="middle_name" class="d-inline">Middle Name</label>
                    <div class="form-check form-check-inline">
            <input type="checkbox" class="form-check-input" id="naCheckbox">
            <label class="form-check-label" for="naCheckbox">N/A</label>
        </div>
                    <input type="text" class="form-control" id="middle_name" name="middle_name">
                    
                </div>
                
                <div class="form-group">
                    <label for="email">Email Address <span class="text-danger">*</span></label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="password">Password <span class="text-danger">*</span></label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
                <div class="form-group">
                    <label for="confirmPassword">Re-type Password <span class="text-danger">*</span></label>
                    <input type="password" class="form-control" id="confirmPassword" name="confirm_password" required>
                    <small id="passwordError" class="text-danger"></small>
                </div>
                <button type="submit" class="btn btn-success btn-block" id="submitBtn" disabled>Submit</button>
            </form>
            <div class="text-center mt-3">
                <a href="index.php" class="btn btn-secondary">ALREADY REGISTERED? SIGN IN</a>
            </div>
        </div>
    </div>
</div>

<script>
    function validatePassword() {
        const password = document.getElementById("password").value;
        const confirmPassword = document.getElementById("confirmPassword").value;
        const submitBtn = document.getElementById("submitBtn");
        const errorMessage = document.getElementById("passwordError");

        if (password !== confirmPassword) {
            errorMessage.textContent = "Passwords do not match.";
            submitBtn.disabled = true;  // Disable the submit button
        } else {
            errorMessage.textContent = "";
            submitBtn.disabled = false;  // Enable the submit button
        }
    }

    // Listen for input events on both password fields
    document.getElementById("password").addEventListener("input", validatePassword);
    document.getElementById("confirmPassword").addEventListener("input", validatePassword);
</script>


<script>
    // JavaScript to handle N/A checkbox toggle
    document.getElementById('naCheckbox').addEventListener('change', function() {
        var middleNameInput = document.getElementById('middle_name');
        if (this.checked) {
            middleNameInput.value = 'Not Applicable'; // Set value to N/A if checkbox is checked
            middleNameInput.readOnly = true; // Make the input readonly
        } else {
            middleNameInput.value = ''; // Clear the input if checkbox is unchecked
            middleNameInput.readOnly = false; // Allow user to edit again
        }
    });
</script>


</body>
</html>

document.getElementById("signupForm").addEventListener("submit", async (e) => {
    e.preventDefault();

    let data = {
        firstname: document.getElementById("fname").value,
        lastname: document.getElementById("lname").value,
        email: document.getElementById("email").value,
        password: document.getElementById("password").value
    };

    const response = await fetch("signup_api.php", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify(data)
    });

    const result = await response.json();

    if (result.state === true) {
        Swal.fire({
            icon: 'success',
            title: 'Success!',
            text: 'Signup successful! Redirecting to login...',
            timer: 2000,
            showConfirmButton: false
        }).then(() => {
            window.location.href = "login.php";
        });
    } else {
        Swal.fire({
            icon: 'error',
            title: 'Signup Failed',
            text: result.error || 'An error occurred during signup. Please try again.'
        });
    }
});

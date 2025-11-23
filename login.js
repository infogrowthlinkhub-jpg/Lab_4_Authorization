document.getElementById("loginForm").addEventListener("submit", async (e) => {
    e.preventDefault();

    let data = {
        email: document.getElementById("email").value,
        password: document.getElementById("password").value
    };

    const response = await fetch("login_api.php", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify(data)
    });

    const result = await response.json();

    if (result.success === true) {
        Swal.fire({
            icon: 'success',
            title: 'Welcome!',
            text: 'Welcome ' + result.username + '!',
            timer: 2000,
            showConfirmButton: false
        }).then(() => {
            window.location.href = "dashboard.php";
        });
    } else {
        Swal.fire({
            icon: 'error',
            title: 'Login Failed',
            text: 'Invalid email or password. Please try again.'
        });
    }
});

async function logout() {
    try {
        const response = await fetch("logout.php");
        const result = await response.json();

        if (result.logout) {
            Swal.fire({
                icon: 'success',
                title: 'Logged Out',
                text: 'You have been successfully logged out.',
                timer: 2000,
                showConfirmButton: false
            }).then(() => {
                window.location.href = "login.php";
            });
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Failed to log out. Please try again.'
            });
        }
    } catch (error) {
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'An error occurred during logout.'
        });
    }
}

// Attach event listener to all logout buttons/links
document.addEventListener('DOMContentLoaded', function() {
    const logoutButtons = document.querySelectorAll('a[href="logout.php"], button.logout-btn, .logout-link');
    logoutButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            logout();
        });
    });
});


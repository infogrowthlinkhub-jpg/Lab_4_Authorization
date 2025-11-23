document.getElementById("courseForm").addEventListener("submit", async (e) => {
    e.preventDefault();

    let data = {
        course_name: document.getElementById("course_name").value,
        course_code: document.getElementById("course_code").value,
    };

    const response = await fetch("create_course_api.php", {
        method: "POST",
        headers: {"Content-Type": "application/json"},
        body: JSON.stringify(data)
    });

    const result = await response.json();

    if (result.success) {
        Swal.fire({
            icon: 'success',
            title: 'Success!',
            text: 'Course created successfully!',
            timer: 2000,
            showConfirmButton: false
        }).then(() => {
            document.getElementById("courseForm").reset();
            window.location.href = "dashboard.php";
        });
    } else {
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: result.error || "Failed to create course. Please try again."
        });
    }
});

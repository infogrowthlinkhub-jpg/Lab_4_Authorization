async function loadCourses() {
    const r = await fetch("list_courses.php");
    const courses = await r.json();

    let div = document.getElementById("courseList");
    
    if (courses.length === 0) {
        div.innerHTML = "<p style='text-align: center; color: #666;'>No courses available at the moment.</p>";
        return;
    }

    div.innerHTML = ""; // Clear previous content
    courses.forEach(c => {
        const courseCard = document.createElement("div");
        courseCard.className = "card";
        courseCard.style.margin = "15px 0";
        courseCard.innerHTML = `
            <h3 style="color: #0A66C2; margin-top: 0;">${c.course_name}</h3>
            <p><strong>Course Code:</strong> ${c.course_code}</p>
            <button onclick="join(${c.id})" style="width: auto; padding: 8px 20px;">Join Course</button>
        `;
        div.appendChild(courseCard);
    });
}

async function join(id) {
    const response = await fetch("join_course.php", {
        method: "POST",
        headers: {"Content-Type": "application/json"},
        body: JSON.stringify({course_id: id})
    });

    const result = await response.json();

    if (result.success) alert("Request sent!");
    else alert("Error: " + result.error);
}

loadCourses();

async function loadRequests() {
    const r = await fetch("list_requests.php");
    const requests = await r.json();

    let div = document.getElementById("requestList");
    
    if (requests.length === 0) {
        div.innerHTML = "<p style='text-align: center; color: #666;'>No pending requests at the moment.</p>";
        return;
    }

    div.innerHTML = ""; // Clear previous content
    requests.forEach(req => {
        const requestCard = document.createElement("div");
        requestCard.className = "card";
        requestCard.style.margin = "15px 0";
        requestCard.innerHTML = `
            <h3 style="color: #0A66C2; margin-top: 0;">${req.first_name} ${req.last_name}</h3>
            <p><strong>Course:</strong> ${req.course_name}</p>
            <div style="margin-top: 15px;">
                <button onclick="handle(${req.request_id}, 'approved')" style="width: auto; padding: 8px 20px; margin-right: 10px; background: #28a745;">Approve</button>
                <button onclick="handle(${req.request_id}, 'rejected')" style="width: auto; padding: 8px 20px; background: #dc3545;">Reject</button>
            </div>
        `;
        div.appendChild(requestCard);
    });
}

async function handle(id, action) {
    const r = await fetch("handle_request.php", {
        method: "POST",
        headers: {"Content-Type":"application/json"},
        body: JSON.stringify({request_id:id, action})
    });

    let result = await r.json();

    if (result.success) {
        alert("Updated!");
        location.reload();
    }
}

loadRequests();

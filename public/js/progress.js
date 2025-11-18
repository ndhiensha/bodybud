/* ============================================
   PROGRESS PAGE JS
   - Update summary cards
   - Fill category progress bars
   - Populate recent activities
   - Render weekly chart (Chart.js)
============================================ */

// Data diambil dari Blade:
// <script>
//     window.progressData = {!! json_encode($data) !!};
// </script>

const data = window.progressData;

// =========================
// SUMMARY CARDS
// =========================
document.getElementById("card-total-workouts").textContent = data.total_workouts;
document.getElementById("card-total-calories").textContent = data.total_calories;
document.getElementById("card-total-minutes").textContent = data.total_minutes;

// =========================
// CATEGORY PROGRESS BARS
// =========================
Object.keys(data.categories).forEach(category => {
    const element = document.querySelector(`.category-item[data-category="${category}"]`);
    if (!element) return;

    const percentage = data.categories[category].percentage;
    const completed = data.categories[category].completed;
    const total = data.categories[category].total;

    element.querySelector(".category-percentage").textContent = percentage + "%";
    element.querySelector(".progress-fill").style.width = percentage + "%";
    element.querySelector(".category-detail").textContent =
        `Completed ${completed} sets from ${total} total`;
});

// =========================
// RECENT ACTIVITIES
// =========================
const activityContainer = document.getElementById("activity-list");

if (data.recent_activities.length === 0) {
    activityContainer.innerHTML = `<p style="color:#777;">No recent activity yet.</p>`;
} else {
    data.recent_activities.forEach(act => {
        const div = document.createElement("div");
        div.classList.add("activity-item");

        div.innerHTML = `
            <div class="activity-icon">🔥</div>
            <div class="activity-info">
                <h4>${act.workout}</h4>
                <div class="activity-meta">
                    ${act.completed_sets} sets • ${act.duration} min • ${act.date}
                </div>
            </div>
        `;
        activityContainer.appendChild(div);
    });
}

// =========================
// WEEKLY CHART
// =========================
const ctx = document.getElementById("weeklyChart");

new Chart(ctx, {
    type: "bar",
    data: {
        labels: data.weekly.labels,
        datasets: [{
            label: "Minutes",
            data: data.weekly.minutes,
            borderWidth: 1
        }]
    },
    options: {
        responsive: true,
        scales: {
            y: { beginAtZero: true }
        }
    }
});

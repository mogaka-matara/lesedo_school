<div class="clock-container w-100 text-center">
    <div class="time" id="time"></div>
    <div class="date" id="date"></div>
    <div class="day-of-week" id="dayOfWeek"></div>
</div>

<style>
    .clock-container {
        background: rgba(0, 0, 0, 0.7);
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.5);
        margin: auto; /* Center align */
        max-width: 520px; /* Ensure it fits in the container */
    }

    .time {
        font-size: 50px; /* Adjusted for smaller container */
        font-weight: bold;
        letter-spacing: 2px;
        color: white;
    }

    .colon {
        animation: blink 1s infinite step-start;
    }

    @keyframes blink {
        0%, 50% { opacity: 1; }
        100% { opacity: 0; }
    }

    .date {
        font-size: 50px; /* Adjusted for smaller container */
        margin-top: 10px;
        color: white;
    }

    .day-of-week {
        font-size: 50px; /* Adjusted for smaller container */
        margin-top: 5px;
        font-weight: bold;
        color: white;
    }
</style>

<script>
    function updateClock() {
        const now = new Date();

        // Format time
        let hours = now.getHours();
        let minutes = now.getMinutes();
        let seconds = now.getSeconds();

        // Add leading zeros
        hours = hours < 10 ? `0${hours}` : hours;
        minutes = minutes < 10 ? `0${minutes}` : minutes;
        seconds = seconds < 10 ? `0${seconds}` : seconds;

        // Update time display (HH:MM:SS) with blinking colon
        const timeString = `${hours}<span class="colon">:</span>${minutes}<span class="colon">:</span>${seconds}`;
        document.getElementById('time').innerHTML = timeString;

        // Format date as "DD-MM-YYYY"
        const day = now.getDate().toString().padStart(2, '0');
        const month = (now.getMonth() + 1).toString().padStart(2, '0'); // Months are zero-based
        const year = now.getFullYear();
        document.getElementById('date').textContent = `${day}-${month}-${year}`;

        // Update day of the week
        const daysOfWeek = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
        document.getElementById('dayOfWeek').textContent = daysOfWeek[now.getDay()];
    }

    // Call updateClock every second
    setInterval(updateClock, 1000);

    // Initialize the clock on page load
    updateClock();
</script>

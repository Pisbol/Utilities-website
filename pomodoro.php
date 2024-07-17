<?php include 'header.php'; ?>

<div class="gen-container">
    <h2>Pomodoro Timer</h2><br><br>
    <div id="pomodoro-timer">
        <div id="time" class="timer">25:00</div>
        <div class="strest">
            <button id="start" class="start">Start</button>
            <button id="reset" class="reset">Reset</button>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>

<script>
    let timer;
    let timeLeft = 1500; // 25 minutes in seconds
    const timerDisplay = document.getElementById('time');
    const startButton = document.getElementById('start');
    const resetButton = document.getElementById('reset');

    function updateTime() {
        const minutes = Math.floor(timeLeft / 60);
        const seconds = timeLeft % 60;
        timerDisplay.textContent = `${minutes < 10 ? '0' : ''}${minutes}:${seconds < 10 ? '0' : ''}${seconds}`;
    }

    function startTimer() {
        if (timer) return; // Prevent multiple intervals
        timer = setInterval(() => {
            if (timeLeft <= 0) {
                clearInterval(timer);
                timer = null;
                alert('Time is up!');
            } else {
                timeLeft--;
                updateTime();
            }
        }, 1000);
    }

    function resetTimer() {
        clearInterval(timer);
        timer = null;
        timeLeft = 1500; // Reset to 25 minutes
        updateTime();
    }

    startButton.addEventListener('click', startTimer);
    resetButton.addEventListener('click', resetTimer);
</script>

const { useState, useEffect } = React;

const DigitalClock = () => {
    // Task 2: useState to store the current time
    const [time, setTime] = useState(new Date());
    const [isRunning, setIsRunning] = useState(true);

    // Task 3: useEffect to update the time every second
    useEffect(() => {
        let timerID;
        if (isRunning) {
            timerID = setInterval(() => {
                setTime(new Date());
            }, 1000);
        }

        // Cleanup function to clear interval on unmount or status change
        return () => clearInterval(timerID);
    }, [isRunning]);

    // Task 4: Display the time in HH:MM:SS format
    const formatTime = (date) => {
        let h = date.getHours().toString().padStart(2, '0');
        let m = date.getMinutes().toString().padStart(2, '0');
        let s = date.getSeconds().toString().padStart(2, '0');
        return `${h}:${m}:${s}`;
    };

    return (
        <div className="clock-container">
            <h2 className="text-uppercase mb-4" style={{fontSize: '1rem', letterSpacing: '3px'}}>Digital Timepiece</h2>
            <div className="time-display">
                {formatTime(time)}
            </div>
            
            {/* Task 5: Option to start/stop the clock */}
            <button 
                className={`btn btn-outline-${isRunning ? 'danger' : 'success'} px-5`}
                onClick={() => setIsRunning(!isRunning)}
            >
                {isRunning ? 'STOP CLOCK' : 'START CLOCK'}
            </button>

            <div className="mt-3 text-secondary small" style={{fontSize: '0.7rem'}}>
                Reactive state update every 1000ms
            </div>
        </div>
    );
};

const root = ReactDOM.createRoot(document.getElementById('root'));
root.render(<DigitalClock />);

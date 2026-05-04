const { useState } = React;

const App = () => {
    // Task 2: useState to store current theme
    const [theme, setTheme] = useState("light");

    // Task 1: Toggle Function
    const toggleTheme = () => {
        setTheme(prev => prev === "light" ? "dark" : "light");
    };

    return (
        // Task 3: Change background and text colors dynamically via classes
        <div className={`app-container ${theme === "light" ? "light-mode" : "dark-mode"}`}>
            <div className="theme-card text-center">
                <h1 className="mb-4">React Theme Switcher</h1>
                
                {/* Task 4: Display the current theme mode */}
                <p className="lead mb-4">Current Mode: <strong>{theme.toUpperCase()}</strong></p>

                <button 
                    className={`btn btn-lg ${theme === "light" ? "btn-dark" : "btn-light"}`}
                    onClick={toggleTheme}
                >
                    Switch to {theme === "light" ? "Dark" : "Light"} Mode
                </button>

                <div className="mt-5">
                    <p className="text-muted">This state is managed via the <code>useState()</code> hook.</p>
                </div>
            </div>
        </div>
    );
};

// Mount to DOM
const root = ReactDOM.createRoot(document.getElementById('root'));
root.render(<App />);

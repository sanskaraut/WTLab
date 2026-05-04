const { useState } = React;

const App = () => {
    // State to manage input amount
    const [usd, setUsd] = useState(1);
    const conversionRate = 83.50; // Current rate for demo

    // Event handler for input change
    const handleUsdChange = (e) => {
        const val = e.target.value;
        setUsd(val);
    };

    return (
        <div className="container">
            <div className="row justify-content-center">
                <div className="col-md-5">
                    <div className="card converter-card p-4 text-center">
                        <h2 className="mb-4">USD to INR Converter</h2>
                        
                        <div className="mb-4 text-start">
                            <label className="form-label text-muted">Amount in US Dollars ($)</label>
                            <div className="input-group input-group-lg">
                                <span className="input-group-text">$</span>
                                <input 
                                    type="number" 
                                    className="form-control" 
                                    value={usd} 
                                    onChange={handleUsdChange}
                                    placeholder="Enter dollars"
                                />
                            </div>
                        </div>

                        {/* Result Display Section */}
                        <div className="p-3 bg-light rounded-3">
                            <div className="text-muted small mb-1">Equivalent in Indian Rupees</div>
                            <div className="conversion-display">
                                ₹ {(usd * conversionRate).toLocaleString('en-IN', { minimumFractionDigits: 2 })}
                            </div>
                            <div className="text-secondary small mt-2">Rate: 1 USD = ₹ {conversionRate}</div>
                        </div>

                        <p className="mt-4 text-muted small">Real-time conversion using React State</p>
                    </div>
                </div>
            </div>
        </div>
    );
};

// Mount the component
const root = ReactDOM.createRoot(document.getElementById('root'));
root.render(<App />);

const { useState } = React;

// Child Component: Result
const Result = ({ mse, ese, subject }) => {
    const total = (mse * 0.3) + (ese * 0.7);
    const status = total >= 40 ? "PASS" : "FAIL";

    return (
        <div className="card p-3 mb-3 border-start border-4 border-info">
            <h5>{subject}</h5>
            <div className="row">
                <div className="col-4">MSE: {mse} (30%)</div>
                <div className="col-4">ESE: {ese} (70%)</div>
                <div className="col-4">Total: <b>{total.toFixed(2)}</b></div>
            </div>
            <div className={status === "PASS" ? "pass mt-2" : "fail mt-2"}>
                Status: {status}
            </div>
        </div>
    );
};

// Child Component: Student
const Student = ({ name, course, marks }) => {
    return (
        <div>
            <div className="mb-4">
                <h4>Student: <span className="text-primary">{name}</span></h4>
                <h6>Course: {course}</h6>
            </div>
            {marks.map((m, index) => (
                <Result key={index} subject={m.subject} mse={m.mse} ese={m.ese} />
            ))}
        </div>
    );
};

// Parent Component: App
const App = () => {
    const [studentName] = useState("Sanskriti");
    const [course] = useState("B.Tech CSE");
    
    // Sample Data (Task 1)
    const [marks] = useState([
        { subject: "Web Technology", mse: 25, ese: 60 },
        { subject: "Data Structures", mse: 28, ese: 75 },
        { subject: "Database Management", mse: 22, ese: 55 },
        { subject: "Operating Systems", mse: 15, ese: 30 }
    ]);

    return (
        <div className="container">
            <div className="row justify-content-center">
                <div className="col-md-8">
                    <div className="card bg-white p-4">
                        <h2 className="text-center mb-4">VIT Semester Result Card</h2>
                        <hr />
                        {/* Passing props to child component */}
                        <Student name={studentName} course={course} marks={marks} />
                    </div>
                </div>
            </div>
        </div>
    );
};

// Rendering to the root
const root = ReactDOM.createRoot(document.getElementById('root'));
root.render(<App />);

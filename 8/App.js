const { useState, useRef } = React;

const App = () => {
    // State for feedback list (Task 5)
    const [feedbackList, setFeedbackList] = useState([
        { id: 1, student: "Rahul", course: "Web Tech", rating: "Excellent", msg: "Very interactive sessions!" }
    ]);

    // Controlled components for form (Task 2)
    const [student, setStudent] = useState("Sanskriti");
    const [course, setCourse] = useState("Database Management");
    const [rating, setRating] = useState("Excellent");

    // useRef for the textarea (Task 3)
    const messageRef = useRef(null);

    const handleSubmit = (e) => {
        e.preventDefault();
        
        // Basic Validation (Task 1)
        const message = messageRef.current.value;
        if (message.length < 5) {
            alert("Please enter a longer message (min 5 chars).");
            return;
        }

        // Create new feedback object
        const newFeedback = {
            id: Date.now(),
            student,
            course,
            rating,
            msg: message
        };

        // Update List (Task 4: Keys)
        setFeedbackList([newFeedback, ...feedbackList]);
        
        // Clear Ref input
        messageRef.current.value = "";
        alert("Feedback submitted!");
    };

    return (
        <div className="container">
            <div className="row">
                {/* Form Section */}
                <div className="col-md-5">
                    <div className="card p-4 shadow">
                        <h3>Course Feedback</h3>
                        <form onSubmit={handleSubmit}>
                            <div className="mb-3">
                                <label>Student Name:</label>
                                <input type="text" className="form-control" value={student} onChange={(e) => setStudent(e.target.value)} required />
                            </div>
                            <div className="mb-3">
                                <label>Course Name:</label>
                                <input type="text" className="form-control" value={course} onChange={(e) => setCourse(e.target.value)} required />
                            </div>
                            <div className="mb-3">
                                <label>Rating:</label>
                                <select className="form-select" value={rating} onChange={(e) => setRating(e.target.value)}>
                                    <option>Excellent</option>
                                    <option>Good</option>
                                    <option>Average</option>
                                </select>
                            </div>
                            <div className="mb-3">
                                <label>Comments:</label>
                                <textarea className="form-control" ref={messageRef} placeholder="Enter your comments..."></textarea>
                            </div>
                            <button className="btn btn-primary w-100">Submit Feedback</button>
                        </form>
                    </div>
                </div>

                {/* Display Section */}
                <div className="col-md-7">
                    <h3>Submitted Feedbacks</h3>
                    <div className="mt-3">
                        {feedbackList.map((item) => (
                            <div key={item.id} className="feedback-item">
                                <div className="d-flex justify-content-between">
                                    <strong>{item.student} - {item.course}</strong>
                                    <span className="badge bg-info">{item.rating}</span>
                                </div>
                                <p className="mt-2 mb-0 text-muted italic">"{item.msg}"</p>
                            </div>
                        ))}
                    </div>
                </div>
            </div>
        </div>
    );
};

const root = ReactDOM.createRoot(document.getElementById('root'));
root.render(<App />);

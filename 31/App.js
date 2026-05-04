const { createStore } = Redux;
const { Provider, useSelector, useDispatch } = ReactRedux;

// 1. Action Types (Task 2)
const ADD_NOTIF = "ADD_NOTIF";
const REMOVE_NOTIF = "REMOVE_NOTIF";

// 2. Reducer (Task 3)
const initialState = { notifications: [] };
const notificationReducer = (state = initialState, action) => {
    switch (action.type) {
        case ADD_NOTIF:
            return { ...state, notifications: [...state.notifications, action.payload] };
        case REMOVE_NOTIF:
            return { ...state, notifications: state.notifications.filter(n => n.id !== action.payload) };
        default:
            return state;
    }
};

// 3. Store Initialization (Task 1)
const store = createStore(notificationReducer);

const App = () => {
    const notifications = useSelector(state => state.notifications);
    const dispatch = useDispatch();

    const addMessage = (type, text) => {
        const id = Date.now();
        dispatch({ 
            type: ADD_NOTIF, 
            payload: { id, type, text } 
        });

        // Auto-remove notification after 5 seconds
        setTimeout(() => dispatch({ type: REMOVE_NOTIF, payload: id }), 5000);
    };

    return (
        <div className="container py-5">
            <h2 className="text-center mb-5">Redux Notification System</h2>
            
            <div className="d-flex justify-content-center gap-3">
                <button className="btn btn-success" onClick={() => addMessage('success', 'Operation Completed!')}>Add Success</button>
                <button className="btn btn-danger" onClick={() => addMessage('danger', 'Error Detected!')}>Add Error</button>
                <button className="btn btn-warning" onClick={() => addMessage('warning', 'Low Battery Warning!')}>Add Warning</button>
            </div>

            <div className="mt-5 text-center text-muted">
                <p>Click buttons to trigger global notifications via Redux store.</p>
                <p>Toasts will automatically disappear after 5 seconds.</p>
            </div>

            {/* Task 4: Display Notifications in UI */}
            <div className="notification-tray">
                {notifications.map(n => (
                    <div key={n.id} className="toast-item" style={{borderLeftColor: getBorder(n.type)}}>
                        <div className="d-flex justify-content-between align-items-center">
                            <strong className={`text-${n.type}`}>{n.type.toUpperCase()}</strong>
                            {/* Task 5: User dismiss option */}
                            <button className="btn-close" onClick={() => dispatch({type: REMOVE_NOTIF, payload: n.id})}></button>
                        </div>
                        <div className="mt-1 small">{n.text}</div>
                    </div>
                ))}
            </div>
        </div>
    );
};

// Helper to determine border color
const getBorder = (type) => {
    if (type === 'success') return '#198754';
    if (type === 'danger') return '#dc3545';
    if (type === 'warning') return '#ffc107';
    return '#0d6efd';
};

const root = ReactDOM.createRoot(document.getElementById('root'));
root.render(
    <Provider store={store}>
        <App />
    </Provider>
);

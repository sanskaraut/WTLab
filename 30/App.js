const { createStore } = Redux;
const { Provider, useSelector, useDispatch } = ReactRedux;

// 1. Initial State & Data (Task 1)
const initialState = {
    products: [
        { id: 1, name: "iPhone 15", category: "Electronics", price: 799 },
        { id: 2, name: "Nike Air Max", category: "Footwear", price: 120 },
        { id: 3, name: "MacBook Pro", category: "Electronics", price: 1299 },
        { id: 4, name: "Adidas Ultraboost", category: "Footwear", price: 180 },
        { id: 5, name: "Coffee Maker", category: "Home", price: 50 },
    ],
    filter: {
        category: "All",
        maxPrice: 2000
    }
};

// 2. Action Types (Task 2)
const SET_CATEGORY = "SET_CATEGORY";
const SET_PRICE = "SET_PRICE";
const RESET = "RESET";

// 3. Reducer (Task 3)
const productReducer = (state = initialState, action) => {
    switch (action.type) {
        case SET_CATEGORY:
            return { ...state, filter: { ...state.filter, category: action.payload } };
        case SET_PRICE:
            return { ...state, filter: { ...state.filter, maxPrice: action.payload } };
        case RESET:
            return { ...state, filter: initialState.filter };
        default:
            return state;
    }
};

// Create the global store
const store = createStore(productReducer);

const App = () => {
    const products = useSelector(state => state.products);
    const filter = useSelector(state => state.filter);
    const dispatch = useDispatch();

    // Task 4: Filter products dynamically based on Redux state
    const filteredProducts = products.filter(p => 
        (filter.category === "All" || p.category === filter.category) &&
        (p.price <= filter.maxPrice)
    );

    return (
        <div className="container">
            <h2 className="mb-4 text-center">Product Catalog (Redux Filter)</h2>
            
            <div className="row mb-5">
                <div className="col-md-4">
                    <label>Category:</label>
                    <select className="form-select" value={filter.category} onChange={(e) => dispatch({type: SET_CATEGORY, payload: e.target.value})}>
                        <option value="All">All Categories</option>
                        <option value="Electronics">Electronics</option>
                        <option value="Footwear">Footwear</option>
                        <option value="Home">Home</option>
                    </select>
                </div>
                <div className="col-md-4">
                    <label>Max Price: ${filter.maxPrice}</label>
                    <input type="range" className="form-range" min="0" max="2000" step="50" 
                        value={filter.maxPrice} 
                        onChange={(e) => dispatch({type: SET_PRICE, payload: e.target.value})} />
                </div>
                <div className="col-md-4 d-flex align-items-end">
                    {/* Task 5: Reset Filters */}
                    <button className="btn btn-secondary w-100" onClick={() => dispatch({type: RESET})}>Reset Filters</button>
                </div>
            </div>

            <div className="row g-4">
                {filteredProducts.map(p => (
                    <div key={p.id} className="col-md-4">
                        <div className="card product-card h-100 p-3 shadow-sm">
                            <span className="badge bg-primary w-25 mb-2">{p.category}</span>
                            <h5>{p.name}</h5>
                            <h4 className="text-success">${p.price}</h4>
                        </div>
                    </div>
                ))}
            </div>
            {filteredProducts.length === 0 && <p className="text-center mt-5">No products match your criteria.</p>}
        </div>
    );
};

const root = ReactDOM.createRoot(document.getElementById('root'));
root.render(
    <Provider store={store}>
        <App />
    </Provider>
);

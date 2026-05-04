# Lab 30: Product Filtering with Redux

## How to Run
1. Run this folder through a local server (like XAMPP or VS Code **Live Server**).
2. Open `http://localhost/WTLab/30/index.html`.

## Requirements
- Browser.
- Internet (React & Redux CDNs).

## Example Input
- **Category:** Select `Electronics`.
- **Max Price:** Move slider to `$500`.

## Expected Output
- Only products matching the category "Electronics" AND priced below $500 will be shown.
- The UI updates instantly as you change the Redux store state via filters.

## Notes
- Uses `useSelector` to read from the global Redux store.
- Uses `useDispatch` to send filter change actions to the reducer.
- Demonstrates central state management for a product catalog.

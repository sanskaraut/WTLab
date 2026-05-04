# Lab 19: Airplane Seat Booking

## How to Run
1. Place the `19/` folder in `htdocs`.
2. Open `http://localhost/WTLab/19/index.php`.

## Requirements
- PHP environment.

## Example Input
- Click on any **Green** seat (e.g., Seat 1).

## Expected Output
- The seat color changes to **Red** and its status becomes "booked".
- A success message appears above the seating chart.
- You cannot click on a red seat again.

## Notes
- Uses a 1D array in `$_SESSION['seats']` to represent the 2D grid.
- Modulo operators (`%`) are used to insert aisles and line breaks in the UI.

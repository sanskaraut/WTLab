# Lab 6: Electricity Bill Calculator

## How to Run
1. Ensure XAMPP/WAMP is running.
2. Place the `6/` folder in `htdocs`.
3. Open `http://localhost/WTLab/6/index.php`.

## Requirements
- PHP environment (XAMPP / WAMP).

## Example Input
- **Units:** `150`

## Expected Output
- **Units:** 150
- **Calculation:** (50 * 3.50) + (100 * 4.00) = 175 + 400 = 575.
- **Total Bill:** ₹ 575.00

## Notes
- Uses `if-else if` ladder to handle different consumption slabs.
- `number_format()` is used to display the currency with two decimal places.

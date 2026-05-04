# Lab 18: Civic Complaint Management

## How to Run
1. Place the `18/` folder in `htdocs`.
2. Open `http://localhost/WTLab/18/index.php`.

## Requirements
- PHP environment.

## Example Input
- **Organization:** `PMC`
- **Category:** `Potholes`
- **Name:** `Sanskriti`
- **Details:** `Large pothole on main road near VIT gate.`

## Expected Output
- A formal registration message.
- A unique tracking number generated using the organization prefix and a unique ID.

## Notes
- This version focuses on the submission interface and dynamic tracking ID generation.
- It uses `uniqid()` for creating non-sequential reference numbers.

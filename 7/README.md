# Lab 7: React Semester Result Card

## How to Run
1. Open the `7/` folder.
2. Open `index.html` in your browser.

## Requirements
- Browser.
- Internet (to load React and Babel CDNs).

## Example Input
- The App is pre-filled with student data:
  - Subjects: Web Tech, Data Structures, DBMS, OS.
  - Calculation: (MSE * 30%) + (ESE * 70%).

## Expected Output
- A responsive list of cards, each showing a subject's marks and Pass/Fail status.
- Pass/Fail is determined dynamically based on a total score threshold of 40.

## Notes
- Uses React Functional Components.
- Demonstrates **Props** (passing data from App -> Student -> Result).
- Uses `toFixed(2)` for clean decimal display.

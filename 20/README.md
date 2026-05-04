# Lab 20: Tic-Tac-Toe Game

## How to Run
1. Place the `20/` folder in `htdocs`.
2. Open `http://localhost/WTLab/20/index.php`.

## Requirements
- PHP environment.

## Example Input
- Click on any empty cell in the 3x3 grid.
- Players **X** and **O** take turns automatically.

## Expected Output
- The cell is marked with X or O.
- The system checks for a win or draw after every move.
- A success message appears when someone wins or if the game is a draw.

## Notes
- Game state (board and turn) is stored in `$_SESSION`.
- `checkWin()` function evaluates all 8 possible winning combinations (rows, columns, diagonals).

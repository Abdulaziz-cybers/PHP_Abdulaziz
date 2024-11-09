# Workday Tracker

This project provides a simple web application for tracking workday information.

## Features

- **Form:** Users can input their name, arrival time, and departure time.
- **Data Storage:** The data is stored in a database table (likely "tracker").
- **Table Display:** A table displays the recorded workday data.
- **Mark as Done:** Users can mark individual workdays as completed.

## Requirements

- PHP (version 7.x or higher)
- MySQL or a compatible database
- Web server (e.g., Apache)

## Installation

1. **Database Setup:**
   - Create a database named "your_database_name".
   - Create a table named "tracker" with the following columns:
     - `id` (INT, PRIMARY KEY, AUTO_INCREMENT)
     - `FISH` (VARCHAR)
     - `arrived` (DATETIME)
     - `leaved` (DATETIME)
     - `required_of` (INT)
     - `done` (TINYINT, DEFAULT 0)  

2. **Configure Database Connection:**
   - Modify the `Conn.php` file with your database credentials.

3. **Run the Application:**
   - Place the files in your web server's document root.
   - Access the application in your web browser (e.g., `http://localhost/workday_tracker/index.php`).

## Usage

1. **Add Workday Data:**
   - Fill out the form with your name, arrival time, and departure time.
   - Click "Submit".
2. **View Workday Data:**
   - The table will display the recorded data.
3. **Mark as Done:**
   - Click the "Done" link for a specific workday to mark it as complete.

## File Structure

- `index.php`: Main entry point for the application.
- `form.php`: Contains the HTML code for the form.
- `Conn.php`:  Handles the database connection.
- `Workday.php`: Contains PHP classes for handling workday data.
- `displayTable.php`:  Handles table display logic.

## Notes

- This project is a simple example.
- Consider adding validation, security features, and error handling for a more robust application.

## Contributing

Contributions are welcome! Please open an issue or submit a pull request.

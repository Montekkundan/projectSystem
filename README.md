# Online Appointment Management System

This project is a simple yet functional online appointment management system designed to facilitate the booking and management of service appointments for users. The system was developed using PHP with sessions for state management, and a MySQL database for persistence. Below are the features and technical implementations of the project.

Made by: Toprak and Montek

Toprak, Student ID: 
Montek, Student ID: 300200716

## Website

The website is hosted at [cis245.great-site.net](http://cis245.great-site.net/) using InfinityFree hosting.

> **Note**: If the website does not render the login page, try a different browser.


## Features

- **User Authentication**: Includes user registration and login functionality.
- **User Roles**: Supports two types of user roles - Admin and Regular User.
- **Appointment Management**: Users can add, view, and delete appointments.
- **Session Management**: Tracks user login state across the application.
- **Security**: Implements password hashing for secure password storage.

## Technical Details

### PHP & MySQL

- **Database Connection**: A `connection.php` file is used to handle the connection to the MySQL database using PDO for secure database interactions.
- **Password Hashing**: During the registration process, passwords are securely hashed using PHP's `password_hash` function before being stored in the database.
- **Session Handling**: PHP sessions are used to maintain user state, allowing for persistent user logins while navigating the system.
- **Prepared Statements**: All database interactions are handled using prepared statements to prevent SQL injection attacks.

### Frontend

- **Login & Registration Styling**: Separate CSS files `login.css` and `style.css` were crafted to style the login/registration and other pages. This includes a centered form with a shadow for a modern look.
- **Responsive Layout**: The application is responsive, with forms and appointment listings adjusting to fit different screen sizes.

### CSS

- **Center Alignment**: Utilized flexbox in the body style to center content horizontally and vertically.
- **Form Styling**: Forms were styled with a minimalist design, including subtle shadows and consistent padding for a clean, user-friendly interface.
- **Text Alignment**: Text across the entire application is centered for a polished layout.
- **Consistent Aesthetics**: The color palette and spacing are uniform throughout the application, providing a cohesive user experience.

## Files Included

- `connection.php`: Manages the database connection.
- `index.php`: The main dashboard for viewing appointments and deleting appointments for admin view.
- `register.php`: Allows new users to create an account with role user or admin.
- `login.php`: Manages the user login process.
- `logout.php`: Handles user logout and session termination.
- `add_appointment.php`: Provides a form for adding new appointments.
- `delete_appointment.php`: Allows users to remove existing appointments.
- `style.css`: General styling applied across the application.
- `login.css`: Specific styling for the login form.
- `register.css`: Specific styling for the registration form.

## Security

The security of the application has been a primary focus:

- User passwords are never stored in plain text; they are hashed using a secure one-way hashing algorithm.
- Database queries are made secure against SQL injection by using prepared statements and parameterized queries.
- Session hijacking is mitigated by regenerating session IDs upon user login.

## Design Considerations

The design of the system is intentionally simple for ease of use and understanding. The interface is clean and intuitive, ensuring that users can navigate and use the system with minimal instruction.

## User page

[user page](/images/user.png)

## Admin page

[Admin page](/images/admin_user.png)

## Login page

[Login page](/images/login.png)

## Register page

[Register page](/images/register.png)

## Appointment page

[Appointment page](/images/appointment.png)
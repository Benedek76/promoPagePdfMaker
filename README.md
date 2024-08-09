# PromoPage PDF Maker

**PromoPage PDF Maker** is a web application designed to allow users to create, edit, and convert promotional documents containing product portfolio images into PDF format. This application requires user authentication before granting access to the main features.

## Features

- **User Authentication:** Secure login system that restricts access to authenticated users only.
- **Document Editing:** Users can edit promotional text directly on the webpage using rich-text editors.
- **PDF Generation:** The application allows users to convert the edited content and accompanying images into a downloadable PDF document.
- **Session Management:** User sessions are securely managed, ensuring a seamless experience between login and logout.

## Project Structure

- **auth.php:** Handles user authentication by verifying credentials against the database and starting a session.
- **home.php:** The main page after login, where users can view and edit promotional content, and generate PDFs.
- **index.php:** The login page where users enter their credentials to access the application.
- **logout.php:** Ends the user's session and redirects them back to the login page.
- **login.sql:** SQL script to set up the database table for storing user credentials.
- **style.css:** Contains the styling for the login page and other elements in the application.

## Installation

1. **Clone the repository:**

   ```bash
   git clone https://github.com/Benedek76/promoPagePdfMaker.git
   ```

2. **Database Setup:**

   - Import `login.sql` into your MySQL database.
   - Ensure your MySQL server is running and accessible.
   - Update the database connection details in `auth.php` if necessary.

3. **Run the Application:**

   - Place the files on your local web server (e.g., XAMPP, MAMP).
   - Open `index.php` in your web browser to start using the application.

## Usage

1. **Login:**
   - Navigate to the login page (`index.php`).
   - Enter your credentials (e.g., username: `JohnDoe`, password: `your_password`).

2. **Edit Content:**
   - Once logged in, edit the promotional text using the rich-text editors provided.

3. **Generate PDF:**
   - Click the "Generate PDF" button to convert the content and images into a PDF document.

4. **Logout:**
   - Click the "Logout" button to end your session.

## Dependencies

- **PHP**: Backend scripting language.
- **MySQL**: Database management system for storing user credentials.
- **jsPDF**: Library for generating PDFs in JavaScript.
- **html2canvas**: Library for rendering HTML elements into canvas.
- **Quill.js**: Rich-text editor for editing content directly in the browser.

## License

This project is licensed under the MIT License.

---

Feel free to modify the content as needed to better fit your specific requirements.

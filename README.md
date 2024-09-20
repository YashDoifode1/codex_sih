Job Portal Installation Guide
Introduction
This Job Portal is designed to offer an easy-to-use platform for managing job listings and applications. Follow the steps below to install and set it up on your local XAMPP server.

Installation Steps
Download and Extract

Clone or download the project files.
Extract the files and rename the folder to job.
Move to XAMPP Directory
Copy the entire job folder and paste it into the htdocs directory of XAMPP:

makefile
Copy code
C:\xampp\htdocs\job
Database Setup

Open XAMPP and start Apache and MySQL.
Go to http://localhost/phpmyadmin/ and create a new database (e.g., job_portal).
Import the provided SQL file into this database.
Configure URL

Open the header.php file located in your project directory.
Find the line where the APP_URL is defined and update it to reflect the correct URL:
php
Copy code
define('APP_URL', 'http://localhost/job/');
Save the changes.
Access the Job Portal
Open your browser and navigate to:

arduino
Copy code
http://localhost/job/
You're Ready!
The job portal is now set up on your local server. You can begin exploring the features and functionality.

By following this guide, you'll have your Job Portal running locally in no time.







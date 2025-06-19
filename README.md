
# ETD Digital Library

The ETD Digital Library is a full-stack web-based application developed to manage, search, and display Electronic Theses and Dissertations (ETDs). The project includes secure user authentication, document management, Elasticsearch-based querying, and semantic enrichment using Wikipedia terms.


## Project Overview

The website is about creating a web-based user interface digital library for the abstracts of electronic theses and dissertations. The UI has a landing page that contains a text box for users to search for ETDs indexed by Elasticsearch. When a user clicks one item in the search result page (SERP), a summary page shows up and displays metadata of the ETD. This was implemented using Elasticsearch, Kibana, HTML5, CSS, JavaScript, Bootstrap, jQuery, and PHP.


## Architecture

The architecture describes the major components used and how they are connected to each other.

### Login

On the login page, users can see that reCAPTCHA is added for security purposes to protect from spam and abuse. The reCAPTCHA used is version 2. The login page also contains registration, sign-in, and forgot password features. When a user is new to the website, they can click on "Register" to create an account. There is also a search box and a search button. When a user enters a query in the search box, it redirects to a search result page where the user can see details of the author, their dissertation, and PDF files. There are also wikifier terms in the abstract; when hovered over, these terms redirect to the relevant Wikipedia page. If the user forgot their password, they can click on the "Forgot Password" button and set a new password.

### Two-Factor Authentication

When a user enters their email address and password, the login page redirects to two-factor authentication, where the user receives a code via email. The user needs to enter the code to access the main web page. For receiving the email, the user must set up 2FA using PHPMailer, with code implemented in `email_config.php`, and dependencies downloaded using Composer. The logic for this is handled in `login_auth.php`.

### Main Web Page

After two-factor authentication, users are taken to the main web page, which contains a navigation bar and a search bar.

### Navigation Bar

The navigation bar consists of:
- Home button
- Logout button
- Dropdown menu containing:
  - View Profile (`view_profile.php`)
  - Update Account (`update_account.php`, functionality in `update_account_btn_action.php`)
  - Reset Password (`change_password.php`)

### Search Box and Search Button

There are two search boxes:
- One on the login page, allowing users to search for theses/dissertations before logging in. On submitting a query, the app redirects to a SERP displaying author, title, year, and document information. Clicking the title takes the user to a detailed document view page. Clicking the document opens it in a new window.
- One on the main webpage (after logging in), with the same functionality.

Search is implemented using various Elasticsearch functions:
- Index: `etd`
- Type: `document`
- Multi-match query with fields `title` and `author`

Implemented in:
- `search_before_signin.php`
- `search_user_logged.php`

Clicking a title redirects to:
- `single_document.php` (before login)
- `single_document_user_logged.php` (after login)


## Database Design

Users must first create the database and table, enter the fields, and connect it to the server. A table named `users` is created with the following fields:

- Email_Id (INT, Primary Key)
- First_name (VARCHAR)
- Last_name (VARCHAR)
- Password (INT)
- Verified_Email (Smallint)
- token_key (VARCHAR)

When the user enters their email and password, the email is stored, and the password is encrypted in the database. A token_key is generated on sign-in and stored in the database. If the token matches the stored token_key, the user can view the JSON objects.

When a new user registers, their email verification field is stored as a temporary value. A verify button is displayed. Upon clicking, the user receives an email. Clicking the verification link changes the Verified_Email field from a temporary value to 1.


## Elasticsearch Design

ETDs are stored in Elasticsearch with the index name `ETD`. Below is the mapping:

- author: text
- advisor: text
- degree: keyword
- etd_file_id: long
- program: keyword
- text: text
- title: text
- university: keyword
- wikifier_terms: text
- year: long


## Implementation Details

### reCAPTCHA

Implemented in `login.php` and `login_btn_action.php`. The user must complete the reCAPTCHA after entering credentials to verify they are not a robot. On successful verification, the system proceeds to 2FA.

### Login and Registration

- Registration is handled in `registration.php`, with logic in `registration_btn_action.php`.
- Login is handled in `login.php`, with logic in `login_btn_action.php`.

### Forgot Password

Handled via `forgot_password.php`.

### Email Verification

Handled via `send_verification_email.php`.


## Document Upload

After logging in, users can upload documents via `add_document.php`. The form includes fields for:
- Title
- Author's name
- Year
- Advisor
- University
- Degree
- Program
- PDF attachment

After submission, the document is indexed in Elasticsearch, and an alert confirms successful indexing.


## Search Functionality

Implemented using Elasticsearch's `multi_match` query with fields `title` and `author`. 10 results are displayed per page. The `isset()` function checks for query validity.

### Pre-login search:
- `login.php`
- Results: `search_before_signin.php`
- Detail view: `single_document.php`

### Post-login search:
- Dashboard search redirects to: `search_user_logged.php`
- Detail view: `single_document_user_logged.php`


## SERP and Highlighting

The Search Engine Results Page (SERP) displays 10 results per page, paginated using JavaScript and AJAX. Search terms are highlighted using the `highlightwords()` function and PHP `ONCLICK` event.


## Wikifier Terms

A Python script, `wikifier.py`, extracts Wikipedia terms from the ETD abstract and stores them along with URLs in Elasticsearch. When hovered or clicked, the terms redirect to their respective Wikipedia articles.


## RESTful API

- A token is generated on login and stored in the database.
- Users can access ETDs by including the token_key in the URL along with search value and range.
- JSON objects are returned in the results.

Implemented in:
- `login_btn_action.php`
- `search.php`


## Additional UI Features

### Favicon

Custom favicon is added to enhance branding.

### Footer

Implemented across all major pages:
- `login.php`, `user_home.php`, `add_document.php`, `view_profile.php`, `update_accounts.php`, `change_password.php`, `search_user_logged.php`, `search_before_signin.php`, `single_document_user_logged.php`, `registration.php`, `forgot_password.php`

### Browser Compatibility

The layout is responsive — it automatically adjusts from grid to vertical layout on smaller screen sizes.


## License

© 2025 Sri Vinay Reddy Surabi. All rights reserved.


# ETD Digital Library

The ETD Digital Library is a full-stack, web-based digital repository designed to index, manage, and search Electronic Theses and Dissertations (ETDs). It combines modern UI/UX design with secure authentication, RESTful APIs, and semantic enrichment using NLP.

---

## Overview

The platform allows users to:
- Register, verify, and securely log in using two-factor authentication
- Perform full-text and field-specific searches on ETD records
- View detailed metadata and abstracts, enriched with Wikipedia-linked terms
- Upload new ETD documents with associated metadata
- Access a RESTful API with token-based authentication
- Interact with a mobile-friendly, responsive interface

---

## System Architecture

The application is divided into several layers:

### Authentication
- Login page features Google reCAPTCHA v2 to protect against spam
- New users must register and verify their email
- Two-factor authentication (2FA) is enforced using PHPMailer
- Once verified, users are granted access to the main dashboard

### Main Interface
- The navigation bar includes links to home, logout, profile management, and document upload
- Users can search ETDs before and after login, view result pages, and access full abstracts
- Abstracts are enhanced with Wikipedia tooltips for keyphrases

---

## Database Design

The primary table, `users`, stores all account information, including:
- Email ID (primary key)
- First and Last Name
- Hashed password
- Verified Email status
- Token Key for API authentication

Passwords are hashed, and token-based access is implemented for RESTful API use. Upon verification, a user’s email status is updated to enable secure access to system features.

---

## Elasticsearch Design

ETDs are indexed in Elasticsearch under the `ETD` index. Document fields include:
- author (text)
- advisor (text)
- degree (keyword)
- etd_file_id (long)
- program (keyword)
- text, title (text)
- university (keyword)
- wikifier_terms (text)
- year (long)

Multi-match queries are used for full-text search across title and author fields, and highlights are returned for matched terms.

---

## Implementation Details

### Database
- Users must initialize the database and connect it to the PHP server
- Includes schema setup for `users` and storage logic

### reCAPTCHA
- Google reCAPTCHA v2 implemented in `login.php` and `login_btn_action.php`
- Users must complete reCAPTCHA before initiating login

### Registration & Login
- `registration.php` and `registration_btn_action.php` manage new user registration
- `login.php` and `login_btn_action.php` handle login and reCAPTCHA validation

### Two-Factor Authentication
- Configured using PHPMailer via `email_config.php`
- Code sent to email and verified through `login_auth.php`

---

## Search Functionality

### Pre-Login Search
- Available on `login.php`
- Results displayed via `search_before_signin.php`
- Individual document view via `single_document.php`

### Post-Login Search
- Available on the user dashboard (`user_home.php`)
- Results displayed via `search_user_logged.php`
- Individual document view via `single_document_user_logged.php`

### Elasticsearch Integration
- Multi-match query on `title` and `author`
- Uses `isset()` to validate input and initiate query
- 10 results displayed per page

---

## Additional Features

### SERP (Search Engine Results Page)
- Paginated (10 results per page) with JavaScript and AJAX
- Highlighting implemented via `highlightwords()` PHP function

### WikiCard Enrichment
- `wikifier.py` extracts Wikipedia keyphrases from ETD abstracts
- Keyphrases are indexed and rendered as tooltips linking to Wikipedia

### RESTful API
- Token key generated and stored upon login
- Users can access the API with token, query, and range via HTTP GET
- JSON results returned

### UI Components
- **Favicon** integrated for browser branding
- **Footer** added to all major pages for design consistency
- **Responsive Design** for mobile compatibility using Bootstrap grid

---

## File Map (Key Files)

- `login.php`, `registration.php`, `forgot_password.php`
- `add_document.php`, `user_home.php`, `navigation.php`
- `search_before_signin.php`, `search_user_logged.php`
- `single_document.php`, `single_document_user_logged.php`
- `view_profile.php`, `update_account.php`, `change_password.php`
- `login_btn_action.php`, `update_account_btn_action.php`, `login_auth.php`, `send_verification_email.php`
- `search.php`, `email_config.php`, `wikifier.py`

---

## License

© 2025 Sri Vinay Reddy Surabi. All rights reserved.  
This project is intended for academic and professional demonstration purposes.





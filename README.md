# 🎓 Course Feedback System

## Overview

The Course Feedback System is a web-based application developed as a university project. It allows students to submit feedback about their courses through a modern and responsive interface. The system validates user input on both the client and server sides and displays a personalized confirmation page after successful submission.

## Features

- 📝 Course feedback submission form
- ⭐ Interactive 5-star course rating system
- ✅ Client-side form validation using JavaScript
- 🔒 Server-side validation using PHP
- 👤 Personalized thank-you page using PHP Sessions
- 📱 Responsive and modern UI design
- ⚠️ Custom inline error messages with alerts
- 🎨 Elegant academic-themed interface

## Technologies Used

### Frontend
- HTML5
- CSS3
- JavaScript

### Backend
- PHP
- PHP Sessions

## Project Structure

```
course-feedback/
│
├── index.html
├── style.css
├── validate.js
├── submit.php
└── README.md
```

## Validation Rules

The system validates the following:

- All required fields must be completed.
- Student ID must contain only numbers.
- Email address must contain a valid "@" symbol.
- A course rating (1–5 stars) must be selected.
- Comments must contain at least 10 characters.

## Form Fields

- Student Name
- Student ID
- Email Address
- Course Name
- Course Rating
- Comments

## Server-side Processing

After successful validation, the system:

- Receives the submitted data using the POST method.
- Stores the student's name in a PHP Session.
- Generates a personalized thank-you message.
- Displays a formatted summary of all submitted feedback.

## Screenshot

<img width="1920" height="891" alt="Screenshot 2026-07-17 171004" src="https://github.com/user-attachments/assets/08be761e-2b10-4f50-aa9f-5d0445b90a0f" />


## Future Improvements
- Store feedback in a MySQL database
- Admin dashboard to manage feedback
- User authentication
- Export feedback reports
- Email confirmation after submission
- Course analytics dashboard

## Author

Developed as a university Web Development project.

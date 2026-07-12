/**
 * validate.js
 * Client-side validation for the Course Feedback Form.
 *
 * Rules enforced:
 *  1. No field may be empty.
 *  2. Student ID must be numeric (digits only).
 *  3. Email must contain "@".
 *  4. Comment must contain at least 10 characters.
 *  5. A rating (1–5) must be selected.
 *
 * On failure  → show an alert AND inline error box, prevent submission.
 * On success  → allow the form to POST to submit.php.
 */

document.addEventListener("DOMContentLoaded", function () {

  const form      = document.getElementById("feedbackForm");
  const errorBox  = document.getElementById("errorBox");
  const errorMsg  = document.getElementById("errorMsg");

  /**
   * Display the error banner inside the page (nicer than a bare alert).
   * Also fires window.alert() as required by the assignment spec.
   */
  function showError(message) {
    errorMsg.textContent = message;
    errorBox.hidden = false;
    errorBox.scrollIntoView({ behavior: "smooth", block: "center" });
    alert(message);          // fulfils the "display an alert message" requirement
  }

  function hideError() {
    errorBox.hidden = true;
    errorMsg.textContent = "";
  }

  form.addEventListener("submit", function (event) {

    // ── Collect values ──────────────────────────────────────────────
    const studentName = document.getElementById("studentName").value.trim();
    const studentId   = document.getElementById("studentId").value.trim();
    const email       = document.getElementById("email").value.trim();
    const courseName  = document.getElementById("courseName").value.trim();
    const comment     = document.getElementById("comment").value.trim();

    // Rating: find the checked radio among star inputs
    const ratingInput = document.querySelector('input[name="rating"]:checked');
    const rating      = ratingInput ? ratingInput.value : "";

    // ── Rule 1: No field may be empty ───────────────────────────────
    if (studentName === "") {
      event.preventDefault();
      showError("Student Name is required. Please fill in all fields.");
      return;
    }

    if (studentId === "") {
      event.preventDefault();
      showError("Student ID is required. Please fill in all fields.");
      return;
    }

    if (email === "") {
      event.preventDefault();
      showError("Email Address is required. Please fill in all fields.");
      return;
    }

    if (courseName === "") {
      event.preventDefault();
      showError("Course Name is required. Please fill in all fields.");
      return;
    }

    if (comment === "") {
      event.preventDefault();
      showError("Comment is required. Please fill in all fields.");
      return;
    }

    // ── Rule 5: A rating must be selected ───────────────────────────
    if (rating === "") {
      event.preventDefault();
      showError("Please select a rating (1 to 5 stars) before submitting.");
      return;
    }

    // ── Rule 2: Student ID must be numeric ──────────────────────────
    if (!/^\d+$/.test(studentId)) {
      event.preventDefault();
      showError("Student ID must contain digits only (e.g. 20231045).");
      return;
    }

    // ── Rule 3: Email must contain "@" ──────────────────────────────
    if (!email.includes("@")) {
      event.preventDefault();
      showError('Email address must contain "@" (e.g. ali@university.edu).');
      return;
    }

    // ── Rule 4: Comment must be at least 10 characters ──────────────
    if (comment.length < 10) {
      event.preventDefault();
      showError("Your comment must be at least 10 characters long.");
      return;
    }

    // ── All rules passed – clear any previous error and submit ───────
    hideError();
    // Form submission continues naturally to submit.php via POST
  });

});
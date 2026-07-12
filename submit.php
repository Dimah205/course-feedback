<?php
/**
 * submit.php
 * Processes the Course Feedback Form submission.
 *
 * Responsibilities:
 *  - Start a PHP session.
 *  - Read POST data sent by index.html.
 *  - Store the student name in a session variable.
 *  - Display a personalized thank-you message using the session variable.
 *  - Display all submitted feedback in a structured, styled format.
 *

 */

session_start();

/* ── 1. Validate that the request came via POST ───────────────── */
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: index.html");
    exit;
}

/* ── 2. Read and sanitise form data ───────────────────────────── */
$studentName = htmlspecialchars(trim($_POST["studentName"] ?? ""), ENT_QUOTES, "UTF-8");
$studentId   = htmlspecialchars(trim($_POST["studentId"]   ?? ""), ENT_QUOTES, "UTF-8");
$email       = htmlspecialchars(trim($_POST["email"]       ?? ""), ENT_QUOTES, "UTF-8");
$courseName  = htmlspecialchars(trim($_POST["courseName"]  ?? ""), ENT_QUOTES, "UTF-8");
$rating      = htmlspecialchars(trim($_POST["rating"]      ?? ""), ENT_QUOTES, "UTF-8");
$comment     = htmlspecialchars(trim($_POST["comment"]     ?? ""), ENT_QUOTES, "UTF-8");

/* ── 3. Basic server-side guard: redirect if name is missing ──── */
if ($studentName === "") {
    header("Location: index.html");
    exit;
}

/* ── 4. Store student name in session variable ────────────────── */
$_SESSION["studentName"] = $studentName;

/* ── 5. Build star display string ─────────────────────────────── */
$ratingInt    = (int) $rating;
$filledStars  = str_repeat("&#9733;", $ratingInt);          // ★
$emptyStars   = str_repeat("&#9734;", 5 - $ratingInt);       // ☆
$starsDisplay = $filledStars . $emptyStars;

/* ── 6. Map numeric rating to a label ────────────────────────── */
$ratingLabels = [
    1 => "Very Poor",
    2 => "Poor",
    3 => "Average",
    4 => "Good",
    5 => "Excellent"
];
$ratingLabel = $ratingLabels[$ratingInt] ?? "N/A";

/* ── 7. Retrieve name from session (demo of session use) ─────── */
$nameFromSession = $_SESSION["studentName"];
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Feedback Received – Course Feedback Portal</title>
  <link rel="stylesheet" href="style.css" />
  <style>
    /* ── Additional styles specific to the confirmation page ── */
    .confirm-header h1 { font-size: clamp(1.7rem, 4vw, 2.5rem); }

    .confirm-badge {
      display: inline-flex;
      align-items: center;
      justify-content: center;
      width: 72px;
      height: 72px;
      border-radius: 50%;
      background: var(--accent-light);
      border: 2px solid #b8d1bf;
      font-size: 2.2rem;
      margin-bottom: 18px;
    }

    .thank-you-msg {
      font-family: 'Playfair Display', serif;
      font-size: clamp(1.3rem, 3vw, 1.75rem);
      color: var(--accent-dark);
      margin-bottom: 6px;
      line-height: 1.3;
    }

    .sub-msg {
      font-size: 0.97rem;
      color: var(--muted);
      margin-bottom: 32px;
    }

    /* ── Feedback summary table ── */
    .summary-table {
      width: 100%;
      border-collapse: collapse;
      font-size: 0.95rem;
    }

    .summary-table caption {
      text-align: left;
      font-size: 0.75rem;
      font-weight: 500;
      letter-spacing: 0.1em;
      text-transform: uppercase;
      color: var(--muted);
      margin-bottom: 12px;
      padding-bottom: 8px;
    }

    .summary-table th,
    .summary-table td {
      padding: 13px 16px;
      text-align: left;
      border-bottom: 1px solid var(--border);
    }

    .summary-table th {
      width: 38%;
      font-size: 0.78rem;
      font-weight: 500;
      letter-spacing: 0.07em;
      text-transform: uppercase;
      color: var(--muted);
      background: var(--bg);
    }

    .summary-table td {
      font-weight: 400;
      color: var(--text);
      word-break: break-word;
    }

    .summary-table tr:last-child th,
    .summary-table tr:last-child td {
      border-bottom: none;
    }

    .stars-cell { color: var(--star-active); font-size: 1.2rem; letter-spacing: 2px; }

    .comment-cell {
      white-space: pre-wrap;
      line-height: 1.6;
      color: #3d3d3d;
    }

    /* ── Return button ── */
    .btn-return {
      display: inline-flex;
      align-items: center;
      gap: 8px;
      margin-top: 28px;
      background: transparent;
      color: var(--accent);
      border: 1.5px solid var(--accent);
      border-radius: 8px;
      padding: 11px 24px;
      font-family: 'DM Sans', sans-serif;
      font-size: 0.95rem;
      font-weight: 500;
      text-decoration: none;
      transition: background var(--transition), color var(--transition), transform var(--transition);
    }

    .btn-return:hover {
      background: var(--accent);
      color: #fff;
      transform: translateY(-2px);
    }
  </style>
</head>
<body>

  <div class="page-wrapper">

    <header class="form-header confirm-header">
      <div class="confirm-badge">✓</div>
      <div class="header-tag">Submission Confirmed</div>

      <!-- Personalised welcome message using session variable -->
      <p class="thank-you-msg">Thank you, <?= $nameFromSession ?>!</p>
      <p class="sub-msg">Your feedback has been received and is greatly appreciated.</p>
    </header>

    <main class="form-card">

      <table class="summary-table">
        <caption>Submitted Feedback Summary</caption>
        <tbody>
          <tr>
            <th scope="row">Student Name</th>
            <td><?= $studentName ?></td>
          </tr>
          <tr>
            <th scope="row">Student ID</th>
            <td><?= $studentId ?></td>
          </tr>
          <tr>
            <th scope="row">Email Address</th>
            <td><?= $email ?></td>
          </tr>
          <tr>
            <th scope="row">Course Name</th>
            <td><?= $courseName ?></td>
          </tr>
          <tr>
            <th scope="row">Rating</th>
            <td>
              <span class="stars-cell"><?= $starsDisplay ?></span>
              &nbsp; <?= $ratingInt ?>/5 &ndash; <?= $ratingLabel ?>
            </td>
          </tr>
          <tr>
            <th scope="row">Comment</th>
            <td class="comment-cell"><?= $comment ?></td>
          </tr>
        </tbody>
      </table>

      <div style="text-align:center;">
        <a href="index.html" class="btn-return">← Submit Another Response</a>
      </div>

    </main>

    <footer class="form-footer">
      © 2026 University Academic Portal &nbsp;·&nbsp; All rights reserved
    </footer>

  </div>

</body>
</html>
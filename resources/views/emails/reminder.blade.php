<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Reminder</title>
</head>
<body>
    <p>Dear {{ $participant->first_name }} {{ $participant->last_name }},</p>
    <p>This is a friendly reminder about the upcoming event. We look forward to seeing you there!</p>
    <p>Best regards,</p>
    <p>Your Event Team</p>
</body>
</html>

!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Suppor Ticket</title>
</head>
<body>
<p>
    <?php echo e($comment->comment); ?>

</p>

---
<p>Replied by: <?php echo e($user->name); ?></p>

<p>Title: <?php echo e($ticket->title); ?></p>
<p>Title: <?php echo e($ticket->ticket_id); ?></p>
<p>Status: <?php echo e($ticket->status); ?></p>

<p>
    You can view the ticket at any time at <?php echo e(url('tickets/'. $ticket->ticket_id)); ?>

</p>

</body>
</html>
<!DOCTYPE html>
<html>
<head>
    <title>Permintaan Persetujuan Acara</title>
</head>
<body>
    <h1>Permintaan Persetujuan Acara Terkirim</h1>
    <p>Halo {{ $eventRequestFeedback->attender->name }},</p>
    <p>Permintaan Anda untuk bergabung dengan acara {{ $eventRequestFeedback->event->title }} telah terkirim.</p>
    <p>Event Organizer {{ $eventRequestFeedback->organizer->name }} akan segera meninjau permintaan Anda. Anda akan menerima pemberitahuan lebih lanjut setelah permintaan Anda disetujui atau ditolak.</p>
    <p>Terima kasih atas partisipasi Anda!</p>
    <p>Best regards,</p>
    <p>Abi Amarulloh,</p>
    <p>CTO EventKu</p>
</body>
</html>

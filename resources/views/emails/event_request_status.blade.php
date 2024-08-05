<!DOCTYPE html>
<html>
<head>
    @if ($eventRequestStatus->status == 'approved')
        <title>Permintaan Anda Disetujui</title>
    @elseif ($eventRequestStatus->status == 'rejected')
        <title>Permintaan Anda Ditolak</title>
    @else
        <title>Permintaan Anda Dibatalkan</title>
    @endif
</head>
<body>
    @if ($eventRequestStatus->status == 'approved')
        <h1>Permintaan Anda Disetujui</h1>
        <p>Halo {{ $eventRequestStatus->attender->name }},</p>
        <p>Permintaan Anda untuk bergabung dengan acara {{ $eventRequestStatus->event->title }} telah disetujui.</p>
        <p>Selamat bergabung dengan acara! Kami berharap Anda menikmati acara tersebut.</p>
        <p>Terima kasih atas partisipasi Anda!</p>
    @elseif ($eventRequestStatus->status == 'rejected')
        <h1>Permintaan Anda Ditolak</h1>
        <p>Halo {{ $eventRequestStatus->attender->name }},</p>
        <p>Permintaan Anda untuk bergabung dengan acara {{ $eventRequestStatus->event->title }} telah ditolak.</p>
        <p>Kami mohon maaf atas ketidaknyamanan ini. Anda dapat menghubungi Event Organizer untuk informasi lebih lanjut.</p>
        
        <p>
            cp: {{ $eventRequestStatus->organizer->name }} - ({{$eventRequestStatus->organizer->email}})
        </p>
        <p>Terima kasih atas pengertian Anda!</p>
    @else 
        <h1>Permintaan Anda Dibatalkan</h1>
        <p>Halo {{ $eventRequestStatus->attender->name }},</p>
        <p>Permintaan Anda untuk bergabung dengan acara {{ $eventRequestStatus->event->title }} telah dibatalkan.</p>
        <p>Kami mohon maaf atas ketidaknyamanan ini. Anda dapat menghubungi Event Organizer untuk informasi lebih lanjut.</p>
        <p>
            cp: {{ $eventRequestStatus->organizer->name }} - ({{$eventRequestStatus->organizer->email}})
        </p>
        <p>Terima kasih atas pengertian Anda!</p>
    @endif
  
    <p>Best regards,</p>
    <p>Abi Amarulloh,</p>
    <p>CTO EventKu</p>
</body>
</html>

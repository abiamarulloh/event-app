<!DOCTYPE html>
<html>
<head>
    <title>Persetujuan Permintaan Acara</title>
</head>
<body>
    <h1>Persetujuan Permintaan Acara</h1>
    <p>Yth. {{ $eventRequest->organizer->name }},</p>
    <p>{{ $eventRequest->attender->name }} - ({{$eventRequest->attender->email}}) telah meminta untuk bergabung dengan acara {{ $eventRequest->event->title }}.</p>
    <p>Silakan tinjau dan setujui atau tolak permintaan tersebut.</p>
</body>
</html>

<!DOCTYPE html>
<html>
<head>
    <title>Daftar Reservasi</title>
</head>
<body>
    <h1>Daftar Reservasi</h1>

    @if(session('success'))
        <div style="color:green">{{ session('success') }}</div>
    @endif

    <table border="1" cellpadding="8">
        <tr>
            <th>ID</th>
            <th>User ID</th>
            <th>Alasan</th>
            <th>Tanggal</th>
            <th>Mulai</th>
            <th>Selesai</th>
            <th>Lantai</th>
            <th>Status</th>
        </tr>
        @foreach($reservations as $r)
        <tr>
            <td>{{ $r->id }}</td>
            <td>{{ $r->user_id }}</td>
            <td>{{ $r->reason_for_reservation }}</td>
            <td>{{ $r->reservation_date }}</td>
            <td>{{ $r->time_start }}</td>
            <td>{{ $r->time_finish }}</td>
            <td>{{ $r->floor }}</td>
            <td>{{ $r->status }}</td>
        </tr>
        @endforeach
    </table>
</body>
</html>

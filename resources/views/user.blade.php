<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data User</title>
</head>
<body>

<h1>Data User</h1>
<a href="{{ route('/user/tambah') }}">+Tambah User</a>

<table border="1" cellpadding="2" cellspacing="0">
    <tr>
        <td>ID</td>
        <td>Username</td>
        <td>Nama</td>
        <td>ID Level Pengguna</td>
        <td>Kode Level</td>
        <td>Nama Level</td>
        <td>Aksi</td>
    </tr>
    
    @foreach ($data as $user)
    <tr>
        <td>{{ $user->user_id }}</td>
        <td>{{ $user->username }}</td>
        <td>{{ $user->nama }}</td>
        <td>{{ $user->level_id }}</td>
        <td>{{ $user ->level ->level_kode }}</td>
        <td>{{ $user->level->level_nama }}</td>
        <td>
            <a href="{{ route('/user/ubah', $user->user_id) }}">Ubah</a> | 
            <a href="{{ route('/user/hapus', $user->user_id) }}">Hapus</a>
        </td>
    </tr>
    @endforeach
</table>


</body>
</html>
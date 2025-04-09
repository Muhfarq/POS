<body>
    <h1>Form Ubah Data User</h1>
    <a href="{{ route('/user') }}">Kembali</a>
    <br>
    <form method="post" action="{{ route('/user/ubah_simpan', $data->user_id) }}">
        @csrf
        @method('PUT')

        <label>Username</label>
        <input type="text" name="username" value="{{ $data->username }}" required>
        <br>

        <label>Nama</label>
        <input type="text" name="nama" value="{{ $data->nama }}" required>
        <br>

        <label>Level ID</label>
        <input type="number" name="level_id" value="{{ $data->level_id }}" required>
        <br>

        <input type="submit" value="Ubah">
    </form>
</body>
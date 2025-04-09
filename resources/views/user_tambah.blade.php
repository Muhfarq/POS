<body>
    <h1>Form Tambah Data User</h1>
    <a href="{{ route('/user') }}">Kembali</a>
    
    <form method="POST" action="{{ route('/user/tambah_simpan') }}">
        @csrf
        
        <label>Username</label>
        <br>
        <input type="text" name="username" placeholder="Masukkan Username" required>
        <br>

        <label>Nama</label>
        <br>
        <input type="text" name="nama" placeholder="Masukkan Nama" required>
        <br>

        <label>Password</label>
        <br>
        <input type="password" name="password" placeholder="Masukkan Password" required>
        <br>

        <label>Level ID</label>
        <br>
        <input type="number" name="level_id" min="1" placeholder="Masukkan ID Level" required>
        <br>

        <input type="submit" class="btn btn-success" value="Simpan">
    </form>
</body>
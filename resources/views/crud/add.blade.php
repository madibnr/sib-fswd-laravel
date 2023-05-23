<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <title>Tambah Pengguna</title>
</head>
<body>
    <div class="container">
        <header class="d-flex justify-content-between my-4">
            <h1>Tambah Pengguna</h1>
            <div>
                <a href="{{ url('/crud')}}" class="btn btn-primary">Kembali</a>
            </div>
        </header>
        <form class="row g-3" method="post" enctype="multipart/form-data">
            <div class="col-12">
                <label for="name" class="form-label">Nama</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Nama Lengkap">
            </div>
            <div class="col-md-6">
                <label for="role" class="form-label">Role</label>
                <select name="role" class="form-control">
                    <option value="">Pilih Role Pengguna</option>
                    <option value="admin">Admin</option>
                    <option value="staff">Staff</option>
                </select>
            </div>
            <div class="col-md-6">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password">
            </div>
            <div class="col-md-6">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="name@examples.com">
            </div>
            <div class="col-md-6">
                <label for="phone" class="form-label">Telp</label>
                <input type="number" class="form-control" id="phone" name="phone" placeholder="08xxxx">
            </div>
            <div class="col-12">
                <label for="address" class="form-label">Alamat</label>
                <input type="text" class="form-control" id="address" name="address" placeholder="Masukkan Alamat Lengkap">
            </div>
            <div class="mb-3">
                <label for="avatar" class="form-label">Unggah Foto</label>
                <input class="form-control" type="file" id="avatar" name="avatar">
            </div>
            <div class="col-12">
                <button type="submit" id="tambah" name="tambah" class="btn btn-primary">Tambah</button>
            </div>
        </form>
    </div>
</body>
</html>
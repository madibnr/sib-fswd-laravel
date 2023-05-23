<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <title>Data Pengguna</title>
</head>
<body> 
    
    <div class="container" style="margin-top: 50px;">
        <div class="row">
            <div class="card">
                <h4>Data Pengguna
                    <a href="" class="btn btn-danger float-end">log out</a>
                    <a href="{{ url('/crud.add')}}" class="btn btn-primary float-end">Tambah Pengguna</a>
                </h4>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <form method="post" style="display: none;">
                        <button type="hidden" name="reset" class="btn btn-secondary btn-sm">Reset ID</button>
                    </form>
                </div>
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Aksi</th>
                            <th>Avatar</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Role</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <a href="{{ url('/crud')}}" class="btn btn-primary btn-sm">Detail</a>
                                <a href="{{ url('/crud.edit')}}" class="btn btn-warning btn-sm">Edit</a>
                                <form style="display: inline;">
                                    <button type="submit" name="delete" class="btn btn-danger btn-sm">Hapus</button>
                                </form>
                            </td>
                            <td><img src="" alt="Avatar" width="40"></td>
                            <td>Adib</td>
                            <td>madib366@gmail.com</td>
                            <td>08951237612</td>
                            <td>admin</td>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</body>
</html>
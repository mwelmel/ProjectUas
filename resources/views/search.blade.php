<!DOCTYPE html>
<html>
<head>
    <title>Search Result</title>
</head>
<body>
 
    <style type="text/css">
        .pagination li{
            float: left;
            list-style-type: none;
            margin:5px;
        }
    </style>
 
    <h3>Data Forum</h3>
 
 
    <p>Cari Forum:</p>
    <form action="/forum/cari" method="GET">
        <input type="text" name="cari" placeholder="Search" value="{{ old('cari') }}">
        <input type="submit" value="CARI">
    </form>
         
    <br/>
 
    <table border="1">
        <tr>
            <th>Judul Forum</th>
            <th>Isi</th>
            <th>Tanggal</th>
        </tr>
        @foreach($forum as $f)
        <tr>
            <td>{{ $f->forum_judul }}</td>
            <td>{{ $f->forum_isi}}</td>
            <td>{{ $f->forum_tanggal }}</td>
        </tr>
        @endforeach
    </table>
 
    <br/>
    Halaman : {{ $forum->currentPage() }} <br/>
    Jumlah Data : {{ $forum->total() }} <br/>
    Data Per Halaman : {{ $forum->perPage() }} <br/>
 
 
    {{ $forum->links() }}
 
 
</body>
</html>
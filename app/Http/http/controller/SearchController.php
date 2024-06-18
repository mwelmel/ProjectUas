<?php
 
namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
 
 
class SearchController extends Controller
{
public function cari(Request $request)
{
// menangkap data pencarian
$cari = $request->cari;
 
// mengambil data dari table forum sesuai pencarian data
$forum = DB::table('forum')
->where('judul_forum','like',"%".$cari."%")
->paginate();
 
// mengirim data forum ke view index
return view('index',['forum' => $forum]);
 
}
 
}
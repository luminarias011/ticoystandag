<?php

namespace App\Http\Controllers\dashboard;

use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class Homepage extends Controller
{
  public function index()
  {
    // $valuee = 99;
    $posts = DB::table('posts')
      ->orderByDesc('pst_date')
      ->get();

    return view('content.dashboard.homepage', compact('posts'));
  }

  public function addPost(Request $request)
  {
    $post_title = $request->post_title;
    $post_description = $request->post_description;
    $date = $request->date;
    $post_file = $request->file('post_file');


    if ($post_file == "") {
      // ! flash error
      // $uuid = '11111aaaaa5555511111qqqqq9999900';
      // $bookIMG = $uuid . '.png';
    } else {
      $uuid = generateuuid();
      $postFILE = $uuid . '.' . $post_file->getClientOriginalExtension();
      // Store image file on server 
      Storage::disk('public-storage')->put('/contents/' . $postFILE, fopen($request->file('post_file'), 'r+'));
    }

    DB::table('posts')
      ->insert([
        'pst_title' => $post_title,
        'pst_description' => $post_description,
        'pst_file' => $postFILE,
        'pst_date' => $date,
        'pst_date_created' => DB::RAW('CURRENT_TIMESTAMP'),
      ]);
    // dd($postFILE);
  }

}

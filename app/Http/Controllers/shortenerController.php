<?php

namespace App\Http\Controllers;

use App\Models\shortener;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class shortenerController extends Controller
{
    public function index(Request $request)
    {
        $data = shortener::where('user_id', Auth::id())->latest()->get();
        return view("home", compact('data'));
    }

    public function store(Request $request)
    {
        $this->validate(
            $request,
            [
                'url' => "required|url",
                "prefix" => "unique:shorteners"
            ]
        );

        $prefix = $request->prefix;
        $prefix = explode(" ", $prefix);
        $prefix = join("-", $prefix);

        shortener::create([
            "url" => $request->url,
            "prefix" => $prefix,
            "user_id" => Auth::id(),
        ]);

        return redirect()->to('/home')->with(
            [
                "url" => request()->getHost() . "/" .  $prefix,
            ]
        );
    }

    public function goto(Request $request, $prefix)
    {

        $data =  shortener::where('prefix', $prefix)->first();
        return  redirect()->away($data->url);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Restaurant;

class RestaurantController extends Controller
{
    public function index(Request $request)
    {
        $name = $request->name;
        $category = $request->category;

            $query = Restaurant::query();
        if($name) {
        $query->where('name', 'like', '%' . $name . '%');
        }
        if($category) {
        // $query->where('category', 'like', '%' . $category . '%');
        // }
        $query->whereHas('category', function($q) use ($category){
            $q->where('name', 'like', '%' . $category . '%');
        });
        }
        $restaurants = $query->simplePaginate(5);
        $restaurants->appends(compact('name', 'category'));
        // appendsは配列の最後尾に追加するときに使う
        return view('restaurants.index', compact('restaurants'));

        // 検索方法(拡張性がないやり方)
        // if(!empty($name)) {
        //     $restaurants = Restaurant::where('name', 'like', '%' . $name . '%');
        //     // 上記､あいまい検索のときにつかう｡$nameが含まれていればいいという意味｡前後を気にしない｡
        // } else {
        //     $restaurants = Restaurant::all();
        // }
        // $restaurants = Restaurant::all()->sortByDesc('recommend');
        // $restaurants = Restaurant::simplepaginate(10);
        // simple入れると数字ペイジネーションが消える
        // return view('restaurants.index', compact('restaurants'));
    }

    public function show($id)
    {
        $restaurant = Restaurant::find($id);
        return view('restaurants.show', compact('restaurant'));
    }
}

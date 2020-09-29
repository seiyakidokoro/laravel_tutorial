<?php

namespace App\Http\Controllers;

use App\Product;
use function GuzzleHttp\Psr7\parse_header;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
	// 一覧
	public function index()
	{
		$products = Product::all();

		return view('products.index', [
			'products' => $products
		]);
	}

	// 新規作成画面
	public function new() {

		return view('products.new');
	}

	// 商品作成
	public function store(Request $request) {

		// バリデーション
		$request->validate([
			'name' => 'required|max:10',
			'description' => 'required|min:5|max:140',
			'point' => 'required',
			'image' => 'required',
		]);

		// php artisan storage:link を実行してpublic/storageを用意する必要あり
		// 保存
		$path = $request->file('image')->store('public/img');
		$path2 = $request->file('image2')->store('public/img');
		$path3 = $request->file('image3')->store('public/img');
		Product::insert([
			"name" => $request->input('name'),
			"description" => $request->input('description'),
			"point" => $request->input('point'),
			"image" => basename($path),
			"image2" => basename($path2),
			"image3" => basename($path3)
		]);

		// 一覧を表示
		return redirect('/manager/products');
	}

	// 編集画面
	public function edit(Product $product) {

		return view('products.edit', [
			'product' => $product
		]);
	}

	// 更新
	public function update(Request $request) {

		// バリデーション
		$request->validate([
			'name' => 'required|max:10',
			'description' => 'required|min:5|max:140',
			'point' => 'required',
		]);

		// 保存
		$product = Product::find($request->input('id'));
		$product->name = $request->input('name');
		$product->description = $request->input('description');
		$product->point = $request->input('point');

		$new_image = $request->file('image');
		if(isset($new_image)) {
			$path = $new_image->store('public/img');
			$product->image = basename($path);
		}
		$new_image2 = $request->file('image2');
		if(isset($new_image2)) {
			$path2 = $new_image2->store('public/img');
			$product->image2 = basename($path2);
		}
		$new_image3 = $request->file('image3');
		if(isset($new_image3)) {
			$path3 = $new_image3->store('public/img');
			$product->image3 = basename($path3);
		}

		$product->save();

		// 一覧を表示
		return redirect('/manager/products');
	}

	// 削除
	public function delete(Product $product) {

		$product->delete();

		// 一覧を表示
		return redirect('/manager/products');
	}

}

<?php

namespace App\Http\Controllers;

use App\Task;
use App\Content;
use App\ContentDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class ApiController extends Controller
{
    public function index(Request $request)
    {
        $task = Task::find($request->params['id']);
        return $task;
    }

    public function content()
    {
        $content = Content::where('deleted', '=',0)->get()->keyBy('id');
        return $content;
    }

    public function content_details(Request $request)
    {
        $content_details = ContentDetail::where('content_id', '=', $request->content_id)->get();
        return $content_details;
    }


    public function all()
    {
        $tasks = Task::all();
        return $tasks;
    }

    public function get()
    {
        $base_url = 'http://127.0.0.1:8080/api';
        $json = file_get_contents($base_url, 'JSON_PRETTY_PARTY');
        echo '<pre>';
        print_r($json);
        exit;
    }

    public function add_contents(Request $request)
    {
        $title = $request->title;

        $content = new Content();
        $result = $content->create([
            'title' => $title,
            'status' => 1,
            'order' => 0,
            'deleted' => 0,
        ]);

        return $result;
    }

    public function add_content_details(Request $request)
    {
        $content_id = $request->content_id;
        $name = $request->name;

        $content_detail = new ContentDetail();

        $content_detail->fill(['content_id' => $content_id]);
        $content_detail->fill(['name'       => $name]);
        $content_detail->fill(['body'       => '']);
        $content_detail->fill(['status'     => 1]);
        $content_detail->fill(['order'      => 0]);
        $content_detail->fill(['deleted'    => 0]);

        $content_detail->save();
        return $content_detail;
    }
    public function save_content_detail(Request $request)
    {
        $content_detail = ContentDetail::find($request->content_detail_id);
        $content_detail->fill(['body' => $request->body]);
        $content_detail->save();

        return $content_detail;
    }

    /**
     * コンテンツ削除
     * @param Request $request
     */
    public function delete_content(Request $request)
    {
        $id = $request->id;

        $content = Content::find($id);
        $content->fill(['deleted' => 1]);
        $content->save();

        return $content;
    }

}

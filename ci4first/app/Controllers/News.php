<?php

namespace App\Controllers;

use App\Models\NewsModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class News extends BaseController
{
    public function index()
    {
        $model = model(NewsModel::class);
        $data = [
            'news' => $model->getNews(),
            'title' => 'News archive'
        ];

        return view('templates/header', $data)
             . view('news/index')
             . view('templates/footer');
    }

    public function show($slug)
    {
        $model = model(NewsModel::class);
        $data['news'] = $model->getNews($slug);

        if (empty($data['news'])) {
            throw new PageNotFoundException('Cannot find the news item: ' . $slug);
        }

        $data['title'] = $data['news']['title'];

        return view('templates/header', $data)
             . view('news/view')
             . view('templates/footer');
    }
}
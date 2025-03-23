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

    public function show_edit_form($slug = null)
    {
        helper('form');

        $data = [];

        if ($slug === null) {
            $data['title'] = 'Create a news item';
        } else {
            $data['title'] = 'Edit a news item';

            $model = model(NewsModel::class);
            $data['news'] = $model->getNews($slug);
        }

        return view('templates/header', $data)
             . view('news/edit')
             . view('templates/footer');
    }

    public function edit()
    {
        helper('form');

        if ( ! $this->validate([
            'title' => 'required|max_length[255]|min_length[3]',
            'body' => 'required|max_length[5000]|min_length[10]'
        ])) {
            return $this->show_edit_form();
        }

        // $post = $this->validator->getValidated();
        $post = $this->request->getVar();

        $model = model(NewsModel::class);

        $saveDate = [
            'title' => $post['title'],
            'slug' => url_title($post['title'], '-', true),
            'body' => $post['body']
        ];

        if (isset($post['id']) && ! empty($post['id'])) {
            $saveDate['id'] = $post['id'];
        }

        $model->save($saveDate);

        $data = [
            'title' => 'Success',
            'message' => 'News item saved successfully'
        ];

        return view('templates/header', $data)
             . view('news/success')
             . view('templates/footer');
    }

    public function delete()
    {
        $post = $this->request->getVar();

        $model = model(NewsModel::class);
        $model->delete($post['id']);

        $data = [
            'title' => 'Success',
            'message' => 'News item deleted successfully'
        ];

        return view('templates/header', $data)
             . view('news/success')
             . view('templates/footer');
    }
}
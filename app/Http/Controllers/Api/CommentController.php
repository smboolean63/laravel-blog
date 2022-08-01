<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Mail\CommentMail;
use App\Mail\CommentMailMarkdown;
use Illuminate\Support\Facades\Mail;

use App\Comment;

class CommentController extends Controller
{
    public function store(Request $request, $post_id)
    {
        // prendere i dati dalla request
        // validazione 422
        $request->validate([
            'name' => 'nullable|string|max:80',
            'content' => 'required|string',
        ]);

        $data = $request->all();
        $data['post_id'] = $post_id;

        // creare il commento a DB usando il Model 
        $newComment = new Comment();
        $newComment->post_id = $data['post_id'];
        $newComment->name = $data['name'];
        $newComment->content = $data['content'];
        $newComment->save();

        // invio una notifica mail all'autore del post
        try {
            // Mail::to($newComment->post->user->email)->send(new CommentMail($newComment));
            Mail::to($newComment->post->user->email)->send(new CommentMailMarkdown($newComment));
        } catch (\Throwable $th) {
            //throw $th;
        }

        // restituisco una risposta json positiva 200
        return $newComment;
    }
}

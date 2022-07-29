@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h1>Lista commenti da approvare</h1>
        </div>
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                  <tr>
                    <th scope="col">Titolo Post</th>
                    <th scope="col">Autore</th>
                    <th scope="col">Contenuto</th>
                    <th scope="col">Azioni</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($comments as $comment)
                    <tr>
                        <td>{{$comment->post->title}}</td>
                        <td>{{$comment->name}}</td>
                        <td>{{$comment->content}}</td>
                        <td>
                            <form action="{{route('admin.comments.update', $comment->id)}}" method="POST">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="btn btn-success">Approva</button>
                            </form>

                            <form action="{{route('admin.comments.destroy', $comment->id)}}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Elimina</button>
                            </form>
                        </td>                    
                    </tr>
                    @endforeach
                </tbody>
              </table>
        </div>
    </div>
</div>
@endsection
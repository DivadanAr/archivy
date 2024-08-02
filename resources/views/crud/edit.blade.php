@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form action="/update/{{$archive->id}}" method="POST">
                        @method('PUT')
                        @csrf
                        <div class="mb-3">
                          <label for="subject" class="form-label">Subject</label>
                          <input name="subject" value="{{$archive->subject}}" type="subject" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                        </div>
                        <div class="mb-3">
                            <label for="content" class="form-label">Content</label>
                            <textarea id="summernote" name="content">{{$archive->content}}</textarea>
                        </div>
                        {{-- <div class="form-group">
                            <label for="file">Choose File</label>
                            <div class="group d-flex gap-1">
                                <input type="file" id="attachment" value="{{$archive->attachment}}" name="attachment" class="form-control">
                                <button type="button" id="cancelFile" class="btn btn-danger cancel-btn">X</button>
                            </div>
                        </div> --}}
                        <button type="submit" class="btn btn-primary">Submit</button>
                      </form>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
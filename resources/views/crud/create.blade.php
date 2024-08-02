@extends('layouts.app')

@section('content')

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Create</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form action="/store" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="subject" class="form-label">Subject</label>
                            <input name="subject" type="text" class="form-control" id="subject" aria-describedby="subjectHelp" required>
                        </div>
                        <div class="mb-3">
                            <label for="content" class="form-label">Content</label>
                            <textarea id="summernote" name="content" required></textarea>
                        </div>
                        
                        <div class="mb-3">
                            <label for="receiver" class="form-label">Send to</label>
                            <select class="form-select" name="receiver" id="receiver-select">
                                <option selected>-</option>
                                @foreach ($user as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="file">Choose File</label>
                            <div class="group d-flex gap-1">
                                <input type="file" id="attachment" name="attachment" class="form-control">
                                <button type="button" id="cancelFile" class="btn btn-danger cancel-btn">X</button>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                    
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById('cancelFile').addEventListener('click', function() {
        document.getElementById('attachment').value = ''; // Clear the file input
    });
</script>

@endsection

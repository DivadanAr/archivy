@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <p class="m-0">Archivy</p>
                    @if ($archive->is_seen == false)
                    <div class="button"><a href="/edit/{{$archive->id}}"><button class="btn btn-success"><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24"><path fill="currentColor" d="M3 21v-4.25L16.2 3.575q.3-.275.663-.425t.762-.15t.775.15t.65.45L20.425 5q.3.275.438.65T21 6.4q0 .4-.137.763t-.438.662L7.25 21zM17.6 7.8L19 6.4L17.6 5l-1.4 1.4z"/></svg></button></a></div>
                    @else
                        <div>

                        </div>
                    @endif

                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                        <div class="container w-100">
                            <div class="sender w-100 d-flex justify-content-end">
                                <p class="m-0">Sender : {{$archive->sender->name}}</p>
                            </div>

                            <div class="subject mt-5 mb-3">
                                <h5 style="font-weight: 600;">Subject : {{$archive->subject}}</h5>
                            </div>
                            <div class="content mt-5" style="text-align: justify">
                                {!! $archive->content !!}
                            </div>
                            <div class="mt-3 mb-2">
                                <label for="attachment" class="form-label">Attachment : </label>
                                <a href="{{ asset($archive->attachment) }}" target="_blank" class="btn">{{basename($archive->attachment)}}</a>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
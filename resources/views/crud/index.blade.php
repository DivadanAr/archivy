@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <div class="tabs">
                        <button class="tab-button btn" onclick="showSection('tome')">To Me</button>
                        <button class="tab-button btn" onclick="showSection('sent')">Sent</button>
                    </div>

 <div class="d-flex gap-2">
    <div>
        <a href="/create"><button class="btn btn-secondary py-1">+</button></a>
    </div>
    <form action="/archives/bulk-delete" method="POST">
        @csrf
        @method('DELETE') 
    <div>
        <a href=""><button class="btn btn-danger py-1"><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24"><path fill="currentColor" d="M6 19a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V7H6zM8 9h8v10H8zm7.5-5l-1-1h-5l-1 1H5v2h14V4z"/></svg></button></a>
    </div>
 </div>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif


                    <table class="table table-stripped tab-content active" id="tome">
                        <thead>
                            <tr>
                                <th></th>
                                <th >Sent by</th>
                                <th>Subject</th>
                                <th>Sent At</th>
                            </tr>
                        </thead>
                        <tbody>
                          @foreach ($tome as $item)
                          <tr>
                            <td><input type="checkbox" name="ids[]" value="{{$item->id}}"></td>
                            <td>{{$item->sender->name}}</td>
                            <td><a href="/detail/{{$item->id}}" style="text-decoration: none; color:rgb(25, 23, 45);">{{$item->subject}}</a></td>
                            <td>{{$item->created_at}}</td>
                          </tr>
                          @endforeach
                        </tbody>
                      </table>

                      <table class="table table-stripped tab-content" id="sent">
                        <thead>
                            <tr>
                                <th></th>
                                <th >Sent to</th>
                                <th>Subject</th>
                                <th>Sent At</th>
                            </tr>
                        </thead>
                        <tbody>
                          @foreach ($sent as $item)
                          <tr>
                            <td><input type="checkbox" name="ids[]" value="{{$item->id}}"></td>
                            <td>{{$item->sender->name}}</td>
                            <td><a href="/detail/{{$item->id}}" style="text-decoration: none; color:rgb(25, 23, 45);">{{$item->subject}}</a></td>
                            <td>{{$item->created_at}}</td>
                          </tr>
                          @endforeach
                        </tbody>
                      </table>
                    </form>     
                </div>
            </div>
        </div>
    </div>
</div>
      

<script>

        var checkboxes = document.getElementsByName('ids[]');
        for (var checkbox of checkboxes) {
            checkbox.checked = this.checked;
        }
    
</script>

<script>
    function showSection(sectionId) {
    // Hide all sections
    const sections = document.querySelectorAll('.tab-content');
    sections.forEach(section => {
        section.classList.remove('active');
    });

    // Deactivate all buttons
    const buttons = document.querySelectorAll('.tab-button');
    buttons.forEach(button => {
        button.classList.remove('active');
    });

    // Show the selected section
    document.getElementById(sectionId).classList.add('active');

    // Activate the corresponding button
    const activeButton = Array.from(buttons).find(button => button.getAttribute('onclick').includes(sectionId));
    if (activeButton) {
        activeButton.classList.add('active');
    }
}

// Initial setup to show the "Sent" section by default
document.addEventListener('DOMContentLoaded', () => {
    showSection('tome');
});
</script>
@endsection


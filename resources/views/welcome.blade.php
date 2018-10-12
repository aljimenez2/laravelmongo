@include('head')
<div class="container">
    <div class="row">
        <div class="col-10 offset-1 col-sm-10 col-md-10 offset-md-1 my-4">
            <div class="row my-4">
                <div class="col-12 col-sm-12 col-md-6  offset-md-3 text-left">
                    <h2>User Availables</h2>
                    <div class="col-md-12">
                        <div class="counter float-left" data-count="{{ $counter }}">0</div>
                        <button class="float-right btn btn-success my-1" id="newUser" data-toggle="1"> Add new user
                        </button>
                    </div>
                </div>
            </div>
            <div class="col-md-4 offset-md-4 text-center my-4" id="newUserdiv">
                @include('partials/newUser')
            </div>
            <div class="board" id="boardOfUsers">
                <div class="board-column todo">
                    <div class="board-column-header bg-light-blue">List of users</div>
                    <div class="board-column-content">
                        @foreach($users as $user)
                            <div class="board-item" id="{{$user->id}}" name="1">
                                <div class="board-item-content">
                                    <div class="card-img-top">
                                        <span class="helper"></span>
                                        <img src="{{ asset('img/'.$user->photo) }}" alt="Card image cap">
                                    </div>
                                    <h3 class="card-text text-center" style="font-size: 0.85em; overflow-x: hidden">{{ $user->description }}</h3>
                                    <p class="text-center">
                                        <a href="#" class="edit" data-selector="{{$user->id}}"><i class="fa fa-edit fa-1x my-3"></i> Edit</a>
                                        <a href="#" class="delete" data-selector="{{$user->id}}"><i class="fa fa-trash fa-1x my-3"></i>
                                            Delete </a>
                                    </p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@extends('footer')
@include('partials/scripts')
<script>
    $("#newUserdiv").hide();
</script>
<head>
</head>
<body>
</body>
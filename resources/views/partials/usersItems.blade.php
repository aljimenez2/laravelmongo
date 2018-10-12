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
                    <h3 class="card-text text-center">{{ $user->description }}</h3>
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
@include('partials/scriptMuuri');


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
                <form action="post" class="col-md-8 offset-md-2 p-2" id="formNewUser"
                      style="box-shadow: 0px 5px 5px 0px #cccccc; border-radius: 4px">
                    <h2 class="my-2">New user</h2>
                    <span class="counte">
                        <div class="" name="1">
                            <img src="{{asset('img/no-image.jpg')}}" id="file" class="img-fluid" width="320px"
                                 height="320px">
                            <div class="box">
                                <input type="file" name="photo" id="file-5" class="inputfile inputfile-4"
                                       data-multiple-caption="{count} files selected" onchange="readURL(this)"
                                       multiple/>
                                <label for="file-5"><figure><svg xmlns="http://www.w3.org/2000/svg" width="20"
                                                                 height="17"
                                                                 viewBox="0 0 20 17"><path
                                                    d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"/></svg></figure> <span>Choose a file&hellip;</span></label>
                            </div>
                            <labe>Description</labe>
                            <input type="text" class="form-control" name="description" id="description" max="300">
                            <button type="submit" class="btn btn-primary form-control my-4">Submit</button>
                        </div>
                </form>
            </div>
            <div class="board" id="boardOfUsers">
                <div class="board-column todo">
                    <div class="board-column-header bg-light-blue">List of User</div>
                    <div class="board-column-content">
                        @foreach($users as $user)
                            <div class="board-item" id="{{$user->id}}" name="1">
                                <div class="board-item-content text-center">
                                    <div class="card-img-top">
                                        <span class="helper"></span>
                                        <img src="{{ asset('img/'.$user->photo) }}" alt="Card image cap">
                                    </div>
                                    <h3 class="card-text text-center">{{ $user->description }}</h3>
                                    <a href="#" class="edit" data-selector="{{$user->id}}">
                                        <i class="fa fa-edit fa-1x my-3"></i> Edit
                                    </a>
                                    <a href="#" class="delete" data-selector="{{$user->id}}"><i
                                                class="fa fa-trash fa-1x my-3"></i> Delete </a>

                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>

    function counterN() {
        $('.counter').each(function () {
            var $this = $(this),
                countTo = $this.attr('data-count');
            $({countNum: $this.text()}).animate({
                    countNum: countTo
                },
                {
                    duration: 1000,
                    easing: 'linear',
                    step: function () {
                        $this.text(Math.floor(this.countNum));
                    },
                    complete: function () {
                        $this.text(this.countNum);
                    }
                });
        });
    }

    counterN();

    function changeButtonNewUser(value) {
        var btn = $('#newUser');
        if (value == 1) {
            btn.text('Cancel new user');
            btn.addClass("btn-danger");
            btn.removeClass("btn-success");
            btn.attr('data-toggle', 0);
        } else {
            btn.text('Add new user');
            btn.removeClass("btn-danger");
            btn.addClass("btn-success");
            btn.attr('data-toggle', 1);
        }
    }

    var itemContainers = [].slice.call(document.querySelectorAll('.board-column-content'));
    var columnGrids = [];
    var arreglos = [];
    var boardGrid;

    // Define the column grids so we can drag those
    // items around.
    itemContainers.forEach(function (container) {
        // Instantiate column grid.
        var grid = new Muuri(container, {
                items: '.board-item',
                layoutDuration: 400,
                layoutEasing: 'ease',
                dragEnabled: true,
                dragSort: function () {
                    return columnGrids;
                },
                dragSortInterval: 0,
                dragContainer: document.body,
                dragReleaseDuration: 400,
                dragReleaseEasing: 'ease',
                dragStartPredicate: function (item, event) {
                    // Prevent first item from being dragged.
                    // For other items use the default drag start predicate.
                        return Muuri.ItemDrag.defaultStartPredicate(item, event);
                },
            })
                .on('dragStart', function (item) {
                    // Let's set fixed widht/height to the dragged item
                    // so that it does not stretch unwillingly when
                    // it's appended to the document body for the
                    // duration of the drag.
                    item.getElement().style.width = item.getWidth() + 'px';
                    item.getElement().style.height = item.getHeight() + 'px';
                })
                .on('dragReleaseEnd', function (item) {
                    arreglos = [];
                    // Let's remove the fixed width/height from the
                    // dragged item now that it is back in a grid
                    // column and can freely adjust to it's
                    // surroundings.
                    item.getElement().style.width = '';
                    item.getElement().style.height = '';
                    // Just in case, let's refresh the dimensions of all items
                    // in case dragging the item caused some other items to
                    // be different size.
                    columnGrids.forEach(function (grid) {
                        var _array = [];
                        grid['_items'].forEach(function (item) {
                            _array.push(item['_element']['id']);
                        });
                        arreglos.push(_array);
                    });
                    $.ajax('{{url('save/order')}}', {
                        method: "POST",
                        data: {'userArray': arreglos},
                        success: function (response) {
                        },
                        error: function () {
                        },
                    });
                })
                .on('layoutStart', function () {
                    // Let's keep the board grid up to date with the
                    // dimensions changes of column grids.
                    boardGrid.refreshItems().layout();
                })
        ;
        // Add the column grid reference to the column grids
        // array, so we can access it later on.
        columnGrids.push(grid);
    });


    // Instantiate the board grid so we can drag those
    // columns around.
    boardGrid = new Muuri('.board', {
        layoutDuration: 400,
        layoutEasing: 'ease',
        dragEnabled: true,
        dragSortInterval: 0,
        dragStartPredicate: {
            handle: '.board-column-header'
        },
        dragReleaseDuration: 400,
        dragReleaseEasing: 'ease'
    });

    $("#newUserdiv").hide();
    $("#newUser").on('click', function () {
        $("#newUserdiv").toggle('slow');
        changeButtonNewUser($(this).attr('data-toggle'));
    });

    $(".edit").on('click', function (e) {
        var id = $(this).attr('data-selector');
        console.log(id);
        $.ajax('{{url('users/edit')}}', {
            method: "POST",
            data: {"id": id},
            success: function (response) {
                if ($("#newUser").attr('data-toggle') == 1) {
                    $("#newUserdiv").toggle('slow');
                    changeButtonNewUser($(this).attr('data-toggle'));
                }
                $('#description').text(response.description);
                $('#file').attr('src', response.photo);
            },
            error: function () {
            },
        });
    });
    $(".delete").on('click', function (e) {
        var id = $(this).attr('data-selector');
        console.log(id);
        $.ajax('{{url('users/delete')}}', {
            method: "POST",
            data: {"id": id},
            success: function (response) {
                $('#boardOfUsers').empty();
                $('#boardOfUsers').append(response);
            },
            error: function () {
            },
        });
    });

    $("#formNewUser").submit(function (e) {
        var formData = new FormData($(this)[0]);
        $.ajax({
            url: "{{url('users/store')}}",
            type: "POST",
            data: formData,
            success: function (response) {
                $.toaster({
                    message: "The new user have been saved successfuly",
                    title: 'Message',
                    priority: 'success',
                    settings: {'timeout': 2000}
                });
                $('#boardOfUsers').empty();
                $('#boardOfUsers').append(response);
                changeButtonNewUser(0);
                var num = $("#boardOfUsers").find(".board-item").length;
                $('.counter').attr('data-count', num);
                counterN();
            }, error: function () {
                $.toaster({
                    message: "Could not save the user, try again please.",
                    title: 'Message',
                    priority: 'danger',
                    settings: {'timeout': 2000}
                });
            },
            cache: false,
            contentType: false,
            processData: false
        });

        e.preventDefault();
        $("#newUserdiv").toggle('slow');

    });

    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#file')
                    .attr('src', e.target.result)
                    .css('maxWidth', '320px')
                    .css('maxHeight', '320px');
            };

            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
<head>
</head>
<body>
</body>
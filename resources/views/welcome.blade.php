    @include('head')
    <div class="container">
        <div class="row">
            <div class="col-10 offset-1 col-sm-10 col-md-10 offset-md-1 my-4">
                <div class="row my-4">
                    <div class="col-12 col-sm-12 col-md-4  offset-md-4 text-left">
                        <h2>User list</h2>
                        <span class="counter">1,234,567</span>
                    </div>
                    <button class="float-right btn btn-success my-1" id="newUser" data-toggle="1"> Add new user</button>
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
                                       data-multiple-caption="{count} files selected" onchange="readURL(this)" multiple/>
                                <label for="file-5"><figure><svg xmlns="http://www.w3.org/2000/svg" width="20" height="17"
                                                                 viewBox="0 0 20 17"><path
                                                    d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"/></svg></figure> <span>Choose a file&hellip;</span></label>
                            </div>
                            <labe>Description</labe>
                            <input type="text my-4" class="form-control" name="description">
                            <button type="submit" class="btn btn-primary form-control my-4">Submit</button>
                        </div>
                    </form>
                </div>
                <div class="board" id="boardOfUsers">
                    <div class="board-column todo">
                        <div class="board-column-header bg-light-blue">Productos de primera necesidad</div>
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
                                            <a href=""><i class="fa fa-edit fa-1x my-3"></i> Edit</a>
                                            <a href="" class="delete" data-selector="{{$user->id}}"><i class="fa fa-trash fa-1x my-3"></i> Delete </a>
                                        </p>
                                        <p class="text-center">

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
    <script>
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
                    dragReleaseEasing: 'ease'
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
            container.addEventListener('click', function (e) {
                e.preventDefault();
            });
            // Add the column grid reference to the column grids
            // array, so we can access it later on.
            columnGrids.push(grid);
        });


        $("#newUserdiv").hide();
        $("#newUser").on('click', function () {
            $("#newUserdiv").toggle('slow');
            if ($(this).attr('data-toggle') == 1) {

                $(this).text('Cancel new user');
                $(this).addClass("btn-danger");
                $(this).removeClass("btn-success");
                $(this).attr('data-toggle', 0);
            } else {
                $(this).text('Add new user');
                $(this).removeClass("btn-danger");
                $(this).addClass("btn-success");
                $(this).attr('data-toggle', 1);
            }
        });

        $(".delete").on('click', function () {
            console.log("click");
            var id = $(this).attr('data-selector');
            $.ajax({
                url: "{{url('users/delete')}}",
                type: "POST",
                data: {"id": id} ,
                success: function (msg) {
                    $('#boardOfUsers').empty();
                    $('#boardOfUsers').append(msg);
                },
                cache: false,
                contentType: false,
                processData: false
            });
        });

        $("#formNewUser").submit(function (e) {
            var formData = new FormData($(this)[0]);

            $.ajax({
                url: "{{url('users/store')}}",
                type: "POST",
                data: formData,
                success: function (msg) {
                    $('#boardOfUsers').empty();
                    $('#boardOfUsers').append(msg);
                },
                cache: false,
                contentType: false,
                processData: false
            });

            e.preventDefault();
            $("#newUserdiv").toggle('slow');

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

    </script>
    <script>
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
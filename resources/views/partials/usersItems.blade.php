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
                        <a href="#"><i class="fa fa-edit fa-1x my-3"></i> Edit</a>
                        <a href="#" class="delete" data-selector="{{$user->id}}"><i class="fa fa-trash fa-1x my-3"></i> Delete </a>
                    </p>
                </div>
            </div>
        @endforeach
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

        // Add the column grid reference to the column grids
        // array, so we can access it later on.
        columnGrids.push(grid);
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


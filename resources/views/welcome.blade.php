@include('head')
<div class="container">
    <div class="row">
        <div class="col-10 offset-1 col-sm-10 col-md-8 offset-md-1 my-4">
            <div class="row my-4">
                <div class="col-12 col-sm-12 col-md-6 text-left">
                    <h2>Usuarios</h2>
                </div>
            </div>
            <div class="board">
                <div class="board-column todo">
                    <div class="board-column-header bg-light-blue">Productos de primera necesidad</div>
                    <div class="board-column-content">
                        @foreach($users as $user)
                            <div class="board-item" id="{{$user->id}}" name="1">
                                <div class="board-item-content">
                                    <div class="card-img-top">
                                        <span class="helper"></span>
                                        <img src=""  alt="Card image cap" >
                                    </div>
                                    <p class="card-text">{{ $user->name }}</p>
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
    $("#save").on('click', function () {
        arreglos.splice(-1, 1);
        $.ajax('{{url('adminxxs/save/config/layout')}}', {
            method: "POST",
            data: {'arreglos': arreglos},
            success: function (response) {
                $.toaster({
                    message: "Se edito la plantilla correctamente.",
                    title: 'Mensaje',
                    priority: 'success',
                    settings: {'timeout': 10000}
                });
            },
            error: function () {
                $.toaster({message: "Hubo en error al editar la plantilla.", title: 'Mensaje', priority: 'danger'});
            },
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
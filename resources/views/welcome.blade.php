<?php
/**
 * Created by PhpStorm.
 * User: alejandroj
 * Date: 02/10/2018
 * Time: 9:57
 *
 *
 */
?>
@include('head/head')
@include('admin/navbar/navbar')
<div class="container">
    <div class="row">
        @include('admin/sidebar/sidebar')
        <div class="col-10 offset-1 col-sm-10 col-md-8  offset-md-1  my-4">
            <div class="row my-4">
                <div class="col-12 col-sm-12 col-md-6 text-left">
                    <h2>Articulos vista inicial</h2>
                </div>
                <div class="col-12 col-sm-12 col-md-6 text-right">
                    <bottom class="btn btn-danger" id="descartar">
                        Descartar
                    </bottom>
                    <bottom class="btn btn-primary" id="save">
                        Guardar
                    </bottom>
                </div>
            </div>
            <div class="board">
                <div class="board-column todo">
                    <div class="board-column-header bg-light-blue">Productos de primera necesidad</div>
                    <div class="board-column-content">
                        @foreach($articles_p1 as $article)
                            <div class="board-item" id="{{$article->id}}" name="1">
                                <?php $principal_photo = \App\Photo::getArticlesPrimaryPhoto($article->id);?>
                                <div class="board-item-content">
                                    <div class="card-img-top">
                                        <span class="helper"></span>
                                        <img src="@if($principal_photo != ""){{asset("uploads/articles/photos/".$principal_photo)}} @else {{ asset("img/picture.png") }} @endif"
                                             alt="Card image cap" @if($principal_photo == "") class="no-image" @endif>
                                    </div>
                                    <p class="card-text">{{ $article->name }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="board-column working">
                    <div class="board-column-header">Articulo destacado posicion grande</div>
                    <div class="board-column-content">
                        @foreach($articles_p2 as $article)
                            <div class="board-item" id="{{$article->id}}" name="1">
                                <?php $principal_photo = \App\Photo::getArticlesPrimaryPhoto($article->id);?>
                                <div class="board-item-content">
                                    <div class="card-img-top">
                                        <span class="helper"></span>
                                        <img src="@if($principal_photo != ""){{asset("uploads/articles/photos/".$principal_photo)}} @else {{ asset("img/picture.png") }} @endif"
                                             alt="Card image cap" @if($principal_photo == "") class="no-image" @endif>
                                    </div>
                                    <p class="card-text">{{ $article->name }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="board-column">
                    <div class="board-column-header bg-dark-turquesa">Articulos destacados posicion pequeña</div>
                    <div class="board-column-content">
                        @foreach($articles_p3 as $article)
                            <div class="board-item" id="{{$article->id}}" name="1">
                                <?php $principal_photo = \App\Photo::getArticlesPrimaryPhoto($article->id);?>
                                <div class="board-item-content">
                                    <div class="card-img-top">
                                        <span class="helper"></span>
                                        <img src="@if($principal_photo != ""){{asset("uploads/articles/photos/".$principal_photo)}} @else {{ asset("img/picture.png") }} @endif"
                                             alt="Card image cap" @if($principal_photo == "") class="no-image" @endif>
                                    </div>
                                    <p class="card-text">{{ $article->name }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="board-column done">
                    <div class="board-column-header bg-light-green">Todos los articulos</div>
                    <div class="board-column-content">
                        @foreach($_articles as $article)
                            <div class="board-item" id="{{$article->id}}" name="1">
                                <?php $principal_photo = \App\Photo::getArticlesPrimaryPhoto($article->id);?>
                                <div class="board-item-content">
                                    <div class="card-img-top">
                                        <span class="helper"></span>
                                        <img src="@if($principal_photo != ""){{asset("uploads/articles/photos/".$principal_photo)}} @else {{ asset("img/picture.png") }} @endif"
                                             alt="Card image cap" @if($principal_photo == "") class="no-image" @endif>
                                    </div>
                                    <p class="card-text">{{ $article->name }}</p>
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
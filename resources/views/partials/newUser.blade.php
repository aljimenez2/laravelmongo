<form action="post" class="col-md-8 offset-md-2 p-2" id="formNewUser"
      style="box-shadow: 0px 5px 5px 0px #cccccc; border-radius: 4px">
    <h2 class="my-2">New user</h2>
    <span class="counte"></span>
    <div class="" name="1">
        <img src="{{asset('img/no-image.jpg')}}" id="file" class="img-fluid" width="320px"
             height="320px">
        <div class="box">
            <input type="file" name="photo" id="file-5" class="inputfile inputfile-4"
                   data-multiple-caption="{count} files selected" onchange="readURL(this)"
                   multiple/>
            <label for="file-5">
                <figure>
                    <svg xmlns="http://www.w3.org/2000/svg" width="20"
                         height="17"
                         viewBox="0 0 20 17">
                        <path
                                d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"/>
                    </svg>
                </figure>
                <span>Choose a file&hellip;</span></label>
        </div>
        <labe>Description</labe>
        <input type="text" class="form-control" name="description" id="description" max="300">
        <input type="hidden" id="id_user" value="" name="id_user">
        <button type="submit" class="btn btn-primary form-control my-4">Submit</button>
    </div>
</form>
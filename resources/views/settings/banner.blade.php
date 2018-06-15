
    <h3><u>Banner</u></h3>
    <div class="row">
            @foreach($banners as $banner)
            <form action="{{ route('upload') }}" enctype="multipart/form-data" method="post">
                {{csrf_field()}}
                <settings-banner :resource="'{{ json_encode($banner)}}'" :resource_errors="'{{ json_encode($errors)}}'" >
                </settings-banner> 
            </form>
            @endforeach  
    </div>
      

  
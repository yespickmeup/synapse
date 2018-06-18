@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading"><h2>Settings</h2></div>
                <div class="panel-body">
                    <settings-setting :resource="'{{ json_encode($setting)}}'">       
                    </settings-setting> 
                   
                    @include('settings.banner2')        
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
<script>
        window.myToken =  <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
</script>

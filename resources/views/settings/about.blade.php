@extends('layouts.app')

@section('css')
<link href="{{ asset('css/trix.css') }}" rel="stylesheet">
<script src="{{ asset('js/trix.js') }}"></script>
@endsection
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading"><h2>About Us</h2></div>
                <div class="panel-body">   
                    <about :resource="'{{ json_encode($setting)}}'" :resource_errors="'{{ json_encode($errors)}}'"></about>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
<script>
    window.myToken =  <?php echo json_encode([
        'csrfToken' => csrf_token(),
    ]); ?>
</script>

@endsection


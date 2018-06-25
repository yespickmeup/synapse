@extends('layouts.app')

@section('css')

@endsection
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading"><h2>Testimonials</h2></div>
                <div class="panel-body">   
                    <settings-testimonials :resource="'{{ json_encode($testimonials)}}'" :resource_errors="'{{ json_encode($errors)}}'"></settings-testimonials>
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


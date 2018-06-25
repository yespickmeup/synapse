@extends('layouts.app')

@section('css')

@endsection
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading"><h2>Our Team</h2></div>
                <div class="panel-body">   
                    <settings-team :resource="'{{ json_encode($team_members)}}'" :resource_errors="'{{ json_encode($errors)}}'"></settings-team>
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


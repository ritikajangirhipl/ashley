@extends('layouts.admin')
@section('title', $pageTitle)
@section('content')

<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header card-header-primary">
                <h4 class="card-title float-left">
                    Users {{ trans('global.list') }}
                </h4>
                @can('user_create')
                    <a class="btn btn-success btn-sm float-right" title="{{ trans('global.add') }} User" href="{{ route('admin.users.create') }}">
                        <i class="fas fa-plus"></i>
                    </a>
                @endcan 
            </div>

            <div class="card-block">
                <div class="table-responsive">
                    <div class="clearfix"></div>
                    {{ $dataTable->table(['class' => 'table dt-responsive nowrap', 'style' => 'width:100%;']) }}
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
@parent
{!! $dataTable->scripts() !!}
<script type="text/javascript">
  $(document).ready( function(){
     

  });
</script>
@endsection


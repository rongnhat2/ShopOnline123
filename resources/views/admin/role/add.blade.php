@extends('admin.layout')
@section('body')


    <form class="row" method="post" action="{{ route('role.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="col-12 grid-margin">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Thêm Chức Vụ</h4>
                    <form class="form-sample">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Tên Chức Vụ</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="display_name"  required=""/>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group row">
                                    @foreach($permissions as $key => $permission)
                                    <?php if ($key == 0): ?>
                                        <div class="form-check col-sm-3 " style="display: none;">
                                            <label class="form-check-label">
                                                <input type="checkbox" class="form-check-input" name="permission[]" id="{{ $permission->id }}" value="{{ $permission->id }}" checked="" />
                                                {{ $permission->display_name }}
                                            </label>
                                        </div>
                                    <?php else: ?>
                                        <div class="form-check col-sm-3 ">
                                            <label class="form-check-label">
                                                <input type="checkbox" class="form-check-input" name="permission[]" id="{{ $permission->id }}" value="{{ $permission->id }}"/>
                                                {{ $permission->display_name }}
                                            </label>
                                        </div>
                                    <?php endif ?>
                                        
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary mr-2">Thêm</button>
                        <button class="btn btn-light">Hủy</button>
                    </form>
                </div>
            </div>
        </div>
    </form>

@endsection()
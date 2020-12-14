@extends('admin.layout')
@section('body')


    <form class="row" method="post" action="" enctype="multipart/form-data">
        @csrf
        <div class="col-12 grid-margin">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Sửa Nhân Viên</h4>
                    <form class="form-sample">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Họ và tên</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="name"  required="" readonly="" value="{{ $admin->name }}" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Email</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="email"  required="" readonly="" value="{{ $admin->email }}" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group row">
                                    @foreach($roles as $role)
                                    <div class="form-check col-sm-3 ">
                                        <label class="form-check-label">
                                            <input type="radio" class="form-check-input" name="roles[]" id="optionsRadios1" value="{{ $role->id }}"  {{ $listRoleOfUser->contains($role->id) ? 'checked' : '' }}/>
                                           {{ $role->display_name }}
                                        </label>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary mr-2">Cập Nhật</button>
                        <button class="btn btn-light">Hủy</button>
                    </form>
                </div>
            </div>
        </div>
    </form>

@endsection()
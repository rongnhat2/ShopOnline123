@extends('admin.layout')
@section('body')


    <div class="row grid-margin">
        @if ( Session::has('error') )
        <div class="col-12 grid-margin">
            <div class="alert alert-fill-danger" role="alert">
                <i class="mdi mdi-alert-circle"></i>
                {{ Session::get('error') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">Close</span>
                </button>
            </div>
        </div>
        @endif
        @if ( Session::has('success') )
        <div class="col-12 grid-margin">
            <div class="alert alert-fill-success" role="alert">
                <i class="mdi mdi-alert-circle"></i>
                {{ Session::get('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">Close</span>
                </button>
            </div>
        </div>
        @endif
    </div>
    <div class="row grid-margin">
        <div class="col-3 grid-margin stretch-card">
            <div class="card">
                <a href="{{ route('item.copy', ['id' => $id]) }}" type="button" class="btn btn-primary">Trở về</a>
            </div>
        </div>
    </div>
    
    <form class="row" method="post" action="" enctype="multipart/form-data">
        @csrf
        <div class="card col-12">
            <div class="card-body">
                <h4 class="card-title">Thêm số lượng sản phẩm </h4>
                <div class="row">
                    <div class="col-12">
                        <div>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Size</th>
                                        <th>Đang hiện có</th>
                                        <th>Nhập thêm</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($item_quantity as $key => $value): ?>
                                        <tr>
                                            <td><?php echo $value->size ?></td>
                                            <td><?php echo $value->quantity ?></td>
                                            <td>
                                                <input type="hidden" class="form-control" name="name[]"  required="" value="<?php echo $value->color->item->name ?>" />
                                                <input type="hidden" class="form-control" name="color[]"  required="" value="<?php echo $value->color->hex ?>" />
                                                <input type="hidden" class="form-control" name="size[]"  required="" value="<?php echo $value->size ?>" \/>
                                                <input type="text" class="form-control" name="quantity[]"  required="" value="0" pattern="[0-9]*"/>
                                            </td>
                                        </tr>
                                    <?php endforeach ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary mr-2">Nhập kho</button>
            </div>
        </div>
    </form>

@endsection()

<div class="row grid-margin">
    @if ( Session::has('error') )
    <div class="col-12 grid-margin">
        <div class="alert alert-danger" role="alert">
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
        <div class="alert alert-success" role="alert">
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
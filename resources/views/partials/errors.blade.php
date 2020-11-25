@if (isset($errors)&&count($errors)>0)
    <div class="alert alert-dismissable alert-danger face show">
        <button type="button" class="close" data-dismiss="alert" aria-label="close">
            <span aria-hidden="true">&times;</span>
        </button>
        <strong>
            @foreach ($errors->all() as $error)
                <li><strong>{!! $error !!}</strong></li>
            @endforeach
        </strong>
    </div>
@endif    
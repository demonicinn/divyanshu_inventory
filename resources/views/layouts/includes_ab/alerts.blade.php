@if($message = Session::get('success'))
    <div class="alert callout callout-success">
        {!! $message !!}
    </div>
@endif

@if($message = Session::get('error'))
    <div class="alert callout callout-danger">
        {!! $message !!}
    </div>
@endif

@if($message = Session::get('warning'))
    <div class="alert callout callout-warning">
        {!! $message !!}
    </div>
@endif

@if($message = Session::get('info'))
    <div class="alert callout callout-info">
        {!! $message !!}
    </div>
@endif

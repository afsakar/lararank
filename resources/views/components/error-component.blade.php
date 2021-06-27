<div>
    @if ($errors->any())
        <div class="alert alert-danger text-sm p-3" role="alert">
            <div class="font-weight-bold">{{ __('Whoops! Bir şeyler yolunda gitmedi.') }}</div>

            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
</div>

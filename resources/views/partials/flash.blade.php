{{-- Pesan flash (success/error) + error validasi --}}
@if (session('success'))
    <div class="alert alert-success">
        <i class="ti ti-check" aria-hidden="true"></i>
        {{ session('success') }}
    </div>
@endif

@if (session('error'))
    <div class="alert alert-error">
        <i class="ti ti-alert-circle" aria-hidden="true"></i>
        {{ session('error') }}
    </div>
@endif

@if ($errors->any())
    <div class="alert alert-error">
        <i class="ti ti-alert-circle" aria-hidden="true"></i>
        {!! collect($errors->all())->map(fn ($e) => e($e))->implode('<br>') !!}
    </div>
@endif

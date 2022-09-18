<script src="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.js"></script>

@if (session()->has('success'))
    <script>
        const notyf = new Notyf({dismissible: true, showDuration: 400})
        notyf.success('{{ session('success') }}')
    </script>
@endif

@if(session('error'))
    <script>
        const notyf = new Notyf({dismissible: true, showDuration: 400})
        notyf.error('{{ session('error') }}')
    </script>
@endif

@if(count($errors) > 0)
    @foreach($errors->all() as $error)
        <script>
            const notyf = new Notyf({dismissible: true, showDuration: 400})
            notyf.error('{{ $error }}')
        </script>
    @endforeach
@endif

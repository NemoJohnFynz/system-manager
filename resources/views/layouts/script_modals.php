@php
    use App\Helpers\ViteModalHelper;
    $modalAssets = App\Helpers\ViteModalHelper::getModalAssets();
@endphp 
<script>
    window.viteAssets = {
        @foreach($modalAssets as $name => $path)
            '{{ $name }}': '{{ Vite::asset($path) }}',
        @endforeach
    };
</script>
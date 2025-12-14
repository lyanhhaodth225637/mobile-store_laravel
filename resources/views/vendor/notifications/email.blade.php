<x-mail::message>
{{-- Lời chào --}}
@if(!empty($greeting))
# {{ $greeting }}
@else
# {{ $level === 'error' ? 'Xin lỗi!' : 'Xin chào!' }}
@endif

{{-- Nội dung mở đầu --}}
@foreach($introLines as $line)
{{ $line }}

@endforeach

{{-- Nút hành động --}}
@isset($actionText)
<?php
    $color = match($level) {
        'success', 'error' => $level,
        default => 'primary',
    };
?>
<x-mail::button :url="$actionUrl" :color="$color">
    {{ $actionText }}
</x-mail::button>
@endisset

{{-- Nội dung kết thúc --}}
@foreach($outroLines as $line)
{{ $line }}

@endforeach

{{-- Lời kết --}}
@if(!empty($salutation))
{{ $salutation }}
@else
Trân trọng,<br>
{{ config('app.name') }}
@endif

{{-- Văn bản phụ --}}
@isset($actionText)
<x-slot:subcopy>
Nếu nút "{{ $actionText }}" không hoạt động, vui lòng sao chép và dán đường dẫn sau vào trình duyệt:
<span class="break-all">[{{ $displayableActionUrl }}]({{ $actionUrl }})</span>
</x-slot:subcopy>
@endisset
</x-mail::message>
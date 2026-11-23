@props(['label', 'value', 'color' => 'netral'])

<div {{ $attributes->class(['stat-kartu', 'stat-kartu-'.$color]) }}>
    <p class="stat-label">{{ $label }}</p>
    <p class="stat-nilai">{{ $value }}</p>
</div>

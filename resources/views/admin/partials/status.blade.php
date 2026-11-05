{{-- Badge status aktif/nonaktif. Parameter: $active, $on, $off --}}
<span @class(['status', 'on' => $active, 'off' => ! $active])>{{ $active ? ($on ?? 'Aktif') : ($off ?? 'Nonaktif') }}</span>

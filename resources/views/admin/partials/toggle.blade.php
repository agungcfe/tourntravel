{{-- Switch on/off. Parameter: $name, $checked, $label --}}
<label class="switch">
    <input type="hidden" name="{{ $name }}" value="0">
    <input type="checkbox" name="{{ $name }}" value="1" @checked($checked)>
    <span class="switch-track"></span>
    <span>{{ $label }}</span>
</label>

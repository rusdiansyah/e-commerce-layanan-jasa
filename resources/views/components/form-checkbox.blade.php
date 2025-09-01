@props(['name','label'])
<div class="form-check">
    <input type="checkbox" wire:model="{{ $name }}" class="form-check-input" id="{{ $name }}">
    <label class="form-check-label" for="{{ $name }}">{{ $label }}</label>
</div>

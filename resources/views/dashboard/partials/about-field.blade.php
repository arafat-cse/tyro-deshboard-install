@php
    $value = old($field, $item?->{$field});
@endphp

@if ($field === 'description')
    <div class="cms-field full">
        <label>{{ $label }}</label>
        <textarea name="{{ $field }}">{{ $value }}</textarea>
    </div>
@elseif ($field === 'type')
    <div class="cms-field">
        <label>{{ $label }}</label>
        <select name="{{ $field }}" required>
            <option value="check" @selected($value === 'check')>Checklist</option>
            <option value="process" @selected($value === 'process')>Process Card</option>
        </select>
    </div>
@elseif ($field === 'sort_order')
    <div class="cms-field">
        <label>{{ $label }}</label>
        <input name="{{ $field }}" type="number" min="0" value="{{ $value ?? 0 }}" required>
    </div>
@elseif (in_array($field, ['is_gold', 'is_published'], true))
    <label class="cms-check">
        <input type="checkbox" name="{{ $field }}" value="1" @checked($item ? $item->{$field} : $field === 'is_published')>
        {{ $label }}
    </label>
@else
    <div class="cms-field">
        <label>{{ $label }}</label>
        <input name="{{ $field }}" value="{{ $value }}" @required(! in_array($field, ['icon_text', 'headline', 'url'], true))>
    </div>
@endif

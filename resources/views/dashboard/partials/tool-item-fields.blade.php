@php
    $styleClass = old('style_class', $item?->style_class ?? '');
@endphp

<div class="cms-form-grid">
    <div class="cms-field">
        <label>Title</label>
        <input name="title" value="{{ old('title', $item?->title) }}" required>
    </div>
    <div class="cms-field">
        <label>Sort Order</label>
        <input name="sort_order" type="number" min="0" value="{{ old('sort_order', $item?->sort_order ?? 0) }}" required>
    </div>
    <div class="cms-field">
        <label>Icon Text</label>
        <input name="icon_text" maxlength="10" value="{{ old('icon_text', $item?->icon_text) }}">
    </div>
    <div class="cms-field">
        <label>Style Class</label>
        <select name="style_class">
            @foreach (['' => 'Default', 'gold-bg' => 'Gold icon', 'green-bg' => 'Green icon', 'purple-bg' => 'Purple icon', 'pink-bg' => 'Pink icon', 'green-img' => 'Green toolkit image', 'purple-img' => 'Purple toolkit image'] as $value => $label)
                <option value="{{ $value }}" @selected($styleClass === $value)>{{ $label }}</option>
            @endforeach
        </select>
    </div>
    <div class="cms-field">
        <label>Meta One</label>
        <input name="meta_one" value="{{ old('meta_one', $item?->meta_one) }}" placeholder="12 Tools or step number">
    </div>
    <div class="cms-field">
        <label>Meta Two</label>
        <input name="meta_two" value="{{ old('meta_two', $item?->meta_two) }}" placeholder="8 Worksheets">
    </div>
    <div class="cms-field">
        <label>Meta Three</label>
        <input name="meta_three" value="{{ old('meta_three', $item?->meta_three) }}" placeholder="3 Checklists">
    </div>
    <div class="cms-field">
        <label>Button Text</label>
        <input name="button_text" value="{{ old('button_text', $item?->button_text) }}">
    </div>
    <div class="cms-field">
        <label>Button URL</label>
        <input name="button_url" value="{{ old('button_url', $item?->button_url) }}">
    </div>
    <label class="cms-field" style="display:flex;gap:.5rem;align-items:center;">
        <input type="checkbox" name="is_published" value="1" @checked(old('is_published', $item?->is_published ?? true)) style="width:auto;">
        Published
    </label>
    <div class="cms-field full">
        <label>Description</label>
        <textarea name="description">{{ old('description', $item?->description) }}</textarea>
    </div>
</div>

@props(['name', 'selected' => '', 'options'])

<select name="{{ $name }}" {{ $attributes->class(['form-select', 'is-invalid' => $errors->has($name)]) }}>
    <option value="" selected disabled>Select...</option>
    @foreach ($options as $key => $value)
        <option value="{{ $key }}" @selected(old($name, $key) == $selected)>{{ $value }}</option>
    @endforeach
</select>
@error($name)
    <div class="invalid-feedback">
        {{ $message }}
    </div>
@enderror

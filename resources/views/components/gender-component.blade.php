<select name="gender" class="form-control">
    <option value="">{{ __('Please Choose') }}</option>
    @foreach ($genders as $item)
        <option {!! selected($item, $selectedGender) !!} value="{{ $item }}">{{ __($item) }}</option>
    @endforeach
</select>

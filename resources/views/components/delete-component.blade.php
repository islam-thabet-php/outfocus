@can($attributes->get('permission'))
<a  class="dropdown-item" href="#delete" onclick="confirm_delete('deleted-form-{{ $attributes->get('id') }}');"><i class="bx bx-trash mr-1"></i>
    {{ __('Delete') }}</a>
<form id="deleted-form-{{ $attributes->get('id') }}" action="{{ $attributes->get('href') }}" method="POST" style="display: none;">
    @csrf
    @method('DELETE')
</form>
@endcan



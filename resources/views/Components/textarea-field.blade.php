<div class="mb-4">
    <label class="block text-xs font-semibold uppercase mb-1" for="{{ $name }}">
        {{ $label }}
    </label>
    <textarea name="{{ $name }}" id="{{ $name }}" placeholder="{{ $placeholder }}" class="w-full border border-gray-300 rounded p-2 text-sm focus:outline-none focus:border-blue-500">{{ old($name, $value) }}</textarea>
    <x-error-message field="{{ $name }}" />
</div>
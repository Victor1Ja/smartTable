@props(['label','name', 'value','placeholder'])
<label class="block mb-4">
    <div class="text-sm font-semibold text-gray-700 mb-1">{{ $label }}</div>
    <input type="text" name="{{ $name }}" value="{{ old($name, $value) }}" placeholder="{{ $placeholder }}" class="block w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-blue-500 transition duration-150 ease-in-out">
</label>
<x-error-message field="{{ $name }}" />
<div x-data="{ isOpen: false, options: @json($options), selectedOption: null }">
    <input x-ref="autocompleteInput" type="text" placeholder="Type to search..." x-model="selectedOption" @click="isOpen = true" @input="isOpen = true" @keydown.escape="isOpen = false" @keydown.tab="isOpen = false" @keydown.arrow-up.prevent="isOpen = true" @keydown.arrow-down.prevent="isOpen = true" @keydown.enter.prevent="isOpen = false" class="border border-gray-300 p-2 rounded" />

    <ul x-show="isOpen && options.length > 0" x-cloak @click.away="isOpen = false" class="absolute z-10 mt-1 w-full bg-white border border-gray-300 rounded-md shadow-lg">
        <li x-for="(option, index) in options" :key="index" @click="selectedOption = option.label; isOpen = false" class="cursor-pointer p-2 hover:bg-gray-200">
            <span x-html="option.label"></span>
        </li>
    </ul>
</div>
<form action="{{ $action }}" method="{{ strtolower($method) === 'get' ? 'GET' : 'POST' }}">
    @csrf
    @if(!in_array(strtoupper($method), ['GET', 'POST']))
    @method($method)
    @endif

    <div class="flex flex-wrap -mx-2">
        @foreach ($fields as $field)

        <div class="{{ $field['width'] }} {{ $field['type'] !== 'invisible' ? 'px-2 mb-6' : '' }}">
            @if ($field['type'] !== 'invisible')
            <label for="{{ $field['name'] }}" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ $field['label'] }}</label>

            @endif

            @if ($field['type'] === 'text')
            <input type="text" id="{{ $field['name'] }}" name="{{ $field['name'] }}" value="{{ old($field['name'], $values->{$field['name']} ?? '') }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="{{ $field['placeholder'] ?? '' }}" {{ $field['required'] ? 'required' : '' }} />
            @elseif ($field['type'] === 'email')
            <input type="email" id="{{ $field['name'] }}" name="{{ $field['name'] }}" value="{{ old($field['name'], $values->{$field['name']} ?? '') }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="{{ $field['placeholder'] ?? '' }}" {{ $field['required'] ? 'required' : '' }} />
            @elseif ($field['type'] === 'password')
            <input type="password" id="{{ $field['name'] }}" name="{{ $field['name'] }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="{{ $field['placeholder'] ?? '' }}" {{ $field['required'] ? 'required' : '' }} />
            @elseif ($field['type'] === 'tel')
            <input type="tel" id="{{ $field['name'] }}" name="{{ $field['name'] }}" value="{{ old($field['name'], $values->{$field['name']} ?? '') }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="{{ $field['placeholder'] ?? '' }}" pattern="{{ $field['pattern'] ?? '' }}" {{ $field['required'] ? 'required' : '' }} />
            @elseif ($field['type'] === 'url')
            <input type="url" id="{{ $field['name'] }}" name="{{ $field['name'] }}" value="{{ old($field['name'], $values->{$field['name']} ?? '') }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="{{ $field['placeholder'] ?? '' }}" {{ $field['required'] ? 'required' : '' }} />
            @elseif ($field['type'] === 'number')
            <input type="number" id="{{ $field['name'] }}" name="{{ $field['name'] }}" value="{{ old($field['name'], $values->{$field['name']} ?? '') }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="{{ $field['placeholder'] ?? '' }}" {{ $field['required'] ? 'required' : '' }} />
            @elseif ($field['type'] === 'color')
            <input type="color" id="{{ $field['name'] }}" name="{{ $field['name'] }}" value="{{ old($field['name'], $values->{$field['name']} ?? '') }}" class="p-1 h-10 w-14 block bg-white border border-gray-200 cursor-pointer rounded-lg disabled:opacity-50 disabled:pointer-events-none" placeholder="{{ $field['placeholder'] ?? '' }}" {{ $field['required'] ? 'required' : '' }} />
            @elseif ($field['type'] === 'invisible')
            <input type="text" id="{{ $field['name'] }}" class="invisible" name="{{ $field['name'] }}" value="{{ old($field['name'], $values->{$field['name']} ?? '') }}" hidden placeholder="{{ $field['placeholder'] ?? '' }}" {{ $field['required'] ? 'required' : '' }} />
            @elseif ($field['type'] === 'checkbox')
            <div class="flex items-start mb-6">
                <div class="flex items-center h-5">
                    <input id="{{ $field['name'] }}" name="{{ $field['name'] }}" type="checkbox" value="{{ $field['value'] ?? '' }}" class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-blue-300 dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-blue-600 dark:ring-offset-gray-800" {{ $field['required'] ? 'required' : '' }} {{ old($field['name'], $values->{$field['name']} ?? false) ? 'checked' : '' }} />
                </div>
            </div>
            @elseif ($field['type'] === 'select')
            <select style="width: 100%" data-placeholder="{{ $field['placeholder'] ?? 'Please select an option' }}" data-allow-clear="false" title="Select city..." id="{{ $field['name'] }}" name="{{ $field['name'] }}{{ isset($field['multiple']) && $field['multiple'] ? '[]' : '' }}" class="{{ isset($field['multiple']) && $field['multiple'] ? 'multipleselect' : '' }} bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" {{ $field['required'] ? 'required' : '' }} {{ isset($field['multiple']) && $field['multiple'] ? 'multiple' : '' }}>
                @foreach ($field['options'] as $value => $label)
                <option value="{{ $value }}" @if(isset($field['multiple']) && $field['multiple']) {{ in_array($value, old($field['name'], $values->{$field['name']} ?? [])) ? 'selected' : '' }} @else {{ old($field['name'], $values->{$field['name']} ?? '') == $value ? 'selected' : '' }} @endif>
                    {{ $label }}
                </option>
                @endforeach
            </select>

            @endif
        </div>
        @endforeach
    </div>

    <div class="mt-0">
        <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
    </div>
</form>
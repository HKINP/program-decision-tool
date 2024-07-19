<!-- resources/views/components/form.blade.php -->

@props(['action', 'method' => 'POST', 'fields' => []])

<form action="{{ $action }}" method="{{ strtolower($method) === 'get' ? 'GET' : 'POST' }}">
    @csrf
    @if(!in_array(strtoupper($method), ['GET', 'POST']))
        @method($method)
    @endif

    <div class="grid grid-cols-{{ $fields['columns'] }} gap-4">
        @foreach ($fields['inputs'] as $input)
            <div class="col-span-{{ $input['width'] }}">
                <label for="{{ $input['name'] }}">{{ $input['label'] }}</label>
                @if ($input['type'] === 'text')
                    <input type="text" name="{{ $input['name'] }}" placeholder="{{ $input['placeholder'] }}" class="w-full">
                @elseif ($input['type'] === 'textarea')
                    <textarea name="{{ $input['name'] }}" placeholder="{{ $input['placeholder'] }}" class="w-full"></textarea>
                @elseif ($input['type'] === 'select')
                    <select name="{{ $input['name'] }}" class="w-full">
                        <option value="">Select</option>
                        @foreach ($input['options'] as $option)
                            <option value="{{ $option['value'] }}">{{ $option['label'] }}</option>
                        @endforeach
                    </select>
                @endif
            </div>
        @endforeach
    </div>

    <div class="mt-6">
        <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
    </div>
</form>

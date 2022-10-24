<div>
    <label for="order-by">Order By </label>
    <select id="order-by" wire:model="orderBy" class="border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
        @foreach($options as $option => $order)
            <option value="{{$order}}"> {{ucwords($option)}} first</option>
        @endforeach
    </select>
</div>

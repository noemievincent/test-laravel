<select name="categories[]"
        id="categories"
        multiple
        class="@error('categories') outline outline-2 outline-red-600 @enderror w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
    @foreach($categories as $category)
        <option value="{{$category->id}}" @selected(old('categories') == $category->id)>
            {{ucwords($category->name)}}
        </option>
    @endforeach
</select>

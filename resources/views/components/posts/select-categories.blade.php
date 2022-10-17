<label for="category_id"
       class="@error('category_id') text-red-600 @enderror block mt-8 mb-2">Category</label>
@error('category_id')
<p class="text-red-600 mb-2">{{ $message }}</p>
@enderror
<select name="category_id[]"
        id="category_id"
        multiple
        class="@error('category_id') outline outline-2 outline-red-600 @enderror w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
        @foreach ($categories as $category)
            <option value="{{ $category->id }}" @if($post)
                @foreach($post->categories as $post_category)
                    @selected($post_category->id == $category->id)
                    @endforeach @endif)>
                {{ ucwords($category->name)  }}
            </option>
        @endforeach
</select>

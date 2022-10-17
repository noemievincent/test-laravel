<label for="body"
       class="@error('body') text-red-600 @enderror block mt-8 mb-2">Post Body</label>
@error('body')
<p class="text-red-600 mb-2">{{ $message }}</p>
@enderror
<textarea name="body"
          id="body"
          rows="20"
          class="@error('body') outline outline-2 outline-red-600 @enderror w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 pl-2">{{old('body') !== null ? old('body') : ($post ? $post->body : '') }}</textarea>

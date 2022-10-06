<div>
    <form action="{{$_SERVER['REQUEST_URI']}}"
          method="get">
        <label for="order-by">Order By </label>
        <select id="order-by"
                name="order-by"
                class="border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
            <option value="newest" {{isset($_GET['order-by']) && $_GET['order-by'] === 'newest' ? 'selected' : ''}}>
                Newest first
            </option>
            <option value="oldest" {{isset($_GET['order-by']) && $_GET['order-by'] === 'oldest' ? 'selected' : ''}}>
                Oldest first
            </option>
        </select>
        <button type="submit"
                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-md ml-1">Change
        </button>
    </form>
</div>

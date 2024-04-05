<div>
    <h2>Add New Restaurant</h2>
</div>
<div>
    <a href="{{ route('restaurants.index') }}"> Back</a>
</div>

<form action="{{ route('restaurants.store') }}" method="POST">
    @csrf

    <div>
        <strong>Name:</strong>
        <input type="text" name="name" placeholder="Name">
    </div>
    <div>
        <strong>Description:</strong>
        <textarea style="height:150px" name="description" placeholder="Description"></textarea>
    </div>
    <div>
        <strong>PostalCode:</strong>
        <input type="text" name="postal_code" placeholder="PostalCode">
    </div>
    <div>
        <strong>Address:</strong>
        <textarea style="height:150px" name="address" placeholder="Address"></textarea>
    </div>
    <div>
        <strong>Phone:</strong>
        <input type="text" name="phone" placeholder="Phone">
    </div>
    <div>
        <strong>Opening Hours:</strong>
        <input type="text" name="opening_hours" placeholder="Opening Hours">
    </div>
    <div>
        <strong>Regular Holiday:</strong>
        <input type="text" name="regular_holiday" placeholder="Regular Holiday">
    </div>
    <div>
        <strong>Budget:</strong>
        <input type="number" name="budget" placeholder="Budget">
    </div>
    <div>
         <strong>Category:</strong>
         <select name="category_id">
         @foreach ($categories as $category)
         <option value="{{ $category->id }}">{{ $category->name }}</option>
         @endforeach
         </select>
     </div>
    <div>
        <button type="submit">Submit</button>
    </div>

</form>

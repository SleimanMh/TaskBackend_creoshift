<form action="/users/index" method="GET">
    <label for="filterFirstName">Filter by First Name:</label>
    <input type="text" name="FirstName">
    <button type="submit">Apply Filter</button>
</form>

@foreach ($passengers as $passenger)
    <p>{{ $passenger->FirstName }}</p>
@endforeach


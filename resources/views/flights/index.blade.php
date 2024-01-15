<form action="/flights" method="GET">
    <label for="filterNumber">Filter by Flight Number:</label>
    <input type="text" name="number">
    <button type="submit">Apply Filter</button>
</form>

<h1>Flight Details</h1>

@foreach ($flights as $flight)

<ul>
    <li>ID: {{ $flight->id }}</li>
    <li>Number: {{ $flight->number }}</li>
    <li>Departure City: {{ $flight->departure_city }}</li>
    <li>Arrival City: {{ $flight->arrival_city }}</li>
    <li>Departure Time: {{ $flight->departure_time }}</li>
    <li>Arrival Time: {{ $flight->arrival_time ?? 'Not available' }}</li>
</ul>
@endforeach


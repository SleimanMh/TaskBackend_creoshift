<!-- Create Passenger Form -->
<form action="passengers/store" method="POST">
    @csrf

    <label for="FirstName">First Name:</label>
    <input type="text" name="FirstName" required>

    <label for="LastName">Last Name:</label>
    <input type="text" name="LastName" required>

    <label for="email">Email:</label>
    <input type="email" name="email" required>

    <label for="password">Password:</label>
    <input type="password" name="password" required>

    <label for="DOB">Date of Birth:</label>
    <input type="date" name="DOB" required>

    <label for="passport_expiry_date">Passport Expiry Date:</label>
    <input type="date" name="passport_expiry_date" required>

    <label for="flight_id">Flight ID:</label>
    <input type="number" name="flight_id" required>

    <button type="submit">Create Passenger</button>
</form>

function validateAddFlightForm() {
    let flightNumber = document.getElementById('flight_number').value;
    let airline = document.getElementById('airline').value;
    let origin = document.getElementById('origin').value;
    let destination = document.getElementById('destination').value;
    let departureTime = document.getElementById('departure_time').value;
    let arrivalTime = document.getElementById('arrival_time').value;

    if (flightNumber.trim() === '') {
        alert('Please enter the flight number.');
        return false;
    }

    if (airline.trim() === '') {
        alert('Please enter the airline.');
        return false;
    }

    if (origin.trim() === '') {
        alert('Please enter the origin.');
        return false;
    }

    if (destination.trim() === '') {
        alert('Please enter the destination.');
        return false;
    }

    if (departureTime.trim() === '') {
        alert('Please enter the departure time.');
        return false;
    }

    if (arrivalTime.trim() === '') {
        alert('Please enter the arrival time.');
        return false;
    }

    return true;
}

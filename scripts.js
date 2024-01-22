let temperature = 20;
let humidity = 75;
let pressure = 50;
let unit = "C";

function convertUnit() {
    document.getElementById("unit").innerHTML = "°"+unit;
    if (unit === "C") {
        unit = "F";
    }
    else if (unit === "F") {
        unit = "C";
    }
    updateReadings();
}

function updateReadings() {
    if (unit === "F") {
        temperature = farenhite_temperature;
    }
    else if (unit === "C") {
        temperature = celcius_temperature;
    }
    document.getElementById("temperature").innerHTML = temperature+`°<span>${unit}</span>`;
    document.getElementById("humidity").innerHTML = humidity+'%';
    document.getElementById("pressure").innerHTML = pressure+`hPa`;
}

async function fetchReadings() {
    let response = await fetch("/api/Readings.json");
    let readings = await response.json();
    celcius_temperature = readings.temperature;
    farenhite_temperature = celcius_temperature*9/5+32;
    humidity = readings.humidity;
    pressure = readings.pressure;
    updateReadings(unit);
}

// setInterval(fetchReadings, 1000);    // 1 second interval updates
fetchReadings();    // initial fetch

const apiKey = 'YOUR_OPENWEATHERMAP_API_KEY';
const city = 'YOUR_CITY_NAME';
const apiUrl = `https://api.openweathermap.org/data/2.5/forecast?q=${city}&appid=${apiKey}&units=metric`;

async function fetchWeatherData() {
    try {
        const response = await fetch(apiUrl);
        const data = await response.json();
        updatePage(data);
    } catch (error) {
        console.error('Error fetching weather data:', error);
    }
}

function updatePage(data) {
    const forecastContainer = document.getElementById('forecast');
    const forecasts = data.list;

    forecasts.forEach(forecast => {
        const timestamp = new Date(forecast.dt * 1000);
        const date = timestamp.toLocaleDateString();
        const time = timestamp.toLocaleTimeString();
        const temperature = forecast.main.temp;
        const description = forecast.weather[0].description;

        const forecastItem = document.createElement('div');
        forecastItem.classList.add('forecast-item');
        forecastItem.innerHTML = `
            <p>Date: ${date}</p>
            <p>Time: ${time}</p>
            <p>Temperature: ${temperature}°C</p>
            <p>Description: ${description}</p>
        `;

        forecastContainer.appendChild(forecastItem);
    });
}

fetchWeatherData();

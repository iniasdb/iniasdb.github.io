//initialize variables
var weatherIcon,
  temp,
  feelsLikeTemp,
  tempMin,
  tempMax,
  pressure,
  humidity,
  visibilityM,
  visibilityKM,
  windSpeed,
  cloudiness,
  sunriseUnix,
  sunsetUnix,
  sunrise,
  sunset,
  city,
  country;

const apiCall = async (city) => {
  var citySearch = city;
  const response = await fetch(
    "https://api.openweathermap.org/data/2.5/weather?q" +
      citySearch +
      "&units=metric&appid=a1b0b1d1ba758ad4a0971f19cc475c39"
  ); //make api call
  const myJson = await response.json(); //extract JSON from the http response

  weatherIcon = myJson.weather[0].icon;
  temp = Math.round(myJson.main.temp);
  feelsLikeTemp = Math.round(myJson.main.feels_like);
  tempMin = Math.round(myJson.main.temp_min);
  tempMax = Math.round(myJson.main.temp_max);
  pressure = myJson.main.pressure;
  humidity = myJson.main.humidity;
  visibilityM = myJson.visibility;
  visibilityKM = Math.round(((visibilityM / 1000) * 100) / 100);
  windSpeed = Math.round(myJson.wind.speed);
  cloudiness = myJson.clouds.all;
  sunriseUnix = myJson.sys.sunrise;
  sunrise = convertUnix(sunriseUnix);
  sunsetUnix = myJson.sys.sunset;
  sunset = convertUnix(sunsetUnix);
  city = myJson.name;
  country = myJson.sys.country;

  document.getElementById("location").innerHTML = city + " " + country;
  document.getElementById("temp").innerHTML = temp + "°C";
  document.getElementById("fl").innerHTML = feelsLikeTemp + "°C";
  document.getElementById("wind").innerHTML = windSpeed * 3.6 + " kph";
  document.getElementById("pressure").innerHTML = pressure + " hPa";
  document.getElementById("visibility").innerHTML = visibilityKM + " km";
  document.getElementById("humidity").innerHTML = humidity + "%";
  document.getElementById("cloudiness").innerHTML = cloudiness + "%";
  document.getElementById("sunrise").innerHTML = sunrise;
  document.getElementById("sunset").innerHTML = sunset;

  switch (weatherIcon) {
    case "01d":
      document.getElementById("bg").style.backgroundImage =
        "url('images/clear sky.png')";
      break;
    case "01n":
      document.getElementById("bg").style.backgroundImage =
        "url('images/clear sky night.png')";
      break;
    case "02d":
      document.getElementById("bg").style.backgroundImage =
        "url('images/few clouds.jpg')";
      break;
    case "02n":
      document.getElementById("bg").style.backgroundImage =
        "url('images/few clouds night.jpg')";
      break;
    case "03d":
      document.getElementById("bg").style.backgroundImage =
        "url('images/few clouds.jpg')";
      break;
    case "03n":
      document.getElementById("bg").style.backgroundImage =
        "url('images/few clouds night.jpg')";
      break;
    case "04d":
      document.getElementById("bg").style.backgroundImage =
        "url('images/broken clouds.jpg')";
      break;
    case "04n":
      document.getElementById("bg").style.backgroundImage =
        "url('images/broken clouds night.jpg')";
      break;
    case "09d":
      document.getElementById("bg").style.backgroundImage =
        "url('images/rain.jpg')";
      break;
    case "09n":
      document.getElementById("bg").style.backgroundImage =
        "url('images/rain night.jpg')";
      break;
    case "10d":
      document.getElementById("bg").style.backgroundImage =
        "url('images/rain.jpg')";
      break;
    case "10n":
      document.getElementById("bg").style.backgroundImage =
        "url('images/rain night.jpg')";
      break;
    case "11d":
      document.getElementById("bg").style.backgroundImage =
        "url('images/thunderstorm.jpg')";
      break;
    case "11n":
      document.getElementById("bg").style.backgroundImage =
        "url('images/thunderstorm night.jpg')";
      break;
    case "13d":
      document.getElementById("bg").style.backgroundImage =
        "url('images/snow.jpg')";
      break;
    case "13n":
      document.getElementById("bg").style.backgroundImage =
        "url('images/snow night.jpg')";
      break;
    case "50d":
      document.getElementById("bg").style.backgroundImage =
        "url('images/fog.jpg')";
      break;
    case "50n":
      document.getElementById("bg").style.backgroundImage =
        "url('images/fog night.jpg')";
      break;
    default:
      document.getElementById("bg").style.backgroundImage =
        "url('images/nightsky.jpg')";
  }
};

function convertUnix(timestamp) {
  //to miliseconds
  var date = new Date(timestamp * 1000);
  var hours = date.getHours();
  var minutes = "0" + date.getMinutes();
  var seconds = "0" + date.getSeconds();
  var time = hours + ":" + minutes.substr(-2) + ":" + seconds.substr(-2);

  return time;
}

function changeCity(x) {
  if (x || event.key === "Enter") {
    var value = document.getElementById("city").value;
    document.getElementById("city").value = "";
    apiCall(value);
  }
}

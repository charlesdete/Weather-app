<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=10">
        <title>Weather App</title>
        <link rel="stylesheet" href="style.css">
    </head>
    <div>

    <div class="card">
            <div class="search">

               <input type="text" placeholder="Enter city name" spellcheck="false">
                <button ><img src="images/search.png">  </button>
            </div>

        <div class="error">
            <p>Invalid city name</p>
        </div>

        <div class="weather">
            <img src="images/weather.png" class="weather-icon">
            <h1 class="temp">22°C</h1>
            <h2 class="city">Nairobi</h2>

            <div class="details">

                <div class="col">
                    <img src="images/humidity.png">
                 <div>
                    <p class="humidity">50%</p>
                    <p>Humidity</p>
                </div>
                </div>
             
                <div class="col">
                    <img src="images/wind.png">
                <div>
                    <p class="wind">15 km/hr</p>
                    <p>Wind Speed</p>
                </div>
            </div>  
        </div>
     </div>
    </div>

    <script>
        const apikey = "97573149e9ee3101e88cb1395e804682";
        const apiUrl = "https://api.openweathermap.org/data/2.5/weather?units=metric&q=";

        const searchBox = document.querySelector(".search input");
        const searchBtn = document.querySelector(".search button");
        const weatherIcon =document.querySelector(".weather-icon");

        async function checkWeather(city){
           const response = await fetch(apiUrl + city + `&appid=${apikey}`);
           
           if(response.status == 404){
            document.querySelector(".error").style.display = "block";
            document.querySelector(".weather").style.display = "none";
           }else{
            var data = await response.json();      

            document.querySelector(".city").innerHTML = data.name;
            document.querySelector(".temp").innerHTML = Math.round(data.main.temp) +  "°C" ;
            document.querySelector(".humidity").innerHTML = data.main.humidity + "%";
            document.querySelector(".wind").innerHTML = data.wind.speed + "km/hr";
     
             if (data.weather[0].main == "Clouds"){
                weatherIcon.src = "images/cloudy.png";
             }
             else if(data.weather[0].main == "Mist"){
                weatherIcon.src = "images/mist.png";
             }
             else if(data.weather[0].main == "Clear"){
                weatherIcon.src = "images/sunny.png";
             }
             else if(data.weather[0].main == "Rain"){
                weatherIcon.src = "images/rain.png";
             }

               document.querySelector(".weather").style.display ="block";
               document.querySelector(".error").style.display = "none";

           } 
           
        }

        searchBtn.addEventListener("click", ()=>{
            checkWeather(searchBox.value);

        }  )

        checkWeather(city);
    </script>
    </body>
</html>
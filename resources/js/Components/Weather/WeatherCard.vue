<template>
    <div class="list-card
    bg-white rounded-lg flex flex-col lg:row 
    items-center gap-2
    border-solid border-zinc-300 border-1 px-6 py-3
    w-full justify-between">
      <div class="texts flex flex-col lg:felx-row items-center w-full">
            <div class="flex flex-row justify-center items-center"> 
                <img class="drop-shadow-md w-12 h-12"
                v-bind:src="'https://openweathermap.org/img/wn/'+ weather_data.weather[0].icon +'.png'" alt="weather icon">
                <p class="subtitle font-semibold text-xl text-zinc-900">
                  {{ weather_data.weather[0].description[0].toUpperCase() + weather_data.weather[0].description.slice(1) }}
                </p>
            </div>
            <p class="subtitle font-semibold text-3xl text-amber-400 mb-1"> {{ Math.round(weather_data.main.temp) }}°C</p>

            <p class="subtitle font-semibold text-sm text-zinc-900"> {{ 
              Math.floor(weather_data.main.temp_min) }}°C - 
              {{ Math.round(weather_data.main.temp_max)}}°C</p>
        
      </div>
      <div class="flex justify-center w-full gap-2">

      </div>
    </div>
  </template>
  
  <script>



  export default {
    name: "WeatherCard",
    props: ["weather_data"],
    components: {

    },

    data() {
        return {
           
        };
    },

    //  https://openweathermap.org/img/wn/[iconCODE]@2x.png

    mounted() {

        
      
    },
  };
  </script>
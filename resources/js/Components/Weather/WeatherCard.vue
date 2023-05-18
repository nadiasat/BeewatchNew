<template>
    <div class="list-card
    bg-white rounded-lg flex flex-col lg:row 
    items-center gap-2
    border-solid border-zinc-300 border-1 px-6 py-3
    w-full justify-between">
      <div class="texts flex flex-col lg:felx-row items-start w-full">
        <p class="subtitle font-semibold text-xl text-zinc-900">{{ weather_data.weather[0].description }}</p>
            <div class="flex flex-row "> 
                <img
                v-bind:src="'https://openweathermap.org/img/wn/'+ weather_data.weather[0].icon +'.png'" alt="weather icon" class="w-12 h-12">
                
                <p class="subtitle font-semibold text-xl text-amber-400"> {{ Math.round(weather_data.main.temp) }}°C</p>
                <div>
                    <p class="subtitle font-semibold text-xl text-amber-400"> Max:{{ Math.round(weather_data.main.temp_max) }}°C</p>
                    <p class="subtitle font-semibold text-xl text-amber-400"> Min:{{ Math.floor(weather_data.main.temp_min) }}°C</p>
                </div>
            </div>
        
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
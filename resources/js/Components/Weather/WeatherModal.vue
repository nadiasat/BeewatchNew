<template>

    <button @click="modalShowWeather= !modalShowWeather" id="btn-weather"
    class="flex items-center rounded-xl text-sm border-2 border-zinc-900 px-2 py-2 text-zinc-900 font-semibold hover:bg-zinc-900 hover:text-white">
        <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg" class="h-4 w-4">
            <path fill-rule="evenodd" clip-rule="evenodd" d="M10.9999 7.51667C9.07613 7.51667 7.51659 9.07622 7.51659 11C7.51659 12.9238 9.07613 14.4833 10.9999 14.4833C12.9237 14.4833 14.4833 12.9238 14.4833 11C14.4833 9.07622 12.9237 7.51667 10.9999 7.51667ZM5.68326 11C5.68326 8.06369 8.06361 5.68334 10.9999 5.68334C13.9362 5.68334 16.3166 8.06369 16.3166 11C16.3166 13.9363 13.9362 16.3167 10.9999 16.3167C8.06361 16.3167 5.68326 13.9363 5.68326 11Z" fill="currentColor"/>
            <path fill-rule="evenodd" clip-rule="evenodd" d="M10.175 3.3V0.825C10.175 0.369365 10.5444 0 11 0C11.4556 0 11.825 0.369365 11.825 0.825V3.3H10.175ZM5.05009 6.21682L3.3 4.46673C2.97782 4.14454 2.97782 3.62218 3.3 3.3C3.62218 2.97782 4.14454 2.97782 4.46673 3.3L6.21682 5.05009L5.05009 6.21682ZM15.9167 5.05009L17.6667 3.3C17.9889 2.97782 18.5113 2.97782 18.8335 3.3C19.1557 3.62218 19.1557 4.14454 18.8335 4.46673L17.0834 6.21682L15.9167 5.05009ZM3.3 11.825H0.825C0.369365 11.825 0 11.4556 0 11C0 10.5444 0.369365 10.175 0.825 10.175H3.3V11.825ZM22 11C22 11.4556 21.6306 11.825 21.175 11.825H18.7V10.175H21.175C21.6306 10.175 22 10.5444 22 11ZM3.30002 18.8335C2.97784 18.5113 2.97784 17.9889 3.30002 17.6667L5.05011 15.9166L6.21684 17.0834L4.46675 18.8335C4.14456 19.1556 3.6222 19.1556 3.30002 18.8335ZM18.8335 17.6667C19.1556 17.9889 19.1556 18.5113 18.8335 18.8335C18.5113 19.1556 17.9889 19.1556 17.6667 18.8335L15.9166 17.0834L17.0834 15.9166L18.8335 17.6667ZM11 22C10.5444 22 10.175 21.6306 10.175 21.175V18.7H11.825V21.175C11.825 21.6306 11.4556 22 11 22Z" fill="currentColor"/>
        </svg> 
        <span class="ml-2">Météo</span>
    </button>    

    <div v-show="modalShowWeather" @close="modalShowWeather = false"
    class="absolute rounded-lg bg-white p-6 drop-shadow-md z-50
    top-[72px] left-0 right-0
    md:left-[152px] md:right-auto
    lg:top-[86px] lg:left-[216px]
    min-w-max">
        <div class="container">

            <WeatherCard v-if="weather!=null" :weather_data="weather"></WeatherCard>

            <div class="text-center">
                <button @click="modalShowWeather = false" class="text-red-1 font-semibold">Fermer</button>
            </div>
        </div>
    </div>

</template>

<script>
import Modal from "@/Components/Modal.vue";
import WeatherCard from "@/Components/Weather/WeatherCard.vue";


export default {
    name: "WeatherModal",
    components: {
        Modal,
        WeatherCard,
    },

    data() {
        return {
            modalShowWeather: false,
            weather: null,
            currentDate: new Date().toLocaleDateString(),
            btnWeatherPosition: {
                top: 0,
                left: 0,
            },
        };
    },

    methods: {

        callWeatherAPI(){
            const APP_KEY = import.meta.env.VITE_OPENWEATHER_API_KEY;
            const APP_COUNTRY = 'CH';
            const APP_CITY = 'Geneva';
            const APP_LANG = import.meta.env.VITE_OPENWEATHER_API_LANG;
            
            
            fetch(`https://api.openweathermap.org/data/2.5/weather?q=${APP_CITY},${APP_COUNTRY}&appid=${APP_KEY}&lang=${APP_LANG}&units=metric&cnt=5`)
                .then(response => response.json())
                .then(data => {
                    this.weather = data;
                    console.log(this.weather);
                })
                .catch((error) => {
                    console.log(error);
                });
        }
    },
        
    mounted() {
            // call openWeatherAPI with fetch if weather is null
            if (this.weather == null) {
                this.callWeatherAPI();
            }else{
                console.log(this.weather);
            }

            //get left position of button in pixels
            this.btnWeatherPosition.left = document.getElementById('btn-weather').getBoundingClientRect().left;

            console.log(this.btnWeatherPosition.left);
    },
    
}
</script>

<style scoped>

</style>

<template>
    <transition name="fade">
      <div class="w-full h-screen fixed left-0 top-0 z-20">
        <div class="bg-black-400 z-30 bg-opacity-60 overflow-hidden h-screen"
             @click="close"></div>
        <div class="w-full h-full max-h-full absolute z-40 top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2">
          <div class="bg-[#F6F5F1] relative w-full h-full overflow-y-scroll flex justify-center" style="min-height: 300px">
            <button @click="() => {close()}" class="
                items-center gap-2 absolute 
                right-5 lg:right-12 top-6 
                rounded-full text-lg 
                flex flex-row
                font-medium hover:opacity-70">
                Fermer
                <svg stroke="#18181b" fill="#18181b" width="24" height="24" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
            <div id="tile-container" 
            class="pt-[10vh] pb-[10vh] 
            grid grid-cols-2 lg:grid-cols-3
            auto-rows-min
            auto-cols-min gap-4"
            v-show="showTileContainer">

                <h2 class="text-center text-2xl font-bold col-span-3 pb-8">Nouvelle intervention</h2>

                <button v-if="hive.is_active" @click="deactivateHive()" class="items-center justify-center col-span-3 flex flex-row gap-1 text-lg font-medium bg-[#AFAC99] rounded-lg hover:opacity-70">
                    <svg width="80" height="80" viewBox="0 0 80 80" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-10">
                        <path d="M39.4991 76.7488C36.2005 74.1782 30.9909 68.6304 28.1103 60.936C28.8773 61.076 29.8558 61.2463 30.9475 61.4166C33.522 61.8182 36.7794 62.2289 39.3747 62.2289C41.9701 62.2289 45.2275 61.8182 47.802 61.4166C48.895 61.2461 49.8747 61.0756 50.6421 60.9355C47.7827 68.6416 42.764 74.1864 39.4991 76.7488ZM51.3705 58.7634C51.1803 58.8004 50.9472 58.8449 50.6776 58.8952C49.88 59.0439 48.7645 59.2422 47.4937 59.4405C44.9376 59.8392 41.8074 60.2289 39.3747 60.2289C36.9421 60.2289 33.8119 59.8392 31.2558 59.4405C29.985 59.2422 28.8695 59.0439 28.0719 58.8952C27.8023 58.8449 27.5692 58.8004 27.379 58.7634C26.6042 56.1787 26.0975 53.387 25.9894 50.4148C26.0756 50.4293 26.1658 50.4443 26.2598 50.4598C27.1747 50.6109 28.4538 50.8124 29.9115 51.014C32.8138 51.4153 36.4721 51.8238 39.3747 51.8238C42.2774 51.8238 45.9357 51.4153 48.838 51.014C50.2957 50.8124 51.5748 50.6109 52.4897 50.4598C52.5837 50.4443 52.6739 50.4293 52.7601 50.4148C52.652 53.387 52.1453 56.1787 51.3705 58.7634ZM52.7751 48.384C52.5963 48.4144 52.3915 48.4489 52.1637 48.4865C51.2619 48.6355 50.0006 48.8342 48.5641 49.0329C45.6782 49.4319 42.133 49.8238 39.3747 49.8238C36.6165 49.8238 33.0713 49.4319 30.1854 49.0329C28.7489 48.8342 27.4876 48.6355 26.5858 48.4865C26.3585 48.449 26.1541 48.4146 25.9756 48.3842C26.0325 45.3621 26.3962 42.8495 26.9541 40.7707C27.0909 40.7959 27.2415 40.8234 27.4046 40.8528C28.2452 41.0041 29.4204 41.2059 30.76 41.4077C33.4251 41.8092 36.7931 42.2192 39.4731 42.2192C42.1532 42.2192 45.5212 41.8092 48.1863 41.4077C49.5259 41.2059 50.7011 41.0041 51.5417 40.8528C51.6895 40.8261 51.827 40.8011 51.9532 40.7778C52.4223 42.8603 52.7273 45.3713 52.7751 48.384ZM51.4345 38.8396C51.3558 38.854 51.2733 38.8689 51.1873 38.8844C50.3609 39.0332 49.205 39.2316 47.8884 39.43C45.2411 39.8289 41.996 40.2192 39.4731 40.2192C36.9503 40.2192 33.7052 39.8289 31.0579 39.43C29.7413 39.2316 28.5854 39.0332 27.759 38.8844C27.6926 38.8725 27.6283 38.8608 27.5663 38.8495C29.6554 33.2623 33.2567 31.5778 35.2375 31.4142C36.0374 31.674 36.8902 31.8141 37.774 31.8141H42.5763C43.4567 31.8141 44.3065 31.6751 45.1038 31.4171C46.6447 31.5914 49.6655 33.2067 51.4345 38.8396Z" fill="#F1B60F" stroke="#18181b" stroke-width="2"/>
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M28.0211 2.68404C28.1957 2.1601 28.762 1.87694 29.286 2.05159C34.0205 3.62975 36.6052 8.28416 37.8053 10.4451C37.8183 10.4686 37.8312 10.4918 37.8439 10.5146C38.1121 10.9974 37.9382 11.6062 37.4554 11.8744C36.9726 12.1426 36.3638 11.9687 36.0956 11.4859C34.8542 9.25133 32.5949 5.26276 28.6535 3.94895C28.1296 3.77431 27.8464 3.20799 28.0211 2.68404Z" fill="black"/>
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M51.5287 2.68404C51.3541 2.1601 50.7878 1.87694 50.2638 2.05159C45.5293 3.62975 42.9446 8.28416 41.7445 10.4451C41.7315 10.4686 41.7186 10.4918 41.7059 10.5146C41.4377 10.9974 41.6116 11.6062 42.0944 11.8744C42.5772 12.1426 43.186 11.9687 43.4542 11.4859C44.6956 9.25133 46.9549 5.26276 50.8963 3.94895C51.4202 3.77431 51.7034 3.20799 51.5287 2.68404Z" fill="black"/>
                        <path d="M67.1353 63.2691C64.9142 64.5515 62.0476 64.4531 59.1166 63.0477C56.191 61.6448 53.3043 58.9759 51.2063 55.342C50.1982 53.5959 49.4539 51.1251 48.9307 48.2185C48.4101 45.3271 48.1204 42.0759 47.9824 38.8155C47.7493 33.305 47.952 27.8223 48.1852 24.1051C51.3099 26.5777 54.9882 29.8701 58.439 33.3886C62.4562 37.4847 66.1116 41.8332 68.2347 45.5106C70.3327 49.1445 71.2008 52.9789 70.9529 56.214C70.7045 59.455 69.3564 61.9868 67.1353 63.2691Z" fill="white" stroke="#18181b" stroke-width="2"/>
                        <path d="M12.8803 63.2691C15.1014 64.5515 17.9681 64.4531 20.899 63.0477C23.8247 61.6448 26.7113 58.9759 28.8093 55.342C29.8175 53.5959 30.5617 51.1251 31.085 48.2185C31.6055 45.3271 31.8953 42.0759 32.0332 38.8155C32.2663 33.305 32.0636 27.8223 31.8304 24.1051C28.7057 26.5777 25.0274 29.8701 21.5767 33.3886C17.5594 37.4847 13.9041 41.8332 11.7809 45.5106C9.68289 49.1445 8.81485 52.9789 9.06276 56.214C9.3111 59.455 10.6592 61.9868 12.8803 63.2691Z" fill="white" stroke="#18181b" stroke-width="2"/>
                        <path d="M33.0002 20.0836L33.0002 16.9169C33.0002 13.1068 36.1244 10.0002 40.0002 10.0002C43.8761 10.0002 47.0002 13.1068 47.0002 16.9169V20.0836C47.0002 23.8937 43.8761 27.0002 40.0002 27.0002C36.1244 27.0002 33.0002 23.8937 33.0002 20.0836Z" fill="#F1B60F" stroke="#18181b" stroke-width="2"/>
                        <path d="M37.3733 19.0081H42.976C47.0218 19.0081 50.3801 22.4578 50.3801 26.8123C50.3801 30.2377 48.2923 33.118 45.4301 34.1778C44.6629 34.4619 43.8375 34.6166 42.976 34.6166H37.3733C36.5119 34.6166 35.6864 34.4619 34.9192 34.1778C32.057 33.118 29.9692 30.2377 29.9692 26.8123C29.9692 22.4578 33.3275 19.0081 37.3733 19.0081Z" fill="white" stroke="#18181b" stroke-width="2"/>
                    </svg>
                    Désactiver la ruche
                </button>

                <button v-else @click="{showQueenForm = true; showTileContainer = false;}" class="items-center justify-center col-span-3 flex flex-row gap-1 text-lg font-medium bg-amber-400 rounded-lg hover:opacity-70">
                    <svg width="80" height="80" viewBox="0 0 80 80" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-10">
                        <path d="M39.4991 76.7488C36.2005 74.1782 30.9909 68.6304 28.1103 60.936C28.8773 61.076 29.8558 61.2463 30.9475 61.4166C33.522 61.8182 36.7794 62.2289 39.3747 62.2289C41.9701 62.2289 45.2275 61.8182 47.802 61.4166C48.895 61.2461 49.8747 61.0756 50.6421 60.9355C47.7827 68.6416 42.764 74.1864 39.4991 76.7488ZM51.3705 58.7634C51.1803 58.8004 50.9472 58.8449 50.6776 58.8952C49.88 59.0439 48.7645 59.2422 47.4937 59.4405C44.9376 59.8392 41.8074 60.2289 39.3747 60.2289C36.9421 60.2289 33.8119 59.8392 31.2558 59.4405C29.985 59.2422 28.8695 59.0439 28.0719 58.8952C27.8023 58.8449 27.5692 58.8004 27.379 58.7634C26.6042 56.1787 26.0975 53.387 25.9894 50.4148C26.0756 50.4293 26.1658 50.4443 26.2598 50.4598C27.1747 50.6109 28.4538 50.8124 29.9115 51.014C32.8138 51.4153 36.4721 51.8238 39.3747 51.8238C42.2774 51.8238 45.9357 51.4153 48.838 51.014C50.2957 50.8124 51.5748 50.6109 52.4897 50.4598C52.5837 50.4443 52.6739 50.4293 52.7601 50.4148C52.652 53.387 52.1453 56.1787 51.3705 58.7634ZM52.7751 48.384C52.5963 48.4144 52.3915 48.4489 52.1637 48.4865C51.2619 48.6355 50.0006 48.8342 48.5641 49.0329C45.6782 49.4319 42.133 49.8238 39.3747 49.8238C36.6165 49.8238 33.0713 49.4319 30.1854 49.0329C28.7489 48.8342 27.4876 48.6355 26.5858 48.4865C26.3585 48.449 26.1541 48.4146 25.9756 48.3842C26.0325 45.3621 26.3962 42.8495 26.9541 40.7707C27.0909 40.7959 27.2415 40.8234 27.4046 40.8528C28.2452 41.0041 29.4204 41.2059 30.76 41.4077C33.4251 41.8092 36.7931 42.2192 39.4731 42.2192C42.1532 42.2192 45.5212 41.8092 48.1863 41.4077C49.5259 41.2059 50.7011 41.0041 51.5417 40.8528C51.6895 40.8261 51.827 40.8011 51.9532 40.7778C52.4223 42.8603 52.7273 45.3713 52.7751 48.384ZM51.4345 38.8396C51.3558 38.854 51.2733 38.8689 51.1873 38.8844C50.3609 39.0332 49.205 39.2316 47.8884 39.43C45.2411 39.8289 41.996 40.2192 39.4731 40.2192C36.9503 40.2192 33.7052 39.8289 31.0579 39.43C29.7413 39.2316 28.5854 39.0332 27.759 38.8844C27.6926 38.8725 27.6283 38.8608 27.5663 38.8495C29.6554 33.2623 33.2567 31.5778 35.2375 31.4142C36.0374 31.674 36.8902 31.8141 37.774 31.8141H42.5763C43.4567 31.8141 44.3065 31.6751 45.1038 31.4171C46.6447 31.5914 49.6655 33.2067 51.4345 38.8396Z" fill="#F1B60F" stroke="#18181b" stroke-width="2"/>
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M28.0211 2.68404C28.1957 2.1601 28.762 1.87694 29.286 2.05159C34.0205 3.62975 36.6052 8.28416 37.8053 10.4451C37.8183 10.4686 37.8312 10.4918 37.8439 10.5146C38.1121 10.9974 37.9382 11.6062 37.4554 11.8744C36.9726 12.1426 36.3638 11.9687 36.0956 11.4859C34.8542 9.25133 32.5949 5.26276 28.6535 3.94895C28.1296 3.77431 27.8464 3.20799 28.0211 2.68404Z" fill="black"/>
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M51.5287 2.68404C51.3541 2.1601 50.7878 1.87694 50.2638 2.05159C45.5293 3.62975 42.9446 8.28416 41.7445 10.4451C41.7315 10.4686 41.7186 10.4918 41.7059 10.5146C41.4377 10.9974 41.6116 11.6062 42.0944 11.8744C42.5772 12.1426 43.186 11.9687 43.4542 11.4859C44.6956 9.25133 46.9549 5.26276 50.8963 3.94895C51.4202 3.77431 51.7034 3.20799 51.5287 2.68404Z" fill="black"/>
                        <path d="M67.1353 63.2691C64.9142 64.5515 62.0476 64.4531 59.1166 63.0477C56.191 61.6448 53.3043 58.9759 51.2063 55.342C50.1982 53.5959 49.4539 51.1251 48.9307 48.2185C48.4101 45.3271 48.1204 42.0759 47.9824 38.8155C47.7493 33.305 47.952 27.8223 48.1852 24.1051C51.3099 26.5777 54.9882 29.8701 58.439 33.3886C62.4562 37.4847 66.1116 41.8332 68.2347 45.5106C70.3327 49.1445 71.2008 52.9789 70.9529 56.214C70.7045 59.455 69.3564 61.9868 67.1353 63.2691Z" fill="white" stroke="#18181b" stroke-width="2"/>
                        <path d="M12.8803 63.2691C15.1014 64.5515 17.9681 64.4531 20.899 63.0477C23.8247 61.6448 26.7113 58.9759 28.8093 55.342C29.8175 53.5959 30.5617 51.1251 31.085 48.2185C31.6055 45.3271 31.8953 42.0759 32.0332 38.8155C32.2663 33.305 32.0636 27.8223 31.8304 24.1051C28.7057 26.5777 25.0274 29.8701 21.5767 33.3886C17.5594 37.4847 13.9041 41.8332 11.7809 45.5106C9.68289 49.1445 8.81485 52.9789 9.06276 56.214C9.3111 59.455 10.6592 61.9868 12.8803 63.2691Z" fill="white" stroke="#18181b" stroke-width="2"/>
                        <path d="M33.0002 20.0836L33.0002 16.9169C33.0002 13.1068 36.1244 10.0002 40.0002 10.0002C43.8761 10.0002 47.0002 13.1068 47.0002 16.9169V20.0836C47.0002 23.8937 43.8761 27.0002 40.0002 27.0002C36.1244 27.0002 33.0002 23.8937 33.0002 20.0836Z" fill="#F1B60F" stroke="#18181b" stroke-width="2"/>
                        <path d="M37.3733 19.0081H42.976C47.0218 19.0081 50.3801 22.4578 50.3801 26.8123C50.3801 30.2377 48.2923 33.118 45.4301 34.1778C44.6629 34.4619 43.8375 34.6166 42.976 34.6166H37.3733C36.5119 34.6166 35.6864 34.4619 34.9192 34.1778C32.057 33.118 29.9692 30.2377 29.9692 26.8123C29.9692 22.4578 33.3275 19.0081 37.3733 19.0081Z" fill="white" stroke="#18181b" stroke-width="2"/>
                    </svg>
                    Relancer la ruche
                </button>

                <div id="tile-control" 
                class="tile-intervention 
                p-6 flex flex-col gap-4 items-center 
                rounded-xl w-40 h-40 
                hover:opacity-60 cursor-pointer"
                :class="[hive.is_active ? 'bg-amber-400' : 'bg-[#AFAC99]']"
                @click="()=>{showControlForm = true; showTileContainer = false;}">
                    <svg width="80" height="80" viewBox="0 0 80 80" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <rect x="12" y="6" width="56" height="71" rx="5" fill="white" stroke="black" stroke-width="2"/>
                        <path d="M22 20L59 20" stroke="black" stroke-width="2" stroke-linecap="round"/>
                        <path d="M22 32L59 32" stroke="black" stroke-width="2" stroke-linecap="round"/>
                        <path d="M22 45L59 45" stroke="black" stroke-width="2" stroke-linecap="round"/>
                        <path d="M59 57L50.1579 66L45 60.75" stroke="#18181b" stroke-width="2" stroke-linecap="round"/>
                        <rect x="21" y="3" width="38" height="6" rx="2" fill="#F1B60F" stroke="black" stroke-width="2"/>
                    </svg>

                    <p>Contrôle</p>
                </div>

                <div id="tile-material" 
                class="tile-intervention
                p-6 flex flex-col gap-4 items-center 
                rounded-xl w-40 h-40 
                hover:opacity-60  cursor-pointer"
                :class="[hive.is_active ? 'bg-amber-400' : 'bg-[#AFAC99]']"
                @click="()=>{showMaterialForm = true; showTileContainer = false;}">
                    <svg width="80" height="80" viewBox="0 0 80 80" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <g clip-path="url(#clip0_306_31)">
                            <path d="M72.9999 78H49.8258H26.6516C23.3379 78 20.6516 75.3137 20.6516 72V56.5361V35.0722H78.9999V56.5361V72C78.9999 75.3137 76.3136 78 72.9999 78Z" fill="white"/>
                            <path d="M20.6516 56.5361V35.0722H78.9999V56.5361M20.6516 56.5361V72C20.6516 75.3137 23.3379 78 26.6516 78H49.8258H72.9999C76.3136 78 78.9999 75.3137 78.9999 72V56.5361M20.6516 56.5361H78.9999" stroke="#18181b" stroke-width="2"/>
                            <path d="M63.9178 2.4327L35.3081 3.50968C34.9739 3.52227 34.6483 3.62057 34.3619 3.79537L9.84861 18.7573L14.0637 33.0444L68.1329 16.7199L63.9178 2.4327Z" fill="#F1B60F"/>
                            <path d="M63.902 2.37905L63.9178 2.4327M63.9178 2.4327L35.3081 3.50968C34.9739 3.52227 34.6483 3.62057 34.3619 3.79537L9.84861 18.7573M63.9178 2.4327L75.4122 2M63.9178 2.4327L68.1329 16.7199L14.0637 33.0444L9.84861 18.7573M9.83279 18.7036L9.84861 18.7573M9.84861 18.7573L0 24.7685" stroke="#18181b" stroke-width="2"/>
                        </g>
                        <defs>
                            <clipPath id="clip0_306_31">
                                <rect width="80" height="80" fill="white"/>
                            </clipPath>
                        </defs>
                    </svg>

                    <p>Matériel</p>
                </div>

            
            </div>

            <!-- CONTROL FORM -->
            <div id="control-form-container" 
            class="pt-[10vh] pb-[10vh] w-[90vw] lg:w-[35vw]"
            v-show="showControlForm">
                <h2 class="text-center text-2xl font-bold pb-8 text-zinc-900">Formulaire de contrôle</h2>
                <form id="control-form" @submit.prevent="newControl()" class="mx-8">
                    <BreezeLabel value="Avez-vous aperçu la reine ?" class=" font-bold text-base mt-4 lg:mt-0 text-zinc-900 "/>
                    <!-- make 2 radio buttons yes or no -->
                    <div class="flex items-center gap-4 mt-1">
                        <label for="yes_glimpse">
                            <input class="border-zinc-300 checked:bg-amber-400 checked:hover:bg-amber-400 focus:bg-amber-400 focus:outline-none focus:ring-1 focus:ring-amber-400 checked:focus:bg-amber-400 checked:active:bg-amber-400 shadow-sm mr-1" 
                            v-model="createControlForm.glimpse_queen" type="radio" id="yes_glimpse" name="glimpse_queen" value="true" >
                            Oui
                        </label>
                        <label for="no_glimpse">
                            <input class="border-zinc-300 checked:bg-amber-400 checked:hover:bg-amber-400 focus:bg-amber-400 focus:outline-none focus:ring-1 focus:ring-amber-400 checked:focus:bg-amber-400 checked:active:bg-amber-400 shadow-sm mr-1" 
                            v-model="createControlForm.glimpse_queen" type="radio" id="no_glimpse" name="glimpse_queen" value="false">
                            Non
                        </label>
                    </div>

                    <BreezeLabel value="La reine a-t-elle pondu ?" class="font-bold text-base mt-4 lg:mt-0 text-zinc-900"/>
                    <div class="flex items-center gap-4 mt-1">
                        <label for="yes_laid">
                            <input class="border-zinc-300 checked:bg-amber-400 checked:hover:bg-amber-400 focus:bg-amber-400 focus:outline-none focus:ring-1 focus:ring-amber-400 checked:focus:bg-amber-400 checked:active:bg-amber-400 shadow-sm mr-1" 
                            v-model="createControlForm.queen_laid" type="radio" id="yes_laid" name="queen_laid" value="true" >
                            Oui
                        </label>
                        <label for="no_laid">
                            <input class="border-zinc-300 checked:bg-amber-400 checked:hover:bg-amber-400 focus:bg-amber-400 focus:outline-none focus:ring-1 focus:ring-amber-400 checked:focus:bg-amber-400 checked:active:bg-amber-400 shadow-sm mr-1" 
                            v-model="createControlForm.queen_laid" type="radio" id="no_laid" name="queen_laid" value="false">
                            Non
                        </label>
                    </div>
                    
                    <BreezeLabel value="Y a-t-il du couvain ?" class="font-bold text-base mt-4 lg:mt-0 text-zinc-900" />
                    <div class="flex items-center gap-4 mt-1">
                        <label for="yes_brood">
                            <input class="border-zinc-300 checked:bg-amber-400 checked:hover:bg-amber-400 focus:bg-amber-400 focus:outline-none focus:ring-1 focus:ring-amber-400 checked:focus:bg-amber-400 checked:active:bg-amber-400 shadow-sm mr-1" 
                            v-model="createControlForm.brood" type="radio" id="yes_brood" name="brood" value="true" >
                            Oui
                        </label>
                        <label for="no_brood">
                            <input class="border-zinc-300 checked:bg-amber-400 checked:hover:bg-amber-400 focus:bg-amber-400 focus:outline-none focus:ring-1 focus:ring-amber-400 checked:focus:bg-amber-400 checked:active:bg-amber-400 shadow-sm mr-1" 
                            v-model="createControlForm.brood" type="radio" id="no_brood" name="brood" value="false">
                            Non
                        </label>
                    </div>

                    <BreezeLabel value="Les cadres sont-ils pleins ?" class="font-bold text-base mt-4 lg:mt-0 text-zinc-900"/>
                    <div class="flex items-center gap-4 mt-1">
                        <label for="yes_frames">
                            <input class="border-zinc-300 checked:bg-amber-400 checked:hover:bg-amber-400 focus:bg-amber-400 focus:outline-none focus:ring-1 focus:ring-amber-400 checked:focus:bg-amber-400 checked:active:bg-amber-400 shadow-sm mr-1" 
                            v-model="createControlForm.frames_full" type="radio" id="yes_frames" name="frames_full" value="true" >
                            Oui
                        </label>
                        <label for="no_frames">
                            <input class="border-zinc-300 checked:bg-amber-400 checked:hover:bg-amber-400 focus:bg-amber-400 focus:outline-none focus:ring-1 focus:ring-amber-400 checked:focus:bg-amber-400 checked:active:bg-amber-400 shadow-sm mr-1" 
                            v-model="createControlForm.frames_full" type="radio" id="no_frames" name="frames_full" value="false">
                            Non
                        </label>
                    </div>

                    <BreezeLabel value="Y a-t-il du miel ?" class="font-bold text-base mt-4 lg:mt-0 text-zinc-900"/>
                    <div class="flex items-center gap-4 mt-1">
                        <label for="yes_honey">
                            <input class="border-zinc-300 checked:bg-amber-400 checked:hover:bg-amber-400 focus:bg-amber-400 focus:outline-none focus:ring-1 focus:ring-amber-400 checked:focus:bg-amber-400 checked:active:bg-amber-400 shadow-sm mr-1" 
                            v-model="createControlForm.honey" type="radio" id="yes_honey" name="honey" value="true" >
                            Oui
                        </label>
                        <label for="no_honey">
                            <input class="border-zinc-300 checked:bg-amber-400 checked:hover:bg-amber-400 focus:bg-amber-400 focus:outline-none focus:ring-1 focus:ring-amber-400 checked:focus:bg-amber-400 checked:active:bg-amber-400 shadow-sm mr-1" 
                            v-model="createControlForm.honey" type="radio" id="no_honey" name="honey" value="false">
                            Non
                        </label>
                    </div>

                    <BreezeLabel value="Y a-t-il du miel sur les cadres de la hausse ?" class="font-bold text-base mt-4 lg:mt-0 text-zinc-900"/>
                    <div class="flex items-center gap-4 mt-1">
                        <label for="yes_honey_rise">
                            <input class="border-zinc-300 checked:bg-amber-400 checked:hover:bg-amber-400 focus:bg-amber-400 focus:outline-none focus:ring-1 focus:ring-amber-400 checked:focus:bg-amber-400 checked:active:bg-amber-400 shadow-sm mr-1" 
                            v-model="createControlForm.honey_rise" type="radio" id="yes_honey_rise" name="honey_rise" value="true" >
                            Oui
                        </label>
                        <label for="no_honey_rise">
                            <input class="border-zinc-300 checked:bg-amber-400 checked:hover:bg-amber-400 focus:bg-amber-400 focus:outline-none focus:ring-1 focus:ring-amber-400 checked:focus:bg-amber-400 checked:active:bg-amber-400 shadow-sm mr-1" 
                            v-model="createControlForm.honey_rise" type="radio" id="no_honey_rise" name="honey_rise" value="false">
                            Non
                        </label>
                    </div>
                    
                    <BreezeLabel for="nb_varroa" value="Nombre de varroas" class=" font-bold text-base mt-4 lg:mt-0 text-zinc-900 "/>
                    <BreezeInput v-model="createControlForm.nb_varroa" placeholder="25" id="nb_varroa" type="number" min="0" max="500"
                                class="mt-1 block w-full"/>

                    <BreezeLabel for="comment" value="Commentaire supllémentaire" class="font-bold text-base mt-4 lg:mt-0 text-zinc-900"/>
                    <textarea v-model="createControlForm.comment"
                    id="comment"
                    class="mt-1 block w-full
                    border-zinc-300 
                    focus:border-amber-400 focus:ring-amber-400 
                    rounded-md shadow-sm"
                    rows="5" />
                    
                    
                    <button type="submit" :class="{ 'opacity-25': createControlForm.processing }"
                    :disabled="createControlForm.processing"
                    class="mb-4 mt-8 bg-amber-400 border-amber-400 text-black font-semibold border-4 py-2 w-full hover:bg-amber-300 hover:border-amber-300">
                    Confirmer
                    </button>

                </form>
                
                <div class="text-center h-20">
                        <button @click="() => {showControlForm = false; showTileContainer = true;}" class="text-red-1 font-semibold">Annuler</button>
                </div>
            </div>

            <!-- MATERIAL FORM -->
            <div id="material-form-container" 
            class="pt-[10vh] pb-[10vh] w-[90vw] lg:w-[35vw]"
            v-show="showMaterialForm" 
            >
                <h2 class="text-center text-2xl font-bold pb-8">Modification du matériel</h2>
                <form id="material-form" @submit.prevent="updateMaterial()">
                    <BreezeLabel value="Hausse" class="font-bold text-base mt-4 lg:mt-0 text-zinc-900"/>
                    <!-- make 2 radio buttons yes or no -->
                    <div class="flex items-center gap-4 mt-1">
                        <label for="yes">
                            <input class="border-zinc-300 checked:bg-amber-400 checked:hover:bg-amber-400 focus:bg-amber-400 focus:outline-none focus:ring-1 focus:ring-amber-400 checked:focus:bg-amber-400 checked:active:bg-amber-400 shadow-sm mr-1" 
                            v-model="updateMaterialForm.rise" type="radio" id="yes" name="rise" value="true" :checked="updateMaterialForm.rise === 1">
                            Oui
                        </label>
                        <label for="no">
                            <input class="border-zinc-300 checked:bg-amber-400 checked:hover:bg-amber-400 focus:bg-amber-400 focus:outline-none focus:ring-1 focus:ring-amber-400 checked:focus:bg-amber-400 checked:active:bg-amber-400 shadow-sm mr-1" 
                            v-model="updateMaterialForm.rise" type="radio" id="no" name="rise" value="false"
                             :checked="updateMaterialForm.rise === 0">
                            Non
                        </label>
                    </div>


                    <BreezeLabel for="nb_frames" value="Nombre de cadres" class="font-bold text-base mt-4 lg:mt-0 text-zinc-900"/>
                    <BreezeInput v-model="updateMaterialForm.nb_frames" placeholder="5" id="nb_frames" type="number" min="0" max="12"
                        class="mt-1 block w-full"/>

                    <button type="submit" :class="{ 'opacity-25': updateMaterialForm.processing }"
                    :disabled="updateMaterialForm.processing"
                    class="mb-4 mt-8 bg-amber-400 border-amber-400 text-black font-semibold border-4 py-2 w-full hover:bg-amber-300 hover:border-amber-300">
                    Confirmer
                    </button>

                    
                </form>
                <div class="text-center">
                        <button @click="() => {showMaterialForm = false; showTileContainer = true;}" class="text-red-1 font-semibold">Annuler</button>
                </div>
            </div>

            <!-- QUEEN FORM -->
            <div id="queen-form-container" 
            class="pt-[10vh] pb-[10vh] w-[90vw] lg:w-[35vw]"
            v-show="showQueenForm">
                <h2 class="text-center text-2xl font-bold pb-8">Relancer la ruche</h2>
                <form id="queen-form" @submit.prevent="activateHive()">
                    <BreezeLabel for="date_queen" value="Date de la reine" class="font-bold text-base mt-4 lg:mt-0 text-zinc-900"/>
                    <BreezeInput v-model="updateQueenForm.date_queen" id="date_queen" type="date"
                        class="mt-1 block w-full"/>

                    <BreezeLabel for="color_queen" value="Couleur de la reine" class="font-bold text-base mt-4 lg:mt-0 text-zinc-900"/>

                    <select v-model="updateQueenForm.color_queen" 
                    id="color_queen" 
                    class="mt-1 block w-full border-zinc-300 
                    focus:border-amber-400 focus:ring-amber-400 
                    rounded-md shadow-sm" required>
                        <option value="#FF0000">Rouge</option>
                        <option value="#FFFF00">Jaune</option>
                        <option value="#008000">Vert</option>
                        <option value="#0000FF">Bleu</option>
                        <option value="#EE82EE">Violet</option>
                    </select>

                    <BreezeLabel value="Hausse" class=" font-bold text-base mt-4 lg:mt-0 text-zinc-900 "/>
                    
                    <div class="flex items-center gap-4">
                        <label for="yes">
                            <input class="border-zinc-300 checked:bg-amber-400 checked:hover:bg-amber-400 focus:bg-amber-400 focus:outline-none focus:ring-1 focus:ring-amber-400 checked:focus:bg-amber-400 checked:active:bg-amber-400 shadow-sm mr-1" 
                            v-model="updateQueenForm.rise" type="radio" id="yes" name="rise" value="true">
                            Oui
                        </label>
                        <label for="no">
                            <input class="border-zinc-300 checked:bg-amber-400 checked:hover:bg-amber-400 focus:bg-amber-400 focus:outline-none focus:ring-1 focus:ring-amber-400 checked:focus:bg-amber-400 checked:active:bg-amber-400 shadow-sm mr-1" 
                            v-model="updateQueenForm.rise" type="radio" id="no" name="rise" value="false">
                            Non
                        </label>
                    </div>

                    <BreezeLabel for="nb_frames" value="Nombre de cadres" class=" font-bold text-base mt-4 lg:mt-0 text-zinc-900 " />
                    <BreezeInput v-model="updateQueenForm.nb_frames" placeholder="5" id="nb_frames" type="number" min="0" max="12"
                        class="mt-1 block w-full"/>

                    <button type="submit" :class="{ 'opacity-25': updateQueenForm.processing }"
                    :disabled="updateQueenForm.processing"
                    class="mb-4 mt-8 bg-amber-400 border-amber-400 text-black font-semibold border-4 py-2 w-full hover:bg-amber-300 hover:border-amber-300">
                    Confirmer
                    </button>
                </form>
                <div class="text-center">
                    <button @click="() => {showQueenForm = false; showTileContainer = true;}" class="text-red-1 font-semibold">Annuler</button>
                </div>
            </div>
          </div>
        </div>
      </div>
    </transition>
  </template>
  
  <script>

    import { useForm } from "@inertiajs/inertia-vue3";
    import BreezeLabel from "@/Components/InputLabel.vue";
    import BreezeInput from "@/Components/TextInput.vue";
    import Swal from "sweetalert2";
  
    export default {
        emits: ['close'],
        props: ['hive'],
        data(props) {
            return {
                showTileContainer: true,
                showControlForm: false,
                showMaterialForm: false,
                showQueenForm: false,
                
                createControlForm: useForm({
                    hive_id: props.hive.id,
                    glimpse_queen: null,
                    queen_laid: null,
                    brood: null,
                    frames_full: null,
                    honey: null,
                    honey_rise: null,
                    nb_varroa: props.hive.nb_varroa,
                    comment: null,
                }),

                updateMaterialForm: useForm({
                    rise: props.hive.rise,
                    nb_frames: props.hive.nb_frames,
                }),

                updateQueenForm: useForm({
                    date_queen: null,
                    color_queen: null,
                    rise: false,
                    nb_frames: null,
                }),
            }
        },
        methods: {
            close() {
                this.$emit('close');
                this.showTileContainer = true;
                this.showControlForm = false;
                this.showMaterialForm = false;
                this.showQueenForm = false;

                this.createControlForm.reset();
                this.updateQueenForm.reset();

            },

            updateMaterial() {
                this.updateMaterialForm.rise = this.updateMaterialForm.rise === 'true' ? 1 : 0;
                console.log(this.updateMaterialForm.rise);
                this.updateMaterialForm.put(route('hive.updateMaterial', [this.hive.id, this.hive.apiary_id]), {
                    preserveScroll: true,
                    preserveState: false,
                    onSuccess: () => {
                        this.showMaterialForm = false;
                        this.showTileContainer = true;
                        Swal.fire({
                            title: 'Succès',
                            text: 'Le matériel a bien été modifié',
                            icon: 'success',
                            confirmButtonText: 'Ok',
                        });
                    },
                });
            },
            deactivateHive() {
                Swal.fire({
                    title: 'Êtes-vous sûr ?',
                    text: "Vous ne pourrez pas revenir en arrière !",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Oui, désactiver !'
                }).then((result) => {
                    if (result.isConfirmed) {
                        this.updateQueenForm.put(route('hive.deactivateHive', [this.hive.id, this.hive.apiary_id]), {
                            preserveScroll: true,
                            preserveState: false,
                            onSuccess: () => {
                                Swal.fire(
                                    'Désactivé !',
                                    'La ruche a bien été désactivée.',
                                    'success'
                                );
                                this.close();
                            },
                        });
                    }
                })
            },
            activateHive() {
                this.updateQueenForm.rise = this.updateQueenForm.rise === 'true' ? 1 : 0;
                console.log(this.updateQueenForm);
                this.updateQueenForm.put(route('hive.activateHive', [this.hive.id, this.hive.apiary_id]), {
                    preserveScroll: true,
                    preserveState: false,
                    onSuccess: () => {
                        this.showQueenForm = false;
                        this.showTileContainer = true;
                        Swal.fire(
                            'Activé !',
                            'La ruche a bien été activée.',
                            'success'
                        );
                        this.close();
                    },
                });
            },
            newControl() {
                //convert boolean to int if not null
                if (this.createControlForm.glimpse_queen !== null) {
                    this.createControlForm.glimpse_queen = this.createControlForm.glimpse_queen === 'true' ? 1 : 0;
                }

                if (this.createControlForm.queen_laid !== null) {
                    this.createControlForm.queen_laid = this.createControlForm.queen_laid === 'true' ? 1 : 0;
                }

                if (this.createControlForm.brood !== null) {
                    this.createControlForm.brood = this.createControlForm.brood === 'true' ? 1 : 0;
                }

                if (this.createControlForm.frames_full !== null) {
                    this.createControlForm.frames_full = this.createControlForm.frames_full === 'true' ? 1 : 0;
                }

                if (this.createControlForm.honey !== null) {
                    this.createControlForm.honey = this.createControlForm.honey === 'true' ? 1 : 0;
                }

                if (this.createControlForm.honey_rise !== null) {
                    this.createControlForm.honey_rise = this.createControlForm.honey_rise === 'true' ? 1 : 0;
                }


                this.createControlForm.post(route('interventionControl.store'), {
                    preserveScroll: true,
                    preserveState: false,
                    onSuccess: () => {
                        this.showControlForm = false;
                        this.showTileContainer = true;
                        Swal.fire({
                            title: 'Succès',
                            text: 'Le contrôle a bien été ajouté',
                            icon: 'success',
                            confirmButtonText: 'Ok',
                        });
                    },
                });
            }
        },
        components: {
            BreezeLabel,
            BreezeInput,
        }
  }
  </script>
  
  <style scoped>
  .fade-enter-active,
  .fade-leave-active {
    transition: opacity 0.3s ease;
  }
  
  .fade-enter-from,
  .fade-leave-to {
    opacity: 0;
  }
  </style>
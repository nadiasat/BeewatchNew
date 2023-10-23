<template>


    <button @click="modalCreateHive = true" class="
    flex justify-center
    items-center gap-4 
    mb-4 
    border-zinc-900 bg-white 
    text-zinc-900 border-2 
    rounded-xl py-2 
    font-semibold w-full lg:w-72
    mr-5 hover:bg-zinc-900 
    hover:text-white">
        <svg width="16" height="16" viewBox="0 0 12 12" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
            <path d="M0 6H6M12 6H6M6 6V0M6 6V12" stroke="currentColor" stroke-linecap="round"/>
        </svg>
        Ajouter une ruche
    </button>


    <Modal v-show="modalCreateHive" @close="modalCreateHive = false">
        <div class="container">
            <form @submit.prevent="submit" class="mx-8">
                <h4 class="mb-5 text-center text-2xl font-bold text-zinc-900">Nouvelle ruche</h4>
                <BreezeLabel for="name" value="Nom" class=" font-bold text-base mt-4 lg:mt-0 text-zinc-900 "/>
                <BreezeInput v-model="createHiveForm.name" placeholder="Ruche" id="name" type="text"
                    class="mt-1 block w-full" required/>

                <BreezeLabel for="date_queen" value="Date de la reine" class=" font-bold text-base mt-4 lg:mt-0 text-zinc-900 "/>
                <BreezeInput v-model="createHiveForm.date_queen" id="date_queen" type="date"
                    class="mt-1 block w-full"/>

                <div v-if="createHiveForm.date_queen != null">
                    <BreezeLabel for="color_queen" value="Couleur de la reine" class="font-bold text-base mt-4 lg:mt-0 text-zinc-900"/>
                    <!-- Color picker input-->
                    <div class="color-input-container flex flex-row gap-2 items-center">
                            <input v-model="createHiveForm.color_queen" 
                            class="mt-1 w-10 h-10 border-zinc-300 
                            focus:border-amber-400 focus:ring-amber-400 
                            rounded-md shadow-sm"
                            type="color" name="color_picker" id="color_queen">
                            
                            <!-- if color queen is not white print value if not print "pas de couleur" in ternary condition-->
                            <p v-if="createHiveForm.color_queen != '#ffffff'" >Couleur actuelle : {{ createHiveForm.color_queen }}</p>
                            <p v-else>Aucune couleur</p>


                    </div>
                </div>
                
                <BreezeLabel value="Hausse" class=" font-bold text-base mt-4 lg:mt-0 text-zinc-900 "/>
                <!-- make 2 radio buttons yes or no -->
                <div class="flex items-center gap-4">
                    <label for="yes">
                        <input class="border-zinc-300 checked:bg-amber-400 checked:hover:bg-amber-400 focus:bg-amber-400 focus:outline-none focus:ring-1 focus:ring-amber-400 checked:focus:bg-amber-400 checked:active:bg-amber-400 shadow-sm mr-1" 
                        v-model="createHiveForm.rise" type="radio" id="yes" name="rise" value="true">
                        Oui
                    </label>
                    <label for="no">
                        <input class="border-zinc-300 checked:bg-amber-400 checked:hover:bg-amber-400 focus:bg-amber-400 focus:outline-none focus:ring-1 focus:ring-amber-400 checked:focus:bg-amber-400 checked:active:bg-amber-400 shadow-sm mr-1" 
                        v-model="createHiveForm.rise" type="radio" id="no" name="rise" value="false">
                        Non
                    </label>
                </div>



                <div class="flex justify-between gap-4">
                    <div class="grow">
                        <BreezeLabel for="max_nb_frames" value="Nombre de cadres maximal" class=" font-bold text-base mt-4 lg:mt-0 text-zinc-900 " />
                        <BreezeInput v-model="createHiveForm.max_nb_frames" placeholder="5" id="max_nb_frames" type="number" min="0" max="24"
                        @input="maxNumberChange"
                            class="mt-1 block w-full"/>
                    </div>
                    <div class="grow">
                        <BreezeLabel for="nb_varroa" value="Nombre de varroas" class=" font-bold text-base mt-4 lg:mt-0 text-zinc-900 "/>
                        <BreezeInput v-model="createHiveForm.nb_varroa" placeholder="25" id="nb_varroa" type="number" min="0" max="500"
                            class="mt-1 block w-full"/>
                    </div>
                </div>

                <div v-if="createHiveForm.max_nb_frames > 0">
                    <BreezeLabel for="nb_frames" value="Placement des cadres" class=" font-bold text-base mt-4 lg:mt-0 text-zinc-900 " />
                    <div class="frames-indicator grow flex items-start justify-between pt-[2px] pb-[2px]" >
                        <div v-for="(value, index) in selectedValues" 
                        :key="index"
                        @click="toggleColor(index)"
                        class="flex flex-col gap-1 justify-center items-center">
                            <!-- if value if empty text is "-", if frame "c", and if separator "s"-->

                            <div
                            class="w-4 h-[40px] rounded cursor-pointer"
                            :class="value === 'empty' ? 'bg-[#AFAC99]' : value === 'frame' ? 'bg-amber-400' : 'bg-zinc-900'">
                            </div>

                            <div class="w-4 h-full rounded-md">
                                <!-- if value is empty pprint "-", if frame "c", and if separator "s"-->
                                <p class="text-center text-s font-bold text-zinc-900" :class="value === 'empty' ? 'text-zinc-900' : value === 'frame' ? 'text-white' : 'text-white'">
                                    {{ value === 'empty' ? ' ' : value === 'frame' ? 'c' : 's' }}</p>
                            </div>

                        </div>
                    </div>
                </div>
                

                <button type="submit" :class="{ 'opacity-25': createHiveForm.processing }"
                    :disabled="createHiveForm.processing"
                    class="mb-4 mt-8 bg-amber-400 border-amber-400 text-black font-semibold border-4 py-2 w-full hover:bg-amber-300 hover:border-amber-300">
                    Confirmer
                </button>
            </form>

            <div class="text-center">
                <button @click="modalCreateHive = false" class="text-red-1 font-semibold">Annuler</button>
            </div>
        </div>
    </Modal>




</template>

<script>
import Modal from "@/Components/Modal.vue";
import { useForm } from "@inertiajs/inertia-vue3";
import BreezeLabel from "@/Components/InputLabel.vue";
import BreezeInput from "@/Components/TextInput.vue";
import Swal from "sweetalert2";

export default {
    name: "HiveCreate",
    components: {
        Modal,
        BreezeLabel,
        BreezeInput
    },
    props: ['apiary_id'],
    data: function () {
        return {
            selectedValues: null,
            modalCreateHive: false,
            createHiveForm: useForm({
                name: null,
                date_queen: null,
                color_queen: '#ffffff',
                treatment: 'none',
                rise: null,
                max_nb_frames: null,
                frames_slots: null,
                nb_varroa: null,
                apiary: this.apiary_id,
            }),
        }
    },
    methods: {
        maxNumberChange() {
            // if max_nb_frames is changed, set selectedValues to same sized array of empty values if selectedValues is null else keep the same values but with the new size if its smaller, if its bigger, keep the same values but with the new size
            if (this.createHiveForm.max_nb_frames != null) {
                if (this.selectedValues == null) {
                    this.selectedValues = Array(this.createHiveForm.max_nb_frames).fill('empty')
                } else {
                    if (this.selectedValues.length < this.createHiveForm.max_nb_frames) {
                        this.selectedValues = this.selectedValues.concat(Array(this.createHiveForm.max_nb_frames - this.selectedValues.length).fill('empty'))
                    } else if (this.selectedValues.length > this.createHiveForm.max_nb_frames) {
                        this.selectedValues = this.selectedValues.slice(0, this.createHiveForm.max_nb_frames)
                    }
                }
            }

        },
        toggleColor(index) {
            const value = this.selectedValues[index];  

            if (value === 'empty') {
                this.selectedValues[index] = 'frame';
            } else if (value === 'frame') {
                this.selectedValues[index] = 'separator';
            } else {
                this.selectedValues[index] = 'empty';
            }

            //Recréer le if au dessus pour gérer le fait que si on clique et passe un input en séparateur, alors les input à sa gauche ou à sa droite dépendament de si le séparateur est sur la première ou la deuxième moitié de la liste repassent en mode empty
            if (this.selectedValues[index] === 'separator') {
                if (index < this.selectedValues.length / 2) {
                    // if separator is in first half of the list, set all values to empty before the separator
                    for (let i = 0; i < index; i++) {
                        this.selectedValues[i] = 'empty'
                    }
                } else {
                    for (let i = index + 1; i < this.selectedValues.length; i++) {
                        this.selectedValues[i] = 'empty'
                    }
                }
            }

            // Si on clique pour ajouter une frame dans la première moitié de la liste il faut s'assurer qu'il n'y a pas de plus loins dans la meme moitié de la liste et inversentant dans la deuxième moitié de la liste
            if (this.selectedValues[index] === 'frame') {
                if (index < this.selectedValues.length / 2) {
                    // if separator is in first half of the list, set all values to empty before the separator
                    for (let i = index; i < this.selectedValues.length / 2; i++) {
                        if (this.selectedValues[i] === 'separator') {
                            this.selectedValues[index] = 'empty'
                        }
                    }
                } else {
                    for (let i = index; i > this.selectedValues.length / 2; i--) {
                        if (this.selectedValues[i] === 'separator') {
                            this.selectedValues[index] = 'empty'
                        }
                    }
                }
            }


           console.log(this.createHiveForm.nb_frames = this.selectedValues.join(',').replaceAll('empty', 'e').replaceAll('frame', 'c').replaceAll('separator', 's'));
            

        },
        submit() {
            // format date_queen if not null
            if (this.createHiveForm.date_queen != null) {

                this.createHiveForm.date_queen = this.createHiveForm.date_queen.split('-').reverse().join('/')
                console.log(this.createHiveForm.date_queen)
            }


            //format selectedValues to string to send to backend
            if (this.selectedValues != null) {
                //format to smaller text, keep only first letter of each word
                this.createHiveForm.frames_slots = this.selectedValues.join(',').replaceAll('empty', 'e').replaceAll('frame', 'c').replaceAll('separator', 's')
            }


            console.log(this.createHiveForm)
            this.createHiveForm.rise = this.createHiveForm.rise === 'true' ? true : false

            this.createHiveForm.post(route('hive.store'), {
                preserveState: false,
                onSuccess() {
                    console.log('success');
                    Swal.fire({
                        icon: 'success',
                        title: 'Ruche créé avec succès',
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3500,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                            toast.addEventListener('mouseenter', Swal.stopTimer)
                            toast.addEventListener('mouseleave', Swal.resumeTimer)
                        }
                    })
                },onError: () => {

                        console.log('error');
                        let error = Object.values(this.createHiveForm.errors)[0];
                        Swal.fire({
                            icon: 'error',
                            title: 'Erreur',
                            text: error,
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 3500,
                            timerProgressBar: true,
                            didOpen: (toast) => {
                                toast.addEventListener('mouseenter', Swal.stopTimer)
                                toast.addEventListener('mouseleave', Swal.resumeTimer)
                            }
                        });
                    }
            })
        }
    },
}
</script>

<style scoped>

</style>

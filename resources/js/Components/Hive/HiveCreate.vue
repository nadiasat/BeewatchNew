<template>


    <button @click="modalCreateHive = true" class="flex justify-center items-center gap-4 mb-4 border-zinc-900 bg-white text-zinc-900 border-2 rounded-xl py-2 font-semibold w-72 mr-5 hover:bg-zinc-900 hover:text-white">
        <svg width="16" height="16" viewBox="0 0 12 12" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
            <path d="M0 6H6M12 6H6M6 6V0M6 6V12" stroke="#181818" stroke-linecap="round"/>
        </svg>
        Ajouter une ruche
    </button>


    <Modal v-show="modalCreateHive" @close="modalCreateHive = false">
        <div class="container">
            <form @submit.prevent="submit" class="mx-8">
                <h4 class="mb-5 text-center text-2xl font-semibold">Nouvelle ruche</h4>
                <BreezeLabel for="name" value="Nom" />
                <BreezeInput v-model="createHiveForm.name" placeholder="Ruche" id="name" type="text"
                    class="mt-1 block w-full" required/>

                <BreezeLabel for="date_queen" value="Date de la reine" />
                <BreezeInput v-model="createHiveForm.date_queen" id="date_queen" type="date"
                    class="mt-1 block w-full"/>

                
                <BreezeLabel value="Hausse" />
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
                        <BreezeLabel for="nb_frames" value="Nombre de cadres" />
                        <BreezeInput v-model="createHiveForm.nb_frames" placeholder="5" id="nb_frames" type="number" min="0" max="12"
                            class="mt-1 block w-full"/>
                    </div>
                    <div class="grow">
                        <BreezeLabel for="nb_varroa" value="Nombre de varroas" />
                        <BreezeInput v-model="createHiveForm.nb_varroa" placeholder="25" id="nb_varroa" type="number" min="0" max="500"
                            class="mt-1 block w-full"/>
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
            modalCreateHive: false,
            createHiveForm: useForm({
                name: null,
                date_queen: null,
                rise: null,
                nb_frames: null,
                nb_varroa: null,
                apiary: this.apiary_id,
            }),
        }
    },
    methods: {
        submit() {
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
                }
            })
        }
    },
    mounted() {
        console.log(this.apiary_id)
    }
}
</script>

<style scoped>

</style>

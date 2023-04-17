<template>
    <div @click="modalUpdateApiary = true"
        class="btn-edit-hive rounded-md flex 
        items-center justify-center 
        self-stretch px-12 py-2 border-solid 
        border-zinc-900 border-2
        text-zinc-900 
        hover:text-white hover:bg-zinc-900
        cursor-pointer">
        <svg width="21" height="21" viewBox="0 0 21 21" 
        fill="none" xmlns="http://www.w3.org/2000/svg"
        class="w-4 h-4 mr-2">
            <path d="M3.54862 17.5379L3.60417 17.3712L3.71527 17.4823L3.54862 17.5379Z" stroke="currentColor" stroke-width="4"/>
            <path d="M17.8215 1.34072L19.7469 3.26613C20.3144 3.83362 20.3144 4.75371 19.7469 5.3212L8.59066 16.4774L4.61018 12.4969L15.7664 1.34072C16.3339 0.773227 17.254 0.773227 17.8215 1.34072Z" stroke="currentColor"/>
        </svg>
        
        <p class="btn-edit-hive-text font-medium text-center text-sm">Modifier le rucher </p>

    </div>


    <Modal v-show="modalUpdateApiary" @close="modalUpdateApiary = false">
        <div class="container">
            <form @submit.prevent="updateApiary(apiary)" 
            class="mx-8">
                <h4 class="mb-5 text-center text-2xl font-semibold">Modification rucher</h4>

                <BreezeLabel for="name" value="Nom" class="font-bold text-base mt-4 lg:mt-0 text-zinc-900" />
                <!-- create a textbox with apiary value -->
                <BreezeInput class="mt-1 w-full" id="name" type="text" v-model="updateApiaryForm.name" required autofocus />

                <BreezeLabel for="address" value="Adresse" class="font-bold text-base mt-4 lg:mt-0 text-zinc-900"/>
                <!-- create a textbox with apiary value -->
                <BreezeInput class="mt-1 w-full" id="address" type="text" v-model="updateApiaryForm.address" required autofocus />
                <div class="flex mt-8 mb-6 gap-8">
                    <button type="submit" :class="{ 'opacity-25': updateApiaryForm.processing }"
                        :disabled="updateApiaryForm.processing" 
                        @click="modalUpdateApiary = false"
                        class="mb-4 mt-8 bg-amber-400 border-amber-400 text-black font-semibold border-4 py-2 w-full hover:bg-amber-300 hover:border-amber-300">
                        Confirmer
                    </button>
                    <button :class="{ 'opacity-25': updateApiaryForm.processing }"
                        type="button"
                        :disabled="updateApiaryForm.processing"
                        @click="deleteApiary()"
                        class="mb-4 mt-8 bg-red-400 border-red-400 text-black font-semibold border-4 py-2 w-full hover:bg-red-300 hover:border-red-300">
                        Supprimer
                    </button>
                </div>
            </form>

            <div class="text-center">
                <button @click="modalUpdateApiary = false" class="text-red-1 font-semibold">Annuler</button>
            </div>
        </div>
    </Modal>
</template>



<script>
import Modal from "@/Components/Modal.vue";
import { useForm } from "@inertiajs/inertia-vue3";
import BreezeLabel from "@/Components/InputLabel.vue";
import BreezeInput from "@/Components/TextInput.vue";
import Swal from 'sweetalert2';

export default {
    name: "ApiaryEdit",
    props: ['apiary'],

    data(props) {
        return {
            updateApiaryForm: useForm({
                name: props.apiary.name,
                address: props.apiary.address,
            }),
            modalUpdateApiary: false,
        }
    },
    methods: {
        updateApiary(apiary) {
            console.log("UPDATE APIARY");
            this.updateApiaryForm.put(route('apiary.update', apiary), {
                preserveState: false,
                onSuccess: () => {
                    console.log('success');
                    Swal.fire({
                        icon: 'success',
                        title: 'Rucher modifié avec succès',
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
            });
        },
        deleteApiary() {
            Swal.fire({
                title: "Voulez-vous vraiment supprimer cet événement ?",
                text: "Cette action est irréversible.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d93131',
                confirmButtonText: "Confirmer",
                cancelButtonText: "Annuler"
            }) .then((result) => {
                if (result.isConfirmed) {
                    this.updateApiaryForm.delete(route('apiary.destroy', this.apiary), {
                        preserveState: false,
                        onSuccess: () => {
                            console.log('success');
                            Swal.fire({
                                icon: 'success',
                                title: 'Rucher supprimé avec succès',
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
                    });
                }
            });
        }
    },
    components: {
        Modal,
        BreezeLabel,
        BreezeInput,
    },
    mounted() {
        console.log(this.apiary);
    }
}
</script>
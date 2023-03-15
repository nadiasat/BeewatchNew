<template>
    <div @click="modalUpdateApiary = true"
        class="btn-edit-hive rounded-md flex items-center justify-center self-stretch px-12 py-2 border-solid border-black border-2">
        <img alt="" class="edit-icon w-4 h-4 mr-2"
            src="https://static.overlay-tech.com/assets/7d7cec2a-72c6-4360-b376-ef7e694a0092.svg" />

        <p class="btn-edit-hive-text font-medium text-black text-center text-sm">Modifier le rucher </p>

    </div>


    <Modal v-show="modalUpdateApiary" @close="modalUpdateApiary = false">
        <div class="container">
            <form @submit.prevent="updateApiaryForm.put(route('apiary.update', apiary))" class="mx-8">
                <h4 class="mb-5 text-center text-2xl font-semibold">Modification rucher</h4>

                <BreezeLabel for="apiaries" value="Nom" />
                <!-- create a textbox with apiary value -->
                <BreezeInput id="name" type="text" v-model="updateApiaryForm.name" required autofocus />

                <BreezeLabel for="apiaries" value="Adresse" />
                <!-- create a textbox with apiary value -->
                <BreezeInput id="address" type="text" v-model="updateApiaryForm.address" required autofocus />

                <button type="submit" :class="{ 'opacity-25': updateApiaryForm.processing }"
                    :disabled="updateApiaryForm.processing" 
                    @click="modalUpdateApiary = false"
                    class="mb-4 mt-8 bg-amber-400 border-amber-400 text-black font-semibold border-4 py-2 w-full hover:bg-amber-300 hover:border-amber-300">
                    Confirmer
                </button>
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
        updateApiary() {

            console.log("UPDATE APIARY");
            updateApiaryForm.put(route('apiary.update', apiary), {
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
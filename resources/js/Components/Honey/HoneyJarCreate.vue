<template>


    <button @click="modalCreateJar = true" class="flex justify-center items-center mb-4 border-zinc-900 bg-white text-zinc-900 border-2 rounded-xl py-2 font-semibold w-full lg:w-72 mr-5 hover:bg-zinc-900 hover:text-white">
        <svg class="fill-zinc-900 mr-4" width="16" height="16" viewBox="0 0 12 12" xmlns="http://www.w3.org/2000/svg">
            <path d="M0 6H6M12 6H6M6 6V0M6 6V12" stroke="currentColor"/>
        </svg>
        Ajouter un nouveau type de pot

    </button>

    <Modal v-show="modalCreateJar" @close="modalCreateJar = false">
        <div class="container">
            <form @submit.prevent="submit" class="mx-8">
                <h4 class="mb-5 text-center text-2xl font-semibold">Nouveau type de pot</h4>
                <BreezeLabel for="name" value="Type" class="font-bold text-base mt-4 lg:mt-0 text-zinc-900" />
                <BreezeInput v-model="createJarForm.size" placeholder="100g" id="name" type="text"
                    class="mt-1 block w-full" required autocomplete="name"/>

                <BreezeLabel for="address" value="Nombre de pots" class="font-bold text-base mt-4 lg:mt-0 text-zinc-900" />
                <BreezeInput v-model="createJarForm.nb_jar" id="address" type="number" min="0" max="100"
                    class="mt-1 block w-full" required autocomplete="address"/>

                <button type="submit" :class="{ 'opacity-25': createJarForm.processing }"
                    :disabled="createJarForm.processing"
                    class="mb-4 mt-8 bg-amber-400 border-amber-400 text-black font-semibold border-4 py-2 w-full hover:bg-amber-300 hover:border-amber-300">
                    Confirmer
                </button>
            </form>

            <div class="text-center">
                <button @click="modalCreateJar = false" class="text-red-1 font-semibold">Annuler</button>
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
    name: "ApiaryCreate",
    components: {
        Modal,
        BreezeLabel,
        BreezeInput
    },
    data: function () {
        return {
            modalCreateJar: false,
            createJarForm: useForm({
                size: null,
                nb_jar: null
            }),
        }
    },
    methods: {
        submit() {
            this.createJarForm.post(route('inventoryHoney.store'), {
                preserveState: false,
                onSuccess() {
                    console.log('success');
                    Swal.fire({
                        icon: 'success',
                        title: 'Type de pot créé avec succès',
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
    }
}
</script>

<style scoped>

</style>

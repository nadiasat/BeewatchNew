<template>


    <button @click="modalCreateDocument = true" class="flex justify-center items-center mb-4 border-zinc-900 bg-white text-zinc-900 border-2 rounded-xl py-2 font-semibold w-full lg:w-72 mr-5 hover:bg-zinc-900 hover:text-white">
        <svg class="fill-zinc-900 mr-4" width="16" height="16" viewBox="0 0 12 12" xmlns="http://www.w3.org/2000/svg">
            <path d="M0 6H6M12 6H6M6 6V0M6 6V12" stroke="currentColor"/>
        </svg>
        Ajouter un document

    </button>




    <Modal v-show="modalCreateDocument" @close="modalCreateDocument = false">
        <div class="container">
            <form @submit.prevent="submit" class="mx-8">
                <h4 class="mb-5 text-center text-2xl font-semibold">Nouveau document</h4>
                <BreezeLabel for="document" value="Nom" class="font-bold text-base mt-4 lg:mt-0 text-zinc-900" />
                <input type="file" name="document" id="document"
                v-on:change="selectFile($event)"
                class="mt-1 block w-full" required 
                accept=".pdf"
                >
                <!-- <BreezeInput placeholder="Rucher 1" id="document" type="text"
                    class="mt-1 block w-full" required autocomplete="name"/> -->
                <BreezeLabel for="name" value="Nom du document" class="font-bold text-base mt-4 lg:mt-0 text-zinc-900" />
                <BreezeInput placeholder="Type de document" id="name" type="text"
                    v-model="documentForm.name"
                    class="mt-1 block w-full" required />

                <BreezeLabel for="documentType" value="Type de document" class="font-bold text-base mt-4 lg:mt-0 text-zinc-900" />
                <BreezeInput placeholder="Type de document" id="documentType" type="text"
                    v-model="documentForm.documentType"
                    class="mt-1 block w-full" required />
                
                <BreezeLabel for="description" value="Description du document" class="font-bold text-base mt-4 lg:mt-0 text-zinc-900" />
                <BreezeInput placeholder="Type de document" id="documentType" type="text"
                    v-model="documentForm.description"
                    class="mt-1 block w-full" required />
                
                
                <button type="submit"
                    
                    class="mb-4 mt-8 bg-amber-400 border-amber-400 text-black font-semibold border-4 py-2 w-full hover:bg-amber-300 hover:border-amber-300">
                    Confirmer
                </button>
            </form>

            <div class="text-center">
                <button @click="modalCreateDocument = false" class="text-red-1 font-semibold">Annuler</button>
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
    props: ['documents'],
    components: {
        Modal,
        BreezeLabel,
        BreezeInput
    },
    data: function () {
        return {
            documentForm: useForm({
                name: null,
                document: null,
                documentType: null,
                description: null,
            }),
            modalCreateDocument: false,
        }
    },
    methods: {

        selectFile(e) {
            console.log(e.target.files[0]);
            this.document = e.target.files[0];
            this.documentForm.document = e.target.files[0];
            //get file name but remove the extension
            this.documentForm.name = e.target.files[0].name.split('.').slice(0, -1).join('.');
        },
        submit() {
            console.log(this.documentForm);
            
            this.documentForm.post(route('documents.store'), {
                preserveState: false,
                onSuccess() {
                    console.log('success');
                    Swal.fire({
                        icon: 'success',
                        title: 'Document ajouté avec succès',
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
                },
            })
        }
    }
}
</script>

<style scoped>

</style>

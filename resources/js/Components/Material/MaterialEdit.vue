<template>

    <button @click="click()"  class="flex items-center rounded-xl text-sm border-2 border-zinc-900 px-2 py-2 text-zinc-900 font-semibold mr-3 hover:bg-zinc-900 hover:text-white">
        <svg width="10" height="12" viewBox="0 0 10 12" xmlns="http://www.w3.org/2000/svg"
        class="w-4 h-4">
            <path d="M0.501622 10.5325L1.10616 8.67699L2.32077 9.91963L0.500056 10.5405L0.500003 10.5398C0.500015 10.5395 0.500095 10.5372 0.501622 10.5325ZM8.26577 1.60164L9.21365 2.5714C9.40978 2.77206 9.40978 3.102 9.21365 3.30266L3.81906 8.82174L2.17237 7.13704L7.58291 1.60165C7.77281 1.40736 8.07587 1.40736 8.26577 1.60164Z" stroke="currentColor"/>
        </svg>
    </button>

    <Modal v-show="modalUpdateMaterial" @close="modalUpdateMaterial = false">
        <div class="container">
            <form @submit.prevent="updateMaterial()" class="mx-8">
                <h4 class="mb-5 text-center text-2xl font-semibold">Modifier le matériel</h4>

                <BreezeLabel for="name" value="Nom" class="font-bold text-base mt-4 lg:mt-0 text-zinc-900" />
                <BreezeInput v-model="updateMaterialForm.name" placeholder="Nom du lieu" id="name" type="text"
                class="mt-1 block w-full" required />

                <div class="flex justify-between gap-4">
                    <div class="grow">
                        <BreezeLabel for="edit_nb_current_stock" value="Stock actuel" class=" font-bold text-base mt-4 lg:mt-0 text-zinc-900 " />
                        <BreezeInput v-model="updateMaterialForm.current_stock" id="edit_nb_current_stock" type="number" min="0" max="500"
                            class="mt-1 block w-full"/>
                    </div>
                    <div class="grow">
                        <BreezeLabel for="edit_nb_max_stock" value="Stock maximal" class=" font-bold text-base mt-4 lg:mt-0 text-zinc-900 "/>
                        <BreezeInput v-model="updateMaterialForm.max_stock" id="edit_nb_max_stock" type="number" min="0" max="500"
                            class="mt-1 block w-full"/>
                    </div>
                </div>

                <div class="flex mt-8 gap-8">
                    <button type="submit" :class="{ 'opacity-25': updateMaterialForm.processing }"
                    :disabled="updateMaterialForm.processing"
                     
                    class="mb-4 mt-8 bg-amber-400 border-amber-400 text-black font-semibold border-4 py-2 w-full hover:bg-amber-300 hover:border-amber-300">
                    Confirmer
                    </button>
                </div>
                
            </form>

            <div class="text-center">
                <button @click="modalUpdateMaterial = false" class="text-red-1 font-semibold">Annuler</button>
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
    name: "MaterialEdit",
    props: {
        material: {
            type: Object,
        }
    },
    data: function (props) {
         return {
             updateMaterialForm: useForm({
                id: props.material.id,
                name: props.material.name,
                current_stock: props.material.current_stock,
                max_stock: props.material.max_stock,
            }),
            modalUpdateMaterial: false,

         };
    },
    methods: {
        updateMaterial() {
            console.log(this.updateMaterialForm);

            if (this.updateMaterialForm.current_stock > this.updateMaterialForm.max_stock) {
                Swal.fire({
                    icon: 'error',
                    title: 'Le stock actuel ne peut pas être supérieur au stock maximal !',
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
                //set stock to null
                this.updateMaterialForm.current_stock = null;
                return;
            }

            this.updateMaterialForm.put(route('inventoryMaterial.update', this.material), {
                preserveState: false,
                onSuccess() {
                    console.log('success');
                    Swal.fire({
                        icon: 'success',
                        title: 'Matériel modifié avec succès',
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

            this.modalUpdateMaterial = false;
        }, 
        click() {
            console.log('click');
            this.modalUpdateMaterial = true;
        }

    },
    components: {
        Modal,
        BreezeLabel,
        BreezeInput,
    },
    mounted() {
        //console.log(this.material);
    }
};



</script>
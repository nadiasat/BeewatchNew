<template>

    <button @click="openModal()"  class="flex items-center rounded-xl text-sm border-2 border-zinc-900 bg-white px-2 py-2 text-zinc-900 font-semibold mr-3 hover:bg-zinc-900 hover:text-white">
        <svg width="10" height="12" viewBox="0 0 10 12" xmlns="http://www.w3.org/2000/svg"
        class="w-4 h-4">
            <path d="M0.501622 10.5325L1.10616 8.67699L2.32077 9.91963L0.500056 10.5405L0.500003 10.5398C0.500015 10.5395 0.500095 10.5372 0.501622 10.5325ZM8.26577 1.60164L9.21365 2.5714C9.40978 2.77206 9.40978 3.102 9.21365 3.30266L3.81906 8.82174L2.17237 7.13704L7.58291 1.60165C7.77281 1.40736 8.07587 1.40736 8.26577 1.60164Z" stroke="currentColor"/>
        </svg>
    </button>

    <Modal v-show="modalUpdateInventoryPlace" @close="modalUpdateInventoryPlace = false">
        <div class="container">
            <form @submit.prevent="updateInventoryPlace()" class="mx-8">
                <h4 class="mb-5 text-center text-2xl font-semibold">Modifier le lieu de stockage</h4>

                <BreezeLabel for="name" value="Nom" class="font-bold text-base mt-4 lg:mt-0 text-zinc-900" />
                <BreezeInput v-model="updateInventoryPlaceForm.name" placeholder="Nom du lieu" id="name" type="text"
                class="mt-1 block w-full" required />

                <BreezeLabel for="address" value="Adresse" class="font-bold text-base mt-4 lg:mt-0 text-zinc-900" />
                <BreezeInput v-model="updateInventoryPlaceForm.address" placeholder="10 rue des Tartampions" id="address" type="text"
                class="mt-1 block w-full" required />

                <div class="flex mt-8 mb-6 gap-8">
                    <button type="submit" :class="{ 'opacity-25': updateInventoryPlaceForm.processing }"
                    :disabled="updateInventoryPlaceForm.processing"
                    @click="modalUpdateInventoryPlace = false" 
                    class="mb-4 mt-8 bg-amber-400 border-amber-400 text-black font-semibold border-4 py-2 w-full hover:bg-amber-300 hover:border-amber-300">
                    Confirmer
                </button>
                <button :class="{ 'opacity-25': updateInventoryPlaceForm.processing }"
                        type="button"
                        :disabled="updateInventoryPlaceForm.processing"
                        @click="deleteInventoryPlace()"
                        class="mb-4 mt-8 bg-red-400 border-red-400 text-black font-semibold border-4 py-2 w-full hover:bg-red-300 hover:border-red-300">
                        Supprimer
                    </button>
                </div>
                
            </form>

            <div class="text-center">
                <button @click="modalUpdateInventoryPlace = false" class="text-red-1 font-semibold">Annuler</button>
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
    name: "InventoryPlaceEdit",
    props: {
        inventory_place: {
            type: Object,
        }
    },
    data: function (props) {
         return {
             updateInventoryPlaceForm: useForm({
                 id: props.inventory_place.id,
                 name: props.inventory_place.name,
                 address: props.inventory_place.address,
            }),
            modalUpdateInventoryPlace: false,

         };
    },
    methods: {
        updateInventoryPlace() {
            this.updateInventoryPlaceForm.put(route('inventoryPlace.update', this.inventory_place), {
                preserveState: false,
                onSuccess() {
                    console.log('success');
                    Swal.fire({
                        icon: 'success',
                        title: 'Lieu de stockage modifié avec succès',
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
        }, 
        deleteInventoryPlace() {
            Swal.fire({
                title: "Voulez-vous vraiment supprimer ce lieu de stockage ?",
                text: "Cette action est irréversible. Tous le matériel associés seront supprimés.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d93131',
                confirmButtonText: "Confirmer",
                cancelButtonText: "Annuler"
            }) .then((result) => {
                if (result.isConfirmed) {
                    console.log(this.inventory_place);
                    this.updateInventoryPlaceForm.delete(route('inventoryPlace.destroy', this.inventory_place), {
                        preserveState: false,
                        onSuccess() {
                            console.log('success');
                            Swal.fire({
                                icon: 'success',
                                title: 'Lieu de stockage supprimé avec succès',
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
            });
        },
        openModal() {
            this.updateInventoryPlaceForm.id = this.inventory_place.id;
            this.updateInventoryPlaceForm.name = this.inventory_place.name;
            this.updateInventoryPlaceForm.address = this.inventory_place.address;
            this.modalUpdateInventoryPlace = true;
        }

    },
    components: {
        Modal,
        BreezeLabel,
        BreezeInput,
    },
    mounted() {
        console.log(this.inventory_place);
    }
};



</script>
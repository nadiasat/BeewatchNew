<template>
    <Head title="Calendrier" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Calendrier</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-4">
                    <FullCalendar :options="calendarOptions" />
                    
                    <Modal v-show="modalAddEvent" @close="modalAddEvent = false">
                        <div class="container text-center ">
                            <form @submit.prevent="addEvent()" class="mx-8">
                                <h4 class="mb-5 text-2xl font-semibold">Nouvel évènement</h4>

                                <BreezeLabel for="Title" value="Titre" class="text-left"/>
                                <BreezeInput v-model="EventForm.title" placeholder="Événement 1" id="title" type="text"
                                    class="mt-1 block w-full" required/>

                                <BreezeLabel for="date_start" value="Date de début" class="text-left"/>
                                <BreezeInput v-model="EventForm.date_start" placeholder="Date de début" id="date_start" type="date"
                                    class="mt-1 block w-full" required/>

                                <BreezeLabel for="date_end" value="Date de fin" class="text-left"/>
                                <BreezeInput v-model="EventForm.date_end" placeholder="Date de fin" id="date_end" type="date"
                                    class="mt-1 block w-full" required/>

                                <button type="submit" :class="{ 'opacity-25': EventForm.processing }"
                                    :disabled="EventForm.processing"
                                    class="mb-4 mt-8 bg-amber-400 border-amber-400 text-black font-semibold border-4 py-2 w-full hover:bg-amber-300 hover:border-amber-300">
                                    Confirmer
                                </button>
                            </form>
                            <button @click="modalAddEvent = false" class="text-red-1 font-semibold">
                                Annuler
                            </button>
                        </div>
                    </Modal>

                    <Modal v-show="modalUpdateEvent" @close="modalUpdateEvent = false">
                        <div class="container text-center ">
                            <form @submit.prevent="updateEvent()" class="mx-8">
                                <h4 class="mb-5 text-2xl font-semibold">Modifier un évènement</h4>

                                <BreezeLabel for="Title" value="Titre" class="text-left"/>
                                <BreezeInput v-model="EventForm.title" placeholder="Événement 1" id="title" type="text"
                                    class="mt-1 block w-full" required/>

                                <BreezeLabel for="date_start" value="Date de début" class="text-left"/>
                                <BreezeInput v-model="EventForm.date_start" placeholder="Date de début" id="date_start" type="date"
                                    class="mt-1 block w-full" required/>

                                <BreezeLabel for="date_end" value="Date de fin" class="text-left"/>
                                <BreezeInput v-model="EventForm.date_end" placeholder="Date de fin" id="date_end" type="date"
                                    class="mt-1 block w-full" required/>

                                <div class="flex mt-8 mb-6 gap-8">
                                    <button type="submit" :class="{ 'opacity-25': EventForm.processing }"
                                        :disabled="EventForm.processing"
                                        class=" bg-amber-400 border-amber-400 text-black font-semibold border-4 py-2 w-full hover:bg-amber-300 hover:border-amber-300">
                                        Modifier
                                    </button>
                                    <button :class="{ 'opacity-25': EventForm.processing }"
                                        type="button"
                                        :disabled="EventForm.processing"
                                        @click="deleteEvent()"
                                        class="bg-red-400 border-red-400 text-black font-semibold border-4 py-2 w-full hover:bg-red-300 hover:border-red-300">
                                        Supprimer
                                    </button>
                                </div>
                            </form>
                            <button @click="modalUpdateEvent = false" class="text-red-1 font-semibold">
                                Annuler
                            </button>
                        </div>
                    </Modal>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/inertia-vue3';
import Modal from "@/Components/Modal.vue";
import { useForm } from "@inertiajs/inertia-vue3";
import Swal from 'sweetalert2';


import BreezeLabel from "@/Components/InputLabel.vue";
import BreezeInput from "@/Components/TextInput.vue";

import FullCalendar from '@fullcalendar/vue3';
import dayGridPlugin from '@fullcalendar/daygrid';
import interactionPlugin from '@fullcalendar/interaction';
import frLocale from '@fullcalendar/core/locales/fr';

export default {
    components: {
        AuthenticatedLayout,
        Head,
        FullCalendar,
        Modal,
        BreezeLabel,
        BreezeInput,
    },
    props: ['events'],
    data() {
        return {
            modalAddEvent: false,
            modalUpdateEvent: false,
            EventForm: useForm({
                id: null,
                title: null,
                date_start: null,
                date_end: null,
            }),

            calendarOptions: {
                locale: frLocale,
                plugins: [dayGridPlugin, interactionPlugin],
                initialView: 'dayGridMonth',
                selectable: true,
                events: this.events,
                headerToolbar: {
                    center: 'addEventButton'
                },
                select : function(arg) {
                    console.log(arg);
                    this.EventForm.date_start = arg.startStr;
                    this.EventForm.date_end = arg.endStr;
                }.bind(this),

                eventClick: function(info) {
                    console.log(info.event);
                    this.modalUpdateEvent = true;
                    this.EventForm.id = info.event.id;
                    this.EventForm.title = info.event.title;
                    this.EventForm.date_start = info.event.startStr;
                    this.EventForm.date_end = info.event.endStr;
                }.bind(this),


                customButtons: {
                    addEventButton: {
                        text: 'Ajouter un évènement',
                        //on click get selected values and open the modal
                        click: function() {
                            this.modalAddEvent = true;
                        }.bind(this)
                    }
                },
            },
        };
    },
    methods: {
        addEvent() {
            //Verify that the start date is before the end date
            if (this.EventForm.date_start > this.EventForm.date_end) {
                Swal.fire({
                    icon: 'error',
                    title: 'Erreur',
                    text: 'La date de début doit être antérieure à la date de fin',
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 1750,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.addEventListener('mouseenter', Swal.stopTimer)
                        toast.addEventListener('mouseleave', Swal.resumeTimer)
                    }
                })
                //empty end date
                this.EventForm.date_end = null;
                return;
            }
            this.EventForm.post(route('events.store'), {
                preserveScroll: true,
                preserveState: false,
                onSuccess() {
                    console.log('success');
                    Swal.fire({
                        icon: 'success',
                        title: 'Évènement ajouté avec succès',
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
            });
        },
        updateEvent() {
            //Verify that the start date is before the end date
            console.log("ON UPDATE");
            if (this.EventForm.date_start > this.EventForm.date_end) {
                Swal.fire({
                    icon: 'error',
                    title: 'Erreur',
                    text: 'La date de début doit être antérieure à la date de fin',
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 1750,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.addEventListener('mouseenter', Swal.stopTimer)
                        toast.addEventListener('mouseleave', Swal.resumeTimer)
                    }
                })
                //empty end date
                this.EventForm.date_end = null;
                return;
            }
            this.EventForm.put(route('events.update', this.EventForm.id), {
                preserveScroll: true,
                preserveState: false,
                onSuccess() {
                    console.log('success');
                    Swal.fire({
                        icon: 'success',
                        title: 'Évènement modifié avec succès',
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
            });
        },
        deleteEvent() {
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
                    console.log('ON EST EN TRAIN DE SUPPRIMER')
                    this.EventForm.delete(route('events.destroy', this.EventForm.id), {
                        preserveScroll: true,
                        preserveState: false,
                        onSuccess() {
                            console.log('success');
                            Swal.fire({
                                icon: 'success',
                                title: 'Évènement supprimé avec succès',
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
                    });
                }
            })
            
        },
    },
    mounted() {
        console.log(this.events);
    },
};
</script>